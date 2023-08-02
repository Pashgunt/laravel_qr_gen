<?php

namespace App\Http\Controllers;

use App\Http\Requests\QrGenerationLinkRequest;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\CompanyRepository;
use App\Qr\Repositories\FunnelConfigRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Repositories\QrLinkRepository;
use App\Qr\Services\FunnelFactory;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = app(CompanyRepository::class)->getCompanyList();
        return view('company.company-list', compact('companies'));
    }

    public function show(int $id)
    {
        $companyData = [
            'company' => app(CompanyRepository::class)->getCompanyByID($id)
        ];
        $companyData['qr'] = app(QrLinkRepository::class)
        ->prepareDataForQrCodes($companyData['company']->id, 1);
        $companyData['feedback'] = app(LocationFeedbackRepository::class)
        ->getPaginationFeedbackList($companyData['company']->id);
        $companyData['funnel'] = (new FunnelFactory())
        ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class))
        ->prepareFunnelConfigs($companyData['company']->id, 1, 'feedback');
        return view('company.company-detail', compact('companyData'));
    }

    public function edit(int $id)
    {
        $company = app(CompanyRepository::class)->getCompanyByID($id);
        return view('company.company-edit', compact('company'));
    }

    public function update(QrGenerationLinkRequest $request, int $id)
    {
        $companyDTO = $request->makeDTO();
        $res = app(CompanyRepository::class)->updateCompany($id, [
            'name' => $companyDTO->getName(),
            'adress' => $companyDTO->getAdress(),
            'link' => $companyDTO->getLink(),
        ]);
        return $this->prepareResultForUpdate(
            $res,
            'Succes Edit',
            'Error Edit',
            'company.index'
        );
    }

    public function destroy(int $id)
    {
        $res = app(CompanyRepository::class)->updateCompany($id, ['is_actual' => 0]);

        return $this->prepareResultForUpdate(
            $res,
            'Succes Deleted',
            'Error Deleted',
            'company.index'
        );
    }
}
