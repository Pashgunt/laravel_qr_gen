<?php

namespace App\Http\Controllers;

use App\Actions\CreateFunnelAction;
use App\Actions\StoreFunnelAction;
use App\Filters\FunnelConfigFilter;
use App\Http\Requests\FunnelRequest;
use App\QR\Enums\FunnelEnums;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Services\FunnelFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class FunnelController extends Controller
{
    public function index(FunnelConfigFilter $filter): View
    {
        $funnels = (new FunnelFactory())
            ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class))
            ->prepareFunnelConfigs($filter);

        return view('funnel.funnel-list', compact('funnels'));
    }

    public function create(
        Request $request,
        CreateFunnelAction $createFunnel
    ): View {
        $funnel = $createFunnel->handle($request);
        return view('funnel.funnel-create', compact('funnel'));
    }

    public function store(
        FunnelRequest $request,
        StoreFunnelAction $storeFunnel,
        int $companyID
    ) {
        $storeFunnel->handle($request, $companyID);

        return redirect(route('qr.create'));
    }
}
