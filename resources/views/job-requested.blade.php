<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>پروفایل کاربر | شرکت برنامه نویسی پارسا</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', 'Tahoma', monospace;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* کارت اصلی با بکگراند #221A44 */
        .profile-card {
            background: #221A44;
            border-radius: 48px;
            padding: 48px 32px 40px 32px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(109, 204, 240, 0.2);
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* دایره آبی با آیکون */
        .avatar-circle {
            width: 120px;
            height: 120px;
            background: #6DCCF0;
            border-radius: 50%;
            margin: 0 auto 24px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(109, 204, 240, 0.3);
        }

        .avatar-circle i {
            font-size: 64px;
            color: #221A44;
        }

        /* اسم کاربر با رنگ جدید */
        .user-name {
            font-size: 28px;
            font-weight: 800;
            color: #27ECAB;
            margin-bottom: 40px;
            letter-spacing: -0.5px;
        }

        /* متن‌های اطلاع‌رسانی (سفید) */
        .info-text {
            color: #ffffff;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 12px;
        }

        /* فاصله بین آخرین متن اطلاع‌رسانی و دکمه‌ها - مقدار مناسب */
        .last-info-text {
            margin-bottom: 32px; /* فاصله متعادل بین متن آخر و دکمه‌ها */
        }

        /* دکمه‌ها */
        .buttons-row {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .btn-primary {
            background: #27ECAB;
            border: none;
            padding: 14px 28px;
            border-radius: 60px;
            font-size: 16px;
            font-weight: bold;
            color: #0B1120;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary {
            background: #6DCCF0;
            border: none;
            padding: 14px 28px;
            border-radius: 60px;
            font-size: 16px;
            font-weight: bold;
            color: #0B1120;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            background: #1bc49a;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(39, 236, 171, 0.4);
        }

        .btn-secondary:hover {
            background: #4fb4db;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(109, 204, 240, 0.4);
        }

        /* متن پایین کارت */
        .footer-text {
            color: #ffffff;
            font-size: 14px;
            text-align: center;
            margin-top: 8px;
            opacity: 0.8;
            letter-spacing: 0.5px;
        }

        .footer-text i {
            color: #ff6b6b;
        }

        /* پیام toast */
        .toast-msg {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #1E293B;
            border-left: 5px solid #27ECAB;
            color: #E2E8F0;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 500;
            z-index: 1100;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            display: none;
            font-family: monospace;
        }
    </style>
</head>

<body>

<!-- کارت اصلی پروفایل -->
<div class="profile-card">
    <div class="avatar-circle">
        <i class="fas fa-user"></i>
    </div>
    <div class="user-name">{{ auth()->user()->fullname }}</div>
    <div class="info-text">اطلاعات شما برای مدیر ارسال شد و درخواست شما درحال بررسی است</div>
    <!-- کلاس last-info-text با فاصله 32px -->
    <div class="info-text last-info-text">نتیجه نهایی درخواست شما ، برایتان ارسال خواهد شد</div>

    <div class="buttons-row">
        <button class="btn-primary" id="showDetailsBtn">
            <i class="fas fa-id-card"></i> مشخصات
        </button>
        <button class="btn-secondary" id="backHomeBtn">
            بازگشت به صفحه اصلی
        </button>
    </div>

    <div class="footer-text">
        شرکت برنامه نویسی پارسا❤️
    </div>
</div>
</body>

</html>
