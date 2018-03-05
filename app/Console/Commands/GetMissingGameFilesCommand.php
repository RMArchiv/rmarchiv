<?php

namespace App\Console\Commands;

use App\Models\GamesFile;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GetMissingGameFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:missingfiles';

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
        $gf = GamesFile::all();
        $i = 0;
        $content = '';

        $doc_root = './public';
        echo $doc_root;

        $content = "Missing Gamefiles:".PHP_EOL;
        $content .= 'Created at: '.Carbon::now()->toDateTimeString().PHP_EOL;
        $content .= '----------------------------------------------------------------'.PHP_EOL;

        foreach ($gf as $g){
            $filepath = storage_path('app/public/'.$g->filename);
            if (!file_exists($filepath)){
                $i +=1;
                $content .= $g->game->title.' - '.$g->game->subtitle.' - ID:'.$g->game_id.' - Version:'.$g->release_version.' - up by:'.$g->user->name.' - uuid: '.$g->filename.PHP_EOL;
            }
        }

        file_put_contents($doc_root.'/missfiles.txt', $content);
    }
}
