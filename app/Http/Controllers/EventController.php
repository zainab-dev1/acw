<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Event;
use App\Models\EventType;
use App\Models\AcademicYear;
use App\Models\EventResult;
use Illuminate\Http\Request;
use App\Mail\CertificateMail;
use App\Models\EventAttendance;
use Illuminate\Support\Facades\Mail;
use App\Models\EventOtherAttendance;
use App\Http\Requests\AttendanceRequest;

class EventController extends Controller
{
    public function public()
    {
        $academic_years = AcademicYear::where('is_active',1)->first();

        $surveys = Event::with('results')->where('academic_year_id',$academic_years->id)->get();

        return view('survey.public')->with('surveys',$surveys);;
    }


    public function index(Request $request)
    {
        $academic_years = AcademicYear::all();
        
        $surveys = [];
        $selected_year = $request->get('academic_year_id');
        
        if ($selected_year) {
            $surveys = Event::where('academic_year_id', $selected_year)->get();
        }

        return view('survey.index')
            ->with('surveys', $surveys)
            ->with('academic_years', $academic_years)
            ->with('selected_year', $selected_year);
    }

    public function prepare()
    {
        $academic_years = AcademicYear::where('is_active',1)->pluck('name','id');

        $survey_types = EventType::pluck('name','id');

        return view('survey.prepare')
            ->with('survey_types',$survey_types)
            ->with('academic_years',$academic_years);
    }

    public function postprepare(Request $request)
    {
        \Log::info('Event Create Request Data:', $request->all());
        
        $data = $request->only([
            'academic_year_id',
            'survey_type_id',
            'title',
            'training_date',
            'day_option',
            'trainor',
            'position'
        ]);
        
        \Log::info('Data to be saved:', $data);
        
        $event = Event::create($data);
        
        \Log::info('Event created with ID: ' . $event->id . ' and training_date: ' . $event->training_date);

        Alert::success('Success', 'Event Added');

        return redirect()->route('event.index');
    }

    public function edit($id)
    {
        $academic_years = AcademicYear::where('is_active',1)->pluck('name','id');

        $survey_types = EventType::pluck('name','id');

        $survey = Event::findOrFail($id);

        return view('survey.edit')
            ->with('academic_years',$academic_years)
            ->with('survey_types',$survey_types)
            ->with('survey',$survey);
    }

    public function update(Request $request, $id)
    {
        $survey = Event::findOrFail($id);

        \Log::info('Event Update Request Data:', $request->all());
        \Log::info('Current training_date in DB: ' . $survey->getOriginal('training_date'));
        
        $data = $request->only([
            'academic_year_id',
            'survey_type_id',
            'title',
            'training_date',
            'day_option',
            'trainor',
            'position'
        ]);
        
        \Log::info('Data to update:', $data);

        $survey->update($data);
        
        \Log::info('Updated training_date in DB: ' . $survey->fresh()->getOriginal('training_date'));

        Alert::success('Success', 'Event Updated');

        return redirect()->route('event.index');

    }

    public function isopen($id)
    {
        $survey = Event::findOrFail($id);

        // Use direct DB update to avoid touching other fields
        \DB::table('events')->where('id', $id)->update(['is_open' => 1]);

        \Log::info('Event Opened', ['event_id' => $id, 'title' => $survey->title, 'is_open_after' => 1]);

        Alert::success('Success', 'Event Opened Successfully');

        return redirect()->route('event.index');
    }

    public function isclose($id)
    {
        $survey = Event::findOrFail($id);

        // Use direct DB update to avoid touching other fields
        \DB::table('events')->where('id', $id)->update(['is_open' => 0]);

        \Log::info('Event Closed', ['event_id' => $id, 'title' => $survey->title, 'is_open_after' => 0]);

        Alert::success('Success', 'Event Closed Successfully');

        return redirect()->route('event.index');
    }

    public function feedback($survey_id)
    {
        return view('survey.feedback')->with('survey_id',$survey_id);
    }

