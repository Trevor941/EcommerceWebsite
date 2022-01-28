<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;
class ProductTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag1 = Tag::create([
            'name' => 'blue',
            'slug' => Str::slug('blue', '-'),
            'description' => ''
        ]);
        $tag2 = Tag::create([
            'name' => 't-shirt',
            'slug' => Str::slug('t-shirt', '-'),
            'description' => ''
        ]);
        $tag3 = Tag::create([
            'name' => 'blouse',
            'slug' => Str::slug('blouse', '-'),
            'description' => ''
        ]);
        $tag4 = Tag::create([
            'name' => 'local',
            'slug' => Str::slug('local', '-'),
            'description' => ''
        ]);
    }
}
