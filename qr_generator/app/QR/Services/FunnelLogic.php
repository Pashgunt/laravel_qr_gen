<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\Enums\FunnelLogicEnums;

class FunnelLogic implements Funnel
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createType(
        string $type,
        $repository
    ) {
    }

    public function prepareDataForCreate(
        $funnelFields,
        $funnelDTO = null
    ) {
        return function ($logicBlockOperator = '') use ($funnelFields) {
            foreach ($funnelFields as $logicOperator => $funelFieldIDs) {
                if (in_array($logicOperator, [FunnelLogicEnums::AND->value, FunnelLogicEnums::OR->value])) {
                    $logicBlockOperator = $logicOperator;
                }
                if (is_array($funelFieldIDs)) return $this->prepareDataForCreate($funelFieldIDs)($logicBlockOperator);
                $this->repository->createFunneLogic($funelFieldIDs, $logicBlockOperator);
            }
        };
    }
}
