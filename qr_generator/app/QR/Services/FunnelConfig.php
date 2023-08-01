<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\Qr\Repositories\FunnelConfigRepository;

class FunnelConfig implements Funnel
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
        $funnelIDs,
        $funnelDTO = null
    ) {
    }

    public function prepareFunnelConfigs(
        int $companyID,
        int $isActual,
        string $funnelType
    ) {
        $configs = $this->repository->getFunnelConfig($companyID, $isActual, $funnelType)->toArray();
        
        return array_reduce($configs, function ($acc, $configItem) use ($configs) {
            $configDataAppend = [
                'field_name' => $configItem['field_name'],
                'operator' => $configItem['operator'],
                'value' => $configItem['value'],
                'value_range_from' => $configItem['value_range_from'],
                'value_range_to' => $configItem['value_range_to'],
            ];
            if (count($configs)-1 !== $acc['i']) $configDataAppend['logic_operator'] = $configItem['logic_operator'];
            $acc['result'][] = $configDataAppend;
            $acc['i']++;
            return $acc;
        }, ['result' => [], 'i' => 0])['result'];
    }
}
