<?php

namespace haunv\artStarter\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait RolerFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterCustomName(Builder $builder, $value)
    {
        return $builder->where('name', 'REGEXP', $value);
    }
}
