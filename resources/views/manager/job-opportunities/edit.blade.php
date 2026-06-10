<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ایجاد فرصت شغلی جدید | شرکت برنامه نویسی پارسا</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/Vazirmatn-Variable-font-face.css'])
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

        /* کارت اصلی با بکگراند #221A44 و بوردر و سایز حفظ شده */
        .profile-card {
            background: #221A44;
            border-radius: 48px;
            padding: 48px 32px 40px 32px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(109, 204, 240, 0.2);
            position: relative;
        }

        /* فلش بالا سمت چپ */
        .top-left-arrow {
            position: absolute;
            top: 28px;
            left: 28px;
            color: #6DCCF0;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s ease;
        }

        /* عنوان اصلی بدون فلش (فقط متن) */
        .form-title {
            font-size: 28px;
            font-weight: 800;
            color: #6DCCF0;
            margin-bottom: 40px;
            letter-spacing: -0.5px;
            text-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
        }

        /* گروه هر کادر */
        .input-group {
            margin-bottom: 28px;
            text-align: right;
        }

        /* استایل لیبل‌ها با رنگ #6DCCF0 و فونت مناسب */
        .input-group label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #6DCCF0;
            margin-bottom: 8px;
            font-family: 'Vazirmatn', monospace;
            letter-spacing: 0.3px;
        }

        /* inputها و textarea:
           - رنگ متن داخل فیلدها #707070
           - سایز فونت نسبتاً کوچک‌تر (14px) اما خوانا
           - border رنگ #707070 و فوکوس */
        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 12px 18px;
            font-size: 14px;
            /* سایز فونت کوچک‌تر از قبل (قبلاً 16 بود) */
            font-family: 'Vazirmatn', monospace;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid #707070;
            border-radius: 28px;
            color: #707070;
            /* رنگ متن داخل فیلدها #707070 */
            outline: none;
            transition: all 0.2s ease;
            resize: vertical;
            line-height: 1.4;
        }

        /* برای textarea هم همین قانون */
        .input-group textarea {
            min-height: 95px;
            font-size: 14px;
        }

        /* placeholder جدید: رنگ ملایم‌تر از #707070 اما برای خوانایی */
        .input-group input::placeholder,
        .input-group textarea::placeholder {
            color: rgba(112, 112, 112, 0.65);
            /* #707070 با شفافیت ظریف */
            font-size: 13px;
            font-weight: normal;
        }

        /* فوکوس: همرنگ #6DCCF0 برای جلوه زیبا ولی بوردر اصلی #707070 تغییر نمی‌کند؛ فقط سایه/گلور */
        .input-group input:focus,
        .input-group textarea:focus {
            border-color: #6DCCF0;
            box-shadow: 0 0 0 3px rgba(109, 204, 240, 0.3);
            background: rgba(255, 255, 255, 0.12);
            color: #e0e0e0;
            /* هنگام فوکوس برای خوانایی بهتر، کمی روشن‌تر اما هنوز نزدیک به تم dark */
        }

        /* دکمه ثبت با رنگ پس‌زمینه #27ECAB ، border #707070 و فونت #22342E */
        .submit-btn {
            background: #27ECAB;
            border: 2px solid #707070;
            padding: 14px 28px;
            border-radius: 60px;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Vazirmatn', monospace;
            color: #22342E;
            cursor: pointer;
            transition: 0.2s;
            width: 50%;
            margin: 16px auto 8px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            text-align: center;
        }

        .submit-btn:hover {
            background: #1bc49a;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(39, 236, 171, 0.3);
        }

        /* متن فوتر اختیاری */
        .footer-text {
            color: #ffffff;
            font-size: 14px;
            text-align: center;
            margin-top: 28px;
            opacity: 0.8;
            letter-spacing: 0.5px;
        }

        .footer-text i {
            color: #ff6b6b;
        }
    </style>
</head>

<body>

<!-- کارت اصلی با سایز و بک‌گراند و بوردر ثابت -->
<form action="{{ route('manager.job-opportunities.update',['job_opportunity'=>$jobOpportunity]) }}" method="post"
      class="profile-card">
    @csrf
    @method('PUT')
    <!-- فلش بالا سمت چپ ➡ با رنگ #6DCCF0 -->
    <a href="{{ route('manager.index') }}" class="top-left-arrow">
        ⬅
    </a>

    <!-- عنوان اصلی بدون فلش (فقط متن "ایجاد فرصت شغلی جدید") -->
    <div class="form-title">
        <span>ایجاد فرصت شغلی جدید</span>
    </div>

    <!-- کادر اول: برچسب "عنوان" با placeholder جدید و متن داخلی خالی (بدون مقدار از پیش تعیین شده)
         همچنین سایز فونت و رنگ #707070 داخل فیلد -->
    <div class="input-group">
        <label>عنوان</label>
        <input name="title" type="text" id="jobTitle" placeholder="عنوان را وارد کنید ... "
               value="{{ old('title',$jobOpportunity->title) }}">
    </div>

    <!-- کادر دوم: برچسب "توضیحات" با placeholder جدید و متن داخلی خالی -->
    <div class="input-group">
        <label>توضیحات</label>
        <textarea name="description" id="jobDesc"
                  placeholder="توضیحات(حقوق،ساعت کاری و ...) را وارد کنید">{{ old('description',$jobOpportunity->description) }}</textarea>
    </div>

    <!-- کادر سوم: برچسب "ظرفیت" با placeholder جدید و متن داخلی خالی -->
    <div class="input-group">
        <label>ظرفیت</label>
        <input name="capacity" type="text" id="jobCapacity" placeholder="ظرفیت را وارد کنید ... "
               value="{{ old('capacity',$jobOpportunity->capacity) }}">
    </div>

    <!-- دکمه ثبت بدون آیکون (فقط متن "ثبت") و در وسط قرار گرفته -->
    <button name="createSubmit" class="submit-btn" id="submitBtn">
        ثبت
    </button>
</form>

</body>

</html>
