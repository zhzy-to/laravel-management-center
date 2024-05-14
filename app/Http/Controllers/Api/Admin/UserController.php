<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\MenuTypeEnum;
use App\Models\AdminUser;
use App\Services\Admin\User\AdminUserService;
use App\Services\Admin\User\Interfaces\AdminUserServiceInterface;

class UserController extends Controller
{
    protected AdminUserService $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function getUserRoles()
    {
        $user = AdminUser::query()->find(1);

        $menus = $user->roles()
            ->with('menus', function ($query) {
                $query->where('type', MenuTypeEnum::Button);
            })
            ->get()
            ->pluck('menus')
            ->flatten()
            ->unique()
            ->pluck('code')
            ->toArray();


        dd($menus);

        // 判断是否存在 superadmin
        $user->roles()->where('slug', 'superadmin')->exists();
        dd($user->roles->toArray());
        dd($user->roles()->pluck('slug'));

        dd($this->getId());
    }
}
