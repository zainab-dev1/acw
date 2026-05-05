@extends('layouts.content')

@section('maincontent')
<div class="row">
    <div class="col-lg-12">
        <div class="welcome-card">
            <h2>Welcome to Academic Creativity Week</h2>
            <p>Manage your events and creativity week activities efficiently</p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-4">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib color-warning border-warning">
                    <i class="ti-comments"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-digit">Activities</div>
                    <div class="stat-text">                                                    
                        <a href="{{ route('activity.index') }}">Open Application</a>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib" style="background: rgba(239, 68, 68, 0.1);">
                    <i class="ti-pencil-alt" style="color: #ef4444;"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-digit">Create Activity</div>
                    <div class="stat-text">                                                    
                        <a href="{{ route('activity.prepare') }}">Create New</a>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="stat-widget-one">
                <div class="stat-icon dib" style="background: rgba(236, 72, 153, 0.1);">
                    <i class="ti-bookmark-alt" style="color: #ec4899;"></i>
                </div>
                <div class="stat-content dib">
                    <div class="stat-digit">Academic Year</div>
                    <div class="stat-text">                                                    
                        <a href="{{ route('academicyear.index') }}">Manage Years</a>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection