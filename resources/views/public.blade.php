@extends('layouts.base')

@section('base')
<style>
    /* Use DINNextLTArabic font like the rest of the system */
    body {
        font-family: 'DINNextLTArabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    
    .event-card {
        background: #f8fafc;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(102, 126, 234, 0.1);
        font-family: 'DINNextLTArabic', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.2);
        border-color: rgba(102, 126, 234, 0.3);
    }
    .event-type-badge {
        display: inline-block;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: linear-gradient(135deg, #8d919fff 0%, #8d919fff 100%);
        color: white;
        margin-bottom: 15px;
    }
    .event-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        min-height: 50px;
        font-family: 'DINNextLTArabic', sans-serif;
    }
    .event-info {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 8px;
    }
    .event-info i {
        color: #667eea;
        font-size: 14px;
    }
    .event-btn {
        display: inline-block;
        padding: 10px 25px;
        background: linear-gradient(135deg, #4f46e5 0%, #4f46e5 100%);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        margin-top: 15px;
    }
    .event-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #bb540bff;
        text-align: center;
        margin-bottom: 10px;
        font-family: 'DINNextLTArabic', sans-serif;
    }
    .no-events {
        text-align: center;
        padding: 60px 20px;
        background: #f8fafc;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(102, 126, 234, 0.1);
    }
    .no-events i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    .no-events h3 {
        color: #64748b;
        font-size: 20px;
    }

    .activity-sections {
        margin: 10px 0 28px;
        padding: 18px 16px 10px;
        backdrop-filter: blur(6px);
        position: relative;
        overflow: hidden;
    }
    .activity-sections-title {
        color: rgba(255, 255, 255, 0.98);
        text-align: center;
        font-weight: 900;
        font-size: 38px;
        line-height: 1.1;
        margin: 0 0 12px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.35);
    }
    /* Smaller variant used for the "Discover More" callout */
    .activity-sections-title.activity-sections-title-sm {
        font-size: 26px;
        line-height: 1.25;
        font-weight: 800;
        margin-bottom: 8px;
    }
    .activity-sections-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 16px;
        align-items: end;
        padding: 12px 6px 0;
    }
    @media (max-width: 992px) {
        .activity-sections-title { font-size: 38px; }
        .activity-sections-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }
    @media (max-width: 576px) {
        .activity-sections-title { font-size: 34px; }
        .activity-sections-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    .activity-section-item {
        text-align: center;
        color: #fff;
    }
    .activity-section-icon {
        width: 120px;
        height: 120px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 24px;
    }
    .activity-section-icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.35));
    }
    .activity-section-label {
        margin-top: 12px;
        font-weight: 300;
        font-size: 28px;
        letter-spacing: 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.38);
        padding: 12px 10px;
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow:
            0 10px 28px rgba(0, 0, 0, 0.22),
            0 0 22px rgba(255, 255, 255, 0.10);
        line-height: 1;
    }
    @media (max-width: 992px) {
        .activity-section-icon { width: 96px; height: 96px; }
        .activity-section-label { font-size: 38px; padding: 10px 10px; }
    }
    @media (max-width: 576px) {
        .activity-section-icon { width: 86px; height: 86px; }
        .activity-section-label { font-size: 34px; padding: 10px 10px; }
    }

    /* Label color ribbons (approximate to reference image) */
    .activity-section-item .activity-section-label {
        backdrop-filter: blur(6px);
    }
    .activity-section-item.youth .activity-section-label {
        background: linear-gradient(90deg, rgba(207, 177, 70, 1), rgba(207, 178, 70, 1));
    }
    .activity-section-item.creativity .activity-section-label {
        background: linear-gradient(90deg, rgba(227, 132, 49, 1), rgba(227, 132, 49, 1));
    }
    .activity-section-item.sustainability .activity-section-label {
        background: linear-gradient(90deg, rgba(84, 181, 94, 1), rgba(84, 181, 94, 1));
    }
    .activity-section-item.technology .activity-section-label {
        background: linear-gradient(90deg, rgba(22, 119, 165, 1), rgba(22, 119, 165, 1));
    }
    .activity-section-item.industry .activity-section-label {
        background: linear-gradient(90deg, rgba(137, 88, 177, 1), rgba(137, 88, 177, 1));
    }

    .acw-intro {
        direction: rtl;
        margin: 6px 0 18px;
        padding: 18px 18px;
        backdrop-filter: blur(6px);
        color: rgba(255, 255, 255, 0.96);
        text-align: center;
        font-weight: 300;
        font-size: 28px;
        line-height: 1.7;
        text-shadow: 0 2px 10px rgba(0,0,0,0.35);
        white-space: pre-line;
    }
    @media (max-width: 992px) {
        .acw-intro { font-size: 28px; }
    }
    @media (max-width: 576px) {
        .acw-intro { font-size: 22px; padding: 14px 14px; }
    }

    .acw-divider {
        position: relative;
        height: 10px;
        max-width: 980px;
        margin: 18px auto 0;
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
</style>

<div style="min-height: 100vh; background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat; padding: 13px 0 40px;">
    <div style="position:relative;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5 animate-fadeInDown">
                    <div class="acw-header">
                        <div style="flex: 0 1 auto; text-align: center;">
                            <img class="acw-logo" src="{{ asset('theme/images/acw-white.png') }}" alt="Academic Creativity Week">
                        </div>
                        <div style="flex: 1 1 200px; text-align: right;">
                            <img class="utas-logo" src="{{ asset('theme/images/utas-logo-w.png') }}" alt="UTAS">
                        </div>
                    </div>
                    <h1 style="color: #ffffffff; font-size: 60px; font-weight: 500; text-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'DINNextLTArabic', sans-serif;">
أسبــوع الإبــداع الأكـــاديمي الأول
                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"><br>
                <div class="acw-divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="acw-intro">
                    يقام أسبوع الإبداع الأكاديمي الأول ٢٠٢٦ بجامعة التقنية والعلوم التطبيقية – فرع صلالة، بهدف تنمية مهارات الطلبة وإشعال الإبداع، انسجاماً مع الخطة الإستراتيجية للجامعة ٢٠٢٦-٢٠٣٠.

                    ويتضمن البرنامج معارض طلابية، مسابقات تخصصية، ورش عمل، وجلسات حوارية لإبراز المواهب الوطنية وتعزيز الشراكات.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"><br>
                <div class="acw-divider"></div>
            </div>
        </div>
        <!-- Activity Sections Banner (أقسام الفعالية) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="activity-sections">
                    <div class="activity-sections-title">أقسام الفعاليات</div>

                    <div class="activity-sections-grid">
                        <div class="activity-section-item youth">
                            <div class="activity-section-icon">
                                <img src="{{ asset('theme/images/الشباب.png') }}" alt="الشباب">
                            </div>
                            <div class="activity-section-label">الشباب</div>
                        </div>
                        <div class="activity-section-item creativity">
                            <div class="activity-section-icon">
                                <img src="{{ asset('theme/images/الابداع.png') }}" alt="الإبداع">
                            </div>
                            <div class="activity-section-label">الإبداع</div>
                        </div>
                        <div class="activity-section-item sustainability">
                            <div class="activity-section-icon">
                                <img src="{{ asset('theme/images/الاستدامة.png') }}" alt="الإستدامة">
                            </div>
                            <div class="activity-section-label">الإستدامة</div>
                        </div>
                        <div class="activity-section-item technology">
                            <div class="activity-section-icon">
                                <img src="{{ asset('theme/images/التقنية.png') }}" alt="التقنية">
                            </div>
                            <div class="activity-section-label">التقنية</div>
                        </div>
                        <div class="activity-section-item industry">
                            <div class="activity-section-icon">
                                <img src="{{ asset('theme/images/الصناعة.png') }}" alt="الصناعة">
                            </div>
                            <div class="activity-section-label">الصناعة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"><br>
                <div class="acw-divider"></div>
            </div>
        </div>
<br><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="activity-sections">
                    <div style="direction: rtl;" class="activity-sections-title activity-sections-title-sm"> استكشف الانشطة والفعاليات ... Discover More Activities <br><br></div>
                                <a href="{{ route('public.upcoming') }}" style="color:white; text-align:center; border: 1px solid white; padding: 10px 16px; border-radius: 25px; display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(4px); transition: all 0.3s ease; color:white; text-align:center;"><h4>
                                    Click here  - اضغط هنا 
                                </h4></a>
                    </div>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-lg-12"><br>
                <div class="acw-divider"></div>
            </div>
        </div>

<br><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="activity-sections" style="text-align:center;">
                    <div class="activity-sections-title activity-sections-title-sm"> 
                        <i class="ti-gallery" style="color: #fff; font-size: 50px; line-height: 1; filter: drop-shadow(0 8px 16px rgba(0,0,0,0.35)); font-family: 'themify' !important; speak: none; font-style: normal; font-weight: normal; font-variant: normal; text-transform: none; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;"></i>
                        <br>
                         هل لديك مشروع تود عرضه في المعرض المصاحب؟  <br> Do you have a project you would like to showcase at the exhibition? <br><br></div>
                        <a href="{{ route('exhibition.register') }}" style="color:white; text-align:center; border: 1px solid white; padding: 10px 16px; border-radius: 25px; display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(4px); transition: all 0.3s ease;">
                            <h4 style="margin: 0; display: inline-block; text-align: center;">
                                Click here  - اضغط هنا 
                            </h4>
                        </a>
                    </div>
                </div>
            </div> 
        </div>
<br><br>
        <div class="row">
            <div class="col-lg-12"><br>
                <div class="acw-divider"></div>
            </div>
        </div>
        <!-- Sponsors / الداعمين -->
        <div class="row">
            <div class="col-lg-12">
                <div class="activity-sections" style="text-align:center;">
                    <div class="activity-sections-title activity-sections-title-sm" style="margin-bottom: 14px;">
                        Sponsors / الداعمين
                    </div>

                    <div style="display:flex; flex-wrap:wrap; gap:16px; justify-content:center; align-items:center; padding: 8px 6px 2px;">
                        @php($sponsorLogo = asset('theme/images/acw-ic-white.png'))
                            <div style="width: 160px; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding: 10px; gap: 8px;">
                                <div style="width: 100%; height: 90px; display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ $sponsorLogo }}" alt="Sponsor" style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.25));">
                                </div>
                                <div style="color: white; font-size: 18px; font-weight: 700; font-family: 'DINNextLTArabic', sans-serif; line-height: 1;">
                                    Sponsor 1
                                </div>
                            </div>
                            <div style="width: 160px; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding: 10px; gap: 8px;">
                                <div style="width: 100%; height: 90px; display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ $sponsorLogo }}" alt="Sponsor" style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.25));">
                                </div>
                                <div style="color: white; font-size: 18px; font-weight: 700; font-family: 'DINNextLTArabic', sans-serif; line-height: 1;">
                                    Sponsor 2
                                </div>
                            </div>
                            <div style="width: 160px; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding: 10px; gap: 8px;">
                                <div style="width: 100%; height: 90px; display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ $sponsorLogo }}" alt="Sponsor" style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.25));">
                                </div>
                                <div style="color: white; font-size: 18px; font-weight: 700; font-family: 'DINNextLTArabic', sans-serif; line-height: 1;">
                                    Sponsor 3
                                </div>
                            </div>
                            <div style="width: 160px; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding: 10px; gap: 8px;">
                                <div style="width: 100%; height: 90px; display:flex; align-items:center; justify-content:center;">
                                    <img src="{{ $sponsorLogo }}" alt="Sponsor" style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain; filter: drop-shadow(0 10px 18px rgba(0,0,0,0.25));">
                                </div>
                                <div style="color: white; font-size: 18px; font-weight: 700; font-family: 'DINNextLTArabic', sans-serif; line-height: 1;">
                                    Sponsor 4
                                </div>
                            </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-lg-12"><br>
                            <div class="acw-divider"></div>
                        </div>
                    </div>
                    <div style="max-width: 800px; margin: 14px auto 0;">
                        <div style="display:flex; align-items:stretch; justify-content:center; flex-wrap:wrap; gap: 12px;">
                            <div style="min-width: 220px; flex: 1 1 220px; display:flex; align-items:center; gap: 10px; text-align:right; direction: rtl;">
                                <img src="{{ asset('theme/images/date.png') }}" alt="Date" style="width: 45px; height: 45px; object-fit: contain;">
                                <div style="color: rgba(255,255,255,0.96); font-weight: 300; line-height: 1.25; font-size: 24px; font-family: 'DINNextLTArabic', sans-serif;">
                                     <span style="font-weight: 300;">١١-١٢-١٣ مايو ٢٠٢٦</span>
                                </div>
                            </div>
                            <div style="min-width: 220px; flex: 1 1 220px; display:flex; align-items:center; gap: 10px; text-align:right; direction: rtl;">
                                <img src="{{ asset('theme/images/venue.png') }}" alt="Venue" style="width: 50px; height: 50px; object-fit: contain;">
                                <div style="color: rgba(255,255,255,0.96); font-weight: 300; line-height: 1.25; font-size: 24px; font-family: 'DINNextLTArabic', sans-serif;">
                                    <span style="font-weight: 300;">قاعــــة ظفـــــار</span>
                                </div>
                            </div>
                            <div style="min-width: 220px; flex: 1 1 220px; display:flex; align-items:center; gap: 10px; text-align:right; direction: rtl;">
                                <img src="{{ asset('theme/images/time.png') }}" alt="Time" style="width: 45px; height: 45px; object-fit: contain;">
                                <div style="color: rgba(255,255,255,0.96); font-weight: 300; line-height: 1.25; font-size: 24px; font-family: 'DINNextLTArabic', sans-serif;">
                                    <span style="font-weight: 300;">٩ صبــاحا - ٢ مســـاء</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br><br>
    <br><br>
    <div class="row mt-4">
        <div class="col-lg-12">
            @include('layouts._footer')
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection