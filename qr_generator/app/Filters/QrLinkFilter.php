<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class QrLinkFilter extends QueryFilter
{
    public function company_id(int $id): Builder
    {
        return $this->builder->where('company_table_hash.company_id', '=', $id);
    }

    public function link_id(int $id): Builder
    {
        return $this->builder->where('links_for_qr_code.id', $id);
    }

    public function link_ids(array $ids): Builder
    {
        return $this->builder->whereIn('links_for_qr_code.id', $ids);
    }
}
