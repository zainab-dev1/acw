<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Event;
use App\Models\EventResult;
use Illuminate\Http\Request;
use App\Mail\CertificateMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\EventAssignatory;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CertificateController extends Controller
{
    public function view($id)
    {
        $survey_result = EventResult::find($id);
        if (!$survey_result) {
            Alert::error('Not Found', 'Certificate not found');
            return redirect()->route('certificate.verify');
        }

        // New system uses activities; keep fallback to old events for backward compatibility.
        $survey = Activity::find($survey_result->survey_id) ?? Event::find($survey_result->survey_id);
        if (!$survey) {
            Alert::error('Not Found', 'Activity/Event not found for this certificate');
            return redirect()->route('certificate.verify');
        }

        $assignatories = EventAssignatory::where('survey_id', $survey->id)->first();

        $qrlink = route('certificate.view',$id);

        if (empty($assignatories)) {
            $assignatories = EventAssignatory::where('is_default', 1)->first();
        }
        
/*
            return view('certificate.view')
                ->with('survey_result',$survey_result)
                ->with('survey',$survey)
                ->with('assignatories',$assignatories);

 */
        
        
        
                $pdf = Pdf::loadView('certificate.view', compact('survey_result', 'survey', 'assignatories', 'qrlink'));

                return $pdf->stream();
    }

    public function edit($id)
    {
        $survey_result = EventResult::findOrFail($id);

        return view('certificate.edit')->with('survey_result',$survey_result);
    }

    public function update(Request $request, $id)
    {
        $survey_result = EventResult::find($id);
        if (!$survey_result) {
            Alert::error('Not Found', 'Certificate not found');
            return redirect()->route('certificate.list');
        }

        $survey_result->update($request->all());

        return redirect()->route('activity.participants', $survey_result->survey_id);
    }

    public function email($id)
    {
        $survey_result = EventResult::findOrFail($id);

        //Send Email
        if ($survey_result->email) {
            Mail::to($survey_result->email)->send(new CertificateMail($survey_result));
        }

    return redirect()->route('activity.participants',$survey_result->survey_id);
    }

    public function verify()
    {
        $certificate = [];

        return view('certificate.verify')
            ->with('certificate',$certificate);
    }

    public function postverify(Request $request)
    {
        $certno =(int)$request->certificate_code;

        $certificate = EventResult::where('id',$certno)->first();

        if ($certificate) {

            return view('certificate.verify')
                    ->with('certificate',$certificate);
        } else {

            Alert::error('Not Found','The Certificate Code not found on our records');

            return redirect()->route('certificate.verify');
        }
    }

    public function list()
    {
        $certificates = [];

        return view('certificate.list')->with('certificates',$certificates);
    }

    public function postlist(Request $request)
    {
        $certificates = [];

        if ($request->has('email')) {
            $certificates = EventResult::where('email',$request->email)->get();
        } else {
            if ($request->has('civilno')) {
                $certificates = EventResult::where('civil_no',$request->civilno)->get();
            }
        }

        return view('certificate.list')->with('certificates',$certificates);
    }
}
