<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VisitParticipantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('visit_participants')->delete();
        
        \DB::table('visit_participants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Students',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Staff',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Students and Staff',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}