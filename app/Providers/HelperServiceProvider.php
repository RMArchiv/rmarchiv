<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once(app_path().'/Helpers/CheckRateableHelper.php');
        require_once(app_path().'/Helpers/DatabaseHelper.php');
        require_once(app_path().'/Helpers/MiscHelper.php');
    }
}