<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blue = Color::create([
            'name' => 'blue'
        ]);
        $red = Color::create([
            'name' => 'red'
        ]);
        $black = Color::create([
            'name' => 'black'
        ]);
        $pink = Color::create([
            'name' => 'pink'
        ]);
        $white = Color::create([
            'name' => 'white'
        ]);
        $yellow = Color::create([
            'name' => 'blue'
        ]);
        $green = Color::create([
            'name' => 'green'
        ]);
        $brown = Color::create([
            'name' => 'brown'
        ]);
        $grey = Color::create([
            'name' => 'grey'
        ]);
    }
}
