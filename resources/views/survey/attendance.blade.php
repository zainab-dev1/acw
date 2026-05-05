@extends('layouts.base')

@section('base')
<style>
    body {
        font-family: 'DINNextLTArabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .acw-bg {
        min-height: 100vh;
        background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat;
        padding: 1px 0 40px;
    }
    .acw-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 28px;
        border: 1px solid rgba(102, 126, 234, 0.15);
    }
    .acw-title {
        color: #ffffff;
        font-weight: 900;
        text-shadow: 0 2px 10px rgba(0,0,0,0.35);
        margin: 0;
    }
    .acw-subtitle {
        color: rgba(255, 255, 255, 0.95);
        font-weight: 700;
        margin-top: 6px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.35);
    }
    .acw-divider {
        position: relative;
        height: 10px;
        max-width: 980px;
        margin: 16px auto 0;
    }
    .acw-divider::before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 2px;
        background: linear-gradient(
            90deg,
            rgba(0, 208, 255, 0) 0%,
            rgba(0, 208, 255, 0.85) 18%,
            rgba(190, 246, 255, 0.95) 50%,
            rgba(0, 208, 255, 0.85) 82%,
            rgba(0, 208, 255, 0) 100%
        );
        box-shadow:
            0 0 10px rgba(0, 208, 255, 0.55),
            0 0 28px rgba(0, 208, 255, 0.35);
        border-radius: 999px;
    }
    .acw-divider::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(0, 208, 255, 0.95) 35%, rgba(0,208,255,0) 70%);
        box-shadow:
            0 0 20px rgba(0, 208, 255, 0.8),
            0 0 48px rgba(0, 208, 255, 0.55);
    }
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        outline: none;
    }
    /* Make the department dropdown height consistent (Bootstrap's select can be shorter) */
    .attendance-form select.form-control[name="department_id"] {
        height: 48px;
        line-height: 48px;
        padding-top: 0;
        padding-bottom: 0;
    }
    .btn-acw {
        background: linear-gradient(135deg, #284ca9ff 0%, #284ca9ff 100%);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 800;
        font-size: 15px;
        color: #fff;
        transition: all 0.2s ease;
    }
    .btn-acw:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(79, 70, 229, 0.28);
        color: #fff;
    }
    .field-label {
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .field-label i { color: #1d4ed8; }
</style>

<div class="acw-bg">
    <div class="container">
        <div class="acw-header">
            <div style="flex: 0 1 auto; text-align: center;">
                <img class="acw-logo" src="{{ asset('theme/images/acw-white.png') }}" alt="Academic Creativity Week">
            </div>
            <div style="flex: 1 1 200px; text-align: right;">
                <img class="utas-logo" src="{{ asset('theme/images/utas-logo-w.png') }}" alt="UTAS">
            </div>
        </div>

        <div class="text-center" style="margin-bottom: 18px;">
            <h2 class="acw-title">Registration - التسجيل</h2>
            <div class="acw-divider"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="acw-card">
                    <div class="attendance-form">
                        @if($survey->is_open == 1)
                            @if(isset($is_full) && $is_full)
                                <div class="alert alert-danger text-center" style="border-radius: 12px; padding: 30px; background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); border: none; color: white;">
                                    <i class="ti-na" style="font-size: 25px; margin-bottom: 15px; display: block;"></i>
                                    <h5 style="color: white; font-weight: 700; margin-bottom: 10px;">
                                        Seats are full
                                    </h5>
                                    <h5 style="color: white; font-weight: 700; margin-bottom: 15px;">
                                        المقاعد مكتملة
                                    </h5>
                                    <p style="color: rgba(255,255,255,0.95); font-size: 15px; margin-bottom: 0;">
                                        Registration for this activity is no longer available
                                    </p>
                                </div>
                            @else
                            @if ($errors->any())
                                <div class="alert alert-danger" style="border-radius: 8px; border-left: 4px solid #dc2626;">
                                    <ul style="margin-bottom: 0;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            {{ Form::open(['route'=>['activity.postregister',$survey->id], 'files' => true]) }}
                        
                        <div class="form-group">
                            <label class="field-label"><i class="ti-user"></i> Full Name (English)</label>
                            {{ Form::text('fullname_en',null, ['class'=>'form-control', 'placeholder'=>'Enter your full name in English', 'required'=>true]) }}
                        </div>
                        
                        <div class="form-group">
                            <label class="field-label"><i class="ti-mobile"></i> Phone Number - رقم الهاتف</label>
                            {{ Form::text('civil_no',null, ['class'=>'form-control', 'placeholder'=>'أدخل رقم الهاتف', 'required'=>true]) }}
                        </div>
                        
                        <div class="form-group">
                            <label class="field-label"><i class="ti-briefcase"></i> Department - القسم</label>
                            {{ Form::select('department_id', $departments ?? [], null, ['class'=>'form-control', 'placeholder'=>'Select your department', 'required'=>true]) }}
                        </div>
                        
                        <div class="form-group">
                            <label class="field-label"><i class="ti-email"></i> Email Address - البريد الإلكتروني</label>
                            {{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Enter your email address', 'required'=>true]) }}
                        </div>

                        @if((int)($survey->has_attachment ?? 0) === 1)
                        <div class="form-group">
                            <label class="field-label"><i class="ti-clip"></i> Attach File - إرفاق ملف</label>
                            {{ Form::file('attachment', ['class'=>'form-control', 'required'=>false]) }}
                            <small class="text-muted">Optional (يمكن رفع أي نوع ملف بما في ذلك الصوت/الفيديو حسب متطلبات الفعالية).</small>
                        </div>
                        @endif
                        
                        <button type="submit" class="btn btn-acw btn-block" style="margin-top: 20px;">
                            <i class="ti-check"></i>Register - تسجيل
                        </button>
                        
                        {{ Form::close() }}
                        
                            @endif
                        @else
                            <!-- Event Closed Message -->
                            <div class="alert alert-warning text-center" style="border-radius: 12px; padding: 30px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); border: none; color: white;">
                                <i class="ti-lock" style="font-size: 25px; margin-bottom: 15px; display: block;"></i>
                                <h5 style="color: white; font-weight: 700; margin-bottom: 10px;">
                                    Activity Registration Closed
                                </h5>
                                <h5 style="color: white; font-weight: 700; margin-bottom: 15px;">
                                    التسجيل في الورشة مغلق
                                </h5>
                                <p style="color: rgba(255,255,255,0.9); font-size: 15px; margin-bottom: 0;">
                                    Registration for this activity is no longer available
                                </p>
                                <p style="color: rgba(255,255,255,0.9); font-size: 15px;">
                                    التسجيل في هذه الورشة غير متاح حالياً
                                </p>
                            </div>
                        @endif
                        
                        <div class="text-center m-t-15">
                            <a href="{{ route('public.upcoming') }}" style="color: #1e188eff; font-size: 14px; text-decoration: none; font-weight: 500;">
                                <i class="ti-arrow-left"></i> Back - رجوع
                            </a>

                            <span style="display:inline-block; margin: 0 10px; opacity: 0.35;">|</span>

                            <a href="{{ route('public') }}" style="color: #1e188eff; font-size: 14px; text-decoration: none; font-weight: 800;">
                                <i class="ti-home"></i> Home - الرئيسية
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="row mt-4">
            <div class="col-lg-12">
                @include('layouts._footer')
            </div>
        </div>
</div>
@endsection