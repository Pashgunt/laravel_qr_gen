<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;
use App\QR\Enums\FunnelLogicEnums;

class FunnelFieldsRepository extends Repositories
{
    public function createFunnelFields(
        int $funnelConfigId,
        string $fieldName,
        string $operator,
        ?int $value,
        ?int $valueRangeFrom,
        ?int $valueRangeTo,
    ) {
        return $this->create([
            'funnel_config_id' => $funnelConfigId,
            'field_name' => $fieldName,
            'operator' => $operator,
            'value' => $value,
            'value_range_from' => $valueRangeFrom,
            'value_range_to' => $valueRangeTo,
        ]);
    }
}
