@extends('layouts.content')

@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <!-- Header with Logo -->
                <div class="text-center mb-4">
                    <h2 style="color: #4f46e5; font-weight: 700; margin-bottom: 10px;">
                        Available Activities
                    </h2>
                    <p style="color: #64748b; font-size: 14px;">Scan QR Code to Register</p>
                </div>

                <!-- Events Table -->
                <div class="card" style="border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <div class="card-body" style="padding: 30px;">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                        <th style="border: none; padding: 15px;">No.</th>
                                        <th style="border: none; padding: 15px;">Activity Type</th>
                                        <th style="border: none; padding: 15px;">Date</th>
                                        <th style="border: none; padding: 15px;">Time</th>
                                        <th style="border: none; padding: 15px;">Title / Name</th>
                                        <th style="border: none; padding: 15px;">Location</th>
                                        <th style="border: none; padding: 15px;">Award</th>
                                        <th class="text-center" style="border: none; padding: 15px;">Attendance</th>
                                        <th class="text-center" style="border: none; padding: 15px; display: none;">Feedback</th>
                                    </tr>
                                </thead>
                                @php $sn =1 @endphp
                                <tbody>
                                    @foreach ($surveys as $survey)
                                    <tr style="border-bottom: 1px solid #e2e8f0;">
                                        <td style="padding: 20px; vertical-align: middle;">{{ $sn++ }}</td>
                                        <td style="padding: 20px; vertical-align: middle;">
                                            <span style="background: #ede9fe; color: #6d28d9; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                                {{ $survey->type->name }}
                                            </span>
                                        </td>
                                        <td style="padding: 20px; vertical-align: middle;">{{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</td>
                                        <td style="padding: 20px; vertical-align: middle;">
                                            @if($survey->time)
                                                {{ \Carbon\Carbon::parse($survey->time)->format('h:i A') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td style="padding: 20px; vertical-align: middle; font-weight: 600; color: #1e293b;">{{ $survey->title }}</td>
                                        <td style="padding: 20px; vertical-align: middle;">{{ $survey->location ?? '-' }}</td>
                                        <td style="padding: 20px; vertical-align: middle;">
                                            @if(($survey->award_type ?? 'none') !== 'none')
                                                {{ ucfirst($survey->award_type) }}{{ $survey->award_details ? ' - ' . $survey->award_details : '' }}
                                            @else
                                                None
                                            @endif
                                        </td>
                                        <td class="text-center" style="padding: 20px; vertical-align: middle;">
                                            @if($survey->is_open == 1)
                                                @php $attendance_link = route('activity.register',$survey->id) @endphp
                                                <div style="background: white; padding: 10px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate($attendance_link)) !!}" 
                                                            style="border-radius: 6px;">
                                                </div>
                                                <p style="margin-top: 10px; margin-bottom: 0;">
                                                    <a href="{{ $attendance_link }}" 
                                                        style="color: #4f46e5; font-weight: 600; text-decoration: none; font-size: 14px;">
                                                        <i class="ti-user"></i> Attendance
                                                    </a>
                                                </p>
                                            @else
                                                <span style="color: #94a3b8; font-size: 14px;">
                                                    <i class="ti-lock"></i> Closed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="padding: 20px; vertical-align: middle; display: none;">
                                            @if($survey->is_open == 1 && (int)($survey->has_feedback ?? 1) === 1 && (($survey->survey_type_id == 1) || ($survey->survey_type_id == 2) || ($survey->survey_type_id == 3)))
                                                @php $feedback_link = route('activity.feedback',$survey->id) @endphp
                                                <div style="background: white; padding: 10px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->eye('circle')->size(120)->generate($feedback_link)) !!}"
                                                            style="border-radius: 6px;">
                                                </div>
                                                <p style="margin-top: 10px; margin-bottom: 0;">
                                                    <a href="{{ $feedback_link }}" 
                                                        style="color: #10b981; font-weight: 600; text-decoration: none; font-size: 14px;">
                                                        <i class="ti-comment"></i> Feedback
                                                    </a>
                                                </p>
                                            @else
                                                <span style="color: #94a3b8; font-size: 14px;">
                                                    <i class="ti-lock"></i> Closed
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
.public-events-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.events-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    padding: 40px;
}

.table-hover tbody tr:hover {
    background-color: #f8fafc;
    transition: all 0.2s ease;
}
</style>
@endsection