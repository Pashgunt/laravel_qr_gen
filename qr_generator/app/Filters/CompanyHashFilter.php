<?php

namespace App\Filters;

class CompanyHashFilter extends QueryFilter
{
    public function qr(string $hash)
    {
        return $this->builder->where('hash_value', $hash);
    }
}
