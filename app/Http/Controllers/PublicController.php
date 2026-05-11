<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AcademicYear;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $strategicSponsors = $this->sponsorImages('theme/images/sponsors/main sponser');
        $supportiveSponsors = $this->sponsorImages('theme/images/sponsors/supported sponser');

        return view('public')
            ->with('applists', $applists)
            ->with('events', $events)
            ->with('strategicSponsors', $strategicSponsors)
            ->with('supportiveSponsors', $supportiveSponsors);
    }

    private function sponsorImages(string $relativeDir): array
    {
        $absolutePath = public_path($relativeDir);
        if (!File::isDirectory($absolutePath)) {
            return [];
        }

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg', 'webp'];

        $files = collect(File::files($absolutePath))
            ->filter(function ($file) use ($allowedExtensions) {
                return in_array(strtolower($file->getExtension()), $allowedExtensions, true);
            })
            ->sortBy(fn($file) => $file->getFilename())
            ->values();

        return $files
            ->map(function ($file) use ($relativeDir) {
                $relativePath = trim($relativeDir, '/') . '/' . $file->getFilename();
                $encodedRelativePath = collect(explode('/', $relativePath))
                    ->map(fn($segment) => rawurlencode($segment))
                    ->implode('/');

                return [
                    'url' => asset($encodedRelativePath),
                    'name' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                ];
            })
            ->all();
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
