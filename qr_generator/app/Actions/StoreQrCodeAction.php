<?php

namespace App\Actions;

use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFilesJob;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;

class StoreQrCodeAction
{
    public function handle(QrGenerationLinkRequest $request): void
    {
        $qrLinkDTO = $request->makeDTO();
        $companyID = $qrLinkDTO->getCompanyID() ?? app(CompanyRepository::class)->createCompany(
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
            dispatch(new GenerateQrCodeFilesJob($hashValue, $companyHashId));
        }
    }
}
