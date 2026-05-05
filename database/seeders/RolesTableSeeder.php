<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();
        Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Assistant Dean']);
        Role::create(['name'=>'Dept Incharge']);
        Role::create(['name'=>'HOD']);
        Role::create(['name'=>'HOS']);
    }
}
