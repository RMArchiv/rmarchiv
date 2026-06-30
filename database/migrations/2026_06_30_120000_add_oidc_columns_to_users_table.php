<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOidcColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('oidc_provider')->nullable()->after('remember_token');
            $table->string('oidc_subject')->nullable()->after('oidc_provider');
            $table->timestamp('oidc_last_login_at')->nullable()->after('oidc_subject');

            $table->unique(['oidc_provider', 'oidc_subject'], 'users_oidc_provider_subject_unique');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_oidc_provider_subject_unique');
            $table->dropColumn(['oidc_provider', 'oidc_subject', 'oidc_last_login_at']);
        });
    }
}
