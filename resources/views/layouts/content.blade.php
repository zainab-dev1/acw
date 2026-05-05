@extends('layouts.base')    

@section('base')
    @include('layouts._sidebar')
    @include('layouts._header')

    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                
                <!-- /# row -->
                @yield('maincontent')
                
            </div>
        </div>
    </div>

@endsection