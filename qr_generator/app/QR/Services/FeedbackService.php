<?php

namespace App\QR\Services;

use App\Filters\FeedbackFilter;
use App\Filters\FunnelConfigFilter;
use App\Models\Feedback;
use App\QR\DTO\CompanyDTO;
use App\QR\DTO\FeedbackDTO;
use App\QR\DTO\TableHashDTO;
use App\QR\Enums\FunnelEnums;
use App\QR\Enums\FunnelLogicEnums;
use App\QR\Enums\FunnelOperatorEnums;
use App\QR\Helpers\Arrays;
use App\QR\Repositories\FunnelConfigRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use Closure;
use Illuminate\Http\Request;

class FeedbackService
{
    private ?LocationFeedbackRepository $locationFeedbackRepository;
    private ?FeedbackFilter $filters;

    public function __construct(
        ?LocationFeedbackRepository $locationFeedbackRepository = null,
        ?FeedbackFilter $filters = null
    ) {
        $this->locationFeedbackRepository = $locationFeedbackRepository;
        $this->filters = $filters;
    }

    public function showFeedbackPipeline(
        array $data,
        Closure $next
    ): array {
        $data['feedback_list'] = Feedback::filter(
            $this->filters,
            [
                'company_id' => $data['company']->id
            ]
        )->paginate(10);
        return $next($data);
    }

    public function showCompanyPipeline(
        array $data,
        Closure $next
    ): array {
        $data['feedback'] = Feedback::filter($this->filters)
            ->paginate(10);
        return $next($data);
    }

    public function preparePipeline(
        object $data,
        Closure $next
    ): array {
        $hashTableDTO = new TableHashDTO($data);
        $companyDTO = new CompanyDTO($data->getCompanyParams->first());
        $data = [
            'company_id' => $companyDTO->getCompanyID(),
            'company_name' => $companyDTO->getCompanyName(),
            'company_address' => $companyDTO->getCompanyAdress(),
            'company_link' => $companyDTO->getCompanyLink(),
            'company_table_number' => $hashTableDTO->getTableNumber(),
            'company_hash' => $hashTableDTO->getHashValue()
        ];
        return $next($data);
    }

    public function prepareColumnNamesForFunnelOptions(): array
    {
        $columnNames = $this->locationFeedbackRepository->getColumnList();

        return [
            'Рейтинг' => current(array_filter($columnNames, fn ($column) => preg_match('/rating/ui', $column))),
        ];
    }

    public function feedbackFilters(
        int $companyID,
        int $isActual,
        string $funnelType,
    ): array {
        $funnelConfigs = (new FunnelFactory())
            ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class));
        return $funnelConfigs->prepareFunnelConfigs(
            new FunnelConfigFilter(app(Request::class)),
            [
                'company_id' => $companyID,
                'is_actual' => $isActual,
                'funnel_type' => $funnelType
            ]
        );
    }

    private function checkResultFilter(
        string $operator,
        array $filterRaw,
        int $value
    ): array {
        switch ($operator) {
            case FunnelOperatorEnums::RANGE->value:
                $result = $value >= $filterRaw['value_range_from'] && $value <= $filterRaw['value_range_to'];
                $description = !$result ?
                    sprintf(
                        'Значения поля %s не попало в промежуток от %d до %d',
                        $filterRaw['field_name'],
                        (int)$filterRaw['value_range_from'],
                        (int)$filterRaw['value_range_to']
                    )
                    : '';
                return compact('result', 'description');
                break;
            case FunnelOperatorEnums::EQUAL->value:
                $result = $value == $filterRaw['value'];
                $description = !$result ?
                    sprintf(
                        'Значение поля %s не равно %d',
                        $filterRaw['field_name'],
                        (int)$filterRaw['value']
                    )
                    : '';
                return compact('result', 'description');
                break;
            case FunnelOperatorEnums::NOT_EQUAL->value:
                $result = $value != $filterRaw['value'];
                $description = !$result ?
                    sprintf(
                        'Значение поля %s должно быть равно %d',
                        $filterRaw['field_name'],
                        (int)$filterRaw['value']
                    )
                    : '';
                return compact('result', 'description');
                break;
        }

        return [
            'result' => true,
            'description' => '',
        ];
    }

    private function checkLogicResultForFilter(
        bool $resultFirst,
        ?bool $resultSecond = null,
        ?string $logicOperator = null
    ): bool {
        if (is_null($resultSecond)) {
            return $resultFirst;
        }
        return match ($logicOperator) {
            FunnelLogicEnums::AND->value => $resultFirst && $resultSecond,
            FunnelLogicEnums::OR->value => $resultFirst || $resultSecond,
            default => $resultFirst && $resultSecond,
        };
    }

    private function checkFilterRaw(
        array $filterRaw,
        FeedbackDTO $feedbackDTO,
        array $result
    ): array {
        if (!empty($feedbackDTO->getValidatedByKey($filterRaw['field_name']))) {
            $logicOperator = $filterRaw['logic_operator'] ?? '';
            $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filterRaw['operator']]['operator'];
            $checkResutFilter = $this->checkResultFilter($operator, $filterRaw, $feedbackDTO->getValidatedByKey($filterRaw['field_name']));
            return [
                'result' => $this->checkLogicResultForFilter(
                    $result['result'],
                    $checkResutFilter['result'],
                    $logicOperator
                ),
                'description' => $checkResutFilter['description'],
            ];
        }
        return $result;
    }

    public function checkCorrectData(
        array $filters,
        FeedbackDTO $feedbackDTO
    ): array {
        if (empty($filters)) return [
            'result' => true,
            'description' => '',
        ];
        $result = [
            'result' => true,
            'description' => '',
        ];
        array_walk($filters, function ($filterRaw, $index) use ($filters, $feedbackDTO, &$result) {
            if (!empty($feedbackDTO->getValidatedByKey($filterRaw['field_name']))) {
                $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filterRaw['operator']]['operator'];
                $result['result'] = $this->checkLogicResultForFilter(
                    $this->checkResultFilter($operator, $filterRaw, $feedbackDTO->getValidatedByKey($filterRaw['field_name']))['result']
                );
                if (isset($filters[$index + 1])) {
                    $resultOfCheck = $this->checkFilterRaw($filters[$index + 1], $feedbackDTO, $result);
                    $result['result'] = $resultOfCheck['result'];
                    $result['description'] .= "{$resultOfCheck['description']} ";
                }
                if (isset($filters[$index - 1])) {
                    $resultOfCheck = $this->checkFilterRaw($filters[$index - 1], $feedbackDTO, $result);
                    $result['result'] = $resultOfCheck['result'];
                    $result['description'] .= "{$resultOfCheck['description']} ";
                }
                if (!$result) return;
            }
        }, array_keys($filters));
        if ($result['result']) $result['description'] = '';
        return $result;
    }
}
