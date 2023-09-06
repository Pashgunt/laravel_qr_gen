<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class FunnelConfigRepository extends Repositories
{
    public function createFunneConfig(
        int $companyID,
        int $funnelTypeId,
        string $workStartedAt
    ): Model {
        return $this->create([
            'company_id' => $companyID,
            'funnel_type_id' => $funnelTypeId,
            'work_started_at' => $workStartedAt,
        ]);
    }

    public function updateFunnelConfig($raw, array $update)
    {
        return $this->update($raw, $update);
    }
}
