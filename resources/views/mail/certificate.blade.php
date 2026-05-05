<p>Dear {{ $survey_result->participant_name }},</p>
<p>Your Certificate is available through this link: {{ route('certificate.view',$survey_result->id) }}</p>

<p>Thank you,</p>
<p>Academic Creativity Week</p>

<p>//*** This is system generated Please dont reply to this email **//</p>