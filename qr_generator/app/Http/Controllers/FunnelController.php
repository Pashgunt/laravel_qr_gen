<?php

namespace App\Http\Controllers;

use App\Actions\CreateFunnelAction;
use App\Actions\DestroyFunnelAction;
use App\Actions\EditFunnelAction;
use App\Actions\ShowFunnelConfigAction;
use App\Actions\ShowFunnelOptionsAction;
use App\Actions\StoreFunnelAction;
use App\Actions\UpdateFunnelFieldAction;
use App\Filters\FunnelConfigFilter;
use App\Filters\FunnelFieldFilter;
use App\Filters\FunnelTypeFilter;
use App\Http\Requests\FieldRequest;
use App\Http\Requests\FunnelRequest;
use App\Models\Company;
use App\Models\FunnelFields;
use App\QR\Enums\FunnelOperatorEnums;
use App\Qr\Repositories\FunnelFieldsRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use ShowFunnelOptions;

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
        $result = $storeFunnel->handle($request);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Create',
            'Error Creare',
            'qr.create'
        );
    }

    public function destroyField(FunnelFieldFilter $filter)
    {
        $result = app(FunnelFieldsRepository::class)
            ->updateFunnelField(
                FunnelFields::filter($filter),
                ['is_actual' => 0]
            );

        return $this->prepareResultForUpdate(
            $result,
            'Succes Deleted',
            'Error Deleted',
            'funnel.index'
        );
    }

    public function destroyFunnel(
        Request $request,
        DestroyFunnelAction $destroyFunnel
    ) {
        $result = $destroyFunnel->handle($request);

        return $this->prepareResultForUpdate(
            $result,
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

        $data = [
            'funnel_data' => $showFunnel->handle($filter),
            'funnel' => $createFunnel->handle(app(Request::class)),
            'companies' => Company::all()
        ];

        return view('funnel.funnel-edit', compact('data'));
    }

    public function update(
        FunnelRequest $request,
        EditFunnelAction $editFunnel
    ) {
        $result = $editFunnel->handle($request);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Update',
            'Error Update',
            'funnel.index'
        );
    }

    public function editField(
        FunnelConfigFilter $filter,
        ShowFunnelConfigAction $showField,
        ShowFunnelOptionsAction $funnelOptions
    ): View {
        $funnelConfig = current($showField->handle($filter));
        $data = [
            'field_data' => $funnelConfig,
            'funnel_options' => $funnelOptions
                ->handle(new FunnelTypeFilter(
                    null,
                    [
                        'funnel_type_id' => $funnelConfig['funnel_type_id']
                    ]
                )),
            'operators' => FunnelOperatorEnums::getAssociations()
        ];

        return view('funnel.funnel-edit-field', compact('data'));
    }

    public function updateField(
        FieldRequest $request,
        UpdateFunnelFieldAction $updateFieldAction
    ) {
        $result = $updateFieldAction->handle($request);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Update',
            'Error Update',
            'funnel.index'
        );
    }
}
