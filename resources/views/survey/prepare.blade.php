@extends('layouts.content')

@section('maincontent')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Create Activity</h4>

                    {{ Form::open(['route' => 'activity.postprepare', 'files' => true]) }}
                    @include('survey._prepareform',['submitText'=>' Save'])
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
