<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Seeder;

class AcademicYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('academic_years')->delete();
        AcademicYear::create(['name'=>'2nd Semester 2022-2023','is_active'=> '1']);
    }
}