<?php

namespace App\Qr\Services;

use App\Filters\CompanyFilter;
use App\Models\Company;
use Closure;

class CompanyService
{

    private CompanyFilter $filters;

    public function __construct(CompanyFilter $filters)
    {
        $this->filters = $filters;
    }

    public function showCompanyPipeline(
        array $data,
        Closure $next
    ): array {
        $data['company'] = Company::filter($this->filters)->first();
        return $next($data);
    }
}
