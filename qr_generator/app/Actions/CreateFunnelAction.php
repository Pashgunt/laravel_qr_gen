<?php

namespace App\Actions;

use App\QR\Services\FunnelFieldService;
use App\QR\Services\FunnelLogicService;
use App\QR\Services\FunnelTypeService;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class CreateFunnelAction
{
    public function handle(Request $request): array
    {
        return app(Pipeline::class)
            ->send([
                'company_id' => $request->get('company_id')
            ])
            ->through([
                FunnelTypeService::class,
                FunnelFieldService::class,
                FunnelLogicService::class
            ])
            ->via('createFunnelPipeline')
            ->thenReturn();
    }
}
