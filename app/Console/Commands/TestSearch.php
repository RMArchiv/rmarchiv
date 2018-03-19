<?php

namespace App\Console\Commands;

use App\Helpers\SearchFilterHelper;
use Illuminate\Console\Command;

class TestSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test search filter';

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
        $searchTerm = 'zelda maps:25 legend maps:30';
        $result = SearchFilterHelper::searchFilter($searchTerm);

        echo PHP_EOL;
        print_r($result);
        echo PHP_EOL;
    }
}
