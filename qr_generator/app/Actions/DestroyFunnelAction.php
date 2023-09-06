<?php

namespace App\Actions;

use App\Filters\FunnelConfigFilter;
use App\Filters\FunnelFieldFilter;
use App\Models\FunnelConfig;
use App\Models\FunnelFields;
use App\QR\Repositories\FunnelConfigRepository;
use App\QR\Repositories\FunnelFieldsRepository;
use Illuminate\Http\Request;

class DestroyFunnelAction
{
    public function handle(Request $request): bool
    {
        $resOfUpdateConfig = app(FunnelConfigRepository::class)
            ->updateFunnelConfig(
                FunnelConfig::filter(new FunnelConfigFilter($request)),
                ['is_actual' => 0]
            );
        if (!$resOfUpdateConfig) return false;
        $resOfUpdateFields = app(FunnelFieldsRepository::class)
            ->updateFunnelField(
                FunnelFields::filter(new FunnelFieldFilter($request)),
                ['is_actual' => 0]
            );
        if (!$resOfUpdateFields) return false;
        return true;
    }
}
