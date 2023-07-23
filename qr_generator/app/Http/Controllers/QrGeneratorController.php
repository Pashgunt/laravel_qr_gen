<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFiles;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;
use Illuminate\Http\Request;

class QrGeneratorController extends Controller
{
    private CompanyRepository $companyRepository;
    private CompanyTableHashRepository $companyTableHashRepository;

    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
        $this->companyTableHashRepository = new CompanyTableHashRepository();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('qr.create');
    }

    public function store(QrGenerationLinkRequest $request)
    {
        $qrLinkDTO = $request->makeDTO();
        $companyID = $this->companyRepository->createCompany(
            $qrLinkDTO->getName(),
            $qrLinkDTO->getAdress(),
            $qrLinkDTO->getLink()
        )->id;
        foreach ($qrLinkDTO->getHashParams() as $tableNumber => $hashValue) {
            $companyHashId = $this->companyTableHashRepository->createHashForCompany(
                $companyID,
                $tableNumber,
                $hashValue
            )->id;
            dispatch(new GenerateQrCodeFiles($hashValue, $companyHashId));
        }

        return $this->create();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
