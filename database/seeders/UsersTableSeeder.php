<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'objectguid' => NULL,
                'username' => 'admin',
                'password' => Hash::make('admin123$'),
                'fullname' => 'Zainab Alawaid',
                'email' => 'zainab.alawaid@utas.edu.om',
                'department_id' => 2,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'objectguid' => NULL,
                'username' => 'avc-office',
                'password' => Hash::make('Oman@123'),
                'fullname' => 'Academic Creativity Week Office',
                'email' => 'avc-sll@utas.edu.om',
                'department_id' => 2,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}