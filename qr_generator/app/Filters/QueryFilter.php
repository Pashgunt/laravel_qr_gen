<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;

    protected array $addedParams;

    protected $builder;

    protected string $delimiter = ',';

    public function __construct(Request $request, array $addedFilterParams = [])
    {
        $this->request = $request;
        $this->addedParams = $addedFilterParams;
    }
    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], (array)$value);
            }
        }
    }

    protected function fields(): array
    {
        return array_filter(
            array_map('trim', array_merge(
                $this->request->route()->parameters(),
                $this->request->all(),
                $this->addedParams
            ))
        );
    }

    protected function paramToArray(string $param): array
    {
        return explode($this->delimiter, $param);
    }
}
