<?php

namespace App\Qr\Services;

use App\Filters\CompanyHashFilter;
use App\Models\CompanyTableHash;
use App\QR\Repositories\CompanyTableHashRepository;
use Closure;

class CompanyTableHashService
{

    private CompanyHashFilter $filters;

    public function __construct(CompanyHashFilter $filters)
    {
        $this->filters = $filters;
    }

    public function showFeedbackPipeline(
        array $data,
        Closure $next
    ): array {
        $data['company'] = CompanyTableHash::filter($this->filters)
            ->first();
        return $next($data);
    }

    public function saveQrCodePipeline(array $data, Closure $next): array
    {
        $repository = app(CompanyTableHashRepository::class);
        $repository->updateCompanyTableHash(
            CompanyTableHash::filter(new CompanyHashFilter(), ['company_hash_id' => $data['company_hash_id']]),
            ['is_actual' => 0]
        );
        $companyHashID = $repository->createHashForCompany(
            $data['company_id'],
            $data['table_number'],
            $data['hash_value'],
        );
        $data['company_hash_id'] = $companyHashID->id;
        return $next($data);
    }
}
