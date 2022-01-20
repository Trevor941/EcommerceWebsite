<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xtrasmall = Size::create([
            'size' => 'xtrasmall'
        ]);
        $small = Size::create([
            'size' => 'small'
        ]);
        $medium = Size::create([
            'size' => 'medium'
        ]);
        $small = Size::create([
            'size' => 'small'
        ]);
        $large = Size::create([
            'size' => 'large'
        ]);
        $xtralarge = Size::create([
            'size' => 'xtralarge'
        ]);
    }
}
