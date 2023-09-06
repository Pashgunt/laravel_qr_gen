<?php

namespace App\Actions;

use App\Http\Requests\FunnelRequest;
use App\QR\Repositories\FunnelConfigRepository;
use App\QR\Services\FunnelFieldService;
use App\QR\Services\FunnelLogicService;
use Illuminate\Pipeline\Pipeline;

class StoreFunnelAction
{
    public function handle(FunnelRequest $request): bool
    {
        $funnelDTO = $request->makeDTO();

        $funnelConfigID = app(FunnelConfigRepository::class)->createFunneConfig(
            $funnelDTO->getCompanyID(),
            $funnelDTO->getFunnelID(),
            $funnelDTO->getWorkStartDate()
        )->id;

        return (bool)app(Pipeline::class)
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
