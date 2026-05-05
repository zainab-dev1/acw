<?php

namespace Database\Seeders;


use App\Models\EventType;
use Illuminate\Database\Seeder;

class SurveyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('event_types')->delete();
        EventType::create(['name'=>'Community Training']);
        EventType::create(['name'=>'Industry Visit']);
        EventType::create(['name'=>'Guest Lecture']);
    }
}
