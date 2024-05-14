<?php

namespace App\Http\Middleware;

use App\Enums\ErrorCodeEnum;
use App\Exceptions\Admin\AuthException;
use App\Services\Admin\User\AdminUserService;
use App\Services\Admin\User\Interfaces\AdminUserServiceInterface;
use Closure;
use Illuminate\Http\Request;

class AdminPermission
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthException
     * @throws \App\Exceptions\Admin\ServeException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $id = auth('admin')->id()) {
            throw new AuthException('Token is illegal .', ErrorCodeEnum::TokenExpired);
        }

        /**
         * @var AdminUserService $adminService
         */
        $adminService = app()->make(AdminUserServiceInterface::class);

        if (! $adminService->isSuperAdmin($id) ) {

            $permission = $adminService->getUserPermissionByID($id);

            // 通过路由名称作为权限code
            // system:add
            $routeName = $request->route()->getName();

            if (! in_array($routeName, $permission, true)) {
                throw new AuthException('Forbidden .', ErrorCodeEnum::Forbidden);
            }
        }

        return $next($request);
    }
}
