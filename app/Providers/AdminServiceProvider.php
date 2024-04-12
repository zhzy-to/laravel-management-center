<?php

namespace App\Providers;

use App\Services\Admin\User\Providers\AdminUserServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    protected array $middlewareGroups = [
        'admin' => [
            'throttle:150,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected array $middlewareMap = [
        'admin.permission' => \App\Http\Middleware\AdminPermission::class,
        'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
    ];

    protected array $commands = [
        \App\Console\Commands\AdminInitCommand::class,
        \App\Console\Commands\AdminCacheConfig::class
    ];

    public function register(): void
    {
        $this->commands($this->commands);

        $this->app->register(AdminUserServiceProvider::class);
    }


    public function boot(): void
    {
        // 注册中间件别名
        foreach ($this->middlewareMap as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // 定义中间件组
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }

        // 将 routes/admin.php 中定义的路由作为一个路由组，并使用默认配置来管理这些路由
        Route::group([], base_path('routes/admin.php'));
    }
}
