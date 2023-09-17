<?php

namespace App\Http\Controllers;

use App\Actions\DestroyQrCodeAction;
use App\Actions\StoreQrCodeAction;
use App\Actions\UpdateQrCodesAction;
use App\Filters\QrLinkFilter;
use App\Http\Requests\QrGenerationLinkRequest;
use App\Models\Company;
use App\Models\QrLink;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrGeneratorController extends Controller
{

    public function index(QrLinkFilter $filter): View
    {
        $qr = QrLink::joined()
            ->filter($filter)
            ->paginateResult();

        return view('qr.qr-list', compact('qr'));
    }

    public function create(): View
    {
        $companies = Company::all();

        return view('qr.create', compact('companies'));
    }

    public function show(QrLinkFilter $filter): View
    {
        $qr = QrLink::joined()
            ->filter($filter)
            ->firstResult();

        return view('qr.qr-detail', compact('qr'));
    }

    public function edit(QrLinkFilter $filter): View
    {
        $qr = QrLink::joined()
            ->filter($filter)
            ->firstResult();

        return view('qr.qr-edit', compact('qr'));
    }

    public function update(
        Request $request,
        UpdateQrCodesAction $updateQrCode,
        QrLink $link
    ) {
        $result = $updateQrCode->handle($request);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Update',
            'Error Update',
            'qr.index'
        );
    }

    public function store(
        QrGenerationLinkRequest $request,
        StoreQrCodeAction $storeQrCode
    ) {
        $result = $storeQrCode->handle($request);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Create',
            'Error Create',
            'company.index'
        );
    }

    public function destroy(
        QrLinkFilter $filter,
        DestroyQrCodeAction $destroyQrCode
    ) {
        $result = $destroyQrCode->handle($filter);

        return $this->prepareResultForUpdate(
            $result,
            'Succes Deleted',
            'Error Deleted',
            'qr.index'
        );
    }
}
