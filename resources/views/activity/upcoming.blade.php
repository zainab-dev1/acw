@extends('layouts.base')

@section('base')
<style>
    body {
        font-family: 'DINNextLTArabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .detail-hero {
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

    .meta-item {
        background: #f8fafc;
        border: 1px solid rgba(102, 126, 234, 0.15);
        border-radius: 12px;
        padding: 16px 16px;
        color: #0f172a;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .meta-item .label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .meta-item .value {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        word-break: break-word;
    }

    .event-title-highlight {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 30px;
        background: linear-gradient(90deg, rgba(201, 191, 142, 0.55), rgba(240, 225, 198, 0.5));
        border: 1px solid rgba(251, 146, 60, 0.35);
        color: #0f172a;
        box-shadow: 0 8px 18px rgba(251, 146, 60, 0.20);
        line-height: 1.25;
        max-width: 100%;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .meta-list {
        display: grid;
        gap: 10px;
        margin-top: 2px;
    }

    .meta-pair {
        display: grid;
        gap: 2px;
    }

    .card-spacer {
        flex: 1 1 auto;
    }

        .read-more-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(29, 78, 216, 0.08);
            border: 1px solid rgba(29, 78, 216, 0.18);
            color: #1d4ed8;
            font-weight: 900;
            font-size: 13px;
            text-decoration: none;
        }
        .read-more-cta:hover {
            background: rgba(29, 78, 216, 0.12);
            text-decoration: none;
        }
</style>
<div style="min-height: 100vh; background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat; padding: 18px 0 40px;">
    <div style="position:relative;">
    <div class="detail-hero" style="background: transparent; padding-top: 0; padding-bottom: 18px;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap: 12px;">
                    <div>
                        <h2 style="margin:0; font-weight: 900;">الأنشطة القادمة</h2>
                        <div style="opacity:0.95; margin-top: 6px; font-weight: 700;">Upcoming Activities</div>
                    </div>
                    <div>
                        <a href="{{ route('public') }}" class="btn btn-light" style="border-radius: 10px; font-weight: 800;">
                            <i class="ti-arrow-left"></i> Back - رجوع
                        </a>
                        <a href="{{ route('public') }}" class="btn btn-outline-light" style="border-radius: 10px; font-weight: 900;">
                            <i class="ti-home"></i> Home - الرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="padding-bottom: 40px;">
        <div class="detail-card">

            @if(($events ?? collect())->count() === 0)
                <div class="text-center" style="padding: 40px 10px; color: #64748b;">
                    <i class="ti-calendar" style="font-size: 48px; color:#cbd5e1;"></i>
                    <h4 style="margin-top: 12px; font-weight: 900;">لا توجد أنشطة قادمة</h4>
                </div>
            @else
                <div class="row g-3">
                    @foreach($events as $event)
                        <div class="col-12 col-md-6 d-flex">
                            <a href="{{ route('activity.show', $event->id) }}" class="w-100" style="text-decoration:none; display:block;">
                                <div class="meta-item w-100">
                                    <div class="value event-title-highlight" style="font-size: 16px; font-weight: 900;">{{ $event->title }}</div>

                                    <div class="meta-list">
                                        <div class="meta-pair">
                                            <div class="label"><i class="ti-calendar"></i> Date <span dir="rtl">التاريخ</span></div>
                                            <div class="value">{{ \Carbon\Carbon::parse($event->training_date)->format('d M Y') }}</div>
                                        </div>

                                        <div class="meta-pair">
                                            <div class="label"><i class="ti-time"></i> Time <span dir="rtl">الوقت</span></div>
                                            <div class="value">
                                                @if(!empty(optional($event->detail)->time_range))
                                                    {{ optional($event->detail)->time_range }}
                                                @elseif($event->time)
                                                    {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </div>

                                        <div class="meta-pair">
                                            <div class="label"><i class="ti-location-pin"></i> Location <span dir="rtl">الموقع</span></div>
                                            <div class="value">{{ optional($event->detail)->place ?? ($event->location ?? '-') }}</div>
                                        </div>

                                        @if(!empty(optional($event->detail)->category))
                                            <div class="meta-pair">
                                                <div class="label"><i class="ti-tag"></i> Category <span dir="rtl">الفئة</span></div>
                                                <div class="value">{{ optional($event->detail)->category }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-spacer"></div>

                                    <span class="read-more-cta">
                                        <span>Read more</span>
                                        <span dir="rtl">المزيد</span>
                                        <i class="ti-arrow-right" style="color:#1d4ed8;"></i>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
            <div class="mt-4">
                @include('layouts._footer')
            </div>
</div>

@endsection