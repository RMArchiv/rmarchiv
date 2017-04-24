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
        $toindexed = array();

        foreach ($gamefiles as $gamefile) {
            $makerid = $gamefile->game()->first()->maker_id;

            if($makerid == 2 or $makerid == 3 or $makerid == 9){
                if($gamefile->playerIndex()->count() == 0){
                    $toindexed[] = $gamefile;
                    $counter += 1;
                }
            }
        }

        $this->info('Es wurden '.$counter.' Gamefiles gefunden.');
        $this->info('Starte Indizierung der Gamefiles.');
        foreach ($toindexed as $toindex){
            //$this->info('Entpacken von: '.$toindex->game()->name);
            $path = storage_path('app/public/'.$toindex->filename);
            //$this->info($path);
        }

        $this->info('Fertig.');
    }
}
