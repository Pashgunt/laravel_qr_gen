<?php

namespace App\Actions;

use App\Filters\FunnelConfigFilter;
use App\Http\Requests\FunnelRequest;
use App\Models\FunnelConfig;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Services\FunnelFieldService;
use App\Qr\Services\FunnelLogicService;
use Illuminate\Pipeline\Pipeline;

class EditFunnelAction
{
    public function handle(FunnelRequest $request): bool
    {
        $funnelDTO = $request->makeDTO();
        $funnelConfigID = $request->route()->parameter('funnel_id');

        app(FunnelConfigRepository::class)->updateFunnelConfig(
            FunnelConfig::filter(new FunnelConfigFilter(), [
                'funnel_id' => $funnelConfigID,
            ]),
            [
                'funnel_type_id' => $funnelDTO->getFunnelID(),
                'work_started_at' => $funnelDTO->getWorkStartDate(),
                'company_id' => $funnelDTO->getCompanyID(),
            ]
        );

        return (bool)app(Pipeline::class)
            ->send([
                'funnel_config_id' => $funnelConfigID,
                'funnel_dto' => $funnelDTO
            ])
            ->through([
                FunnelFieldService::class,
                FunnelLogicService::class
            ])
            ->via('updateFunnelPipeline')
            ->thenReturn();
    }
}
