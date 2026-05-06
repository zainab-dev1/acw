<h1>Industry Visit Request</h1>

<p><strong>Academic Year:</strong> {{ $visit_requests->ay->name }}</p>
<p><strong>Activity Type:</strong> {{ $visit_requests->activity_type->name }}</p>
<p><strong>Department:</strong> {{ $visit_requests->department->name }}</p>
<p><strong>Section:</strong> {{ $visit_requests->section->name }}</p>
<p><strong>Participants:</strong> {{ $visit_requests->participant->name }}</p>
<p><strong>Proposed Date:</strong> {{ \Carbon\Carbon::parse($visit_requests->proposed_date)->format('d M Y') }}</p>
<p><strong>Proposed Time:</strong> {{ $visit_requests->start_time }} - {{ $visit_requests->end_time }}</p>
<p><strong>Committee/Course Name:</strong> {{ $visit_requests->committee_course_name }}</p>
<p><strong>Title:</strong> {{ $visit_requests->title_visit }}</p>
<p><strong>Industry Experts:</strong> {{ $visit_requests->industry_experts }}</p>
@if ($visit_requests->cv_link)
<p><strong>CV:</strong> {{ $visit_requests->cv_link }}</p>
@endif
<p><strong>Transport Required:</strong> @if ($visit_requests->is_transport) YES @else NO @endif</p>
<p><strong>Requested By:</strong> {{ $visit_requests->requested_by->fullname }}</p>
