<?php

namespace App\Http\Controllers;

use App\Actions\ShowCompanyAction;
use App\Filters\CompanyFilter;
use App\Http\Requests\QrGenerationLinkRequest;
use App\Models\Company;
use App\QR\Repositories\CompanyRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(CompanyFilter $filters): View
    {
        $companies = Company::filter($filters)->paginate(10);
        return view('company.company-list', compact('companies'));
    }

    public function show(
        Request $request,
        ShowCompanyAction $showCompany
    ): View {
        $companyData = $showCompany->handle($request);
        return view('company.company-detail', compact('companyData'));
    }

    public function edit(CompanyFilter $filters): View
    {
        $companies = Company::filter()->get();
        $company = Company::filter($filters)->first();
        return view('company.company-edit', compact('company', 'companies'));
    }

    public function update(
        QrGenerationLinkRequest $request,
        int $id
    ) {
        $companyDTO = $request->makeDTO();

        $result = app(CompanyRepository::class)->updateCompany(
            Company::filter(
                new CompanyFilter(null),
                [
                    'company_id' => $id
                ]
            ),
            [
                'name' => $companyDTO->getName(),
                'adress' => $companyDTO->getAdress(),
                'link' => $companyDTO->getLink(),
            ]
        );

        return $this->prepareResultForUpdate(
            $result,
            'Succes Edit',
            'Error Edit',
            'company.index'
        );
    }

    public function destroy(int $id)
    {
        $result = app(CompanyRepository::class)->updateCompany(
            Company::filter(
                new CompanyFilter(null),
                [
                    'company_id' => $id
                ]
            ),
            ['is_actual' => 0]
        );

        return $this->prepareResultForUpdate(
            $result,
            'Succes Deleted',
            'Error Deleted',
            'company.index'
        );
    }
}
