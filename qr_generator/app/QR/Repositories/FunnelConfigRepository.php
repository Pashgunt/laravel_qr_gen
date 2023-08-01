<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;

class FunnelConfigRepository extends Repositories
{
    public function createFunneConfig(
        int $companyID,
        int $funnelTypeId,
        string $workStartedAt
    ) {
        return $this->create([
            'company_id' => $companyID,
            'funnel_type_id' => $funnelTypeId,
            'work_started_at' => $workStartedAt,
        ]);
    }

    public function getFunnelConfig(
        int $companyID,
        int $isActual,
        string $funnelType
    ) {
        return $this->model->where([
            ['company_id', '=', $companyID],
            ['funnel_configs.is_actual', '=', $isActual],
            ['funnel_types.funnel_type_tag', '=', $funnelType],
        ])->join('funnel_fields', function ($join) use ($isActual) {
            $join->on('funnel_configs.id', '=', 'funnel_fields.funnel_config_id')
                ->where('funnel_fields.is_actual', '=', $isActual);
        })->join('funnel_logic_blocks', function ($join) {
            $join->on('funnel_fields.id', '=', 'funnel_logic_blocks.funnel_field_id');
        })->join('funnel_types', 'funnel_configs.funnel_type_id', '=', 'funnel_types.id')
            ->get();
    }
}
