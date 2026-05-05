@extends('layouts.base')

@section('base')

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
                    Activity Questionnaire: Industrial Visit <br />
                        <span dir="rtl">استبانة تقييم ملاحظات زيارة مؤسسة صناعية</span>
                    </strong>
                </h5>



                <p><strong>Program Title (<span dir="rtl">العنوان</span>) : {{ $survey->title ?? "" }}</strong></p>
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
                            <td>The choice of topic/Industry was relevant to me. <br />
                                <p align="right"><span dir="rtl">كان اختيارالموضوع/ المؤسسة الصناعة مناسبا لي.</span></p>
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
                            <td>The visit created enthusiasm<br />
                                <p align="right"><span dir="rtl" align="right">أثارت الزيارة الحماس.</span></p>
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
                            <td>Interaction of expert with the students was adequate <br />
                                <p align="right"><span dir="rtl" align="right">كان تفاعل الخبير مع الطلاب كافياً.</span></p>
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
                            <td>Facilities were exhibited in an organized manner<br />
                                <p align="right"><span dir="rtl" align="right">تم عرض المرافق بطريقة منظمة</span></p>
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
                            <td>The visit provided information which is helpful to solve practical problems<br />
                                <p align="right"><span dir="rtl" align="right">قدمت الزيارة معلومات ذات صلة تساعد لحل التحديات العملية.</span></p>
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
                            <td>Quality of presentation was effective <br />
                                <p align="right"><span dir="rtl" align="right">كان العرض ذا جودة</span></p>
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
                            <td>Volume and complexity of the information was appropriate <br />
                                <p align="right"><span dir="rtl" align="right">كان حجم المعلومات وتعقيدها مطروحا بصورة مناسب.</span></p>
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
                            <td>The presentation’s content was related to current advancements<br />
                                <p align="right"><span dir="rtl" align="right"> المحتوى التقديمي لعرض مرتبط بالتطورات الحالية.</span></p>
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
                            <td></td>
                            <td class="text-right">Mean</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format((($q1_total + $q2_total + $q3_total + $q4_total + $q5_total + $q6_total + $q7_total + $q8_total) / 8 ),2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <p align="left">Kindly give any suggestions to improve future communications across the campus.</p>
                                <p>
                                    <span align="right" dir="rtl">يرجى إعطاء إي أقتراحات لتحسين التواصل في جميع أنحاء حرم الكليه مستقبلا.</span>
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