<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;

class FunnelConfigRepository extends Repositories
{
    public function createFunneConfig(
        int $funnelTypeId,
        string $workStartedAt
    ) {
        return $this->create([
            'funnel_type_id' => $funnelTypeId,
            'work_started_at' => $workStartedAt,
        ]);
    }
}
