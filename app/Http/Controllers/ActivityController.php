<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\EventAttendance;
use App\Models\EventOtherAttendance;
use App\Models\EventResult;
use App\Models\EventType;
use App\Mail\CertificateMail;
use App\Exports\ActivityAttendanceExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ActivityController extends Controller
{
    public function showPublic($id)
    {
        $activity = Activity::with(['type', 'detail'])->findOrFail($id);

        // For simple navigation
        $next = Activity::where('id', '>', $activity->id)->orderBy('id')->first();
        $prev = Activity::where('id', '<', $activity->id)->orderByDesc('id')->first();

        return view('activity.show_public')
            ->with('activity', $activity)
            ->with('next', $next)
            ->with('prev', $prev);
    }

    public function public()
    {
        $academic_years = AcademicYear::where('is_active', 1)->first();

        $surveys = Activity::with('results')
            ->where('academic_year_id', $academic_years->id)
            ->get();

        return view('survey.public')->with('surveys', $surveys);
    }

    public function index(Request $request)
    {
        $academic_years = AcademicYear::all();

        $surveys = [];
        $selected_year = $request->get('academic_year_id');

        if ($selected_year) {
            $surveys = Activity::where('academic_year_id', $selected_year)->get();
        }

        return view('survey.index')
            ->with('surveys', $surveys)
            ->with('academic_years', $academic_years)
            ->with('selected_year', $selected_year);
    }

    public function prepare()
    {
        $academic_years = AcademicYear::where('is_active', 1)->pluck('name', 'id');
        $survey_types = EventType::pluck('name', 'id');

        return view('survey.prepare')
            ->with('survey_types', $survey_types)
            ->with('academic_years', $academic_years);
    }

    public function postprepare(Request $request)
    {
        $data = $request->only([
            'academic_year_id',
            'survey_type_id',
            'title',
            'training_date',
            'time',
            'location',
            'award_type',
            'award_details',
        ]);

        // Default award_type
        if (empty($data['award_type'])) {
            $data['award_type'] = 'none';
        }
        
        // Participant limit (optional)
        $hasLimit = (int)($request->input('has_participant_limit', 0) ?? 0);
        $data['has_participant_limit'] = $hasLimit;
        $data['participant_limit'] = $hasLimit ? $request->input('participant_limit') : null;

        // Attachment upload (optional)
        $data['has_attachment'] = (int)($request->input('has_attachment', 0) ?? 0);

        // Feedback button visibility (optional)
        $data['has_feedback'] = (int)($request->input('has_feedback', 1) ?? 1);

        $activity = Activity::create($data);

        // Public details files (optional, up to 2)
        // Stored on public disk so we can show links in the public activity page.
        if ($request->hasFile('public_file_1')) {
            $path = $request->file('public_file_1')->store("activity_public_files/{$activity->id}", 'public');
            $activity->public_file_1_path = $path;
        }
        if ($request->hasFile('public_file_2')) {
            $path = $request->file('public_file_2')->store("activity_public_files/{$activity->id}", 'public');
            $activity->public_file_2_path = $path;
        }
        if ($activity->isDirty(['public_file_1_path', 'public_file_2_path'])) {
            $activity->save();
        }

        \Log::info('Activity created', ['id' => $activity->id, 'data' => $data]);

        Alert::success('Success', 'Activity Added');

        return redirect()->route('activity.index');
    }

    public function edit($id)
    {
        $academic_years = AcademicYear::where('is_active', 1)->pluck('name', 'id');
        $survey_types = EventType::pluck('name', 'id');

        $survey = Activity::findOrFail($id);

        return view('survey.edit')
            ->with('academic_years', $academic_years)
            ->with('survey_types', $survey_types)
            ->with('survey', $survey);
    }

    public function update(Request $request, $id)
    {
        $survey = Activity::findOrFail($id);

        $data = $request->only([
            'academic_year_id',
            'survey_type_id',
            'title',
            'training_date',
            'time',
            'location',
            'award_type',
            'award_details',
        ]);

        if (empty($data['award_type'])) {
            $data['award_type'] = 'none';
        }
        
        // Participant limit (optional)
        $hasLimit = (int)($request->input('has_participant_limit', 0) ?? 0);
        $data['has_participant_limit'] = $hasLimit;
        $data['participant_limit'] = $hasLimit ? $request->input('participant_limit') : null;

        // Attachment upload (optional)
        $data['has_attachment'] = (int)($request->input('has_attachment', 0) ?? 0);

        // Feedback button visibility (optional)
        $data['has_feedback'] = (int)($request->input('has_feedback', 1) ?? 1);

        $survey->update($data);

        // Public details files (optional, up to 2)
        if ($request->hasFile('public_file_1')) {
            if (!empty($survey->public_file_1_path) && Storage::disk('public')->exists($survey->public_file_1_path)) {
                Storage::disk('public')->delete($survey->public_file_1_path);
            }
            $survey->public_file_1_path = $request->file('public_file_1')->store("activity_public_files/{$survey->id}", 'public');
        }
        if ($request->hasFile('public_file_2')) {
            if (!empty($survey->public_file_2_path) && Storage::disk('public')->exists($survey->public_file_2_path)) {
                Storage::disk('public')->delete($survey->public_file_2_path);
            }
            $survey->public_file_2_path = $request->file('public_file_2')->store("activity_public_files/{$survey->id}", 'public');
        }
        if ($survey->isDirty(['public_file_1_path', 'public_file_2_path'])) {
            $survey->save();
        }

        Alert::success('Success', 'Activity Updated');

        return redirect()->route('activity.index');
    }

    public function isopen($id)
    {
        $survey = Activity::findOrFail($id);

        \DB::table('events')->where('id', $id)->update(['is_open' => 1]);

        \Log::info('Activity Opened', ['event_id' => $id, 'title' => $survey->title, 'is_open_after' => 1]);

        Alert::success('Success', 'Activity Opened Successfully');

        return redirect()->route('activity.index');
    }

    public function isclose($id)
    {
        $survey = Activity::findOrFail($id);

        \DB::table('events')->where('id', $id)->update(['is_open' => 0]);

        \Log::info('Activity Closed', ['event_id' => $id, 'title' => $survey->title, 'is_open_after' => 0]);

        Alert::success('Success', 'Activity Closed Successfully');

        return redirect()->route('activity.index');
    }

    // The remaining public flow still uses the existing survey views & event_* models.
    // We'll keep method names to match current routes and minimize risk.

    public function feedback($survey_id)
    {
        $survey = Activity::find($survey_id);

        // If feedback is disabled for this activity, don't allow direct access.
        if ($survey && (int)($survey->has_feedback ?? 1) !== 1) {
            toast('Feedback is closed', 'error');
            return redirect()->route('public.upcoming');
        }

        return view('survey.feedback')->with('survey_id', $survey_id);
    }

    public function postfeedback(Request $request, $survey_id)
    {
        $surveyGate = Activity::find($survey_id);
        if ($surveyGate && (int)($surveyGate->has_feedback ?? 1) !== 1) {
            toast('Feedback is closed', 'error');
            return redirect()->route('public.upcoming');
        }

        $attendance = EventAttendance::where('survey_id', $survey_id)
            ->where('civil_no', $request->civil_no)
            ->first();

        if ($attendance) {
            $results = EventResult::where('survey_id', $survey_id)
                ->where('civil_no', $request->civil_no)
                ->first();

            if ($results) {
                toast('Already Submitted Feedback', 'error');
                return redirect()->route('activity.feedback', $survey_id);
            }

            $survey = Activity::find($survey_id);

            if ($survey && $survey->is_open == 1) {
                if ($survey->survey_type_id == 1) {
                    return redirect()->route('activity.formcts', [$survey->id, $attendance]);
                }

                if ($survey->survey_type_id == 2) {
                    return redirect()->route('activity.formiv', [$survey->id, $attendance]);
                }

                if ($survey->survey_type_id == 3) {
                    return redirect()->route('activity.formgl', [$survey->id, $attendance]);
                }
            }

            toast('Survey is Already closed', 'error');
            return redirect()->route('activity.feedback', $survey_id);
        }

        toast('You have not attended', 'error');
        return redirect()->route('activity.public');
    }

    public function formcts($id, EventAttendance $attendance)
    {
        $survey = Activity::findOrFail($id);

        return view('survey.form_cts')
            ->with('survey', $survey)
            ->with('attendance', $attendance);
    }

    public function formiv($id, EventAttendance $attendance)
    {
        $survey = Activity::findOrFail($id);

        return view('survey.form_iv')
            ->with('survey', $survey)
            ->with('attendance', $attendance);
    }

    public function formgl($id, EventAttendance $attendance)
    {
        $survey = Activity::findOrFail($id);

        return view('survey.form_gl')
            ->with('survey', $survey)
            ->with('attendance', $attendance);
    }

    public function postform(Request $request, $id)
    {
        $attendance = EventAttendance::findOrFail($request->attendance_id);

        if ($attendance) {

            $survey_result = EventResult::where('attendance_id', $attendance->id)->first();

            if (empty($survey_result)) {
                $request['survey_id'] = $id;
                $request['civil_no'] = $attendance->civil_no;
                $request['email'] = $attendance->email;
                $request['participant_name'] = $attendance->fullname_en;
                $request['participant_name_ar'] = $attendance->fullname_ar ?? null;

                $createdResult = EventResult::create($request->all());

                // Issue certificate only AFTER feedback submission
                if (!empty($createdResult->email)) {
                    Mail::to($createdResult->email)->send(new CertificateMail($createdResult));
                }

                Alert::success('Thank you for your response', 'Your Response has been submitted. Your certificate has been issued.');

                // Show certificate PDF in browser
                return redirect()->route('certificate.view', $createdResult->id);
            } else {
                Alert::error('Error', 'Your Have already submitted your feedback');
            }
        } else {
            Alert::error('Error', 'Your Have not attended');
        }

        return redirect()->route('activity.public');
    }

    public function attendance($id)
    {
        $survey = Activity::findOrFail($id);
        $departments = \App\Models\Department::pluck('name', 'id');
        $isFull = false;
        if ((int)($survey->has_participant_limit ?? 0) === 1 && !empty($survey->participant_limit)) {
            $currentCount = EventAttendance::where('survey_id', $id)->count();
            $isFull = $currentCount >= (int)$survey->participant_limit;
        }
        
        return view('survey.attendance')
            ->with('survey', $survey)
            ->with('departments', $departments)
            ->with('is_full', $isFull);
    }

    public function postattendance(Request $request, $id)
    {
        // Delegate to existing EventController flow by keeping view/controller contract.
        // For now, use the same logic as old controller via DB insert.
        $survey = Activity::findOrFail($id);

        // Attachment upload validation (optional per activity)
        $requiresAttachment = (int)($survey->has_attachment ?? 0) === 1;
        if ($requiresAttachment) {
            $request->validate([
                // Allow any file type (including video/audio). Size is limited for safety.
                'attachment' => 'nullable|file|max:5120',
            ]);
        }
        
        // Block registration if seats are full (when limit is enabled)
        if ((int)($survey->has_participant_limit ?? 0) === 1 && !empty($survey->participant_limit)) {
            $currentCount = EventAttendance::where('survey_id', $id)->count();
            if ($currentCount >= (int)$survey->participant_limit) {
                Alert::error('Registration Closed', 'Seats are full / المقاعد مكتملة');
                return redirect()->route('activity.register', $id);
            }
        }
        
    $payload = $request->except('attachment');
        $payload['survey_id'] = $id;

        // Store attachment if present
        if ($requiresAttachment && $request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store("activity_attachments/{$id}", 'public');
            $payload['attachment_path'] = $path;
        }

        EventAttendance::create($payload);
        Alert::success(
            'تم التسجيل بنجاح',
            'تم التسجيل في الفعالية بنجاح - Registration completed successfully.'
        );
        return redirect()->route('activity.register', $id);
    }

    public function participants($id)
    {
        $survey = Activity::findOrFail($id);
        $participants = EventAttendance::where('survey_id', $id)->get();
        return view('survey.participants')->with('survey', $survey)->with('participants', $participants);
    }

    public function exportParticipants($id)
    {
        $activity = Activity::findOrFail($id);

        $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', (string)($activity->title ?? 'activity'));
        $fileName = 'activity-' . $activity->id . '-' . $safeTitle . '-participants.xlsx';

        return Excel::download(new ActivityAttendanceExport($activity), $fileName);
    }

    public function mean($id)
    {
        $survey = Activity::findOrFail($id);

        if ($survey->survey_type_id == 1) {
            return view('survey.form_mean_cts')->with('survey', $survey);
        }

        if ($survey->survey_type_id == 2) {
            return view('survey.form_mean_iv')->with('survey', $survey);
        }

        return view('survey.form_mean_gl')->with('survey', $survey);
    }

    public function publicQRCodes()
    {
        return $this->public();
    }
}
