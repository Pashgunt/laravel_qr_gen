<?php

namespace App\Http\Controllers;

use App\Http\Requests\FunnelRequest;
use App\QR\Enums\FunnelLogicEnums;
use App\QR\Enums\FunnelOperatorEnums;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Repositories\FunnelFieldsRepository;
use App\Qr\Repositories\FunnelLogicRepository;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;
use Closure;
use Illuminate\Pipeline\Pipeline;

class FunnelController extends Controller
{
    private FunnelTypesRepository $funnelTypeRepository;
    private FunnelConfigRepository $funnelConfigRepository;
    private FunnelFieldsRepository $funnelFieldsRepository;
    private FunnelLogicRepository $funnelLogicRepository;

    public function __construct(
        FunnelTypesRepository $funnelTypeRepository,
        FunnelConfigRepository $funnelConfigRepository,
        FunnelFieldsRepository $funnelFieldsRepository,
        FunnelLogicRepository $funnelLogicRepository
    ) {
        $this->funnelTypeRepository = $funnelTypeRepository;
        $this->funnelConfigRepository = $funnelConfigRepository;
        $this->funnelFieldsRepository = $funnelFieldsRepository;
        $this->funnelLogicRepository = $funnelLogicRepository;
    }

    public function create()
    {
        $funnel = app(Pipeline::class)
            ->send([])
            ->through([
                (new FunnelFactory())->createType('types', $this->funnelTypeRepository),
                function ($data, Closure $next) {
                    $data['operators'] = FunnelOperatorEnums::getOperators();
                    return $next($data);
                },
                function ($data, Closure $next) {
                    $data['logic'] = FunnelLogicEnums::getOperators();
                    return $next($data);
                },
            ])
            ->via('pipelineHandler')
            ->thenReturn();

        return view('funnel.funnel-create', compact('funnel'));
    }

    public function store(FunnelRequest $request)
    {
        $funnelDTO = $request->makeDTO();

        $funnelConfigID = $this->funnelConfigRepository->createFunneConfig(
            $funnelDTO->getFunnelID(),
            $funnelDTO->getWorkStartDate()
        )->id;

        app(Pipeline::class)
            ->send([])
            ->through([
                function ($data, Closure $next) use ($funnelConfigID, $funnelDTO) {
                    $funnelFields = (new FunnelFactory())->createType('fields', $this->funnelFieldsRepository);
                    $funnelFieldIDs = $funnelFields->prepareDataForCreate($funnelConfigID, $funnelDTO);
                    $data['funnel_field_ids'] = $funnelFieldIDs;
                    return $next($data);
                },
                function ($data, Closure $next) {
                    $funnelLogic = (new FunnelFactory())->createType('logic', $this->funnelLogicRepository);
                    $funnelLogic->prepareDataForCreate($data['funnel_field_ids'])();
                    return $next($data);
                },
            ])
            ->thenReturn();

        return route('funnel.index');
    }
}
