<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\Enums\FunnelEnums;
use App\QR\Services\FunnelType;

class FunnelFactory implements Funnel
{
    public function createType(string $type, $repository)
    {
        return FunnelEnums::getAssociations()($type, $repository);
    }

    public function prepareDataForCreate(
        $funnelIDs,
        $funnelDTO = null
    ) {
    }
}
