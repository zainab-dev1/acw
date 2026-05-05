@extends('layouts.content')

@section('maincontent')
<div class="card">
    <div class="card-body">
        <a href="{{ route('userrole.create') }}" class="btn btn-primary"> Add New</a>
        <table class="table table-bordered table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th class="text-center">SN</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $sn=1 @endphp
                @foreach($userroles as $userrole)
                <tr>
                    <td class="text-center">{{ $sn++ }}</td>
                    <td>{{ $userrole->user->fullname }}</td>
                    <td>{{ $userrole->role->name }}</td>
                    <td>
                        <a href="{{ route('userrole.destroy',$userrole->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection