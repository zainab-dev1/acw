<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 40px 30px;
            color: #333;
        }
        .email-body p {
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .reset-button {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .reset-button:hover {
            opacity: 0.9;
        }
        .button-container {
            text-align: center;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e0e0e0;
        }
        .note {
            background-color: #fff3cd;
            border-right: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .note p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div>
            <h1>Password Reset - إعادة تعيين كلمة المرور</h1>
        </div>
        
        <div class="email-body">
            <p>مرحباً <strong>{{ $userName }}</strong>،</p>
            
            <p>We received a request to reset the password for your account in the Events and Activities System.</p>
            <p>تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك في نظام الأحداث والفعاليات.</p>
            
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">
                   Reset Password - إعادة تعيين كلمة المرور
                </a>
            </div>
            
            <div>
                <p><strong>Note:</strong> This link is valid for 60 minutes only.</p>
                <p><strong>تنبيه:</strong> هذا الرابط صالح لمدة 60 دقيقة فقط.</p>
            </div>

            <p>If you did not request a password reset, please ignore this email.</p>
            <p>إذا لم تطلب إعادة تعيين كلمة المرور، يرجى تجاهل هذه الرسالة.</p>
            
            <p style="font-size: 14px; color: #666; margin-top: 30px;">
                If you encounter any issues clicking the button above, copy and paste the following link into your browser: <br>
                إذا واجهت مشكلة في النقر على الزر أعلاه، انسخ الرابط التالي والصقه في متصفحك:
            </p>
            <p style="font-size: 12px; color: #007bff; word-break: break-all;">
                {{ $resetUrl }}
            </p>
        </div>
        
        <div class="email-footer">
            <p>Academic Creativity Week <br>UTAS - Salalah © {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
