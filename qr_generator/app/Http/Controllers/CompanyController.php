<?php

namespace App\Http\Controllers;

use App\Filters\CompanyFilter;
use App\Filters\FeedbackFilter;
use App\Filters\FunnelConfigFilter;
use App\Filters\QrLinkFilter;
use App\Http\Requests\QrGenerationLinkRequest;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\QrLink;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\CompanyRepository;
use App\Qr\Repositories\FunnelConfigRepository;
use App\Qr\Services\FunnelFactory;

class CompanyController extends Controller
{
    public function index(CompanyFilter $filters)
    {
        $companies = Company::filter($filters)->paginate(10);
        return view('company.company-list', compact('companies'));
    }

    public function show(
        CompanyFilter $filters,
        FeedbackFilter $feedbackFilter,
        QrLinkFilter $qrFilter,
        FunnelConfigFilter $funnelFilter
    ) {
        $companyData = [
            'company' => Company::filter($filters)->first(),
            'feedback' => Feedback::filter($feedbackFilter)->paginate(10),
            'qr' => QrLink::filter($qrFilter)->paginate(10, [
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]),
            'funnel' => (new FunnelFactory())
                ->createType(FunnelEnums::CONFIG->value, app(FunnelConfigRepository::class))
                ->prepareFunnelConfigs($funnelFilter)
        ];
        return view('company.company-detail', compact('companyData'));
    }

    public function edit(CompanyFilter $filters)
    {
        $company = Company::filter($filters)->first();
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
