<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->is_super_admin) {
            return $next($request);
        }
//        // c правами на action
        $action = $request->route()->getActionMethod();
        $permission = Permission::getPermissionForAction($action);

        if (!$permission) {
            return response('У Вас нет прав доступа', \Illuminate\Http\Response::HTTP_FORBIDDEN);
        }

        if ($user->permissions->contains('name', $permission)) {
            return $next($request);
        }

        //без прав на action
//        $accessRules = (new Role)->getAccessRules();
//        foreach ($accessRules as $role => $uri) {
//            if ($user->roles->contains('name', $role) && strpos($request->getUri(), $uri) !== false) {
//                return $next($request);
//            }
//        }

        return response('У Вас нет прав доступа', \Illuminate\Http\Response::HTTP_FORBIDDEN);
//        return response([
//            'message' => 'forbidden',
//        ], \Illuminate\Http\Response::HTTP_FORBIDDEN);
    }
}
