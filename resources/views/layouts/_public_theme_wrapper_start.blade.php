{{--
| Public theme wrapper (start)
| Usage:
|   @include('layouts._public_theme_wrapper_start')
|   ...page content...
|   @include('layouts._public_theme_wrapper_end')
--}}

<style>
    .acw-public-bg {
        min-height: 100vh;
        background: url('{{ asset('theme/images/bggggg.jpg') }}') center/cover no-repeat;
        /* Match public/upcoming pages */
        padding: 22px 0 40px;
    }
    .acw-public-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 28px;
    }
    .acw-public-title {
        font-weight: 900;
        color: #0f172a;
        margin: 0;
    }

    /* Keep header/logo measurements consistent with the public homepage header */
    .acw-public-header {
        margin-bottom: 18px;
    }
    .acw-public-header .acw-header {
        width: 100%;
    }

    /* On smaller screens, reduce outer padding like upcoming page */
    @media (max-width: 576px) {
        .acw-public-bg {
            padding: 12px 0 40px;
        }
        .acw-public-card {
            padding: 20px;
        }
        .acw-public-header {
            margin-bottom: 14px;
        }
    }
</style>

<div class="acw-public-bg">
    <div class="container">
        <div class="acw-public-header">
        <div class="acw-header">
            <div style="flex: 0 1 auto; text-align: center;">
                <img class="acw-logo" src="{{ asset('theme/images/acw-white.png') }}" alt="Academic Creativity Week">
            </div>
            <div style="flex: 1 1 200px; text-align: right;">
                <img class="utas-logo" src="{{ asset('theme/images/utas-logo-w.png') }}" alt="UTAS">
            </div>
        </div>
        </div>
