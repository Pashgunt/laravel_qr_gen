<?php

namespace App\Http\Controllers;

use App\Http\Requests\FunnelRequest;
use App\QR\Enums\FunnelLogicEnums;
use App\QR\Enums\FunnelOperatorEnums;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Repositories\FunnelFieldsRepository;
use App\Qr\Repositories\FunnelLogicRepository;
use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Services\FunnelService;
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
                new FunnelService($this->funnelTypeRepository),
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

        $funnelFieldIDs = $this->funnelFieldsRepository->prepareCreateFunnelFields($funnelConfigID, $funnelDTO);
        $this->funnelLogicRepository->prepareCreateFunneLogic($funnelFieldIDs);

        return route('funnel.index');
    }
}
