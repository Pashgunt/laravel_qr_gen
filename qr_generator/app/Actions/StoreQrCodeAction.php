<?php

namespace App\Actions;

use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFilesJob;
use App\QR\Repositories\CompanyRepository;
use App\Qr\Services\CompanyTableHashService;

class StoreQrCodeAction
{
    public function handle(QrGenerationLinkRequest $request): void
    {
        $qrLinkDTO = $request->makeDTO();
        $companyID = app(CompanyRepository::class)->createCompany(
            $qrLinkDTO->getName(),
            $qrLinkDTO->getAdress(),
            $qrLinkDTO->getLink()
        )->id;
        foreach ($qrLinkDTO->getHashParams() as $tableNumber => $hashValue) {
            $companyHashId = app(CompanyTableHashService::class)->createHashForCompany(
                $companyID,
                $tableNumber,
                $hashValue
            )->id;
            dispatch(new GenerateQrCodeFilesJob($hashValue, $companyHashId));
        }
    }
}
