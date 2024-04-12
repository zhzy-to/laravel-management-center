<?php

namespace App\Services\Admin\User\Providers;

use App\Services\Admin\User\AdminUserService;
use App\Services\Admin\User\Interfaces\AdminUserServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class AdminUserServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->instance(AdminUserServiceInterface::class, $this->app->make(AdminUserService::class));
    }
}
