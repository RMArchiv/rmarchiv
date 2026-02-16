<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $target = "tagtree.csv";
        if (file_exists($target)) {
            $tags = Tag::all();
            $file = fopen($target, "r");
            $headerskip = true;

            while ($data = fgetcsv(stream: $file, separator: ",")) {
                if ($headerskip) {
                    $headerskip = false;
                    continue;
                }
                $id = $data[0];
                $name = $data[1];

                // Create Parent tags if they did not yet exist
                if (count($data) >= 6) {
                    $parent = $data[6];
                    if (!empty($parent)) {

                        $tagexists = false;
                        foreach ($tags as $tag) {
                            if (strtolower($tag->title) == $parent) {
                                $tagexists = true;
                            }
                        }
                        if (!$tagexists) {
                            $this->command->info("Adding: " . $parent);
                            Tag::firstOrCreate(['title' => trim($parent)]);
                        }
                    }
                }

                // Add id to parent based on csv
                if (count($data) >= 4) {
                    $parentTitle = $data[3];
                    if (!empty($parentTitle)) {
                        $tag = $tags->filter(fn($item)=>$item->title == $name);
                        $parentTag = $tags->filter(fn($item)=>strcasecmp($item->title, $parentTitle) == 0);

                        if(count($tag) == 1 && count($parentTag) == 1) {
                            $this->command->info("Update pid: " . $tag->first()->title . " => " . $parentTitle);
                            $tag->first()->parent_id = $parentTag->first()->id;
                            $tag->first()->update();
                        }
                    }
                }
            }
        } else {
            $this->command->info("Did not find seeding csv.");
        }
    }
}
