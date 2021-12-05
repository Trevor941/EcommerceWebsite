<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductSize;

class ProductSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xtrasmall = ProductSize::create([
            'size' => 'xtrasmall'
        ]);
        $small = ProductSize::create([
            'size' => 'small'
        ]);
        $medium = ProductSize::create([
            'size' => 'medium'
        ]);
        $small = ProductSize::create([
            'size' => 'small'
        ]);
        $large = ProductSize::create([
            'size' => 'large'
        ]);
        $xtralarge = ProductSize::create([
            'size' => 'xtralarge'
        ]);
    }
}
