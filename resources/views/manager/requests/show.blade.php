<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>کارت ویرایش درخواست</title>
    @vite(['resources/css/Vazirmatn-Variable-font-face.css'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', system-ui, monospace;
            background: #1F2943;
            color: #E2E8F0;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
        a{
            text-decoration: none;
        }

        .card {
            background: #113E4F;
            border: 1px solid #334155;
            max-width: 550px;
            width: 100%;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            overflow: hidden;
            padding: 32px 28px;
        }

        .card-content {
            text-align: right;
            width: 100%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #6DCCF0;
            text-align: right;
        }

        .back-icon {
            font-size: 2rem;
            cursor: pointer;
            color: #6DCCF0;
            background: transparent;
            line-height: 1;
        }

        /* بخش دیوهای اختصاصی با بک‌گراند #221A44 و متن سفید */
        .custom-field-box {
            background-color: #221A44;
            border-radius: 24px;
            padding: 16px 20px;
            margin-bottom: 28px;
            width: 100%;
        }

        .readonly-message {
            background-color: #221A44;
            color: #FFFFFF;
            font-size: 1rem;
            line-height: 1.6;
            word-break: break-word;
            font-weight: 500;
        }

        /* عنوان پاسخ شما (خارج از دیو دوم) - بزرگتر و با رنگ #6DCCF0 */
        .response-label-outer {
            background-color: transparent;
            color: #6DCCF0;
            font-weight: 700;
            font-size: 1.2rem;
            text-align: right;
            letter-spacing: 0.3px;
            display: block;
            margin-bottom: 12px;
            margin-right: 4px;
        }

        /* استایل اینپوت فعال (قابل ویرایش) */
        .editable-input {
            background-color: #221A44;
            border: 1px solid #221A44;
            border-radius: 24px;
            padding: 14px 18px;
            color: #FFFFFF;
            font-size: 0.95rem;
            font-family: inherit;
            width: 100%;
            transition: all 0.2s ease;
            resize: vertical;
        }

        .editable-input:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 2px rgba(39, 236, 171, 0.25);
        }

        /* دکمه ارسال - کوچک‌تر با عرض کمتر و padding متناسب */
        .submit-btn {
            background-color: #27ECAB;
            color: #1F2943;
            border: none;
            border-radius: 40px;
            padding: 8px 22px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            width: auto;
            min-width: 150px;
            text-align: center;
            transition: all 0.2s ease;
            margin-top: 8px;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .submit-btn:hover {
            background-color: #1ad197;
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(39, 236, 171, 0.3);
        }

        /* محفظه دکمه برای چیدمان راست‌چین (اختیاری) */
        .button-wrapper {
            text-align: right;
            margin-top: 6px;
            text-align: center;
        }

        /* فاصله مناسب بین بخش‌ها */
        .field-margin {
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<div class="card">
    <form action="{{ route('manager.requests.response',['request' => $request]) }}" method="post" class="card-content">
        @csrf
        @method('PATCH')
        <div class="card-header">
            <div class="card-title">{{ $request->type->title }} {{ $request->employee->personal_info->fullname }}</div>
            <a href="{{ route('manager.index') }}" class="back-icon">⬅</a>
        </div>

        <!-- دیو اول : متن غیرفعال (فقط خواندنی) با بک گراند #221A44 و متن سفید -->
        <div class="custom-field-box">
            <div class="readonly-message">{{ $request->text }}</div>
        </div>

        <!-- عنوان "پاسخ شما" بیرون از دیو دوم، با سایز بزرگتر و رنگ #6DCCF0 -->
        <span class="response-label-outer">پاسخ شما :</span>

        <!-- دیو دوم : اینپوت قابل ویرایش (بدون عنوان داخلی) -->

        <textarea name="text" type="text" class="editable-input">{{ old('text',$request->response?->text) }}</textarea>

        <!-- دکمه ارسال با اندازه کوچک‌تر -->
        <div class="button-wrapper">
            <button class="submit-btn">ارسال</button>
        </div>
    </form>
</div>

</body>
</html>