    public function postfeedback(Request $request, $survey_id)
    {

        // Check Attendance
        $attendance = EventAttendance::where('survey_id',$survey_id)->where('civil_no',$request->civil_no)->first();
//dd($attendance);
        if ($attendance) {
            // Check if already submitted
            $results = EventResult::where('survey_id',$survey_id)->where('civil_no',$request->civil_no)->first();
//dd($results);
            if ($results) {
                toast('Already Submitted Feedback','error');

                // Redirect to
                return redirect()->route('event.feedback',$survey_id);
            } else {
                $survey = Event::find($survey_id);

                if($survey->is_open ==1)
                {
                    //** redirect to forms **//
                    //! CTS
                    if ($survey->survey_type_id == 1) {

                        return redirect()->route('event.formcts',[$survey->id, $attendance]);
                    }

                    //! Industry Visit
                    if ($survey->survey_type_id == 2) {

                        return redirect()->route('event.formiv',$survey->id, $attendance);
                    }


                    //! Guest Lecture
                    if ($survey->survey_type_id == 3) {

                        return redirect()->route('event.formgl',$survey->id, $attendance);
                    }

                }

                toast('Survey is Already closed','error');
                return redirect()->route('event.feedback',$survey_id);
            }
        }

        toast('You have not attended','error');
        return redirect()->route('event.public');
    }

    public function formcts($id, SurveyAttendance $attendance)
    {
        $survey = Event::findOrFail($id);
//dd($attendance);
        return view('survey.form_cts')
            ->with('survey',$survey)
            ->with('attendance',$attendance);
    }

    public function formiv($id, SurveyAttendance $attendance)
    {
        $survey = Event::findOrFail($id);

        return view('survey.form_iv')
            ->with('survey',$survey)
            ->with('attendance',$attendance);;
    }

    public function formgl($id, SurveyAttendance $attendance)
    {
        $survey = Event::findOrFail($id);

        return view('survey.form_gl')
            ->with('survey',$survey)
            ->with('attendance',$attendance);;
    }

    public function postform(Request $request, $id)
    {
        $attendance = EventAttendance::findOrFail($request->attendance_id);

        $survey = Event::find($id);

        if ($attendance) {

            $survey_result = EventResult::where('attendance_id',$attendance->id)->first();

            if (empty($survey_result)) {
                $request['survey_id'] = $id;
                $request['civil_no'] = $attendance->civil_no;
                $request['email'] = $attendance->email;
                $request['participant_name'] = $attendance->fullname_en;
                $request['participant_name_ar'] = $attendance->fullname_ar ?? null;

                $createdResult = EventResult::create($request->all());

                $shouldIssueCertificate = $survey && (int)($survey->has_certificate ?? 1) === 1;

                if ($shouldIssueCertificate) {
                    if (!empty($createdResult->email)) {
                        Mail::to($createdResult->email)->send(new CertificateMail($createdResult));
                    }

                    Alert::success('Thank you for your response', 'Your Response has been submitted. Your certificate has been issued.');
                    return redirect()->route('certificate.view', $createdResult->id);
                }

                Alert::success('شكراً لتقييمكم', 'تم استلام تقييمكم بنجاح');
            } else {
                Alert::error('Error','Your Have already submitted your feedback');

            }
        } else {
            Alert::error('Error','Your Have not attended');
        }


        return redirect()->route('event.public');
    }

