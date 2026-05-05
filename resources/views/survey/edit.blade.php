@extends('layouts.content')

@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2>Edit Activity</h2>

                    {{ Form::model($survey, ['route' => ['activity.update', $survey->id]]) }}
                    @include('survey._prepareform',['submitText'=>' Update'])
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
