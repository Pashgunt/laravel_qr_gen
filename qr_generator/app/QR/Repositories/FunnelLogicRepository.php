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

    public function prepareCreateFunneLogic(array $funnelFields, string $logicBlockOperator = '')
    {
        foreach ($funnelFields as $logicOperator => $funelFieldIDs) {
            if (in_array($logicOperator, [FunnelLogicEnums::AND->value, FunnelLogicEnums::OR->value])) {
                $logicBlockOperator = $logicOperator;
            }
            if (is_array($funelFieldIDs)) return $this->prepareCreateFunneLogic($funelFieldIDs, $logicBlockOperator);
            $this->createFunneLogic($funelFieldIDs, $logicBlockOperator);
        }
    }
}
