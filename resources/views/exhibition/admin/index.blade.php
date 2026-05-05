@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex" style="align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                    <div>
                        <h3 style="margin: 0;">Exhibition Registrations</h3>
                        <div class="text-muted" style="margin-top: 4px;">
                            Status:
                            @if($setting && $setting->is_open)
                                <span class="badge badge-success">Open</span>
                            @else
                                <span class="badge badge-danger">Closed</span>
                            @endif
                        </div>
                    </div>

                    <div style="display:flex; gap: 8px; flex-wrap: wrap;">
                        @if($setting && $setting->is_open)
                            <a class="btn btn-danger" href="{{ route('exhibition.admin.close') }}"><i class="ti-lock"></i> Close</a>
                        @else
                            <a class="btn btn-success" href="{{ route('exhibition.admin.open') }}"><i class="ti-unlock"></i> Open</a>
                        @endif

                        <a class="btn btn-primary" href="{{ route('exhibition.admin.export') }}"><i class="ti-export"></i> Export Excel</a>
                    </div>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Attachments</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $reg)
                                <tr>
                                    <td>{{ $reg->id }}</td>
                                    <td>{{ $reg->name }}</td>
                                       <td>{{ optional($reg->departmentRef)->name ?? $reg->department }}</td>
                                    <td>{{ $reg->email }}</td>
                                    <td>{{ $reg->phone }}</td>
                                    <td>
                                        @if($reg->files && $reg->files->count())
                                            <ul style="margin:0; padding-left: 18px;">
                                                @foreach($reg->files as $file)
                                                    <li>
                                                        <a href="{{ route('exhibition.admin.file.download', $file->id) }}">
                                                            {{ $file->original_name ?: basename($file->path) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ optional($reg->created_at)->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 12px;">
                    {{ $registrations->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
