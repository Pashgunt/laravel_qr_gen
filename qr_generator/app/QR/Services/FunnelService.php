<?php

namespace App\QR\Services;

use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use Closure;

class FunnelService extends LocationFeedback
{
    private FunnelTypesRepository $funnelTypeRepository;

    public function __construct($funnelTypeRepository, $locationFeedbackRepository = null)
    {
        if ($locationFeedbackRepository) {
            parent::__construct($locationFeedbackRepository);
        }
        $this->funnelTypeRepository = $funnelTypeRepository;
    }

    public function pipelineHandler($data, Closure $next)
    {
        $funnelOptions = $this->funnelTypeRepository->getFunnelOptions(1);
        $data['funnel_options'] = $funnelOptions->toArray();
        return $next($data);
    }

    public function prepareFunnelFields(int $id)
    {
        $funnel = $this->funnelTypeRepository->getFunnelOptionByID($id);
        $funnelTag = $funnel->funnel_type_tag;
        return match ($funnelTag) {
            FunnelEnums::FEEDBACK->value => $this->prepareColumnNamesForFunnelOptions()
        };
    }
}
