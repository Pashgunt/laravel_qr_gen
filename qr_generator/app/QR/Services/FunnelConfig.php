<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;

class FunnelConfig implements Funnel
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createType(
        string $type,
        $repository
    ) {
    }

    public function prepareDataForCreate(
        $funnelIDs,
        $funnelDTO = null
    ) {
    }
}
