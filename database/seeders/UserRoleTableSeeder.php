<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->delete();
        UserRole::create(['user_id'=>'1','role_id'=>'1']);
        UserRole::create(['user_id'=>'2','role_id'=>'3']);
    }
}