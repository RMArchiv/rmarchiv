<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TruncateTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Leere Tabellen, die zu Debug Zwecken gefüllt wurden.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Leere Games Tabelle');
        \DB::table('games')->truncate();

        $this->info('Leere comments Tabelle');
        \DB::table('comments')->truncate();

        $this->info('Leere games_files Tabelle');
        \DB::table('games_files')->truncate();

        $this->info('Leere games_developers Tabelle');
        \DB::table('games_developers')->truncate();

        $this->info('Leere developer Tabelle');
        \DB::table('developer')->truncate();

        $this->info('Tabellen wurden geleert.');
    }
}
