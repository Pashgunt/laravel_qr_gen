<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\DTO\FunnelDTO;
use App\QR\Enums\FunnelLogicEnums;
use App\QR\Enums\FunnelOperatorEnums;
use App\Qr\Repositories\FunnelFieldsRepository;
use Closure;

class FunnelFieldService implements Funnel
{
    private FunnelFieldsRepository $repository;

    public function __construct(FunnelFieldsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createType(
        string $type,
        $repository
    ) {
    }

    public function storeFunnelPipeline(
        array $data,
        Closure $next
    ): array {
        $data['funnel_field_ids'] = $this->prepareDataForCreate($data['funnel_config_id'], $data['funnel_dto']);
        return $next($data);
    }

    public function createFunnelPipeline(
        array $data,
        Closure $next
    ): array {
        $data['operators'] = FunnelOperatorEnums::getAssociations();
        return $next($data);
    }

    public function prepareDataForCreate(
        $funnelConfigID,
        ?FunnelDTO $funnelDTO = null
    ): array {
        $funnelLogicBlocks = [];
        $previousOperator = null;

        $params = $funnelDTO->getPrepareLogicParams();
        array_walk(
            $params,
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
