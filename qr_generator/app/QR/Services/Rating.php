<?php

namespace App\QR\Services;

use App\QR\Repositories\LocationFeedbackRepository;
use Closure;

class Rating
{
    public LocationFeedbackRepository $locationFeedbackRepository;

    public function __construct()
    {
        $this->locationFeedbackRepository = new LocationFeedbackRepository();
    }

    public function preparePipeline(array $hashCompanyData, Closure $next)
    {
        $hashCompanyData['rating'] = $this->locationFeedbackRepository->prepareAvgRatingForComapny($hashCompanyData['company_id']) ?? 0;
        return $next($hashCompanyData);
    }
}
