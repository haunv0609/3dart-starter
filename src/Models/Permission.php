<?php

namespace haunv\artStarter\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use haunv\artStarter\ModelFilters\PermissionFilter;

class Permission extends SpatiePermission
{
    use Loggable, Filterable, PermissionFilter;

    private static $whiteListFilter = ['*'];
}
