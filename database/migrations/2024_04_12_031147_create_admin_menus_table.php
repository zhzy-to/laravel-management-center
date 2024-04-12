<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('admin_menus')) {
            return;
        }

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->integer('parent_id');
            $table->string('level')->default('')->comment('组级集合');
            $table->string('name')->default('')->comment('菜单名称');
            $table->string('code')->default('')->unique('code_unique')->comment('菜单标识代码');
            $table->string('icon')->default('')->comment('菜单图标');
            $table->string('route')->default('')->comment('路由地址');
            $table->string('component')->default('')->comment('组件路径');
            $table->string('redirect')->default('')->comment('重定向地址');
            $table->smallInteger('is_hidden')->default(2)->comment('是否隐藏 (1是 2否)');
            $table->char('type',1)->default("M")->comment('菜单类型 (M菜单 B按钮 L链接 I iframe)');
            $table->smallInteger('status')->default(1)->comment('状态 (1正常 2停用)');
            $table->smallInteger('sort')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);


            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_menus');
    }
};
