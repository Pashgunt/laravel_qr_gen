<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFiles;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrCodeRepository;
use App\QR\Repositories\QrLinkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QrGeneratorController extends Controller
{

    public function index()
    {
        $qr = app(QrLinkRepository::class)->prepareDataForQrCodes(3, 1);
        return view('qr.qr-list', compact('qr'));
    }

    public function create()
    {
        return view('qr.create');
    }

    public function show(int $id)
    {
        $qr = app(QrLinkRepository::class)->prepareDataForQrCodeDetail($id, 1);
        return view('qr.qr-detail', compact('qr'));
    }

    public function edit(int $id)
    {
        $qr = app(QrLinkRepository::class)->prepareDataForQrCodeDetail($id, 1);
        return view('qr.qr-edit', compact('qr'));
    }

    public function update(Request $request, int $id)
    {
        dd($id);
    }

    public function store(QrGenerationLinkRequest $request)
    {
        $qrLinkDTO = $request->makeDTO();
        $companyID = app(CompanyRepository::class)->createCompany(
            $qrLinkDTO->getName(),
            $qrLinkDTO->getAdress(),
            $qrLinkDTO->getLink()
        )->id;
        foreach ($qrLinkDTO->getHashParams() as $tableNumber => $hashValue) {
            $companyHashId = app(CompanyTableHashRepository::class)->createHashForCompany(
                $companyID,
                $tableNumber,
                $hashValue
            )->id;
            dispatch(new GenerateQrCodeFiles($hashValue, $companyHashId));
        }

        return $this->create();
    }

    public function destroy(int $id)
    {
        $res = app(QrLinkRepository::class)->updateLink($id, ['is_actual' => 0]);
        return $this->prepareResultForUpdate(
            $res,
            'Succes Deleted',
            'Error Deleted',
            'qr.index'
        );
    }
}
