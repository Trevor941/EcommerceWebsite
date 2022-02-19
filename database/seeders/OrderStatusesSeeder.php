<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status1 = OrderStatus::create([
            'name' => 'Processing'
        ]);
        $status2 = OrderStatus::create([
            'name' => 'On-hold'
        ]);
        $status3 = OrderStatus::create([
            'name' => 'Completed'
        ]);
        $status4 = OrderStatus::create([
            'name' => 'Cancelled'
        ]);
        $status5 = OrderStatus::create([
            'name' => 'Refunded'
        ]);
    }
}
