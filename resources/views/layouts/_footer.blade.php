<div class="row">
    <div class="col-lg-12">
        <div class="acw-footer">
            <p style="margin: 0;">
                {{ now()->year }} © Academic Creativity Week.<br> Developed By: System Development Team - UTAS Salalah |
                <a href="{{ route('login') }}" style="color: inherit; text-decoration: underline; font-weight: 700;">Staff Login</a>
            </p>
        </div>
    </div>
</div>

<style>
    /* Footer styling shared across all pages */
    .acw-footer {
        background: transparent;
        border: 0;
        border-radius: 0;
        padding: 0;
        box-shadow: none;
        color: rgba(255, 255, 255, 0.92);
        text-align: center;
        text-shadow: 0 2px 10px rgba(0,0,0,0.35);
    }
    .acw-footer a:hover {
        opacity: 0.85;
    }
</style>