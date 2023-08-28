<?php

namespace App\Actions;

use App\Filters\FunnelTypeFilter;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;

class ShowFunnelOptionsAction
{
    public function handle(
        FunnelTypeFilter $filter,
        array $additionalParams = []
    ): array {
        return (new FunnelFactory())
            ->createType(FunnelEnums::TYPE->value, app(FunnelTypesRepository::class))
            ->prepareFunnelFields($filter, $additionalParams);
    }
}
