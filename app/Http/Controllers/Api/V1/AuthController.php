<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\ApiV1\PasswordLoginRequest;
use App\Services\Users\Interfaces\UserServiceInterface;
use App\Services\Users\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    /**
     * @var UserService
     */
    public UserService $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param PasswordLoginRequest $request
     * @return JsonResponse
     */
    public function login(PasswordLoginRequest $request): JsonResponse
    {
        [
            'username' => $username,
            'password' => $password,
        ] = $request->filldata();

        $user = $this->userService->loginByPassword($username, $password);

        if (! $user) {
            return $this->error(__('手机号或密码错误'));
        }

        return $this->data($this->token($user));
    }


    /**
     * @param array $user
     * @return mixed
     */
    protected function token(array $user): mixed
    {
        return auth()->guard('api')->tokenByid($user['id']);
    }
}
