<?php

namespace App\QR\Services;

use App\Filters\FunnelTypeFilter;
use App\Models\Feedback;
use App\Models\FunnelTypes;
use App\Qr\Abstracts\Funnel;
use App\QR\DTO\FunnelDTO;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use Closure;
use Illuminate\Http\Request;

class FunnelTypeService implements Funnel
{

    private FunnelTypesRepository $repository;

    public function __construct(FunnelTypesRepository $repository)
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
        ?FunnelDTO $funnelDTO = null
    ): array {
        return [];
    }

    public function createFunnelPipeline(
        array $data,
        Closure $next
    ): array {
        $funnelOptions = FunnelTypes::filter(new FunnelTypeFilter(app(Request::class)))
            ->get();
        $data['funnel_options'] = $funnelOptions->toArray();
        return $next($data);
    }

    public function prepareFunnelFields(FunnelTypeFilter $filter): array
    {
        $locationFeedbackService = new FeedbackService(new LocationFeedbackRepository(new Feedback()));
        $funnel = FunnelTypes::filter($filter)->first();
        $funnelTag = $funnel->funnel_type_tag;
        return match ($funnelTag) {
            FunnelEnums::FEEDBACK->value => $locationFeedbackService->prepareColumnNamesForFunnelOptions()
        };
    }
}
