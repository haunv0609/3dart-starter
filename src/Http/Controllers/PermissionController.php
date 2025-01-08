<?php

namespace haunv\Starter;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function listPermissions($viewName, $data = [])
    {
        $permissions = Permission::filter()->paginate(10);


        $router = $this->getRoutesByGroup(['middleware' => 'permission']);

        $listRoute = [];

        foreach ($router as $item) {
            $action = $item->getAction();
            $listRoute[] = $action['as'];
        }

        $data = array_merge($data, [
            'permissions' => $permissions,
            'listRoute' => $listRoute,
        ]);

        $customView = view($viewName, $data);

        return $customView;
    }

    function getRoutesByGroup(array $group = [])
    {
        $list = Route::getRoutes()->getRoutes();

        if (empty($group)) {
            return $list;
        }

        $routes = [];
        foreach ($list as $route) {
            $action = $route->getAction();
            foreach ($group as $key => $value) {
                if (empty($action[$key])) {
                    continue;
                }
                $actionValues = Arr::wrap($action[$key]);
                $values = Arr::wrap($value);
                foreach ($values as $single) {
                    foreach ($actionValues as $actionValue) {
                        if (Str::is($single, $actionValue)) {
                            $routes[] = $route;
                        } elseif($actionValue == $single) {
                            $routes[] = $route;
                        }
                    }
                }
            }
        }

        return $routes;
    }
}
