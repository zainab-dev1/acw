<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\ExhibitionRegistration;
use App\Models\ExhibitionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExhibitionRegistrationController extends Controller
{
    public function create()
    {
        $setting = ExhibitionSetting::current();

        return view('exhibition.register')
            ->with('setting', $setting);
    }

    public function store(Request $request)
    {
        $setting = ExhibitionSetting::current();
        if ($setting && !$setting->is_open) {
            Alert::error('Closed', 'Registration is currently closed');
            return redirect()->route('exhibition.register');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'attachments' => 'required',
            'attachments.*' => 'file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,ppt,pptx,xls,xlsx,zip',
        ]);

        $registration = ExhibitionRegistration::create([
            'name' => $validated['name'],
            'department' => $validated['department'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        $files = $request->file('attachments', []);
        foreach ($files as $file) {
            $path = $file->store('exhibition/registrations/' . $registration->id, 'public');
            $registration->files()->create([
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]);
        }

        Alert::success('Success', 'تم التسجيل بنجاح / Registration submitted successfully');
        return redirect()->route('exhibition.register');
    }
}
