<?php

namespace App\Actions;

use App\Filters\FunnelConfigFilter;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelConfigRepository;
use App\QR\Services\FunnelFactory;

class ShowFunnelConfigAction
{
    public function handle(FunnelConfigFilter $filter): array
    {
        return (new FunnelFactory())
            ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class))
            ->prepareFunnelConfigs($filter);
    }
}
