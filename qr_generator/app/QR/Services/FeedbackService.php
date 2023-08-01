<?php

namespace App\QR\Services;

use App\Models\FunneConfig;
use App\QR\DTO\CompanyDTO;
use App\QR\DTO\TableHashDTO;
use App\QR\Enums\FunnelEnums;
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
            $isActual,
            $createdAt,
            $updatedAt,
        ) = array_values($columnNames);

        return [
            'Рейтинг' => $rating,
            'Дата создания' => $createdAt
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
}
