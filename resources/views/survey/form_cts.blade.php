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
        font-weight: 800;
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
    .btn-acw {
        background: linear-gradient(135deg, #284ca9ff 0%, #284ca9ff 100%);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 900;
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
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .field-label i { color: #1d4ed8; }
    .meta-card {
        background: linear-gradient(135deg, #667eea 0%, #4b57a2 100%);
        padding: 18px;
        border-radius: 14px;
        margin: 16px 0 20px;
        color: white;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
    }
    .meta-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }
    @media (min-width: 768px) {
        .meta-grid { grid-template-columns: 1fr 1fr 1fr; }
    }
    .meta-item strong { font-size: 13px; opacity: 0.92; }
    .meta-item p { margin: 6px 0 0 0; font-size: 15px; font-weight: 800; }
    .feedback-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 0;
    }
    .feedback-table thead {
        background: linear-gradient(135deg, #667eea 0%, #4b57a2 100%);
        color: white;
    }
    .feedback-table th {
        border: none;
        padding: 14px;
        vertical-align: middle;
        text-align: center;
        font-size: 12px;
        font-weight: 900;
    }
    .feedback-table td {
        vertical-align: middle;
        padding: 14px;
        background: #fff;
    }
    .radio-lg {
        transform: scale(1.15);
        accent-color: #4f46e5;
        cursor: pointer;
    }
    .feedback-table input[type="radio"] {
        transform: scale(1.15);
        accent-color: #4f46e5;
        cursor: pointer;
    }
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
            <h2 class="acw-title">Activity Questionnaire</h2>
            <div class="acw-subtitle" dir="rtl">تقييم الفعاليات</div>
            <div class="acw-divider"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="acw-card">
                    {{ Form::open(['route'=>['activity.postform',$survey->id]]) }}

                    @include('survey._greeting')

                    <div class="meta-card">
                        <div class="meta-grid">
                            <div class="meta-item">
                                <strong>Event/Competition Title / <span dir="rtl">عنوان الفعالية/المسابقة</span></strong>
                                <p>{{ $survey->title ?? "" }}</p>
                            </div>
                            <div class="meta-item">
                                <strong>Location / <span dir="rtl">الموقع</span></strong>
                                <p>{{ $survey->location ?? "-" }}</p>
                            </div>
                            <div class="meta-item">
                                <strong>Date / <span dir="rtl">التاريخ</span></strong>
                                <p>{{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Participant Info -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">
                                    <i class="ti-user"></i> Participant Name (English)
                                </label>
                                @if(!empty($attendance))
                                    {{ Form::text('participant_name_en', $attendance->fullname_en, ['class'=>'form-control','readonly']) }}
                                @else
                                    {{ Form::text('participant_name_en', null, ['class'=>'form-control', 'required' => true, 'placeholder' => 'Enter your name']) }}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">
                                    <i class="ti-user"></i> Participant Name (Arabic)
                                </label>
                                @if(!empty($attendance))
                                    {{ Form::text('participant_name_ar', $attendance->fullname_ar, ['class'=>'form-control','dir'=>'rtl','readonly']) }}
                                @else
                                    {{ Form::text('participant_name_ar', null, ['class'=>'form-control','dir'=>'rtl', 'placeholder' => 'اكتب الاسم (اختياري)']) }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Department (Optional)</label>
                                {{ Form::text('participant_department',null, ['class'=>'form-control', 'placeholder'=>'Enter your department']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">Section (Optional)</label>
                                {{ Form::text('participant_section', null, ['class'=>'form-control', 'placeholder'=>'Enter your section']) }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Questions Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-hover feedback-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="border: none; padding: 15px; width: 5%;">No<br/><small dir="rtl">الرقم</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 40%;">Statement<br/><small dir="rtl">النقاط</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 11%;">Strongly Disagree<br/>1<br/><small dir="rtl">لا أوافق بشده</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 11%;">Disagree<br/>2<br/><small dir="rtl">لا أوافق</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 11%;">Neutral<br/>3<br/><small dir="rtl">محايد</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 11%;">Agree<br/>4<br/><small dir="rtl">أوافق</small></th>
                                    <th class="text-center" style="border: none; padding: 15px; width: 11%;">Strongly Agree<br/>5<br/><small dir="rtl">أوافق بشده</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">1</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The event was well-organized and clear.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان تنظيم الفعالية جيدًا وواضحًا</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q1" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q1" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q1" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q1" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q1" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">2</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The event adhered to the scheduled time.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">تم الالتزام بالوقت المحدد للفعالية</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q2" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q2" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q2" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q2" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q2" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">3</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The instructions provided to participants were clear and easy to understand.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كانت التعليمات المقدمة للمشاركين واضحة وسهلة الفهم</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q3" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q3" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q3" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q3" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q3" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">4</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The organizing team was cooperative and responsive.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان فريق التنظيم متعاونًا وسريع الاستجابة</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q4" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q4" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q4" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q4" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q4" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">5</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The idea of the competition/event was innovative and enjoyable.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كانت فكرة المسابقة/الفعالية مبتكرة وممتعة</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q5" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q5" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q5" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q5" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q5" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">6</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The level of questions or challenges was appropriate.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">مستوى الأسئلة أو التحديات كان مناسبًا</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q6" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q6" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q6" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q6" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q6" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">7</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The event helped increase my knowledge or skills.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">ساهمت الفعالية في زيادة معرفتي أو مهاراتي</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q7" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q7" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q7" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q7" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q7" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">8</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The activities were varied and not boring.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كانت الأنشطة متنوعة وغير مملة</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q8" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q8" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q8" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q8" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q8" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">9</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        The atmosphere of the event was positive and motivating.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كانت أجواء الفعالية إيجابية ومحفزة</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q9" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q9" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q9" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q9" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q9" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td class="text-center" style="padding: 20px; vertical-align: middle;">10</td>
                                    <td style="padding: 20px; vertical-align: middle;">
                                        I am overall satisfied with this event.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">أنا راضٍ بشكل عام عن هذه الفعالية</span></p>
                                    </td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="1" required name="q10" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="2" required name="q10" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="3" required name="q10" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="4" required name="q10" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                    <td class="text-center" style="padding: 20px;"><input type="radio" value="5" required name="q10" style="width: 20px; height: 20px; cursor: pointer;"></td>
                                </tr>
                                <tr style="background: #f8fafc;">
                                    <td colspan="7" style="padding: 25px;">
                                        <label style="font-weight: 600; color: #1e293b; margin-bottom: 10px; display: block;">
                                            <i class="ti-comment-alt"></i> Comments / Suggestions
                                        </label>
                                        <p style="color: #64748b; font-size: 14px; margin-bottom: 10px;">
                                            What can be improved in future events?
                                        </p>
                                        <p align="right" style="color: #64748b; font-size: 14px; margin-bottom: 15px;">
                                            <span dir="rtl">ما الذي يمكن تحسينه في الفعاليات القادمة؟</span>
                                        </p>
                                        <textarea class="form-control" style="height: 120px; border: 1px solid #e2e8f0; border-radius: 8px;" name="comments" placeholder="Enter your comments here..."></textarea>   
                                    </td>
                                </tr>
                            </tbody>        
                        </table>
                    </div>

                    <button type="submit" class="btn btn-acw btn-block" style="margin-top: 18px;">
                        <i class="ti-check"></i> Submit - إرسال
                    </button>

                    {{ Form::close() }}

                    <h3 class="text-center" style="margin-top: 18px; font-weight: 900; color: #0f172a;">
                        Thank you for your feedback! <br />
                        <span dir="rtl">شكراً</span>
                    </h3>

                    <div class="text-center m-t-15">
                        <a href="{{ route('public.upcoming') }}" style="color: #1e188eff; font-size: 14px; text-decoration: none; font-weight: 700;">
                            <i class="ti-arrow-left"></i> Back - رجوع
                        </a>

                        <span style="display:inline-block; margin: 0 10px; opacity: 0.35;">|</span>

                        <a href="{{ route('public') }}" style="color: #1e188eff; font-size: 14px; text-decoration: none; font-weight: 900;">
                            <i class="ti-home"></i> Home - الرئيسية
                        </a>
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
</div>
@endsection