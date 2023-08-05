<?php

namespace App\Actions;

use App\Http\Requests\FunnelRequest;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Services\FunnelFieldService;
use App\Qr\Services\FunnelLogicService;
use Illuminate\Pipeline\Pipeline;

class StoreFunnelAction
{
    public function handle(FunnelRequest $request, int $companyID): void
    {
        $funnelDTO = $request->makeDTO();

        $funnelConfigID = app(FunnelConfigRepository::class)->createFunneConfig(
            $companyID,
            $funnelDTO->getFunnelID(),
            $funnelDTO->getWorkStartDate()
        )->id;

        app(Pipeline::class)
            ->send([
                'funnel_config_id' => $funnelConfigID,
                'funnel_dto' => $funnelDTO
            ])
            ->through([
                FunnelFieldService::class,
                FunnelLogicService::class
            ])
            ->via('storeFunnelPipeline')
            ->thenReturn();
    }
}
