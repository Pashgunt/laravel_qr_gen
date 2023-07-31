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

    public function prepareCreateFunnelFields(
        $funnelConfigID,
        $funnelDTO
    ) {
        $funnelLogicBlocks = [];
        $previousOperator = null;

        array_walk(
            $funnelDTO->getPrepareLogicParams()['result'],
            function ($fieldData, $logicOperator) use ($funnelConfigID, &$funnelLogicBlocks, &$previousOperator) {
                $funnelFieldID = $this->createFunnelFields(
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
                    if($previousOperator) $logicOperator = $previousOperator;
                    $funnelLogicBlocks[$logicOperator][] = $funnelFieldID;
                    $previousOperator = $logicOperator;
                }
            }
        );

        return $funnelLogicBlocks;
    }
}
