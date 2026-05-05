@extends('layouts.content')

@section('maincontent')
<section id="main-content">
<div class="card">
    <div class="card-body">
        {{ Form::model($survey_result,['route'=>['certificate.update', $survey_result->id ?? 0]]) }}
            <div class="form-group">
                <label for="participant_name">Participant Name</label>
                {{ Form::text('participant_name',null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                <label for="participant_name_ar">Participant Name (Ar)</label>
                {{ Form::text('participant_name_ar',null, ['class'=>'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                {{ Form::text('email',null, ['class'=>'form-control']) }}
            </div>
            <button class="btn btn-success"> Update</button>
        {{ Form::close() }}
    </div>
</div>
</section>
@endsection