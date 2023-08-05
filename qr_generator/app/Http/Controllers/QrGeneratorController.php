<?php

namespace App\Http\Controllers;

use App\Actions\DestroyQrCodeAction;
use App\Actions\StoreQrCodeAction;
use App\Actions\UpdateQrCodesAction;
use App\Filters\QrLinkFilter;
use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\UpdateQrCodeJob;
use App\Models\Company;
use App\Models\QrLink;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrLinkRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\View\View;

class QrGeneratorController extends Controller
{

    public function index(QrLinkFilter $filter): View
    {
        $qr = QrLink::joined()
            ->filter($filter)
            ->paginate(10, [
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
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
            ->first([
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
        return view('qr.qr-detail', compact('qr'));
    }

    public function edit(QrLinkFilter $filter): View
    {
        $qr = QrLink::joined()
            ->filter($filter)
            ->first([
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
        return view('qr.qr-edit', compact('qr'));
    }

    public function update(
        Request $request,
        UpdateQrCodesAction $updateQrCode,
        int $id
    ) {
        $updateQrCode->handle($request);

        return redirect(route('qr.index'));
    }

    public function store(
        QrGenerationLinkRequest $request,
        StoreQrCodeAction $storeQrCode
    ) {
        $storeQrCode->handle($request);

        return redirect(route('qr.index'))->with('message', 'Success created qr codes');
    }

    public function destroy(int $id, DestroyQrCodeAction $destroyQrCode)
    {
        $res = $destroyQrCode->handle($id);
        return $this->prepareResultForUpdate(
            $res,
            'Succes Deleted',
            'Error Deleted',
            'qr.index'
        );
    }
}
