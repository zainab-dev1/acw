@extends('layouts.base')

@section('base')
<section id="main-content">
    <div class="row">
        <div class="col-lg-12">
            <div>
                <center>
                    <a href="{{ route('public') }}"><img src="{{ asset('theme/images/utas-logo.png') }}" alt="" width="20%"></a>
                </center>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Industrial and Community Engagement Committee</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>Verify Certificate Here :</h3>
                    {{ Form::open(['route'=>'certificate.postverify']) }}
                        <div class="form-group">
                            <label for="certificate_code">Certificate Code :</label>
                            {{ Form::text('certificate_code',null, ['class'=>'form-control']) }}
                        </div>
                        <button class="btn btn-success"> Verfiry Now</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($certificate)
                    <h3><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
</svg> Verfied Certificate</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Certificate No.</th>
                            <th>{{ sprintf('%08d', $certificate->id) }}</th>                            
                        </tr>
                        <tr>
                            <th>Training Title</th>
                            <th>{{ $certificate->survey->title }}</th>
                        </tr>                        
                        <tr>
                            <th>Training Date</th>
                            <th>{{ \Carbon\Carbon::parse($certificate->survey->training_date)->format('d M Y') }}</th>
                        </tr>
                        <tr>
                            <th>Participant Name English</th>
                            <th>{{ $certificate->participant_name }}</th>
                        </tr>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection