<?php

use Illuminate\Database\Seeder;

class GameFileTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $l = [];
        $l[] = ['title' => 'TechDemo', 'short' => 'techdemo'];
        $l[] = ['title' => 'Demo', 'short' => 'demo'];
        $l[] = ['title' => 'Fullversion', 'short' => 'full'];

        foreach ($l as $langs) {
            DB::table('games_files_types')->insert([
                'title'      => $langs['title'],
                'short'      => $langs['short'],
                'created_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
