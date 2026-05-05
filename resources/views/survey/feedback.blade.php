@extends('layouts.base')

@section('base')
@include('layouts._public_theme_wrapper_start')

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="acw-public-card">
            <div class="feedback-content">
                <div class="text-center mb-4">
                    <h2 style="color: #4f46e5; font-weight: 900; margin-bottom: 10px;">
                        Activity Feedback
                    </h2>
                    <p style="color: #64748b; font-size: 14px;">Share your feedback with us</p>
                </div>

                    <!-- Feedback Form -->
                    <div class="feedback-form">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="border-radius: 8px; border-left: 4px solid #dc2626;">
                                <ul style="margin-bottom: 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        {{ Form::open(['route'=>['activity.postfeedback',$survey_id]]) }}
                        
                        <div class="form-group">
                            <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">
                                   <i class="ti-mobile"></i> رقم الهاتف
                            </label>
                               {{ Form::text('civil_no',null, ['class'=>'form-control', 'placeholder'=>'أدخل رقم الهاتف', 'required'=>true]) }}
                            <small style="color: #64748b; font-size: 12px; margin-top: 5px; display: block;">
                                الرجاء إدخال نفس رقم الهاتف المستخدم في تسجيل الحضور
                            </small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 20px;">
                            <i class="ti-comment"></i> Submit Feedback
                        </button>
                        
                        {{ Form::close() }}
                        
                        <div class="text-center m-t-15">
                            <a href="{{ route('activity.public') }}" style="color: #4f46e5; font-size: 14px; text-decoration: none; font-weight: 500;">
                                <i class="ti-arrow-left"></i> Back to Activities
                            </a>

                            <span style="display:inline-block; margin: 0 10px; opacity: 0.35;">|</span>

                            <a href="{{ route('public') }}" style="color: #4f46e5; font-size: 14px; text-decoration: none; font-weight: 800;">
                                <i class="ti-home"></i> Home - الرئيسية
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@include('layouts._public_theme_wrapper_end')
@endsection

@section('css')
<style>
/* wrapper provides background + card */
.feedback-page { background: transparent; min-height: auto; padding: 0; }
.feedback-content { background: transparent; box-shadow: none; padding: 0; }

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

.btn-primary {
    background: #4f46e5;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: #4338ca;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.form-group {
    margin-bottom: 20px;
}

.alert {
    margin-bottom: 20px;
}
</style>
@endsection