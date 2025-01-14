<?php

namespace haunv\artStarter\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use haunv\artStarter\ModelFilters\RolerFilter;

class Role extends SpatieRole
{
    use Loggable, Filterable, RolerFilter;

    private static $whiteListFilter = ['*'];
}
