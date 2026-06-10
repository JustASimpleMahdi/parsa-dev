<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>درخواست مرخصی | شرکت برنامه نویسی پارسا</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/Vazirmatn-Variable-font-face.css'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', monospace;
            background: #1F2943;
            color: #E2E8F0;
            line-height: 1.6;
        }

        /* کانتینر با استایل لاگین (موقعیت وسط، پس زمینه تیره، padding) */
        .request-modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            padding: 20px;
        }

        /* کارت با ابعاد مشخص */
        .request-card {
            background: #1E293B;
            border: 1px solid #334155;
            max-width: 500px;
            width: 100%;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            animation: fadeUp 0.3s ease;
            overflow: hidden;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* هدر کارت - عنوان در سمت راست (راست‌چین) */
        .request-header {
            padding: 24px 28px 0 28px;
            display: flex;
            justify-content: flex-start; /* محتوا به سمت راست */
            align-items: center;
            background: #1E293B;
            border-radius: 36px 36px 0 0;
        }

        .request-header h3 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #6DCCF0; /* رنگ آبی مورد نظر */
            margin: 0;
            text-align: right; /* راست‌چین شدن متن عنوان */
            letter-spacing: -0.3px;
        }

        .form-container {
            padding: 28px;
        }

        /* تبدیل متن ثابت به فیلد ورودی - دقیقاً همان استایل قبلی با تغییرات جزئی برای input */
        .request-input {
            background: #113E4F;
            padding: 16px 20px;
            border-radius: 24px;
            color: white;
            font-size: 0.70rem;
            font-weight: 500;
            text-align: right;
            margin-bottom: 32px;
            line-height: 1.7;
            width: 100%;
            border: 1px solid #2a6f8a;
            outline: none;
            font-family: 'Vazirmatn', monospace;
            transition: all 0.2s ease;
        }

        .request-input:focus {
            border-color: #6DCCF0;
            box-shadow: 0 0 0 2px rgba(109, 204, 240, 0.3);
        }

        /* ردیف دکمه‌ها به صورت هم اندازه */
        .buttons-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        /* دکمه ارسال درخواست - الان سمت راست می‌آید (جایگزین شد) */
        .btn-submit {
            flex: 1;
            background: #27ECAB;
            color: #1F2943;
            border: 1.5px solid #1F2943;
            padding: 14px 0;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            text-align: center;
        }

        .btn-submit:hover {
            background: #1bc49a;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(39, 236, 171, 0.3);
        }

        /* دکمه لغو - الان سمت چپ می‌آید (جایگزین شد) */
        .btn-cancel {
            flex: 1;
            background: #113E4F;
            color: #D85656;
            border: 1.5px solid #D85656;
            padding: 14px 0;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            text-align: center;
        }

        .btn-cancel:hover {
            background: #0e2e3d;
            transform: scale(0.98);
        }
    </style>
</head>
<body>
<div class="request-modal-container">
    <div class="request-card">
        <div class="request-header">
            <h3>ویرایش درخواست شما</h3>
        </div>
        <form action="{{ route('employee.requests.update',['request' => $request]) }}" method="post"
              class="form-container">
            @csrf
            @method('PUT')
            <!-- متن ثابت قبلی به فیلد ورودی تبدیل شد -->
            <textarea name="text" type="text" class="request-input">{{ old('text',$request->text) }}</textarea>

            <!-- دو دکمه هم اندازه - جای دکمه‌ها عوض شده: ارسال درخواست اول (راست‌ترین در layout) و لغو دوم -->
            <div class="buttons-row">
                <button class="btn-submit" id="submitBtn">ارسال درخواست</button>
                <a href="{{ route('employee.index') }}" class="btn-cancel" id="cancelBtn">لغو</a>
            </div>
        </form>
    </div>
</div>
<!-- هیچ جاوا اسکریپتی اضافه نشده - فقط فایل HTML با فیلد ورودی -->
</body>
</html>
