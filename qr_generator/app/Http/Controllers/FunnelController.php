<?php

namespace App\Http\Controllers;

use App\QR\Enums\FunnelOperatorEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Services\FunnelService;
use Closure;
use Illuminate\Pipeline\Pipeline;

class FunnelController extends Controller
{

    private FunnelTypesRepository $funnelTypeRepository;

    public function __construct(FunnelTypesRepository $funnelTypeRepository)
    {
        $this->funnelTypeRepository = $funnelTypeRepository;
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
                }
            ])
            ->via('pipelineHandler')
            ->thenReturn();

        return view('funnel.funnel-create', compact('funnel'));
    }
}
