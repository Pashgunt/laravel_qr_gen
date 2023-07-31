<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\Enums\FunnelLogicEnums;

class FunnelField implements Funnel
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
        $funnelConfigID,
        $funnelDTO = null
    ) {
        $funnelLogicBlocks = [];
        $previousOperator = null;

        array_walk(
            $funnelDTO->getPrepareLogicParams()['result'],
            function ($fieldData, $logicOperator) use ($funnelConfigID, &$funnelLogicBlocks, &$previousOperator) {
                $funnelFieldID = $this->repository->createFunnelFields(
                    $funnelConfigID,
                    $fieldData['field'],
                    $fieldData['operator'],
                    $fieldData['value'],
                    $fieldData['from'],
                    $fieldData['to']
                )->id;

                if (
                    in_array($logicOperator, [FunnelLogicEnums::AND->value, FunnelLogicEnums::OR->value]) ||
                    in_array($previousOperator, [FunnelLogicEnums::AND->value, FunnelLogicEnums::OR->value])
                ) {
                    if ($previousOperator) $logicOperator = $previousOperator;
                    $funnelLogicBlocks[$logicOperator][] = $funnelFieldID;
                    $previousOperator = $logicOperator;
                }
            }
        );

        return $funnelLogicBlocks;
    }
}
