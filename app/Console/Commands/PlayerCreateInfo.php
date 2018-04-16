<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

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

        $gamefiles = GamesFile::with('game')->get();

        $counter = 0;
        $toindexed = [];

        foreach ($gamefiles as $gamefile) {
            $makerid = $gamefile->game->maker_id.PHP_EOL;

            echo $makerid.' - '.$gamefile->id;
            if ($makerid == 2 or $makerid == 3 or $makerid == 9) {
                if ($gamefile->playerIndex()->count() == 0) {
                    $toindexed[] = $gamefile;
                    $counter += 1;
                }
            }
        }

        $this->info('Es wurden '.$counter.' Gamefiles gefunden.');

        $bar = $this->output->createProgressBar(count($toindexed));
        $bar->setFormat(" \033[44;37m %title:-37s% \033[0m\n %current%/%max% %bar% %percent:3s%%\n %remaining:-10s% %memory:37s%");
        $bar->setBarCharacter($done = "\033[32m●\033[0m");
        $bar->setEmptyBarCharacter($empty = "\033[31m●\033[0m");
        $bar->setProgressCharacter($progress = "\033[32m➤ \033[0m");
        $bar->setMessage('Starte indizierung der Gamefiles', 'title');
        $bar->start();

        $i = 0;
        foreach ($toindexed as $toindex) {
            $bar->setMessage('Entpacken von: '.$toindex->game_id.'/'.$toindex->id, 'title');
            \Log::info('Entapcken von '.$toindex->game_id.'/'.$toindex->id);
            $path = storage_path('app/public/'.$toindex->filename);
            if ($toindex->extension == 'zip') {
                $zip = new \ZipArchive();
                $zip->open($path);
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);

                    if (! ends_with($filename, '/') and ! starts_with($filename, '_MACOSX')) {
                        $imp = $this->search_for_base_path($filename);

                        if (! $imp == '') {
                            $pl = new PlayerIndexjson();
                            $pl->gamefile_id = $toindex->id;
                            if (! ends_with(strtolower($imp), ['.exe', '.lmu', '.ldb', 'ini', '.dll', 'lmt', 'lsd'])) {
                                $pl->key = preg_replace('/(\.\w+$)/', '', strtolower($imp));
                            } else {
                                $pl->key = strtolower($imp);
                            }
                            $pl->value = $imp;
                            $pl->filename = $filename;
                            $pl->save();

                            \Log::info('Saved basepath: '.$filename);
                        } else {
                            \Log::info('Empty basepath: '.$filename);
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
        for ($i = 0; $i < 2000; $i++) {
            $mapparray[] = 'map'.sprintf('%04d', $i).'.lmu';
        }

        $filearray = array_merge($rootarray, $mapparray);

        $searcharray = array_merge($dirarray, $filearray);

        if (starts_with(strtolower($filepath), $searcharray)) {
            $imp = str_replace('/', '\\/', $filepath);
        } else {
            if (str_contains(strtolower($filepath), $searcharray)) {
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
