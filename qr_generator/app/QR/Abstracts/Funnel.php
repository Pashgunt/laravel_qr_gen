<?php

namespace App\Qr\Abstracts;

use App\QR\DTO\FunnelDTO;

interface Funnel
{
    public function createType(
        string $type,
        $repository
    );

    public function prepareDataForCreate(
        $funnelIDs,
        ?FunnelDTO $funnelDTO = null
    );
}
