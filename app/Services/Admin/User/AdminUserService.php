<?php

namespace App\Services\Admin\User;

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
}
