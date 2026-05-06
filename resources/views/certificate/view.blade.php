<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>

    <style>

    @page { margin: 0px; }
    @font-face {
            font-family: DNMed;
            src: url("{{ asset('fonts/DINNextLTArabic-Regular.ttf') }}");
        }
    @font-face {
            font-family: DNBold;
            src: url("{{ asset('fonts/DINNextLTArabic-Bold.ttf') }}");
        }

    body {
        font-family: DNMed;
        margin: 0px;
        background-image:    url( "data:image/png;base64,{{ base64_encode(file_get_contents(public_path('theme/images/certbg1.png'))) }}");
        background-size:     cover;
        background-repeat:   no-repeat;
        background-position: 0% 0%;
        background-size: 100% 100%;
    }

    .cert_details {
        position: static;
        /*top: 110px;*/
        text-align: center;
        width: 100%;
        margin-top: 100px;
        margin-bottom: 1px;
    }
    .cert_header {

        font-family: DNBold;
        font-size: 30px;
        color: #e16911;
        margin-top: 40px;
        margin-bottom: 0.5px;
    }
    .cert_header1 {

        font-family: DNBold;
        font-size: 30px;
        color: #e16911;
        margin-top: -5px;
        margin-bottom: 2px;
    }

    .cert_awarded1 {
        font-family: DNMed;
        font-weight: 900;
        font-size: 20px;
        display: block;
        margin-top: 1px;
        margin-bottom: 0.5px;
    }
    .cert_name {
        font-family: DNBold;
        color: #e16911;
        font-size: 30px;
        margin-top: -2px;
        margin-bottom: 4px;
    }

    .cert_part1 {
        margin-top: 2px;
        font-size: 20px;
        margin-bottom: 1px;
    }

    .cert_part {
        color: #135f9e;
        margin-top: 0.5px;
        font-size: 20px;
        margin-bottom: 0.5px;
    }
    .cert_title {
        font-family: DNBold;
        font-size: 28px;
        color: #065ca4;
        margin-top: 1px;
        margin-bottom: 1px;
        word-wrap: break-word;
    }
    .cert_date {
        margin-top: 0.05px;
        font-size: 20px;
    }
    .assignatory {
        margin-top: 0.1px;
        margin-left: 5px;
    }
</style>
</head>
<body>
<div>
    <div class="cert_details">
        <p class="cert_header">شهــادة مـشــــاركــة</p>
        <p class="cert_header1">CERTIFICATE OF PARTICIPATION</p>
        <p class="cert_part1">This certificate is awarded to       -       تمنح هذه الشهادة لـ</p>
        <p class="cert_name" dir="rtl">{{ $survey_result->participant_name }}</p>
        <p class="cert_part1">for his\her participation in<span>       </span>-<span>       </span>لمشــاركتهـ/ـا الفعّـالة في </p>
        <div class="cert_title">{{ $survey->title }}</div>
        @php
            $fromDate = $survey->training_date_from
                ? \Carbon\Carbon::parse($survey->training_date_from)
                : ($survey->training_date ? \Carbon\Carbon::parse($survey->training_date) : null);
            $toDate = $survey->training_date_to
                ? \Carbon\Carbon::parse($survey->training_date_to)
                : $fromDate;

            $fromAr = $fromDate ? $fromDate->copy()->locale('ar')->translatedFormat('j F, Y') : null;
            $toAr = $toDate ? $toDate->copy()->locale('ar')->translatedFormat('j F, Y') : null;
            $fromEn = $fromDate ? $fromDate->format('M d, Y') : null;
            $toEn = $toDate ? $toDate->format('M d, Y') : null;

            $isMultiDay = $fromDate && $toDate && $toDate->greaterThan($fromDate) && ($toAr !== $fromAr);
        @endphp

        @if($fromDate)
            @if($isMultiDay)
                <p class="cert_date" style="dir:rtl;">التي اقيمـت من {{ $fromAr }} إلى {{ $toAr }} بفـرع الجامعة ضمن فعاليات أسبوع الإبداع الأكاديمي </p>
                <p class="cert_date">Held from {{ $fromEn }} to {{ $toEn }} at UTAS-Salalah As part of the Academic Creativity Week activities</p>
            @else
                <p class="cert_date" style="dir:rtl;">التي اقيمـت في {{ $fromAr }}  بفـرع الجامعة ضمن فعاليات أسبوع الإبداع الأكاديمي </p>
                <p class="cert_date">Held on {{ $fromEn }} at UTAS-Salalah As part of the Academic Creativity Week activities.</p>
            @endif
        @endif
        <br>
        <br>

    </div>
    <div class="assignatory">
    <table width="90%" border="0">
        <tr>
            <td width="45%" align="center">
                <!--<img style="width: 150px; float: center; margin-left: 175px; margin-top: -3px; z-index: -10px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('theme/images/AVC-Signature.png'))) }}" alt="">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->eye('circle')->size(100)->generate($qrlink)) !!} ">-->
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td width="45%" align="center">
                <p>د. أحمد بن علي الشحري<br/>
             مساعد رئيس الجامعة بصلالة</p>
            </td>
            <td width="25%" align="center">
               <!-- <img style="width: 160px; float: center; margin-top:-31px; margin-left:120px;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('theme/images/AVC-Stamp.png'))) }}" alt="">-->
            </td>
            <td width="30%" align="center">
            </td>
        </tr>  

    </table>
    </div>
</div>
</body>
</html>