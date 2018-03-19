<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Console\Commands;

use App\Models\GamesFile;
use App\Helpers\PlayerHelper;
use App\Models\PlayerFileHash;
use Illuminate\Console\Command;
use App\Models\PlayerFileGamefileRel;

class PT extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates the hash table for all rm2k(3) files';

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

        //Get all game files
        $gamefiles = GamesFile::all();

        $counter = 0;
        $toindexed = [];

        //loop all gamefiles
        foreach ($gamefiles as $gamefile) {
            //Get the maker id
            $makerid = $gamefile->game()->first()->maker_id;

            //Run code only for rm2k(3)
            //Todo: Engine filter can be done with Query
            if ($makerid == 2 or $makerid == 3 or $makerid == 9) {
                //Get path to uploaded files
                $path = storage_path('app/public/'.$gamefile->filename);

                //use only zip fiels
                //Todo: ZIP filter can be done with Query
                if ($gamefile->extension == 'zip') {
                    //Open the ZIP file
                    $zip = new \ZipArchive();
                    $zip->open($path);

                    //Run through all files in ZIP
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        //Get the filename with fileindex
                        $filename = $zip->getNameIndex($i);

                        //Filter Directory and _MACOSX from index
                        if (! ends_with($filename, '/') and ! starts_with($filename, '_MACOSX')) {

                            //Get root path of the file
                            $phelper = new PlayerHelper();
                            $imp = $phelper->getZipRootPath($filename);

                            //if root path not ''
                            if (! $imp == '') {
                                $rel = new PlayerFileGamefileRel();
                                $rel->gamefile_id = $gamefile->id;

                                if (! ends_with(strtolower($imp), ['.exe', '.lmu', '.ldb', 'ini', '.dll', 'lmt', 'lsd'])) {
                                    $rel->orig_filename = preg_replace('/(\.\w+$)/', '', strtolower($imp));
                                } else {
                                    $rel->orig_filename = strtolower($imp);
                                }

                                //Decompress data
                                $filedata = $zip->getFromIndex($i);
                                //create hash of the file
                                $filehash = hash('sha1', $filedata);

                                //get storage path to hashed directory
                                $newfilepath = storage_path('app/public/games_hashed/'.substr($filehash, 0, 2).'/');

                                //check for directory existance
                                if (! file_exists($newfilepath)) {
                                    mkdir($newfilepath);
                                }

                                //write decompressed data to a new file to the storage path
                                file_put_contents($newfilepath.$filehash, $filedata);

                                //check for Database existance of this file
                                $check = PlayerFileHash::whereFilehash($filehash)->first();
                                if (! $check) {
                                    //create a new record to player_file_hash table
                                    $pfh = new PlayerFileHash();
                                    $pfh->filehash = $filehash;
                                    $pfh->save();

                                    $rel->file_hash_id = $pfh->id;
                                } else {
                                    $rel->file_hash_id = $check->id;
                                }

                                $rel->save();
                            }
                        }
                    }
                    $zip->close();
                } else {
                    continue;
                }
            }
        }

        $this->info('Es wurden '.$counter.' Gamefiles gefunden.');

        $i = 0;
        foreach ($toindexed as $toindex) {
        }
    }
}
