<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class FunnelFieldsRepository extends Repositories
{
    public function createFunnelFields(
        int $funnelConfigId,
        string $fieldName,
        string $operator,
        ?int $value,
        ?int $valueRangeFrom,
        ?int $valueRangeTo,
    ): Model {
        return $this->create([
            'funnel_config_id' => $funnelConfigId,
            'field_name' => $fieldName,
            'operator' => $operator,
            'value' => $value,
            'value_range_from' => $valueRangeFrom,
            'value_range_to' => $valueRangeTo,
        ]);
    }

    public function updateFunnelField($raw, array $update): bool
    {
        return $this->update($raw, $update);
    }
}
