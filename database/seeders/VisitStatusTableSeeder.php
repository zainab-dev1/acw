<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VisitStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('visit_status')->delete();
        
        \DB::table('visit_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pending',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Approved',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Rejected',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}