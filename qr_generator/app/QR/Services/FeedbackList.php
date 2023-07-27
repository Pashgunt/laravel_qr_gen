<?php

namespace App\QR\Services;

use App\QR\Repositories\LocationFeedbackRepository;
use Closure;

class FeedbackList
{
    public LocationFeedbackRepository $locationFeedbackRepository;

    public function __construct()
    {
        $this->locationFeedbackRepository = new LocationFeedbackRepository();
    }

    public function preparePipeline($hashCompanyData, Closure $next)
    {
        $hashCompanyData['feedback_list'] = $this->locationFeedbackRepository->getPaginationFeedbackList($hashCompanyData['company_id'], 5);
        return $next($hashCompanyData);
    }
}
