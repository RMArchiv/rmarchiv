<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\TruncateTables::class,
        Commands\IndexSearch::class,
        Commands\setReldate::class,
        Commands\setVotes::class,
        Commands\PlayerCreateInfo::class,
        Commands\PlayerRar2Zip::class,
        Commands\PT::class,
        Commands\TestSearch::class,
        Commands\GetMissingGameFilesCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('ban:delete-expired')->everyMinute();
        $schedule->command('debug:missingfiles')->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
