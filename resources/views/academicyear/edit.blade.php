@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-4">
    <div class="card">
        <div class="card-body">
        {{ Form::model($ay,['route'=>['academicyear.update',$ay->id]]) }}
            @include('academicyear._form',['submitText'=>' Update'])
        {{ Form::close() }}
        </div>
    </div>
    </div>
    
</div>
@endsection