<?php

namespace App\Services\User\Providers;

use App\Services\User\Interfaces\UserServiceInterface;
use App\Services\User\UserService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->instance(UserServiceInterface::class,$this->app->make(UserService::class));
    }
}
