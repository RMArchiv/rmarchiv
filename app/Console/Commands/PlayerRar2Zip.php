<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 *
 * Get all rar gamefiles and repack with zip
 */

namespace App\Console\Commands;

use App\Models\GamesFile;
use Illuminate\Console\Command;

class PlayerRar2Zip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'player:rar2zip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'convert rar files to zip';

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
        //get all rar files from database
        $files = GamesFile::whereExtension('rar')->orderBy('filesize', 'asc')->get();

        foreach ($files as $f) {
            //Check for maker engine 2=rm2k, 3=rm2k3, 9=rm2k3 Steam Edition
            if (!array_search($f->game->maker_id, [2, 3, 9]) === FALSE) {
                echo "Gamefile: $f->filename";

                //prepare the path variables
                $pathrar = storage_path('app/public/' . $f->filename); // Path to original rar file
                $pathzip = storage_path('app/public/' . str_replace('.rar', '.zip', $f->filename)); //Path to zip destination
                $pathdest = storage_path('app/public/games/' . $f->id . '/'); //destination for unrared files

                //delete old temp files (just in case.)
                $this->Delete($pathdest);

                // unrar the rar archive
                $command = 'unrar x \'' . $pathrar . '\' ' . $pathdest;
                exec($command);

                $handle = opendir($pathdest); // erm??

                //zip previous decompressed files
                $this->Zip($pathdest, $pathzip);

                //delete decomressed files
                $this->Delete($pathdest);

                //Update the Database
                $upd = GamesFile::whereId($f->id)->first();
                $upd->extension = 'zip';
                $upd->filename = str_replace('.rar', '.zip', $f->filename);
                $upd->save();

                //delete rar file
                unlink($pathrar);

                echo " - done\n";
            }
        }

    }

    public function Delete($path)
    {
        if (is_dir($path) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file) {
                if (in_array($file->getBasename(), ['.', '..']) !== true) {
                    if ($file->isDir() === true) {
                        rmdir($file->getPathName());
                    } elseif (($file->isFile() === true) || ($file->isLink() === true)) {
                        unlink($file->getPathname());
                    }
                }
            }

            return rmdir($path);
        } elseif ((is_file($path) === true) || (is_link($path) === true)) {
            return unlink($path);
        }

        return false;
    }

    public function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new \ZipArchive();
        if (!$zip->open($destination, \ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), ['.', '..'])) {
                    continue;
                }

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } elseif (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } elseif (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }
}
