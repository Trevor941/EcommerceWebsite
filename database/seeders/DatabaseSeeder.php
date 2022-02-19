<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\Customer::factory(200)->create();
        $this->call([ProductSizesSeeder::class, CategoriesSeeder::class, 
        ProductColorsSeeder::class, ProductTagsSeeder::class, RoleSeeder::class, UsersSeeder::class, OrderStatusesSeeder::class, RoleUserPivotSeeder::class
    ]);
    }
}
