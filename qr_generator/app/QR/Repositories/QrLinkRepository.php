<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;

class QrLinkRepository extends Repositories
{
    public function createLink(
        string $link,
        int $companyHashId
    ) {
        return $this->create([
            'company_hash_id' => $companyHashId,
            'link' => $link
        ]);
    }

    //TODO make union this 2 method
    public function prepareDataForQrCodes(
        int $companyID,
        int $isActual
    ) {
        return $this->model
            ->where([
                ['links_for_qr_code.is_actual', '=', $isActual]
            ])
            ->join('company_table_hash', function ($join) use ($companyID) {
                $join->on('links_for_qr_code.company_hash_id', '=', 'company_table_hash.id')
                    ->where('company_table_hash.company_id', '=', $companyID);
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
    }

    public function prepareDataForQrCodeDetail(
        int $linkID,
        int $isActual
    ) {
        return $this->model
            ->where([
                ['links_for_qr_code.is_actual', '=', $isActual],
                ['links_for_qr_code.id', '=', $linkID]
            ])
            ->join('company_table_hash', function ($join) {
                $join->on('links_for_qr_code.company_hash_id', '=', 'company_table_hash.id');
            })
            ->join('qr_codes', 'links_for_qr_code.id', '=', 'qr_codes.link_id')
            ->leftJoin('qr_codes_pdf', 'links_for_qr_code.id', '=', 'qr_codes_pdf.link_id')
            ->first([
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
    }

    public function updateLink(int $linkID, array $update)
    {
        return $this->update($this->model->where('id', $linkID), $update);
    }
}
