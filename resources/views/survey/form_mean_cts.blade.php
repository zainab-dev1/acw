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

                <p><strong>Event/Competition Title (<span dir="rtl">عنوان الفعالية/المسابقة</span>) : {{ $survey->title ?? "" }}</strong></p>
                <p><strong>Location (<span dir="rtl">الموقع</span>) : {{ $survey->location ?? "" }}</strong></p>
                <p><strong>Date (<span dir="rtl">التاريخ</span>) : {{ \Carbon\Carbon::parse($survey->training_date)->format('d-M-Y') }}</strong></p>



                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No <br /> <span dir="rtl">الرقم</span></th>
                            <th class="text-center">Statement <br /> <span dir="rtl">النقاط</span></th>
                            <th class="text-center">Strongly Disagree<br /> 1 <br /><span dir="rtl">لا أوافق بشده</span></th>
                            <th class="text-center">Disagree<br /> 2 <br /><span dir="rtl">لا أوافق</span></th>
                            <th class="text-center">Neutral<br /> 3 <br /><span dir="rtl">محايد</span></th>
                            <th class="text-center">Agree<br /> 4 <br /><span dir="rtl">أوافق</span></th>
                            <th class="text-center">Strongly Agree<br /> 5 <br /> <span dir="rtl">أوافق بشده</span></th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>The event was well-organized and clear. <br />
                                <p align="right"><span dir="rtl">كان تنظيم الفعالية جيدًا وواضحًا</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q1_1 }}</td>
                            <td class="text-center">{{ $survey_result->q1_2 }}</td>
                            <td class="text-center">{{ $survey_result->q1_3 }}</td>
                            <td class="text-center">{{ $survey_result->q1_4 }}</td>
                            <td class="text-center">{{ $survey_result->q1_5 }}</td>
                            <td>
                                @php
                                $q1_total = (($survey_result->q1_1 * 1) + ($survey_result->q1_2 * 2) + ($survey_result->q1_3 * 3) + ($survey_result->q1_4 * 4) + ($survey_result->q1_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q1_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>The event adhered to the scheduled time.<br />
                                <p align="right"><span dir="rtl" align="right">تم الالتزام بالوقت المحدد للفعالية</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q2_1 }}</td>
                            <td class="text-center">{{ $survey_result->q2_2 }}</td>
                            <td class="text-center">{{ $survey_result->q2_3 }}</td>
                            <td class="text-center">{{ $survey_result->q2_4 }}</td>
                            <td class="text-center">{{ $survey_result->q2_5 }}</td>
                            <td>
                                @php
                                $q2_total = (($survey_result->q2_1 * 1) + ($survey_result->q2_2 * 2) + ($survey_result->q2_3 * 3) + ($survey_result->q2_4 * 4) + ($survey_result->q2_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q2_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>The instructions provided to participants were clear and easy to understand.<br />
                                <p align="right"><span dir="rtl" align="right">كانت التعليمات المقدمة للمشاركين واضحة وسهلة الفهم</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q3_1 }}</td>
                            <td class="text-center">{{ $survey_result->q3_2 }}</td>
                            <td class="text-center">{{ $survey_result->q3_3 }}</td>
                            <td class="text-center">{{ $survey_result->q3_4 }}</td>
                            <td class="text-center">{{ $survey_result->q3_5 }}</td>
                            <td>
                                @php
                                $q3_total = (($survey_result->q3_1 * 1) + ($survey_result->q3_2 * 2) + ($survey_result->q3_3 * 3) + ($survey_result->q3_4 * 4) + ($survey_result->q3_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q3_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>The organizing team was cooperative and responsive.<br />
                                <p align="right"><span dir="rtl" align="right">كان فريق التنظيم متعاونًا وسريع الاستجابة</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q4_1 }}</td>
                            <td class="text-center">{{ $survey_result->q4_2 }}</td>
                            <td class="text-center">{{ $survey_result->q4_3 }}</td>
                            <td class="text-center">{{ $survey_result->q4_4 }}</td>
                            <td class="text-center">{{ $survey_result->q4_5 }}</td>
                            <td>
                                @php
                                $q4_total = (($survey_result->q4_1 * 1) + ($survey_result->q4_2 * 2) + ($survey_result->q4_3 * 3) + ($survey_result->q4_4 * 4) + ($survey_result->q4_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q4_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">5</td>
                            <td>The idea of the competition/event was innovative and enjoyable.<br />
                                <p align="right"><span dir="rtl" align="right">كانت فكرة المسابقة/الفعالية مبتكرة وممتعة</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q5_1 }}</td>
                            <td class="text-center">{{ $survey_result->q5_2 }}</td>
                            <td class="text-center">{{ $survey_result->q5_3 }}</td>
                            <td class="text-center">{{ $survey_result->q5_4 }}</td>
                            <td class="text-center">{{ $survey_result->q5_5 }}</td>
                            <td>
                                @php
                                $q5_total = (($survey_result->q5_1 * 1) + ($survey_result->q5_2 * 2) + ($survey_result->q5_3 * 3) + ($survey_result->q5_4 * 4) + ($survey_result->q5_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q5_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">6</td>
                            <td>The level of questions or challenges was appropriate.<br />
                                <p align="right"><span dir="rtl" align="right">مستوى الأسئلة أو التحديات كان مناسبًا</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q6_1 }}</td>
                            <td class="text-center">{{ $survey_result->q6_2 }}</td>
                            <td class="text-center">{{ $survey_result->q6_3 }}</td>
                            <td class="text-center">{{ $survey_result->q6_4 }}</td>
                            <td class="text-center">{{ $survey_result->q6_5 }}</td>
                            <td>
                                @php
                                $q6_total = (($survey_result->q6_1 * 1) + ($survey_result->q6_2 * 2) + ($survey_result->q6_3 * 3) + ($survey_result->q6_4 * 4) + ($survey_result->q6_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q6_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">7</td>
                            <td>The event helped increase my knowledge or skills.<br />
                                <p align="right"><span dir="rtl" align="right">ساهمت الفعالية في زيادة معرفتي أو مهاراتي</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q7_1 }}</td>
                            <td class="text-center">{{ $survey_result->q7_2 }}</td>
                            <td class="text-center">{{ $survey_result->q7_3 }}</td>
                            <td class="text-center">{{ $survey_result->q7_4 }}</td>
                            <td class="text-center">{{ $survey_result->q7_5 }}</td>
                            <td>
                                @php
                                $q7_total = (($survey_result->q7_1 * 1) + ($survey_result->q7_2 * 2) + ($survey_result->q7_3 * 3) + ($survey_result->q7_4 * 4) + ($survey_result->q7_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q7_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">8</td>
                            <td>The activities were varied and not boring.<br />
                                <p align="right"><span dir="rtl" align="right">كانت الأنشطة متنوعة وغير مملة</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q8_1 }}</td>
                            <td class="text-center">{{ $survey_result->q8_2 }}</td>
                            <td class="text-center">{{ $survey_result->q8_3 }}</td>
                            <td class="text-center">{{ $survey_result->q8_4 }}</td>
                            <td class="text-center">{{ $survey_result->q8_5 }}</td>
                            <td>
                                @php
                                $q8_total = (($survey_result->q8_1 * 1) + ($survey_result->q8_2 * 2) + ($survey_result->q8_3 * 3) + ($survey_result->q8_4 * 4) + ($survey_result->q8_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q8_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">9</td>
                            <td>The atmosphere of the event was positive and motivating.<br />
                                <p align="right"><span dir="rtl" align="right">كانت أجواء الفعالية إيجابية ومحفزة</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q9_1 }}</td>
                            <td class="text-center">{{ $survey_result->q9_2 }}</td>
                            <td class="text-center">{{ $survey_result->q9_3 }}</td>
                            <td class="text-center">{{ $survey_result->q9_4 }}</td>
                            <td class="text-center">{{ $survey_result->q9_5 }}</td>
                            <td>
                                @php
                                $q9_total = (($survey_result->q9_1 * 1) + ($survey_result->q9_2 * 2) + ($survey_result->q9_3 * 3) + ($survey_result->q9_4 * 4) + ($survey_result->q9_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q9_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">10</td>
                            <td>I am overall satisfied with this event.<br />
                                <p align="right"><span dir="rtl" align="right">أنا راضٍ بشكل عام عن هذه الفعالية</span></p>
                            </td>
                            <td class="text-center">{{ $survey_result->q10_1 }}</td>
                            <td class="text-center">{{ $survey_result->q10_2 }}</td>
                            <td class="text-center">{{ $survey_result->q10_3 }}</td>
                            <td class="text-center">{{ $survey_result->q10_4 }}</td>
                            <td class="text-center">{{ $survey_result->q10_5 }}</td>
                            <td>
                                @php
                                $q10_total = (($survey_result->q10_1 * 1) + ($survey_result->q10_2 * 2) + ($survey_result->q10_3 * 3) + ($survey_result->q10_4 * 4) + ($survey_result->q10_5 * 5)) / $survey_result->totalres;
                                @endphp
                                {{ number_format($q10_total,2) }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">Mean</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format((($q1_total + $q2_total + $q3_total + $q4_total + $q5_total + $q6_total + $q7_total + $q8_total + $q9_total + $q10_total) / 10 ),2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <p align="left">What can be improved in future events?</p>
                                <p>
                                    <span align="right" dir="rtl">ما الذي يمكن تحسينه في الفعاليات القادمة؟</span>
                                </p>

                                <div class="text-center">
                                    <ul>
                                        @foreach($survey_comments as $comment)
                                        <li>{{ $comment->comments }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection