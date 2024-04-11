<?php

namespace App\Services\Users\Providers;

use App\Services\Users\Interfaces\UserServiceInterface;
use App\Services\Users\UserService;
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
