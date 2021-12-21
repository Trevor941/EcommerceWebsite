<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

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
            'name' => 'blue'
        ]);
        $tag2 = Tag::create([
            'name' => 't-shirt'
        ]);
        $tag3 = Tag::create([
            'name' => 'blouse'
        ]);
        $tag4 = Tag::create([
            'name' => 'local'
        ]);
    }
}
