<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductColor;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blue = ProductColor::create([
            'color' => 'blue'
        ]);
        $red = ProductColor::create([
            'color' => 'red'
        ]);
        $black = ProductColor::create([
            'color' => 'black'
        ]);
        $pink = ProductColor::create([
            'color' => 'pink'
        ]);
        $white = ProductColor::create([
            'color' => 'white'
        ]);
        $yellow = ProductColor::create([
            'color' => 'blue'
        ]);
        $green = ProductColor::create([
            'color' => 'green'
        ]);
        $brown = ProductColor::create([
            'color' => 'brown'
        ]);
        $grey = ProductColor::create([
            'color' => 'grey'
        ]);
    }
}
