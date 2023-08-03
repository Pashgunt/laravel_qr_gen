<?php

namespace App\Filters;

class CompanyFilter extends QueryFilter
{
    public function company_id($id)
    {
        return $this->builder->where('id', $id);
    }
}
