<p>Dear {{ $survey_result->participant_name }},</p>
<p>Thank you for your participation. Your Certificate is available through this link: {{ route('certificate.view',$survey_result->id) }}</p>

<p>Thank you,</p>

<p>ISETC Development Team</p>