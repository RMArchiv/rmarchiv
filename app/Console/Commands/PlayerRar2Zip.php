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
        $files = GamesFile::whereExtension('rar')->get();

        foreach ($files as $f){
            //entpacken
            $pathrar = storage_path('app/public/'.$f->filename);
            $pathzip = str_replace('.rar', '.zip', $f->filename );
            $pathdest = storage_path('app/public/games/'.$f->id.'/');
            $command = 'unrar x \''.$pathrar.'\' '.$pathdest;
            exec($command);

            $handle = opendir($pathdest);

            $zip = new \ZipArchive();
            $zip->open($pathzip, \ZIPARCHIVE::CREATE);
            while (false !== ($file = readdir($handle)))
            {
                $zip->addFile($pathdest.'/'.$file);
                echo "$file\n";
            }
            closedir($handle);
            $zip->close();
            $this->Delete($pathdest);
            echo $f->filename.PHP_EOL;
            echo "fertig";

            return;
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
}
