<?php

namespace App\Console\Commands;

use App\Models\GamesFile;
use Illuminate\Console\Command;

class PlayerCreateInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:createinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates index.json data for easyrpg';

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
        $this->info('Lade Gamefiles ohne index.json');

        $gamefiles = GamesFile::all();

        $counter = 0;

        foreach ($gamefiles as $gamefile) {
            if($gamefile->playerIndex()->count() == 0){
                $counter += 1;
            }
        }

        $this->info('Es wurden '.$counter.' Gamefiles gefunden.');
        $this->info('Starte Indizierung der Gamefiles.');


        $this->info('Fertig.');
    }
}
