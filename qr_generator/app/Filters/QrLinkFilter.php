<?php

namespace App\Filters;

class QrLinkFilter extends QueryFilter
{
    public function company_id($id)
    {
        return $this->builder
            ->join('company_table_hash', function ($join) use ($id) {
                $join->on('links_for_qr_code.company_hash_id', '=', 'company_table_hash.id')
                    ->where('company_table_hash.company_id', '=', $id);
            })
            ->join('qr_codes', 'links_for_qr_code.id', '=', 'qr_codes.link_id')
            ->leftJoin('qr_codes_pdf', 'links_for_qr_code.id', '=', 'qr_codes_pdf.link_id');
    }

    public function link_id($id)
    {
        return $this->builder->where('links_for_qr_code.id', $id)
            ->join('company_table_hash', function ($join){
                $join->on('links_for_qr_code.company_hash_id', '=', 'company_table_hash.id');
            })
            ->join('qr_codes', 'links_for_qr_code.id', '=', 'qr_codes.link_id')
            ->leftJoin('qr_codes_pdf', 'links_for_qr_code.id', '=', 'qr_codes_pdf.link_id');
    }
}
