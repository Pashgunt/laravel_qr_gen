<?php

namespace App\QR\Repositories;

use App\Models\FunnelTypes;
use App\QR\Abstracts\Repositories;
use Illuminate\Database\Eloquent\Model;

class FunnelTypesRepository extends Repositories
{
    public function createFunnelType(
        string $funnelTypeTag,
        string $funnelTypeName
    ): Model {
        return $this->create([
            'funnel_type_tag' => $funnelTypeTag,
            'funnel_type_name' => $funnelTypeName,
        ]);
    }
}
