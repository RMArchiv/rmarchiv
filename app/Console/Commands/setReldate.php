<?php

namespace App\Console\Commands;

use App\Helpers\DatabaseHelper;
use App\Models\Game;
use Illuminate\Console\Command;

class setReldate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:reldate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set releasedate from gamefiles';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $games = Game::all();

        foreach ($games as $g){
            $this->info('Setze Releasedate für: '.$g->title);
            DatabaseHelper::setReleaseInfos($g->id);
        }

        $this->info('Fertig.');
    }
}
