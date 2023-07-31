<?php

namespace App\Qr\Abstracts;

interface Funnel
{
    public function createType(
        string $type,
        $repository
    );

    public function prepareDataForCreate(
        $funnelIDs,
        $funnelDTO = null
    );
}
