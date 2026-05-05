<?php

namespace App\Http\Controllers;

use App\Exports\ExhibitionRegistrationsExport;
use App\Models\ExhibitionRegistration;
use App\Models\ExhibitionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExhibitionAdminController extends Controller
{
    public function index()
    {
        $setting = ExhibitionSetting::current();

        $registrations = ExhibitionRegistration::with('files')
            ->orderByDesc('id')
            ->paginate(25);

        return view('exhibition.admin.index')
            ->with('setting', $setting)
            ->with('registrations', $registrations);
    }

    public function open()
    {
        $setting = ExhibitionSetting::current();
        if (!$setting) {
            $setting = ExhibitionSetting::create(['is_open' => 1]);
        }

        $setting->update(['is_open' => 1]);

        toast('Registration opened', 'success');
        return redirect()->route('exhibition.admin.index');
    }

    public function close()
    {
        $setting = ExhibitionSetting::current();
        if (!$setting) {
            $setting = ExhibitionSetting::create(['is_open' => 0]);
        }

        $setting->update(['is_open' => 0]);

        toast('Registration closed', 'success');
        return redirect()->route('exhibition.admin.index');
    }

    public function downloadFile($fileId)
    {
        $file = \App\Models\ExhibitionRegistrationFile::findOrFail($fileId);

        if (!Storage::disk('public')->exists($file->path)) {
            abort(404);
        }

        $downloadName = $file->original_name ?: basename($file->path);

        return Storage::disk('public')->download($file->path, $downloadName);
    }

    public function export()
    {
        return Excel::download(new ExhibitionRegistrationsExport(), 'exhibition-registrations.xlsx');
    }
}
