<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\Services\FunnelType;

class FunnelFactory implements Funnel
{
    public function createType(string $type, $repository)
    {
        return match ($type) {
            'config' => new FunnelConfig($repository),
            'fields' => new FunnelField($repository),
            'logic' => new FunnelLogic($repository),
            'types' => new FunnelType($repository),
        };
    }

    public function prepareDataForCreate(
        $funnelIDs,
        $funnelDTO = null
    ) {
    }
}
