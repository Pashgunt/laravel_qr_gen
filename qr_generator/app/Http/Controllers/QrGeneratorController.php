<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFiles;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;

class QrGeneratorController extends Controller
{
    public function create()
    {
        return view('qr.create');
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
}
