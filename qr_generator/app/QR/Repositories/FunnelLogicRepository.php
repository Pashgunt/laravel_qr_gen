<?php

namespace App\Qr\Repositories;

use App\QR\Abstracts\Repositories;
use App\QR\Enums\FunnelLogicEnums;

class FunnelLogicRepository extends Repositories
{
    public function createFunneLogic(
        int $funnelFieldFirstId,
        string $logicOperator
    ) {
        return $this->create([
            'funnel_field_id' => $funnelFieldFirstId,
            'logic_operator' => $logicOperator,
        ]);
    }
}
