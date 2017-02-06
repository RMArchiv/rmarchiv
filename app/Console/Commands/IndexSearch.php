<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class IndexSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Erneuern des Suchindexes';

    /**
     * Create a new command instance.
     *
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
        $this->info('Erstellen des Suchindexes');
        $this->info('------------------------------------');
        $this->info('Erstelle Games Index');
        $i = \TNTSearch::createIndex('games.index');
        $i->query('SELECT id, title, subtitle, desc_md, desc_html FROM games');
        $i->run();
        $this->info('------------------------------------');
        $this->info('Erstelle Kommentar Index');
        $i = \TNTSearch::createIndex('comments.index');
        $i->query('SELECT id, comment_md, comment_html FROM comments');
        $i->run();

        $this->info('Fertig!');
    }
}
