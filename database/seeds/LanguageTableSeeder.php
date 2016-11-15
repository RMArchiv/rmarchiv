<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $l = array();
        $l[] = ['name' => 'Deutsch', 'short' => 'de'];
        $l[] = ['name' => 'English', 'short' => 'en'];
        $l[] = ['name' => 'français', 'short' => 'fr'];
        $l[] = ['name' => '日本語 (にほんご)', 'short' => 'ja'];
        $l[] = ['name' => 'Multiple Languages', 'short' => 'multi'];

        foreach ($l as $langs){
            DB::table('languages')->insert([
                'name' => $langs['name'],
                'short' => $langs['short'],
            ]);
        }
    }
}
