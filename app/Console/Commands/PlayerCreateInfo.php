<?php

namespace App\Console\Commands;

use App\Models\GamesFile;
use App\Models\PlayerIndexjson;
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
            $this->info('Entpacken von: '.$toindex->game_id.'/'.$toindex->id);
            $path = storage_path('app/public/'.$toindex->filename);
            $extractto = storage_path('app/public/playertmp/'.$toindex->id);
            $files = array();
            if($toindex->extension == 'zip'){
                $zip = new \ZipArchive;
                $zip->open($path);
                for($i = 0; $i < $zip->numFiles; $i++){
                    $filename = $zip->getNameIndex($i);
                    $exp = explode('/', $filename);
                    $expcount = count($exp);
                    $imp = '';
                    if($expcount >= 3){
                        $exp = array_slice($exp, $expcount - 2);
                        $imp = implode("\\/", $exp);
                    }elseif($expcount == 1){
                        $imp = '.\\/'.$exp[0];
                    }else{
                        $imp = implode("\\/", $exp);
                    }

                    $pl = new PlayerIndexjson;
                    $pl->gamefile_id = $toindex->id;
                    $pl->key = strtolower($imp);
                    $pl->value = $imp;
                    $pl->filename = $filename;
                    $pl->save();

                    echo $filename.PHP_EOL;
                }
                $zip->close();
            }else{
                continue;
            }

            //return;
        }

        $this->info('Fertig.');
    }
}
