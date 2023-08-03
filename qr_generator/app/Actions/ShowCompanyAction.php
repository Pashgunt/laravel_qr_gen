<?php

namespace App\Actions;

use App\Filters\CompanyFilter;
use App\Filters\FeedbackFilter;
use App\Filters\FunnelConfigFilter;
use App\Filters\QrLinkFilter;
use App\Qr\Services\CompanyService;
use App\QR\Services\FeedbackService;
use App\Qr\Services\FunnelConfigService;
use App\Qr\Services\QrLinkService;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ShowCompanyAction
{
    public function handle(Request $request): array
    {
        $companyFilter = new CompanyFilter($request);
        $feedbackFilter = new FeedbackFilter($request);
        $qrLinkFilter = new QrLinkFilter($request);
        $funnelConfigFilter = new FunnelConfigFilter($request);

        return app(Pipeline::class)
            ->send([])
            ->through([
                new CompanyService($companyFilter),
                new FeedbackService(null, $feedbackFilter),
                new QrLinkService($qrLinkFilter),
                new FunnelConfigService(null, $funnelConfigFilter),
            ])
            ->via('showCompanyPipeline')
            ->thenReturn();
    }
}
