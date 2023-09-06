<?php

namespace App\Actions;

use App\Filters\CompanyHashFilter;
use App\Filters\FeedbackFilter;
use App\QR\Services\CompanyTableHashService;
use App\QR\Services\FeedbackService;
use App\QR\Services\Rating;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ShowFeedbackAction
{
    public function handle(Request $request): array
    {
        $companyTableHashFilter = new CompanyHashFilter($request);
        $feedbackFilter = new FeedbackFilter($request);

        return app(Pipeline::class)
            ->send([])
            ->through([
                new CompanyTableHashService($companyTableHashFilter),
                new FeedbackService(null, $feedbackFilter),
                new Rating($feedbackFilter),
            ])
            ->via('showFeedbackPipeline')
            ->thenReturn();
    }
}
