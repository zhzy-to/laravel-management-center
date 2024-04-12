<?php

namespace App\Console\Commands;

use App\Models\AdminMenu;
use App\Models\AdminRole;
use App\Models\AdminUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdminInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化基础路由配置，管理员角色和权限';

    public static $initConfirm = '初始化操作，会清空路由、管理员、角色和菜单表，以及相关关联表数据。是否确认？';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->confirm(static::$initConfirm)) {
            $this->createMenus();
            $this->createUserRoleMenus();
            $this->call(AdminCacheConfig::class);
            $this->info('初始化完成，管理员为：admin，密码为：123456');
        }

        return 0;
    }

    protected function createMenus(): void
    {
        AdminMenu::query()->truncate();

        // todo:: 初始化数据
    }

    protected function createUserRoleMenus(): void
    {
        AdminUser::query()->truncate();
        AdminRole::query()->truncate();

        collect(['admin_role_menus', 'admin_user_roles'])
            ->each(function ($table) {
                DB::table($table)->truncate();
            });

        // todo:: 初始化数据
    }
}
