<?php

namespace App\Qr\Services;

use App\Filters\FunnelConfigFilter;
use App\Models\FunnelConfig;
use App\Qr\Abstracts\Funnel;
use App\QR\DTO\FunnelDTO;
use App\Qr\Repositories\FunnelConfigRepository;
use Closure;

class FunnelConfigService implements Funnel
{
    private ?FunnelConfigRepository $repository;

    private ?FunnelConfigFilter $filters;

    public function __construct(
        ?FunnelConfigRepository $repository = null,
        ?FunnelConfigFilter $filters = null
    ) {
        $this->repository = $repository;
        $this->filters = $filters;
    }

    public function createType(
        string $type,
        $repository
    ) {
    }

    public function prepareDataForCreate(
        $funnelIDs,
        ?FunnelDTO $funnelDTO = null
    ): array {
        return [];
    }

    public function showCompanyPipeline(
        array $data,
        Closure $next
    ): array {
        $data['funnel'] = $this->prepareFunnelConfigs($this->filters);
        return $next($data);
    }

    public function prepareFunnelConfigs(
        FunnelConfigFilter $filter,
        array $addedFilterParams = []
    ): array {
        $configs = FunnelConfig::joined()
            ->filter($filter, $addedFilterParams)
            ->get()
            ->toArray();

        return array_reduce($configs, function ($acc, $configItem) use ($configs) {
            $configDataAppend = [
                'field_name' => $configItem['field_name'],
                'operator' => $configItem['operator'],
                'value' => $configItem['value'],
                'value_range_from' => $configItem['value_range_from'],
                'value_range_to' => $configItem['value_range_to'],
            ];
            if (count($configs) - 1 !== $acc['i']) $configDataAppend['logic_operator'] = $configItem['logic_operator'];
            $acc['result'][] = $configDataAppend;
            $acc['i']++;
            return $acc;
        }, ['result' => [], 'i' => 0])['result'];
    }
}
