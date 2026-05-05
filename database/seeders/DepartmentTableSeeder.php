<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('departments')->delete();
        Department::create(['name' => 'English Language Center']);
        Department::create(['name' => 'Educational Technology Center']);
        Department::create(['name' => 'Business Studies Department']);
        Department::create(['name' => 'Information Technology Department']);
        Department::create(['name' => 'Engineering Department']);
    }
}
