<?php

namespace App\QR\Repositories;

use App\Models\FunnelTypes;
use App\QR\Abstracts\Repositories;

class FunnelTypesRepository extends Repositories
{
    public function createFunnelType(string $funnelTypeTag, string $funnelTypeName)
    {
        return $this->create([
            'funnel_type_tag' => $funnelTypeTag,
            'funnel_type_name' => $funnelTypeName,
        ]);
    }

    public function getFunnelOptions(int $isActual)
    {
        return $this->model
            ->where('is_actual', '=', $isActual)
            ->get();
    }

    public function getFunnelOptionByID(int $id)
    {
        return $this->model->find($id)->first();
    }
}
