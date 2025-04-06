<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaratrustPrepareDropForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating permissions to roles (Many-to-Many)

        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::table('user_role_user', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
            // Drop primary
            $table->dropPrimary(['user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('user_roles')
                ->onUpdate('cascade')->onDelete('cascade');
            // Restore primary
            $table->primary(['user_id', 'role_id']);
        });
        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('user_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('user_roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