    public function mean($survey_id)
    {
        $survey = \DB::table('events')->where('id',$survey_id)->first();

        $survey_result = \DB::table('event_results')
                                ->where('survey_id',$survey_id)
                                ->select(\DB::raw("
                                    count(id) as totalres,
                                    count(if(q1 = 1,1, NULL)) as q1_1,count(if(q1 = 2,1, NULL)) as q1_2,count(if(q1 = 3,1, NULL)) as q1_3,count(if(q1 = 4,1, NULL)) as q1_4,count(if(q1 = 5,1, NULL)) as q1_5,
                                    count(if(q2 = 1,1, NULL)) as q2_1,count(if(q2 = 2,1, NULL)) as q2_2,count(if(q2 = 3,1, NULL)) as q2_3,count(if(q2 = 4,1, NULL)) as q2_4,count(if(q2 = 5,1, NULL)) as q2_5,
                                    count(if(q3 = 1,1, NULL)) as q3_1,count(if(q3 = 2,1, NULL)) as q3_2,count(if(q3 = 3,1, NULL)) as q3_3,count(if(q3 = 4,1, NULL)) as q3_4,count(if(q3 = 5,1, NULL)) as q3_5,
                                    count(if(q4 = 1,1, NULL)) as q4_1,count(if(q4 = 2,1, NULL)) as q4_2,count(if(q4 = 3,1, NULL)) as q4_3,count(if(q4 = 4,1, NULL)) as q4_4,count(if(q4 = 5,1, NULL)) as q4_5,
                                    count(if(q5 = 1,1, NULL)) as q5_1,count(if(q5 = 2,1, NULL)) as q5_2,count(if(q5 = 3,1, NULL)) as q5_3,count(if(q5 = 4,1, NULL)) as q5_4,count(if(q5 = 5,1, NULL)) as q5_5,
                                    count(if(q6 = 1,1, NULL)) as q6_1,count(if(q6 = 2,1, NULL)) as q6_2,count(if(q6 = 3,1, NULL)) as q6_3,count(if(q6 = 4,1, NULL)) as q6_4,count(if(q6 = 5,1, NULL)) as q6_5,
                                    count(if(q7 = 1,1, NULL)) as q7_1,count(if(q7 = 2,1, NULL)) as q7_2,count(if(q7 = 3,1, NULL)) as q7_3,count(if(q7 = 4,1, NULL)) as q7_4,count(if(q7 = 5,1, NULL)) as q7_5,
                                    count(if(q8 = 1,1, NULL)) as q8_1,count(if(q8 = 2,1, NULL)) as q8_2,count(if(q8 = 3,1, NULL)) as q8_3,count(if(q8 = 4,1, NULL)) as q8_4,count(if(q8 = 5,1, NULL)) as q8_5,
                                    count(if(q9 = 1,1, NULL)) as q9_1,count(if(q9 = 2,1, NULL)) as q9_2,count(if(q9 = 3,1, NULL)) as q9_3,count(if(q9 = 4,1, NULL)) as q9_4,count(if(q9 = 5,1, NULL)) as q9_5,
                                    count(if(q10 = 1,1, NULL)) as q10_1,count(if(q10 = 2,1, NULL)) as q10_2,count(if(q10 = 3,1, NULL)) as q10_3,count(if(q10 = 4,1, NULL)) as q10_4,count(if(q10 = 5,1, NULL)) as q10_5
                                    "))
                                ->first();

        $survey_comments = \DB::table('event_results')->select('comments')->where('survey_id',$survey_id)->get();

        //dd($survey_result);
        if($survey_result->totalres > 0) {
            //1 = Community Training
            if ($survey->survey_type_id == 1) {

                return view('survey.form_mean_cts')
                    ->with('survey',$survey)
                    ->with('survey_result',$survey_result)
                    ->with('survey_comments', $survey_comments);

            }
            // 2= Industry Visit
            if ($survey->survey_type_id == 2) {

                return view('survey.form_mean_iv')
                    ->with('survey',$survey)
                    ->with('survey_result',$survey_result)
                    ->with('survey_comments', $survey_comments);

            }

            // 3 = Guest Lecture
            if ($survey->survey_type_id == 3) {

                return view('survey.form_mean_gl')
                    ->with('survey',$survey)
                    ->with('survey_result',$survey_result)
                    ->with('survey_comments', $survey_comments);

            }
        } else {

            Alert::error('No Respondents','Cant Generate Report');

            return redirect()->route('event.index');
        }


    }

    public function participants($survey_id)
    {
        $participants = \DB::table('event_results')->where('survey_id',$survey_id)->get();

        $survey = Event::find($survey_id);

        return view('survey.participants')
            ->with('participants',$participants)
            ->with('survey',$survey);
    }

    public function attendance($survey_id)
    {
        $event = Event::findOrFail($survey_id);
        $departments = \App\Models\Department::pluck('name', 'id');
        
        return view('survey.attendance')
            ->with('event', $event)
            ->with('survey_id',$survey_id)
            ->with('departments',$departments);
    }

    public function postattendance(AttendanceRequest $request, $event_id)
    {
        $event = Event::find($event_id);
        $hasCertificate = $event && (int)($event->has_certificate ?? 1) === 1;

        $event_attendance = EventAttendance::where('survey_id',$event_id)->where('civil_no',$request->civil_no)->first();

        if ($event_attendance) {

            //$event_attendance->update($request->all());

            $other_attendance = EventOtherAttendance::create([
                'survey_attendance_id' => $event_attendance->id,
                'survey_id' => $event_attendance->survey_id
            ]);

            if ($hasCertificate) {
                toast('Thank you, attendance updated. Please submit feedback to receive the certificate.','success');
            } else {
                toast('Thank you, attendance updated. Please submit feedback.','success');
            }

            return redirect()->route('event.feedback', $event_id);

        } else {
            $request['survey_id'] = $event_id;

            $event_att = EventAttendance::create($request->all());

            EventOtherAttendance::create([
                'survey_attendance_id' => $event_att->id,
                'survey_id' => $event_att->survey_id
            ]);

            if ($hasCertificate) {
                toast('Thank you, you have attended. Please submit feedback to receive the certificate.','success');
            } else {
                toast('Thank you, you have attended. Please submit feedback.','success');
            }

            return redirect()->route('event.feedback', $event_id);

        }

        return redirect()->route('event.public');
    }
}