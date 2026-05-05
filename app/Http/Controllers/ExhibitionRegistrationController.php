<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\ExhibitionRegistration;
use App\Models\ExhibitionSetting;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExhibitionRegistrationController extends Controller
{
    public function create()
    {
        $setting = ExhibitionSetting::current();

        $departments = Department::orderBy('name')->get(['id', 'name']);

        return view('exhibition.register', compact('setting', 'departments'));
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
            'department_id' => 'required|integer|exists:departments,id',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'attachments' => 'required',
            'attachments.*' => 'file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,ppt,pptx,xls,xlsx,zip',
        ]);

        $department = Department::find($validated['department_id']);

        $registration = ExhibitionRegistration::create([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'],
            // Keep legacy string column populated so existing exports/admin lists keep working.
            'department' => $department ? $department->name : null,
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
