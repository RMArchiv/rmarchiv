<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Console\Commands;

use App\Models\Game;
use App\Helpers\DatabaseHelper;
use Illuminate\Console\Command;

class setVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'speichert votes und comments in gametable';

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

        foreach ($games as $game) {
            $this->info('Setze Releasedate für: '.$game->title);
            DatabaseHelper::setVotesAndComments($game->id);
        }
        $this->info('Fertig!');
    }
}
