@extends('layouts.base')

@section('base')
@include('layouts._public_theme_wrapper_start')

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="acw-public-card">
                    <div class="login-content">
                        <div class="login-form">
                            <div class="text-center mb-4">
                                <h2 style="color: #4f46e5; font-weight: 700; margin-bottom: 10px;">
                                    Academic Creativity Week
                                </h2>
                                <p style="color: #64748b; font-size: 14px;">Sign in to continue</p>
                            </div>
                                    
                            {{ Form::open(['route'=>'postlogin']) }}
                                <div class="form-group">
                                    <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30 btn-block">
                                    <i class="ti-lock"></i> Sign In
                                </button>
                                
                                <div class="text-center m-t-15">
                                    <a href="{{ route('password.request') }}" style="color: #4f46e5; font-size: 14px; text-decoration: none; font-weight: 500;">
                                        <i class="ti-email"></i> Forgot Password?
                                    </a>
                                </div>
                                
                                <div class="register-link m-t-15 text-center">
                                    <p style="color: #64748b; font-size: 13px; margin-top: 15px; margin-bottom: 5px;">
                                        <strong>Developed By:</strong> System Development Team
                                    </p>
                                    <p style="color: #94a3b8; font-size: 12px; margin-top: 10px;">
                                        University of Technology and Applied Sciences - Salalah
                                    </p>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
        </div>
    </div>
</div>

@include('layouts._public_theme_wrapper_end')
@endsection

@section('css')
<style>
/* overridden by public theme wrapper */
.unix-login { background: transparent; min-height: auto; }
.login-content { background: transparent; box-shadow: none; padding: 0; margin-top: 0; }

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
</style>
@endsection