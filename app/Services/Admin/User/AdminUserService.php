<?php

namespace App\Services\Admin\User;

use App\Enums\MenuTypeEnum;
use App\Exceptions\Admin\ServeException;
use App\Models\AdminUser;
use App\Services\Admin\User\Interfaces\AdminUserServiceInterface;
use Illuminate\Support\Facades\Hash;

class AdminUserService implements AdminUserServiceInterface
{
    /**
     * @param string $username
     * @param string $password
     * @return array
     */
    public function login(string $username, string $password): array
    {
        $user = AdminUser::query()->where('username', $username)->first();

        if (! $user) {
            return [];
        }

        if (!Hash::check($password, $user->password)) {
            return [];
        }

        return $user->toArray();
    }

    /**
     * @param int $userId
     * @return bool
     * @throws ServeException
     */
    public function isSuperAdmin(int $userId): bool
    {
        if (! $user = AdminUser::query()->find($userId)) {
            throw new ServeException('用户不存在 .');
        }

        return (bool) $user->roles()->where('slug', 'superadmin')->exists();
    }

    /**
     * @param int $userId
     * @return array
     * @throws ServeException
     */
    public function getUserPermissionByID(int $userId): array
    {
        if (! $user = AdminUser::query()->find($userId)) {
            throw new ServeException('用户不存在 .');
        }

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

        return $menus ?? [];
    }

}
