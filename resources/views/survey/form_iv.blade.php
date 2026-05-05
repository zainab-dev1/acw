@extends('layouts.base')

@section('base')
<style>
  .form-control {
    border-color: #000;
  }
</style>
<div class="container">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td><img src="{{ asset('theme/images/2040Logo-h100.png') }}" alt="" class="float-left"></td>
                            <td></td>
                            <td><img src="{{ asset('theme/images/utas-logo.png') }}" height="100px" alt="" ></td>
                        </tr>
                    </table>
                </div>
                <h5 class="text-center">
                    <strong>
                    Activity Questionnaire  <br />
                        <span dir="rtl"> تقييم الفعاليات    </span>
                    </strong>
                </h5>
    
            {{ Form::open(['route'=>['activity.postform',$survey->id]]) }}
            <div class="row">
                @include('survey._greeting')
            </div>
            <p><strong>Program Title (<span dir="rtl">العنوان</span>) : {{ $survey->title ?? "" }}</strong></p>
            <p><strong>Location (<span dir="rtl">الموقع</span>) : {{ $survey->location ?? "" }}</strong></p>
            <p><strong>Date (<span dir="rtl">التاريخ</span>) : {{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</strong></p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="participant_name">Participant Name (English) </label>
                        {{ Form::text('participant_name_en',$attendance->fullname_en, ['class'=>'form-control','readonly']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="participant_name">Participant Name (Arabic) </label>
                        {{ Form::text('participant_name_ar',$attendance->fullname_ar, ['class'=>'form-control','dir'=>'rtl','readonly']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department">Department (Optional)</label>
                        {{ Form::text('participant_department',null, ['class'=>'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department">Section (Optional)</label>
                        {{ Form::text('participant_section', null, ['class'=>'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">No <br/> <span dir="rtl">الرقم</span></th>
                    <th class="text-center">Statement <br/> <span dir="rtl">النقاط</span></th>
                    <th class="text-center">Strongly Disagree<br/> 1 <br /><span dir="rtl">لا أوافق بشده</span></th>
                    <th class="text-center">Disagree<br/> 2 <br /><span dir="rtl">لا أوافق</span></th>
                    <th class="text-center">Neutral<br/> 3 <br /><span dir="rtl">محايد</span></th>
                    <th class="text-center">Agree<br/> 4 <br /><span dir="rtl">أوافق</span></th>
                    <th class="text-center">Strongly Agree<br/> 5 <br /> <span dir="rtl">أوافق بشده</span></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>The choice of topic was appropriate. <br /> <p align="right"><span dir="rtl">كان اختيار الموضوع مناسبًا</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q1"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q1"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q1"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q1"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q1"></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>The time allocated for the training was adequate.<br /> <p align="right"><span dir="rtl" align="right">كان الوقت المخصص للتدريب كافياً</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q2"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q2"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q2"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q2"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q2"></td>
                </tr>
                <tr>    
                    <td class="text-center">3</td>
                    <td>The training covered what I was expecting.<br /> <p align="right"><span dir="rtl" align="right">غطى التدريب ما كنت أتوقعه</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q3"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q3"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q3"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q3"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q3"></td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>The training was well organized.<br /> <p align="right"><span dir="rtl" align="right">كان التدريب منظما بشكل جيد</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q4"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q4"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q4"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q4"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q4"></td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>The training was properly delivered.<br /> <p align="right"><span dir="rtl" align="right">تم تقديم التدريب بشكل صحيح</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q5"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q5"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q5"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q5"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q5"></td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td>The knowledge I gained from this training will be useful for my career<br /> <p align="right"><span dir="rtl" align="right">ستكون المعرفة التي اكتسبتها من هذا التدريب مفيدة لحياتي المهنية</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q6"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q6"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q6"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q6"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q6"></td>
                </tr>  
                <tr>          
                    <td class="text-center">7</td>
                    <td>I got Opportunity to ask questions for clarification.<br /> <p align="right"><span dir="rtl" align="right">وفر المتحدث فرصة لطرح الأسئلة بغرض التوضيح.</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q7"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q7"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q7"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q7"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q7"></td>
                </tr>
                <tr>
                    <td class="text-center">8</td>
                    <td>The speaker stimulated my interest in the topic<br /> <p align="right"><span dir="rtl" align="right">أثار المتحدث اهتمامي  بالموضوع.</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q8"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q8"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q8"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q8"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q8"></td>
                </tr>
                <tr>
                    <td class="text-center">9</td>
                    <td>The speaker provided clear answers to my questions<br /> <p align="right"><span dir="rtl" align="right">قدم المتحدث إجابات واضحة على أسئلتي </span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q9"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q9"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q9"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q9"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q9"></td>
                </tr>
                <tr>
                    <td class="text-center">10</td>
                    <td>The choice of venue was appropriate<br /> <p align="right"><span dir="rtl" align="right">كان اختيار المكان مناسبا</span></p></td>
                    <td class="text-center"><input type="radio" value="1" required name="q10"></td>
                    <td class="text-center"><input type="radio" value="2" required name="q10"></td>
                    <td class="text-center"><input type="radio" value="3" required name="q10"></td>
                    <td class="text-center"><input type="radio" value="4" required name="q10"></td>
                    <td class="text-center"><input type="radio" value="5" required name="q10"></td>        
                </tr>
                <tr>
                    <td colspan="7">
                        <p align="left">Kindly give any suggestions to improve future communications across the campus.</p>
                        <p>
                            <span align="right" dir="rtl">يرجى إعطاء إي أقتراحات لتحسين التواصل في جميع أنحاء حرم الكليه مستقبلا.</span>
                        </p>
                        
                            <textarea class="form-control" style="height: 100px;" name="comments"></textarea>   
                        
                    </td>
                </tr>
                </tbody>        
            </table>
            </div>
            <button class="btn btn-success btn-block"> Submit</button>
            {{ Form::close() }}
            <h3 class="text-center mt-4">
                Thank you for your feedback! <br />
                <span dir="rtl">شكرا</span>
            </h3>
            </div>
        </div>
    </div>
</div>
@endsection