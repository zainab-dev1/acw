@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-4">
    <div class="card">
        <div class="card-body">
        {{ Form::open(['route'=>'academicyear.store']) }}
            @include('academicyear._form',['submitText'=>' Save'])
        {{ Form::close() }}
        </div>
    </div>
    </div>
    
</div>
@endsection