<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    

    public function index()
    {

        $applists = \DB::table('applist')->get();

        return view('dashboard')->with('applists',$applists);
    }
}
