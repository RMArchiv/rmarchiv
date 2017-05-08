<?php

namespace App\Console\Commands;

use App\Helpers\PlayerHelper;
use App\Models\GamesFile;
use App\Models\PlayerFileGamefileRel;
use App\Models\PlayerFileHash;
use Illuminate\Console\Command;

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
    protected $description = 'Command description';

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
                //Get Uploaded Filepath
                $path = storage_path('app/public/' . $gamefile->filename);

                // Filter zip files
                if ($gamefile->extension == 'zip') {
                    $zip = new \ZipArchive;
                    $zip->open($path);
                    //Run through all files in ZIP
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i);

                        if (!ends_with($filename, "/") and !starts_with($filename, '_MACOSX')) {
                            $phelper = new PlayerHelper();
                            $imp = $phelper->getZipRootPath($filename);

                            if (!$imp == '') {
                                $rel = new PlayerFileGamefileRel();
                                $rel->gamefile_id = $gamefile->id;

                                if (!ends_with(strtolower($imp), ['.exe', '.lmu', '.ldb', 'ini', '.dll', 'lmt', 'lsd'])) {
                                    $rel->orig_filename = preg_replace('/(\.\w+$)/', '', strtolower($imp));
                                } else {
                                    $rel->orig_filename = strtolower($imp);
                                }

                                //Entpacken der Datei und speichern in storage
                                $filedata = $zip->getFromIndex($i);
                                $filehash = hash('sha1', $filedata);

                                $newfilepath = storage_path('app/public/games_hashed/' . substr($filehash, 0, 2) . '/');
                                if(!file_exists($newfilepath)){
                                    mkdir($newfilepath);
                                }
                                file_put_contents($newfilepath . $filehash, $filedata);

                                $check = PlayerFileHash::whereFilehash($filehash)->first();
                                if(!$check){
                                    $pfh = new PlayerFileHash;
                                    $pfh->filehash = $filehash;
                                    $pfh->save();
                                    $rel->file_hash_id = $pfh->id;
                                }else{
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
