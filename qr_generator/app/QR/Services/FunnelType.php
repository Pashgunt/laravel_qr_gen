<?php

namespace App\QR\Services;

use App\Models\Feedback;
use App\Qr\Abstracts\Funnel;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\LocationFeedbackRepository;
use Closure;

class FunnelType implements Funnel
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

    public function pipelineHandler($data, Closure $next)
    {
        $funnelOptions = $this->repository->getFunnelOptions(1);
        $data['funnel_options'] = $funnelOptions->toArray();
        return $next($data);
    }

    public function prepareFunnelFields(int $id)
    {
        $locationFeedbackService = new FeedbackService(new LocationFeedbackRepository(new Feedback()));
        $funnel = $this->repository->getFunnelOptionByID($id);
        $funnelTag = $funnel->funnel_type_tag;
        return match ($funnelTag) {
            FunnelEnums::FEEDBACK->value => $locationFeedbackService->prepareColumnNamesForFunnelOptions()
        };
    }
}
