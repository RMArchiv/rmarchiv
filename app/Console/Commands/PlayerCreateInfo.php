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
            if($toindex->extension == 'zip'){
                $zip = new \ZipArchive;
                $zip->open($path);
                for($i = 0; $i < $zip->numFiles; $i++){
                    $filename = $zip->getNameIndex($i);
                    echo $filename.PHP_EOL;

                    if(!ends_with($filename, "/")){
                        $imp = $this->search_for_base_path($filename);

                        if(!$imp == ''){
                            $pl = new PlayerIndexjson;
                            $pl->gamefile_id = $toindex->id;
                            $pl->key = preg_replace('/(\.\w+$)/','',strtolower($imp));
                            $pl->value = $imp;
                            $pl->filename = $filename;
                            $pl->save();
                        }
                    }
                }
                $zip->close();
            }else{
                continue;
            }

            //return;
        }

        $this->info('Fertig.');
    }

    function search_for_base_path($filepath){
        $dirarray = [
            'backdrop',
            'battle',
            'battle2',
            'battlecharset',
            'battleweapon',
            'charset',
            'chipset',
            'faceset',
            'frame',
            'gameover',
            'monster',
            'panorama',
            'picture',
            'system',
            'system2',
            'title',
            'music',
            'sound',
        ];

        $rootarray = [
            'harmony.dll',
            'rpg_rt.exe',
            'rpg_rt.ini',
            'rpg_rt.ldb',
            'rpg_rt.lmt',
            'rpg_rt.dat',
        ];

        $mapparray = array();
        for($i = 0; $i < 2000; $i++){
            $mapparray[] = 'map'.sprintf('%04d', $i).'.lmu';
        }

        $filearray = array_merge($rootarray, $mapparray);

        $searcharray = array_merge($dirarray, $filearray);

        if(starts_with(strtolower($filepath), $searcharray)){
            $imp = str_replace('/','\\/',$filepath);
        }else{
            if(str_contains($filepath, $searcharray)){
                $exp = explode('/', $filepath);
                $res = array_shift($exp);
                $imp = implode('/', $exp);
                $imp = $this->search_for_base_path($imp);
            }else{
                $imp = '';
            }
        }

        if(str_contains($imp, $filearray)){
            $imp = '.\\/'.$imp;
        }

        return $imp;
    }
}
