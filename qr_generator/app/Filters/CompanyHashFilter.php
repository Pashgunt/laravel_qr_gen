<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CompanyHashFilter extends QueryFilter
{
    public function qr(string $hash): Builder
    {
        return $this->builder->where('hash_value', $hash);
    }
}
