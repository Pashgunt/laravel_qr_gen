<?php

namespace App\QR\Services;

use App\QR\Abstracts\Funnel;
use App\QR\DTO\FunnelDTO;
use App\QR\Enums\FunnelEnums;

class FunnelFactory implements Funnel
{
    public function createType(
        string $type,
        $repository
    ) {
        return FunnelEnums::getAssociations()($type, $repository);
    }

    public function prepareDataForCreate(
        $funnelIDs,
        ?FunnelDTO $funnelDTO = null
    ): array {
        return [];
    }
}
