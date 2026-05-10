<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AcademicYear;
use App\Models\Activity;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function public()
    {
        $applists = \DB::table('applist')->get();
        
        // Get active academic year
        $academic_year = AcademicYear::where('is_active', 1)->first();
        
        // Get upcoming events (both open and closed) - use date only for comparison
        $events = Event::with('type')
            ->where('academic_year_id', $academic_year->id ?? null)
            ->whereDate('training_date', '>=', now()->toDateString())
            ->orderBy('training_date', 'asc')
            ->take(6)
            ->get();

        return view('public')
            ->with('applists', $applists)
            ->with('events', $events);
    }

    public function upcomingActivities()
    {
        // All activities (list view)
        $events = Activity::with(['type', 'detail'])
            ->orderBy('training_date', 'desc')
            ->get();

        return view('activity.upcoming')
            ->with('events', $events);
    }
    
}
