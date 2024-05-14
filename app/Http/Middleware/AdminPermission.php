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
    public function handle(Request $request, Closure $next)
    {
        if (! $id = auth('admin')->id()) {
            throw new AuthException('Token is illegal', ErrorCodeEnum::Token_expired);
        }

        /**
         * @var AdminUserService $adminService
         */
        $adminService = app()->make(AdminUserServiceInterface::class);

        if (! $adminService->isSuperAdmin($id) ) {

            $permission = $adminService->getUserPermissionByID($id);

            dd($permission);
        }


        return $next($request);
    }
}
