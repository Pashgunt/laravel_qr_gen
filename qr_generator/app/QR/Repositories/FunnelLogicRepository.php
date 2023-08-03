<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;
use App\QR\Enums\FunnelLogicEnums;
use Illuminate\Database\Eloquent\Model;

class FunnelLogicRepository extends Repositories
{
    public function createFunneLogic(
        int $funnelFieldFirstId,
        string $logicOperator
    ): Model {
        return $this->create([
            'funnel_field_id' => $funnelFieldFirstId,
            'logic_operator' => $logicOperator,
        ]);
    }
}
