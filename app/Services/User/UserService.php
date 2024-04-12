<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\User\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements Interfaces\UserServiceInterface
{
    /**
     * @param string $username
     * @param string $password
     * @return array
     */
    public function loginByPassword(string $username, string $password): array
    {
        $user = User::query()->where('username', $username)->first();
        if (! $user) {
            return [];
        }

        if (!Hash::check($password, $user->password)) {
            return [];
        }

        return $user->toArray();
    }
}
