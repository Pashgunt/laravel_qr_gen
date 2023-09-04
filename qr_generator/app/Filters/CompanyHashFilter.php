<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyHashFilter extends QueryFilter
{
    public function qr(string $hash): Builder
    {
        return $this->builder->where('hash_value', $hash);
    }

    public function company_hash_id(int $id)
    {
        return $this->builder->where('id', $id);
    }
}
