<?php

namespace App\Http\Controllers\Api\Admin;

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
        dd($this->getId());
    }
}
