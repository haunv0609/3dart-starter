<?php

namespace haunv\artStarter\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait PermissionFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterCustomDes(Builder $builder, $value)
    {
        return $builder->where('description', 'like', '%'.$value.'%');
    }
}
