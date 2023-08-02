<?php

namespace App\Http\Controllers;

use App\Http\Requests\FunnelRequest;
use App\QR\Enums\FunnelEnums;
use App\QR\Enums\FunnelLogicEnums;
use App\QR\Enums\FunnelOperatorEnums;
use App\QR\Repositories\CompanyRepository;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Repositories\FunnelFieldsRepository;
use App\Qr\Repositories\FunnelLogicRepository;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class FunnelController extends Controller
{

    public function index()
    {
        $funnels = (new FunnelFactory())
            ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class))
            ->prepareFunnelConfigs(1, 1, 'feedback');

        return view('funnel.funnel-list', compact('funnels'));
    }

    public function create(Request $request)
    {
        $funnel = app(Pipeline::class)
            ->send([
                'company_id' => $request->get('company_id')
            ])
            ->through([
                (new FunnelFactory())->createType(FunnelEnums::TYPE->value, app(FunnelTypesRepository::class)),
                function ($data, Closure $next) {
                    $data['operators'] = FunnelOperatorEnums::getAssociations();
                    return $next($data);
                },
                function ($data, Closure $next) {
                    $data['logic'] = FunnelLogicEnums::getAssociations();
                    return $next($data);
                },
            ])
            ->via('pipelineHandler')
            ->thenReturn();

        return view('funnel.funnel-create', compact('funnel'));
    }

    public function store(FunnelRequest $request, int $companyID)
    {
        $funnelDTO = $request->makeDTO();

        $funnelConfigID = app(FunnelConfigRepository::class)->createFunneConfig(
            $companyID,
            $funnelDTO->getFunnelID(),
            $funnelDTO->getWorkStartDate()
        )->id;

        app(Pipeline::class)
            ->send([])
            ->through([
                function ($data, Closure $next) use ($funnelConfigID, $funnelDTO) {
                    $funnelFields = (new FunnelFactory())->createType(FunnelEnums::FIELD->value, app(FunnelFieldsRepository::class));
                    $funnelFieldIDs = $funnelFields->prepareDataForCreate($funnelConfigID, $funnelDTO);
                    $data['funnel_field_ids'] = $funnelFieldIDs;
                    return $next($data);
                },
                function ($data, Closure $next) {
                    $funnelLogic = (new FunnelFactory())->createType(FunnelEnums::LOGIC->value, app(FunnelLogicRepository::class));
                    $funnelLogic->prepareDataForCreate($data['funnel_field_ids'])();
                    return $next($data);
                },
            ])
            ->thenReturn();

        return route('qr.create');
    }
}
