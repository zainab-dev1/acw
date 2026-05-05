@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('activity.index') }}" class="mb-4">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="academic_year_id" class="font-weight-bold">Select Academic Year - اختر العام الأكاديمي</label>
                                <select name="academic_year_id" id="academic_year_id" class="form-control" required>
                                    <option value="">Select Academic Year - اختر العام الأكاديمي</option>
                                    @foreach($academic_years as $year)
                                        <option value="{{ $year->id }}" {{ $selected_year == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                     عرض البيانات / Show Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                @if($selected_year)
                <div class="table-responsive">
                    <table class="table table-hover" style="border: none;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <th style="border: none; padding: 15px;">No.</th>
                                <th style="border: none; padding: 15px;">Type</th>
                                <th style="border: none; padding: 15px;">Date</th>
                                <th style="border: none; padding: 15px;">Time</th>
                                <th style="border: none; padding: 15px;">Title</th>
                                <th style="border: none; padding: 15px;">Location</th>
                                <th style="border: none; padding: 15px;">Award</th>
                                <th style="border: none; padding: 15px;">Status</th>
                                <th style="border: none; padding: 15px;">Participants</th>
                                <th style="border: none; padding: 15px;">Actions</th>
                            </tr>
                        </thead>
                        @php $sn =1 @endphp
                        <tbody>
                            @foreach ($surveys as $survey)
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 20px; vertical-align: middle;">{{ $sn++ }}</td>
                                <td style="padding: 20px; vertical-align: middle;">
                                        {{ $survey->type->name }}
                                </td>
                                <td style="padding: 20px; vertical-align: middle;">{{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    @if($survey->time)
                                        {{ \Carbon\Carbon::parse($survey->time)->format('h:i A') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td style="padding: 20px; vertical-align: middle; font-weight: 600; color: #1e293b;">{{ $survey->title }}</td>
                                <td style="padding: 20px; vertical-align: middle;">{{ $survey->location ?? '-' }}</td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    @if(($survey->award_type ?? 'none') !== 'none')
                                        {{ ucfirst($survey->award_type) }}{{ $survey->award_details ? ' - ' . $survey->award_details : '' }}
                                    @else
                                        None
                                    @endif
                                </td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    @if ($survey->is_open == 1)
                                    <span style="color: #16a34a;">
                                        <i class="ti-check-box"></i> Open - مفتوح
                                    </span>
                                    @else
                                    <span style="color: #dc2626;">
                                        <i class="ti-na"></i> Closed - مغلق
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center" style="padding: 20px; vertical-align: middle; font-weight: 600; color: #4f46e5; font-size: 16px;">
                                    {{ $survey->attendances()->count() }}
                                </td>
                                <td style="padding: 20px; vertical-align: middle;">
                                    <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                                        @if ($survey->is_open == 1)
                                        <a href="{{ route('activity.isclose',$survey->id) }}" class="btn btn-danger btn-sm" style="border-radius: 6px;">
                                            <i class="ti-lock"></i> Close
                                        </a>
                                        @else
                                        <a href="{{ route('activity.isopen',$survey->id) }}" class="btn btn-success btn-sm" style="border-radius: 6px;">
                                            <i class="ti-unlock"></i> Open
                                        </a>
                                        @endif
                                        <a href="{{ route('activity.mean',$survey->id) }}" class="btn btn-info btn-sm" style="border-radius: 6px; display: none;">
                                            <i class="ti-bar-chart"></i> Results
                                        </a>
                                        <a href="{{ route('activity.participants', $survey->id) }}" class="btn btn-warning btn-sm" style="border-radius: 6px;">
                                            <i class="ti-user"></i> Participants
                                        </a>
                                        <a href="{{ route('activity.edit',$survey->id) }}" class="btn btn-primary btn-sm" style="border-radius: 6px;">
                                            <i class="ti-pencil"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-warning text-center">
                    Please select an academic year to display the data - يرجى اختيار العام الأكاديمي لعرض البيانات
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    /* Action Buttons Styling */
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        margin: 2px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .btn-sm i {
        margin-right: 4px;
    }
    
    /* Badge Styling */
    .badge {
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 6px;
    }
    
    .badge i {
        margin-right: 4px;
    }
    
    /* Table Header */
    .bg-primary th {
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        padding: 12px 8px;
    }
    
    /* Table Body */
    /* Table Styling */
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8fafc !important;
        transform: scale(1.001);
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
    }
</style>
@endsection