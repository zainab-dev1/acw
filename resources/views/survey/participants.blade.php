@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex" style="align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                    <div>
                        <h3 style="margin: 0;">{{ $survey->title }}</h3>
                        <div class="text-muted" style="margin-top: 4px;">
                            {{ \Carbon\Carbon::parse($survey->training_date)->format('d M Y') }}
                            @if(!empty($survey->location))
                                • {{ $survey->location }}
                            @endif
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('activity.participants.export', $survey->id) }}" class="btn btn-primary btn-sm">
                            <i class="ti-export"></i> Export Excel
                        </a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>SN</th>
                        <th>Phone No</th>
                        <th>Name (English)</th>
                        @if((int)($survey->has_attachment ?? 0) === 1)
                            <th>Attachment</th>
                        @endif
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @php $sn = 1 @endphp
                    @foreach($participants as $participant)
                    <tr>
                        <td>{{ $sn++ }}</td>
                        <td>{{ $participant->civil_no }}</td>
                        <td>{{ $participant->fullname_en ?? '-' }}</td>
                        @if((int)($survey->has_attachment ?? 0) === 1)
                            <td>
                                @if(!empty($participant->attachment_path))
                                    <a class="btn btn-sm btn-primary" target="_blank" href="{{ asset('storage/' . ltrim($participant->attachment_path, '/')) }}">
                                        Download
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endif
                        <td>{{ $participant->email }}</td>
                        <td>                
                            <a href="{{ route('certificate.edit',$participant->id) }}" class="btn btn-warning btn-sm"> Edit Details</a>
                            <span class="text-muted" style="font-size: 12px; display: inline-block; margin-left: 6px;">
                                Certificate is issued after feedback submission
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection