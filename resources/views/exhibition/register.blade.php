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
        background: linear-gradient(90deg, rgba(0, 208, 255, 0) 0%, rgba(0, 208, 255, 0.85) 18%, rgba(190, 246, 255, 0.95) 50%, rgba(0, 208, 255, 0.85) 82%, rgba(0, 208, 255, 0) 100%);
        box-shadow: 0 0 10px rgba(0, 208, 255, 0.55), 0 0 28px rgba(0, 208, 255, 0.35);
        border-radius: 999px;
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
    .btn-acw {
        background: linear-gradient(135deg, #4f46e5 0%, #4f46e5 100%);
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
            <h2 class="acw-title">Exhibition Registration - التسجيل في المعرض</h2>
            <div class="acw-divider"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="acw-card">

                    @if($setting && !$setting->is_open)
                        <div class="alert alert-warning text-center" style="border-radius: 12px; padding: 22px;">
                            <strong>Registration is closed</strong><br>
                            التسجيل مغلق حاليا
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

                        {{ Form::open(['route'=>['exhibition.register.store'], 'files' => true]) }}

                        <div class="form-group">
                            <label class="field-label"><i class="ti-user"></i> Name / الاسم</label>
                            {{ Form::text('name', old('name'), ['class'=>'form-control', 'required'=>true]) }}
                        </div>

                        <div class="form-group">
                            <label class="field-label"><i class="ti-briefcase"></i> Department / القسم</label>
                               <select name="department_id" id="department_id" class="form-control" required style="height: 45px;">
                                   <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>-- اختر القسم / Select department --</option>
                                   @foreach(($departments ?? []) as $dept)
                                       <option value="{{ $dept->id }}" {{ (string)old('department_id') === (string)$dept->id ? 'selected' : '' }}>
                                           {{ $dept->name }}
                                       </option>
                                   @endforeach
                               </select>
                               @error('department_id')
                                   <small class="text-danger">{{ $message }}</small>
                               @enderror
                        </div>

                        <div class="form-group">
                            <label class="field-label"><i class="ti-email"></i> Email / البريد الإلكتروني</label>
                            {{ Form::email('email', old('email'), ['class'=>'form-control', 'required'=>true]) }}
                        </div>

                        <div class="form-group">
                            <label class="field-label"><i class="ti-mobile"></i> Phone / رقم الهاتف</label>
                            {{ Form::text('phone', old('phone'), ['class'=>'form-control', 'required'=>true]) }}
                        </div>

                        <div class="form-group">
                            <label class="field-label"><i class="ti-clip"></i> Attachments / المرفقات</label>
                            <input type="file" name="attachments[]" class="form-control" multiple required>
                            <small class="text-muted">You can upload multiple files (PDF, images, Office, zip). Max 10MB each.</small>
                        </div>

                        <button type="submit" class="btn btn-acw btn-block" style="margin-top: 20px;">
                            <i class="ti-check"></i> Submit / إرسال
                        </button>

                        {{ Form::close() }}

                    @endif

                </div>
            </div>
        </div>
    <div class="row mt-4">
    <div class="col-lg-12">
            @include('layouts._footer')
        </div>
    </div>
    </div>
</div>
@endsection
