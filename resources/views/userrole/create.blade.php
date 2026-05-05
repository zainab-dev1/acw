@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3>Assign Role</h3>
            </div>
            <div class="card-body">
                {{ Form::open(['route'=>'userrole.store']) }}
                <div class="form-group">
                    <label for="user">User</label>
                    {{ Form::select('user_id',$users,null, ['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    {{ Form::select('role_id',$roles, null, ['class'=>'form-control'])}}
                </div>
                <button class="btn btn-success"> Save</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>User</th>
                            <th>Role</th>
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
    </div>
</div>
@endsection