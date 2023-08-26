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
use App\Qr\Helpers\Arrays;
use App\Qr\Repositories\FunnelConfigRepository;
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
            ['company_id' => $data['company']->id]
        )->paginate(10);
        return $next($data);
    }

    public function showCompanyPipeline(
        array $data,
        Closure $next
    ): array {
        $data['feedback'] = Feedback::filter($this->filters)->paginate(10);
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
    ): bool {
        return match ($operator) {
            FunnelOperatorEnums::RANGE->value => $value >= $filterRaw['value_range_from'] && $value <= $filterRaw['value_range_to'],
            FunnelOperatorEnums::EQUAL->value => $value == $filterRaw['value'],
            FunnelOperatorEnums::EQUAL->value => $value != $filterRaw['value'],
        };
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
        };
    }

    private function checkFilterRaw(
        array $filterRaw,
        FeedbackDTO $feedbackDTO,
        bool $result
    ): bool {
        if (isset($filterRaw) && !empty($feedbackDTO->getValidatedByKey($filterRaw['field_name']))) {
            $logicOperator = $filterRaw['logic_operator'];
            $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filterRaw['operator']]['operator'];

            return $this->checkLogicResultForFilter(
                $result,
                $this->checkResultFilter($operator, $filterRaw, $feedbackDTO->getValidatedByKey($filterRaw['field_name'])),
                $logicOperator
            );
        }

        return $result;
    }

    public function checkCorrectData(
        array $filters,
        FeedbackDTO $feedbackDTO
    ): bool {
        if (empty($filters)) return true;

        $result = true;
        array_walk($filters, function ($filterRaw, $index) use ($filters, $feedbackDTO, &$result) {
            if (!empty($feedbackDTO->getValidatedByKey($filterRaw['field_name']))) {
                $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filterRaw['operator']]['operator'];
                $result = $this->checkLogicResultForFilter(
                    $this->checkResultFilter($operator, $filterRaw, $feedbackDTO->getValidatedByKey($filterRaw['field_name']))
                );
                $result = $this->checkFilterRaw($filters[$index + 1], $feedbackDTO, $result) &&
                    $this->checkFilterRaw($filters[$index + 1], $feedbackDTO, $result);

                if (!$result) return;
            }
        }, array_keys($filters));

        return $result;
    }
}
