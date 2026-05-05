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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route'=>'certificate.postlist']) }}
                    <div class="form-group">
                        <label for="email">Email</label>
                        {{ Form::text('email',null, ['class'=>'form-control']) }}
                    </div>
                    <button class="btn btn-success"> Search</button>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route'=>'certificate.postlist']) }}
                    <div class="form-group">
                        <label for="civlno">Civil No</label>
                        {{ Form::text('civilno',null, ['class'=>'form-control']) }}
                    </div>
                    <button class="btn btn-success"> Search</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if ($certificates)
                    <table class="table table-bordered">
                        <tr>
                            <th>SN</th>
                            <th>Participant Name (EN)</th>
                            <th>Participant Name (Ar)</th>
                            <th>training</th>
                            <th>Training Date</th>                            
                        </tr>
                        @php $sn =1 @endphp
                        @foreach($certificates as $certificate)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td>{{ $certificate->participant_name }}</td>
                            <td>{{ $certificate->participant_name_ar }}</td>
                            <td>{{ $certificate->survey->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($certificate->survey->training_date)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection