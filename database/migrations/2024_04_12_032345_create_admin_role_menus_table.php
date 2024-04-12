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
        if (Schema::hasTable('admin_role_menus')) {
            return;
        }

        Schema::create('admin_role_menus', function (Blueprint $table) {

            $table->integer('role_id')->index('role_id');
            $table->integer('menu_id')->index('menu_id');

            $table->unique(['role_id', 'menu_id'],'role_menu_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_role_menus');
    }
};
