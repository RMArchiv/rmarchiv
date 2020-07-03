<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Console\Commands;

use App\Models\GamesFile;
use App\Models\PlayerIndexjson;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
        // Historical memory_limit
        ini_set('memory_limit', '128M');
        $this->info('Lade Gamefiles ohne index.json');

        // Load all Gamefile Rows including the game relationship
        $gamefiles = GamesFile::with('game')->get();

        $counter = 0; //init counter
        $toindexed = []; //Object array for indexable gamefiles

        //Loop to collect needed informations about gamefiles
        foreach ($gamefiles as $gamefile) {
            //Filter Gamefiles without Game relation (orphaned files)
            if ($gamefile->game) {
                $makerid = $gamefile->game->maker_id;

                //filter webplayer compatible makers
                if ($makerid == 2 or //rm2k
                    $makerid == 3 or //rm2k3
                    $makerid == 6 or //rmmv
                    $makerid == 9 or //rm2k3 steam edition
                    $makerid == 11) { //rm2k steam edition

                    //check if Gamefile has no entries
                    if ($gamefile->playerIndex()->count() == 0) {
                        $toindexed[] = $gamefile; //Add to array
                        $counter += 1;
                    }
                }
            }
        }

        $this->info('Es wurden '.$counter.' Gamefiles gefunden.');

        //create and configure fancy cli progressbar
        $bar = $this->output->createProgressBar(count($toindexed));
        $bar->setFormat(" \033[44;37m %title:-37s% \033[0m\n %current%/%max% %bar% %percent:3s%%\n %remaining:-10s% %memory:37s%");
        $bar->setBarCharacter($done = "\033[32m●\033[0m");
        $bar->setEmptyBarCharacter($empty = "\033[31m●\033[0m");
        $bar->setProgressCharacter($progress = "\033[32m➤ \033[0m");
        $bar->setMessage('Starte indizierung der Gamefiles', 'title');
        $bar->start();

        //loop for all indexable gamefiles
        foreach ($toindexed as $toindex) {
            $bar->setMessage('Entpacken von: '.$toindex->game_id.'/'.$toindex->id, 'title');
            $this->info('Entpacken von: '.$toindex->game_id.'/'.$toindex->id.'/'.$toindex->game->title);

            $path = storage_path('app/public/'.$toindex->filename); //path to gamefile
            if ($toindex->extension == 'zip') { //check for zip extension
                //create ZipArchive Object
                $zip = new \ZipArchive();
                //open zip file
                $zip->open($path);

                $makerid = $toindex->game->maker_id;
                if ($makerid == 6) { //rmmv
                    //loop for every file in zip
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i); // get filename from zip index
                        if (Str::endsWith($filename, 'www/')) { //todo: Hier muss ich noch mal schauen.
                            //save data to db
                            $pl = new PlayerIndexjson();
                            $pl->gamefile_id = $toindex->id;
                            $pl->key = 'www';
                            $pl->value = $filename;
                            $pl->filename = $filename;
                            $pl->save();

                            break; //??
                        }
                    }
                } else {
                    // RPG Maker 2k/2k3

                    //loop for every file in zip
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i); // get filename from zip index

                        //filter directorys and _MACOS files/directory
                        if (! Str::endsWith($filename, '/') and ! Str::startsWith($filename, '_MACOSX')) {
                            $imp = $this->search_for_base_path($filename); //search for game basepath

                            if (! $imp == '') {
                                //safe data to db
                                $pl = new PlayerIndexjson();
                                $pl->gamefile_id = $toindex->id;

                                //check for file endings. subdirectory files dont need .\/
                                if (! Str::endsWith(strtolower($imp), ['.exe', '.lmu', '.ldb', 'ini', '.dll', 'lmt', 'lsd'])) {
                                    $pl->key = preg_replace('/(\.\w+$)/', '', strtolower($imp));
                                } else {
                                    $pl->key = strtolower($imp);
                                }
                                $pl->value = $imp;
                                $pl->filename = $filename;
                                $pl->save();

                            }
                        }
                    }
                }
                @$zip->close();
            } else {
                continue;
            }

            //return;
            $bar->advance();
        }

        $bar->finish();

        $this->info('Fertig.');
    }

    public function search_for_base_path($filepath)
    {
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

        $mapparray = [];
        for ($i = 0; $i < 4444; $i++) {
            $mapparray[] = 'map'.sprintf('%04d', $i).'.lmu';
        }

        ini_set('memory_limit', '8G');

        $filearray = array_merge($rootarray, $mapparray);

        $searcharray = array_merge($dirarray, $filearray);

        if (Str::startsWith(strtolower($filepath), $searcharray)) {
            $imp = str_replace('/', '\\/', $filepath);
        } else {
            if (Str::contains(strtolower($filepath), $searcharray)) {
                $exp = explode('/', $filepath);
                $res = array_shift($exp);
                $imp = implode('/', $exp);

                $imp = $this->search_for_base_path($imp);
            } else {
                $imp = '';
            }
        }

        if ($imp != '') {
            if (array_search(strtolower($imp), $filearray)) {
                $imp = '.\\/'.$imp;
            }
        }
        return $imp;
    }
}

