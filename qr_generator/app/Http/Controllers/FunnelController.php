<?php

namespace App\Http\Controllers;

use App\Actions\CreateFunnelAction;
use App\Actions\DestroyFunnelAction;
use App\Actions\ShowFunnelConfigAction;
use App\Actions\StoreFunnelAction;
use App\Filters\FunnelConfigFilter;
use App\Filters\FunnelFieldFilter;
use App\Http\Requests\FunnelRequest;
use App\Models\Company;
use App\Models\FunnelConfig;
use App\Models\FunnelFields;
use App\QR\Enums\FunnelEnums;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Repositories\FunnelFieldsRepository;
use App\Qr\Services\FunnelFactory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FunnelController extends Controller
{
    public function index(
        FunnelConfigFilter $filter,
        ShowFunnelConfigAction $showFunnel
    ): View {
        $funnels = $showFunnel->handle($filter);

        return view('funnel.funnel-list', compact('funnels'));
    }

    public function create(
        Request $request,
        CreateFunnelAction $createFunnel
    ): View {
        $companies = Company::all();
        $funnel = $createFunnel->handle($request);
        return view('funnel.funnel-create', compact('funnel', 'companies'));
    }

    public function store(
        FunnelRequest $request,
        StoreFunnelAction $storeFunnel
    ) {
        $storeFunnel->handle($request);

        return redirect(route('qr.create'));
    }

    public function destroyField(FunnelFieldFilter $filter)
    {
        $res = app(FunnelFieldsRepository::class)
            ->updateFunnelField(
                FunnelFields::filter($filter),
                ['is_actual' => 0]
            );

        return $this->prepareResultForUpdate(
            $res,
            'Succes Deleted',
            'Error Deleted',
            'funnel.index'
        );
    }

    public function destroyFunnel(
        Request $request,
        DestroyFunnelAction $destroyFunnel
    ) {
        $res = $destroyFunnel->handle($request);

        return $this->prepareResultForUpdate(
            $res,
            'Succes Deleted',
            'Error Deleted',
            'funnel.index'
        );
    }

    public function edit(
        FunnelConfigFilter $filter,
        ShowFunnelConfigAction $showFunnel,
        CreateFunnelAction $createFunnel
    ): View {

        $funnel = $showFunnel->handle($filter);
        $companies = Company::all();
        $funnelOperators = $createFunnel->handle(app(Request::class));
        return view('funnel.funnel-edit', compact('funnel', 'companies'));
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
