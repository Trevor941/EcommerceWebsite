<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'men',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);

        $category2 = Category::create([
            'name' => 'women',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);

        $category3 = Category::create([
            'name' => 'kids',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);

        $category4 = Category::create([
            'name' => 'Dresses',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);

        $category5 = Category::create([
            'name' => 'Shirts',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);

        $category6 = Category::create([
            'name' => 'T-Shirts',
            'description' => '',
            'slug' => '',
            'CountProducts' => 0,
            'image' => ''
        ]);
    }
}
