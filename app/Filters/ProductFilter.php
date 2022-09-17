<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

final class ProductFilter
{
    private Builder $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function search($value)
    {
        $this->builder->whereRaw(
            'MATCH(title, description) AGAINST(? IN NATURAL LANGUAGE MODE)'
        , [$value]);
    }

    public function dateRange($from, $to)
    {
        $this->builder->whereBetween('manufacture_date', [
            Carbon::parse($from)->format('Y-m-d'),
            Carbon::parse($to)->format('Y-m-d')
        ]);
    }

    public function getBuilder()
    {
        return $this->builder;
    }
}
