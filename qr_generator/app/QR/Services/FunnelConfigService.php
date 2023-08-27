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
        array $additionalParams = []
    ): array {
        $configs = FunnelConfig::joined()
            ->filter(
                $filter,
                $additionalParams
            )
            ->getResult()
            ->toArray();

        return array_reduce($configs, function ($acc, $configItem) use ($configs) {
            $configDataAppend = [
                'funnel_type_id' => $configItem['funnel_type_id'],
                'company_id' => $configItem['company_id'],
                'funnel_config_id' => $configItem['funnel_config_id'],
                'funnel_field_id' => $configItem['funnel_field_id'],
                'work_started_at' => $configItem['work_started_at'],
                'funnel_type_name' => $configItem['funnel_type_name'],
                'funnel_type_tag' => $configItem['funnel_type_tag'],
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
