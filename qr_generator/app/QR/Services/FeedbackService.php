<?php

namespace App\QR\Services;

use App\Models\FunneConfig;
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

class FeedbackService
{

    private LocationFeedbackRepository $locationFeedbackRepository;

    public function __construct(
        LocationFeedbackRepository $locationFeedbackRepository,
    ) {
        $this->locationFeedbackRepository = $locationFeedbackRepository;
    }

    public function preparePipeline($hashCompanyData, Closure $next)
    {
        $hashTableDTO = new TableHashDTO($hashCompanyData);
        $companyDTO = new CompanyDTO($hashCompanyData->getCompanyParams->first());
        $hashCompanyData = [
            'company_id' => $companyDTO->getCompanyID(),
            'company_name' => $companyDTO->getCompanyName(),
            'company_address' => $companyDTO->getCompanyAdress(),
            'company_link' => $companyDTO->getCompanyLink(),
            'company_table_number' => $hashTableDTO->getTableNumber(),
            'company_hash' => $hashTableDTO->getHashValue()
        ];
        return $next($hashCompanyData);
    }

    public function prepareColumnNamesForFunnelOptions()
    {
        $columnNames = $this->locationFeedbackRepository->getColumnList();
        list(
            $id,
            $comanyID,
            $tableID,
            $rating,
            $feedbackText,
            $feedbackUserName,
            $contactData,
        ) = array_values($columnNames);

        return [
            'Рейтинг' => $rating,
        ];
    }

    public function feedbackFilters(
        int $companyID,
        int $isActual,
        string $funnelType,
    ) {
        $funnelConfigs = (new FunnelFactory())
            ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class));
        return $funnelConfigs->prepareFunnelConfigs($companyID, $isActual, $funnelType);
    }

    private function checkResultFilter(string $operator, array $filterRaw, $value)
    {
        return match ($operator) {
            FunnelOperatorEnums::RANGE->value => $value >= $filterRaw['value_range_from'] && $value <= $filterRaw['value_range_to'],
            FunnelOperatorEnums::EQUAL->value => $value == $filterRaw['value'],
            FunnelOperatorEnums::EQUAL->value => $value != $filterRaw['value'],
        };
    }

    private function checkLogicResultForFilter(bool $resultFirst, ?bool $resultSecond = null, ?string $logicOperator = null)
    {
        if (is_null($resultSecond)) {
            return $resultFirst;
        }
        return match ($logicOperator) {
            FunnelLogicEnums::AND->value => $resultFirst && $resultSecond,
            FunnelLogicEnums::OR->value => $resultFirst || $resultSecond,
        };
    }

    // TODO make this logic through yield
    public function checkCorrectData(array $filters, FeedbackDTO $feedbackDTO)
    {
        if (empty($filters)) return true;

        $result = true;

        array_walk($filters, function ($filterRaw, $index) use ($filters, $feedbackDTO, &$result) {
            if (!empty($feedbackDTO->getValidatedByKey($filterRaw['field_name']))) {
                $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filterRaw['operator']]['operator'];
                $result = $this->checkLogicResultForFilter(
                    $this->checkResultFilter($operator, $filterRaw, $feedbackDTO->getValidatedByKey($filterRaw['field_name']))
                );
                if (isset($filters[$index + 1]) && !empty($feedbackDTO->getValidatedByKey($filters[$index + 1]['field_name']))) {
                    $logicOperator = $filterRaw['logic_operator'];
                    $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filters[$index + 1]['operator']]['operator'];
                    $result = $this->checkLogicResultForFilter(
                        $result,
                        $this->checkResultFilter($operator, $filters[$index + 1], $feedbackDTO->getValidatedByKey($filters[$index + 1]['field_name'])),
                        $logicOperator
                    );
                }
                if (isset($filters[$index - 1]) && !empty($feedbackDTO->getValidatedByKey($filters[$index - 1]['field_name']))) {
                    $logicOperator = $filters[$index - 1]['logic_operator'];
                    $operator = Arrays::index(FunnelOperatorEnums::getAssociations(), 'tag')[$filters[$index - 1]['operator']]['operator'];
                    $result = $this->checkLogicResultForFilter(
                        $result,
                        $this->checkResultFilter($operator, $filters[$index - 1], $feedbackDTO->getValidatedByKey($filters[$index - 1]['field_name'])),
                        $logicOperator
                    );
                }
                if (!$result) return;
            }
        }, array_keys($filters));
        return $result;
    }
}
