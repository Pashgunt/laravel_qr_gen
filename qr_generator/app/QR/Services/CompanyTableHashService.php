<?php

namespace App\Qr\Services;

use App\Filters\CompanyHashFilter;
use App\Models\Company;
use App\Models\CompanyTableHash;
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
}
