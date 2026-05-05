@extends('layouts.base')

@section('base')
<div class="feedback-form-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="feedback-form-content">
                    <!-- Header with Logos -->
                    <div class="text-center mb-4">
                        <div class="logos-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                            <img src="{{ asset('theme/images/2040Logo-h100.png') }}" alt="Vision 2040" style="height: 80px;">
                            <img src="{{ asset('theme/images/utas-logo.png') }}" alt="UTAS" style="height: 80px;">
                        </div>
                        <h2 style="color: #4f46e5; font-weight: 700; margin-bottom: 10px;">
                            Activity Questionnaire
                        </h2>
                        <h3 style="color: #64748b; font-size: 18px; font-weight: 600;" dir="rtl">
                            تقييم الفعاليات
                        </h3>
                    </div>
    
                    {{ Form::open(['route'=>['activity.postform',$survey->id]]) }}
                    
                    @include('survey._greeting')
                    
                    <!-- Event Details Card -->
                    <div class="event-details-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; border-radius: 12px; margin-bottom: 30px; color: white;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div>
                                <strong style="font-size: 14px; opacity: 0.9;">Program Title / العنوان:</strong>
                                <p style="margin: 5px 0 0 0; font-size: 16px;">{{ $survey->title ?? "" }}</p>
                            </div>
                            <div>
                                <strong style="font-size: 14px; opacity: 0.9;">Location / الموقع:</strong>
                                <p style="margin: 5px 0 0 0; font-size: 16px;">{{ $survey->location ?? "" }}</p>
                            </div>
                            <div>
                                <strong style="font-size: 14px; opacity: 0.9;">Date / التاريخ:</strong>
                                <p style="margin: 5px 0 0 0; font-size: 16px;">{{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</p>
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
                                {{ Form::text('participant_name_en',$attendance->fullname_en, ['class'=>'form-control','readonly']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-weight: 600; color: #1e293b; margin-bottom: 8px;">
                                    <i class="ti-user"></i> Participant Name (Arabic)
                                </label>
                                {{ Form::text('participant_name_ar',$attendance->fullname_ar, ['class'=>'form-control','dir'=>'rtl','readonly']) }}
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
                        <table class="table feedback-table" style="border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
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
                                        The choice of topic was appropriate.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان اختيار الموضوع مناسبًا</span></p>
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
                                        The time allocated for the training was adequate.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان الوقت المخصص للتدريب كافياً</span></p>
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
                                        The training covered what I was expecting.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">غطى التدريب ما كنت أتوقعه</span></p>
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
                                        The training was well organized.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان التدريب منظما بشكل جيد</span></p>
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
                                        The training was properly delivered.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">تم تقديم التدريب بشكل صحيح</span></p>
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
                                        The knowledge I gained from this training will be useful for my career
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">ستكون المعرفة التي اكتسبتها من هذا التدريب مفيدة لحياتي المهنية</span></p>
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
                                        I got Opportunity to ask questions for clarification.
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">وفر المتحدث فرصة لطرح الأسئلة بغرض التوضيح</span></p>
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
                                        The speaker stimulated my interest in the topic
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">أثار المتحدث اهتمامي بالموضوع</span></p>
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
                                        The speaker provided clear answers to my questions
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">قدم المتحدث إجابات واضحة على أسئلتي</span></p>
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
                                        The choice of venue was appropriate
                                        <p align="right" style="margin-top: 8px; color: #64748b;"><span dir="rtl">كان اختيار المكان مناسبا</span></p>
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
                                            Kindly give any suggestions to improve future communications across the campus.
                                        </p>
                                        <p align="right" style="color: #64748b; font-size: 14px; margin-bottom: 15px;">
                                            <span dir="rtl">يرجى إعطاء أي اقتراحات لتحسين التواصل في جميع أنحاء حرم الكلية مستقبلاً.</span>
                                        </p>
                                        <textarea class="form-control" style="height: 120px; border: 1px solid #e2e8f0; border-radius: 8px;" name="comments" placeholder="Enter your comments here..."></textarea>   
                                    </td>
                                </tr>
                            </tbody>        
                        </table>
                    </div>
                    
                    <button class="btn btn-success btn-block" style="margin-top: 30px; background: #10b981; border: none; border-radius: 8px; padding: 15px; font-weight: 600; font-size: 16px;">
                        <i class="ti-check"></i> Submit Feedback
                    </button>
                    
                    {{ Form::close() }}
                    
                    <div class="text-center" style="margin-top: 30px; padding: 20px; background: #f0fdf4; border-radius: 12px;">
                        <h3 style="color: #10b981; font-weight: 700; margin-bottom: 10px;">
                            <i class="ti-heart"></i> Thank you for your feedback!
                        </h3>
                        <p style="color: #64748b; font-size: 16px;" dir="rtl">شكراً لك</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
.feedback-form-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 40px 0;
}

.feedback-form-content {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    padding: 40px;
}

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

.form-control[readonly] {
    background-color: #f8fafc;
}

.feedback-table tbody tr:hover {
    background-color: #f8fafc;
    transition: all 0.2s ease;
}

.btn-success:hover {
    background: #059669 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    transition: all 0.2s ease;
}

input[type="radio"] {
    accent-color: #4f46e5;
}

.form-group {
    margin-bottom: 20px;
}
</style>
@endsection