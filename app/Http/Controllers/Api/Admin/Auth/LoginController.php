<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Api\Admin\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\User\AdminUserService;
use App\Services\Admin\User\Interfaces\AdminUserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var AdminUserService
     */
    protected AdminUserService $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        [
            'username' => $username,
            'password' => $password,
        ] = $request->filldata();

        $user = $this->adminUserService->login($username, $password);

        /**
         * @var \Tymon\JWTAuth\JWTGuard $JWTGuard
         */
        $JWTGuard = Auth::guard('admin');

        $token = $JWTGuard->tokenByid($user['id']);

        return $this->data([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $JWTGuard->factory()->getTTL() * 60,
        ]);
    }

}
