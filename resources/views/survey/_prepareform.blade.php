<div class="form-group">
    <label for="academic_year">Academic Year</label>
    {{ Form::select('academic_year_id', $academic_years, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="survey_tye_id">Activity Type</label>
    {{ Form::select('survey_type_id', $survey_types, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="title">Title / Name</label>
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="training_date">Date</label>
    {{ Form::date('training_date', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="time">Time</label>
    {{ Form::time('time', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="location">Location</label>
    {{ Form::text('location', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="award_type">Award (Certificates or Prizes)</label>
    {{ Form::select('award_type', ['none' => 'None', 'certificate' => 'Certificate', 'prize' => 'Prize'], null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="award_details">Award Details</label>
    {{ Form::text('award_details', null, ['class' => 'form-control', 'placeholder' => 'e.g., Participation Certificate / 1st Prize']) }}
</div>

<div class="form-group">
    <label for="has_participant_limit">Participant limit enabled?</label>
    {{ Form::select('has_participant_limit', [0 => 'No limit', 1 => 'Limit participants'], null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="participant_limit">Maximum participants (optional)</label>
    {{ Form::number('participant_limit', null, ['class' => 'form-control', 'min' => 1, 'placeholder' => 'e.g., 30']) }}
    <small class="text-muted">If “Limit participants” is enabled, registration will close automatically when the seats are full.</small>
</div>

<div class="form-group">
    <label for="has_attachment">Attachment upload required?</label>
    {{ Form::select('has_attachment', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control']) }}
    <small class="text-muted">If enabled, the registration page will show a file upload field.</small>
</div>

<div class="form-group">
    <label for="has_feedback">Feedback enabled?</label>
    {{ Form::select('has_feedback', [1 => 'Open (show feedback button)', 0 => 'Closed (hide feedback button)'], null, ['class' => 'form-control']) }}
    <small class="text-muted">If closed, the public page will not show the Feedback button (even if registration is open).</small>
</div>

<button class="btn btn-success"> {{ $submitText }}</button>
