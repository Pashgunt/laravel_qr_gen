<?php

namespace App\Qr\Services;

use App\Qr\Abstracts\Funnel;
use App\QR\DTO\FunnelDTO;
use App\QR\Enums\FunnelLogicEnums;
use App\Qr\Repositories\FunnelLogicRepository;
use Closure;

class FunnelLogicService implements Funnel
{
    private FunnelLogicRepository $repository;

    public function __construct(FunnelLogicRepository $repository)
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
        $this->prepareDataForCreate($data['funnel_field_ids'])();
        return $next($data);
    }

    public function updateFunnelPipeline(
        array $data,
        Closure $next
    ): array {
        $this->storeFunnelPipeline(
            $data,
            $next
        );
        return $next($data);
    }

    public function createFunnelPipeline(
        array $data,
        Closure $next
    ): array {
        $data['logic'] = FunnelLogicEnums::getAssociations();
        return $next($data);
    }

    /**
     * @return Closure
     */
    public function prepareDataForCreate(
        $funnelFields,
        ?FunnelDTO $funnelDTO = null
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
