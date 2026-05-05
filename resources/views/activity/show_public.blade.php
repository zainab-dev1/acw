@extends('layouts.base')

@section('base')
<style>
    body {
        font-family: 'DINNextLTArabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .detail-hero {
        background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat;
        padding: 40px 0;
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
    }
    .detail-hero > .container {
        position: relative;
    }
    .detail-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    .detail-hero i {
        color: #bfdbfe;
    }
    .detail-card i {
        color: #1d4ed8;
    }
    .meta-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }
    @media (min-width: 768px) {
        .meta-row {
            grid-template-columns: 1fr 1fr;
        }
    }
    .meta-item {
        background: #f8fafc;
        border: 1px solid rgba(102, 126, 234, 0.15);
        border-radius: 12px;
        padding: 14px 16px;
        color: #0f172a;
    }
    .meta-item .label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .meta-item .value {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }
    .desc {
        white-space: pre-line;
        color: #334155;
    }
</style>
<div style="min-height: 100vh; background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat; padding: 13px 0 40px;">
    <div style="position:relative;">
        <div class="detail-hero" style="background: transparent; padding-top: 0;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
            <div>
                <h2 style="margin:0; font-weight: 800;">{{ $activity->title }}</h2>
                <div style="opacity: 0.95; margin-top: 6px;">
                    <span style="margin-right: 12px;"><i class="ti-bookmark-alt"></i> {{ $activity->detail->category ?? 'Activity' }}</span>
                    <span style="margin-right: 12px;"><i class="ti-calendar"></i> {{ \Carbon\Carbon::parse($activity->training_date)->format('d M Y') }}</span>
                    @if($activity->time)
                        <span><i class="ti-time"></i> {{ \Carbon\Carbon::parse($activity->time)->format('h:i A') }}</span>
                    @endif
                </div>
            </div>
            <div>
                <a href="{{ route('public.upcoming') }}" class="btn btn-light" style="border-radius: 10px; font-weight: 700;">
                    <i class="ti-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
        </div>
    </div>
<br>

<div class="container" style="margin-top: -22px; padding-bottom: 40px;">
    <div class="detail-card">

        <div class="meta-row">
            <div class="meta-item">
                <div class="label">Place</div>
                <div class="value">{{ $activity->detail->place ?? $activity->location ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Location</div>
                <div class="value">{{ $activity->location ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Time Range</div>
                <div class="value">{{ $activity->detail->time_range ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Category</div>
                <div class="value">{{ $activity->detail->category ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Contact person</div>
                <div class="value">{{ $activity->detail->contact_person ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Email</div>
                <div class="value">
                    @if(!empty($activity->detail->contact_email))
                        <a href="mailto:{{ $activity->detail->contact_email }}">{{ $activity->detail->contact_email }}</a>
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="meta-item">
                <div class="label">Certificate</div>
                <div class="value">{{ $activity->detail->certificate_policy ?? '-' }}</div>
            </div>
            <div class="meta-item">
                <div class="label">Prizes</div>
                <div class="value">{{ $activity->detail->prizes ?? '-' }}</div>
            </div>
        </div>

        <hr style="margin: 22px 0;" />

        <h4 style="font-weight: 800; color: #0f172a;">Description</h4>
        <div class="desc">{{ $activity->detail->description ?? '-' }}</div>

        @if(!empty($activity->public_file_1_path) || !empty($activity->public_file_2_path))
            <hr style="margin: 22px 0;" />
            <h4 style="font-weight: 800; color: #0f172a;">More details files</h4>
            <div class="meta-row" style="margin-top: 10px;">
                @if(!empty($activity->public_file_1_path))
                    <div class="meta-item" style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                        <div>
                            <div class="label">File 1</div>
                            <div class="value">Download / تحميل</div>
                        </div>
                        <a class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 800;" href="{{ asset('storage/' . $activity->public_file_1_path) }}" target="_blank" rel="noopener">
                            <i class="ti-download"></i> Download
                        </a>
                    </div>
                @endif
                @if(!empty($activity->public_file_2_path))
                    <div class="meta-item" style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                        <div>
                            <div class="label">File 2</div>
                            <div class="value">Download / تحميل</div>
                        </div>
                        <a class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 800;" href="{{ asset('storage/' . $activity->public_file_2_path) }}" target="_blank" rel="noopener">
                            <i class="ti-download"></i> Download
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <hr style="margin: 22px 0;" />

        <div class="d-flex justify-content-between flex-wrap" style="gap: 10px;">
            <div>
                @if($prev)
                    <a class="btn btn-outline-primary" style="border-radius: 10px;" href="{{ route('activity.show', $prev->id) }}">
                        <i class="ti-angle-left"></i> Previous
                    </a>
                @endif
            </div>
            <div>
                @if($activity->is_open == 1)
                    <a class="btn btn-success" style="border-radius: 10px; font-weight: 800;" href="{{ route('activity.register', $activity->id) }}">
                        <i class="ti-pencil"></i> Register
                    </a>
                    @if((int)($activity->has_feedback ?? 1) === 1)
                        <a class="btn btn-info" style="border-radius: 10px; font-weight: 800;" href="{{ route('activity.feedback', $activity->id) }}">
                            <i class="ti-comment"></i> Feedback
                        </a>
                    @endif
                @endif
            </div>
            <div>
                @if($next)
                    <a class="btn btn-outline-primary" style="border-radius: 10px;" href="{{ route('activity.show', $next->id) }}">
                        Next <i class="ti-angle-right"></i>
                    </a>
                @endif
            </div>
        </div>

    </div>

    <div class="mt-4">
        @include('layouts._footer')
    </div>
</div>
@endsection
