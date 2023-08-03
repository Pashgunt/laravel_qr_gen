<?php

namespace App\Http\Controllers;

use App\Filters\QrLinkFilter;
use App\Http\Requests\QrGenerationLinkRequest;
use App\Jobs\GenerateQrCodeFiles;
use App\Models\QrLink;
use App\QR\Repositories\CompanyRepository;
use App\QR\Repositories\CompanyTableHashRepository;
use App\QR\Repositories\QrLinkRepository;
use Illuminate\Http\Request;

class QrGeneratorController extends Controller
{

    public function index(QrLinkFilter $filter)
    {
        $qr = QrLink::filter($filter)
            ->join('company_table_hash', function ($join) {
                $join->on('links_for_qr_code.company_hash_id', '=', 'company_table_hash.id');
            })
            ->join('qr_codes', 'links_for_qr_code.id', '=', 'qr_codes.link_id')
            ->leftJoin('qr_codes_pdf', 'links_for_qr_code.id', '=', 'qr_codes_pdf.link_id')
            ->paginate(10, [
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
        return view('qr.qr-list', compact('qr'));
    }

    public function create()
    {
        return view('qr.create');
    }

    public function show(QrLinkFilter $filter)
    {
        $qr = QrLink::filter($filter)->first([
            'qr_codes.file_name AS svg_file_name',
            'qr_codes.file_path AS svg_file_path',
            'company_table_hash.*',
            'qr_codes_pdf.*',
            'links_for_qr_code.*',
        ]);
        return view('qr.qr-detail', compact('qr'));
    }

    public function edit(QrLinkFilter $filter)
    {
        $qr = QrLink::filter($filter)->first([
            'qr_codes.file_name AS svg_file_name',
            'qr_codes.file_path AS svg_file_path',
            'company_table_hash.*',
            'qr_codes_pdf.*',
            'links_for_qr_code.*',
        ]);
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
