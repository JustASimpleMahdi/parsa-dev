<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>تأیید حذف فرصت شغلی</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, 'Segoe UI', 'Vazirmatn', 'Tahoma', monospace;
            background: #221A44; /* پس‌زمینه اصلی مطابق خواسته */
            color: #E2E8F0;
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* کانتینر اصلی */
        .confirm-container {
            width: 100%;
            max-width: 540px;
            margin: 0 auto;
            background: transparent;
        }

        /* کارت سوال – بدون هیچ انیمیشن و جی اس */
        .confirm-card {
            background: #1E293B;
            border-radius: 36px;
            border: 1px solid #334155;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            padding: 32px 28px 36px 28px;
        }

        /* متن اصلی سوال: رنگ #6DCCF0 */
        .question-text {
            font-size: 1.65rem;
            font-weight: 600;
            text-align: center;
            color: #6DCCF0;
            margin-bottom: 40px;
            line-height: 1.5;
            word-break: break-word;
        }

        /* محفظه دکمه‌ها: دو دکمه در کنار هم */
        .button-group {
            display: flex;
            flex-direction: row;
            gap: 20px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        /* استایل مشترک دکمه‌ها - بدون هیچ event یا جاوااسکریپت */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: inherit;
            border-radius: 60px;
            cursor: pointer;
            background: transparent;
            text-decoration: none;
            min-width: 120px;
            border: 2px solid transparent;
            text-align: center;
            user-select: none;
        }

        /* دکمه لغو: بک‌گراند #221A44 , بوردر و فونت #D85656 */
        .btn-cancel {
            background: #221A44;
            border: 2px solid #D85656;
            color: #D85656;
        }

        /* دکمه بله: بک‌گراند #27ECAB , border #707070 , رنگ فونت #221A44 */
        .btn-confirm {
            background: #27ECAB;
            border: 2px solid #707070;
            color: #221A44;
        }

        .btn:focus, .btn:active {
            outline: none;
            transform: none;
            box-shadow: none;
        }

        /* واکنش‌گرایی برای موبایل */
        @media (max-width: 480px) {
            .confirm-card {
                padding: 24px 20px 28px;
            }

            .question-text {
                font-size: 1.35rem;
                margin-bottom: 32px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 1rem;
                min-width: 100px;
            }

            .button-group {
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<div class="confirm-container">
    <div class="confirm-card">
        <!-- متن سوال با رنگ #6DCCF0 -->
        <div class="question-text">
            آیا از حذف این فرصت شغلی اطمینان دارید ؟
        </div>
        <form
            action="{{ route('manager.job-opportunities.destroy',['job_opportunity'=>$jobOpportunity]) }}"
            method="post" class="delete-icon">
            @csrf
            @method('DELETE')
            <!-- دو دکمه: ابتدا "بله" و سپس "لغو" (جای آن‌ها عوض شده نسبت به نسخه قبل) -->
            <div class="button-group">
                <!-- دکمه بله: background #27ECAB، border #707070، فونت #221A44 -->
                <button class="btn btn-confirm">بله</button>
                <!-- دکمه لغو: background #221A44، border و فونت #D85656 -->
                <a href="{{ route('manager.index') }}" class="btn btn-cancel">لغو</a>
            </div>
        </form>
    </div>
</div>

<!-- بدون هیچ اسکریپت، هیچ کد جاوااسکریپتی وجود ندارد.
     مطابق خواسته: "جاوا اسکریپت هم نزن" رعایت شده است.
     جای دو دکمه عوض شد: ابتدا "بله" سپس "لغو" -->
</body>
</html>
