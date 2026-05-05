<?php

namespace Database\Seeders;

use App\Models\Applist;
use Illuminate\Database\Seeder;

class ApplistTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('applist')->delete();
        Applist::create([
                        'name' => 'Community Training',
                        'icon' => 'ti-pencil-alt',
                        'color' => 'success',
                        'link' => 'https://www.sct.edu.om/cts/public',
                        'link_type' => 'link']);

        Applist::create([
                'name' => 'Industrial Visit',
                'icon' => 'ti-car',
                'color' => 'warning',
                'link' => 'visits.request',
                'link_type' => 'route']);
        
        Applist::create([
                    'name' => 'Survey Forms',
                    'icon' => 'ti-pencil-alt',
                    'color' => 'primary',
                    'link' => 'survey.public',
                    'link_type' => 'route']);

        Applist::create([
            'name' => 'Manage Survey ',
            'icon' => 'ti-pencil-alt',
            'color' => 'info',
            'link' => 'survey.index',
            'link_type' => 'route']);
        
        
    }
}

