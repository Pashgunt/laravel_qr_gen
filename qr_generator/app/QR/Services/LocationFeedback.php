<?php

namespace App\QR\Services;

use App\QR\Contracts\Feedback;
use App\QR\DTO\CompanyDTO;
use App\QR\DTO\TableHashDTO;
use Closure;

class LocationFeedback implements Feedback
{
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
}
