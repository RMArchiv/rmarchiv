<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaratrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Change to bigincrements since all other changed to
        Schema::table('users', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        // Change user roles id to bigint
        Schema::table('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        // Change user permissions id to bigint
        Schema::table('user_permissions', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::table('user_role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->change();
            $table->unsignedBigInteger('user_id')->change();
            $table->string('user_type');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id')->change();
            $table->unsignedBigInteger('role_id')->change();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::table('user_role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('user_roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('user_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('user_roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('user_permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'permission_id', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['role_id']);
        });

        Schema::table('user_role_user', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::table('permission_user', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
        });

        Schema::dropIfExists('permission_user');

        Schema::table('user_roles', function (Blueprint $table) {
            $table->increments('id')->change();
        });

        Schema::table('user_permissions', function (Blueprint $table) {
            $table->increments('id')->change();
        });

        Schema::table('user_role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
            $table->dropPrimary(['user_id', 'role_id', 'user_type']);

            $table->dropColumn('user_type');
        });

        Schema::table('user_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned()->change();
            $table->integer('role_id')->unsigned()->change();
        });


        // Change to bigincrements since all other changed to
        Schema::table('users', function (Blueprint $table) {
            $table->increments('id')->change();
        });

    }
}
