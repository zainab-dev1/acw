<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SurveyTypeTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DepartmentTableSeeder::class);
        $this->call(ApplistTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(VisitActivityTypesTableSeeder::class);
        $this->call(VisitParticipantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ActivityDetailsSeeder::class);
        $this->call(VisitStatusTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(AcademicYearTableSeeder::class);
        $this->call(SurveyTypeTableSeeder::class);
    }
}