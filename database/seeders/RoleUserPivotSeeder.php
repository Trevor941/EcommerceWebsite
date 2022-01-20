<?php

namespace Database\Seeders;
use App\Models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pivot1 = RoleUser::create([
            'role_id' => '1',
            'user_id' => '1'
        ]);
        $pivot2 = RoleUser::create([
            'role_id' => '1',
            'user_id' => '2'
        ]);
    }
}
