@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('academicyear.create') }}" class="btn btn-success"> New Sem/Academic Year</a>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th class="text-center">SN</th>
                            <th>Semester/Academic Year</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn=1 @endphp
                        @foreach($academic_years as $ay)
                        <tr>
                            <td class="text-center">{{ $sn++ }}</td>
                            <td>{{ $ay->name }}</td>
                            <td>
                                @if($ay->is_active == 1)
                                Active
                                @else
                                In-Active
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('academicyear.edit',$ay->id) }}" class="btn btn-info"> Edit</a>
                                @if($ay->is_active == 1)
                                <a href="{{ route('academicyear.setinactive',$ay->id) }}" class="btn btn-danger">Set In-Active</a>
                                @else
                                <a href="{{ route('academicyear.setactive',$ay->id) }}" class="btn btn-success">Set Active</a>
                                @endif

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