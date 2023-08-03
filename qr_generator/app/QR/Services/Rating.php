<?php

namespace App\QR\Services;

use App\QR\Repositories\LocationFeedbackRepository;
use Closure;

class Rating
{
    public LocationFeedbackRepository $locationFeedbackRepository;

    public function __construct($locationFeedbackRepository)
    {
        $this->locationFeedbackRepository = $locationFeedbackRepository;
    }

    public function preparePipeline(array $hashCompanyData, Closure $next)
    {
        //TODO change this method for filter
        $hashCompanyData['rating'] = $this->locationFeedbackRepository->prepareAvgRatingForComapny($hashCompanyData['company']->company_id) ?? 0;
        return $next($hashCompanyData);
    }
}
