<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductStatus;
class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status1 = ProductStatus::create([
            'name' => 'published'
        ]);
        $status2 = ProductStatus::create([
            'name' => 'draft'
        ]);
    }
}
