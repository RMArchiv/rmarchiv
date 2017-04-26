<?php

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
        $files = GamesFile::whereExtension('rar')->orderBy('filesize', 'asc')->get();

        foreach ($files as $f){
            //entpacken
            echo "Gamefile: $f->filename";
            $pathrar = storage_path('app/public/'.$f->filename);
            $pathzip = storage_path('app/public/'.str_replace('.rar', '.zip', $f->filename ));
            $pathdest = storage_path('app/public/games/'.$f->id.'/');

            //löschen der eventuell vorhandenen tempdateien
            $this->Delete($pathdest);


            $command = 'unrar x \''.$pathrar.'\' '.$pathdest;
            exec($command);

            $handle = opendir($pathdest);

            $this->Zip($pathdest, $pathzip);
            $this->Delete($pathdest);

            $upd = GamesFile::whereId($f->id)->first();
            $upd->extension = "zip";
            $upd->filename = str_replace('.rar', '.zip', $f->filename );
            $upd->save();

            unlink($pathrar);

            echo " - done\n";
        }
    }

    function Delete($path)
    {
        if (is_dir($path) === true)
        {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file)
            {
                if (in_array($file->getBasename(), array('.', '..')) !== true)
                {
                    if ($file->isDir() === true)
                    {
                        rmdir($file->getPathName());
                    }

                    else if (($file->isFile() === true) || ($file->isLink() === true))
                    {
                        unlink($file->getPathname());
                    }
                }
            }

            return rmdir($path);
        }

        else if ((is_file($path) === true) || (is_link($path) === true))
        {
            return unlink($path);
        }

        return false;
    }

    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new \ZipArchive();
        if (!$zip->open($destination, \ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true)
        {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file)
            {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true)
                {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }
                else if (is_file($file) === true)
                {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }
}
