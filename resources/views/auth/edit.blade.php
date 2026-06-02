<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشخصات کامل</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #000000;
            font-family: 'Segoe UI', 'Tahoma', 'Vazir', system-ui, sans-serif;
            min-height: 100vh;
            padding: 2rem;
        }

        /* کانتینر اصلی با بک‌گراند #1F2943 */
        .container {
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
            background-color: #1F2943;
            border-radius: 24px;
            overflow: hidden;
        }

        /* هدر با بک‌گراند #221A44 */
        .header {
            background-color: #221A44;
            padding: 1.2rem 1.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* عنوان سمت راست با رنگ #6DCCF0 */
        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6DCCF0;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .header-title span {
            font-size: 1.8rem;
        }

        /* فقط فلش سمت چپ بالا - با رنگ #6DCCF0 */
        .arrow-only {
            color: #6DCCF0;
            font-size: 1.8rem;
            line-height: 1;
        }

        /* بخش لیست اطلاعات - یک ستون پشت سر هم */
        .info-list {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        /* هر آیتم اطلاعات */
        .info-item {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            border-bottom: 1px solid #27ECAB;
            padding-bottom: 0.75rem;
        }

        /* برچسب سمت راست - با رنگ #6DCCF0 */
        .info-label {
            width: 140px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #6DCCF0;
            letter-spacing: 0.3px;
        }

        /* مقدار سمت چپ - با رنگ #27ECAB و چینش چپ */
        .info-value {
            flex: 1;
            color: #27ECAB;
            font-size: 1rem;
            font-weight: 500;
            word-break: break-word;
            padding-right: 10px;
            text-align: left;
        }

        /* بخش کادرهای پایین */
        .bottom-cards {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        /* کادرها با رنگ #221A44 */
        .card {
            background-color: #221A44;
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
        }

        /* هدر هر کادر */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .card-title {
            color: #6DCCF0;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-value {
            color: #6DCCF0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* متن داخل کادر اول */
        .card-text {
            color: #6DCCF0;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        /* لینک گیت‌هاب */
        .github-link {
            color: #6DCCF0;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
        }

        .github-link:hover {
            text-decoration: underline;
            opacity: 0.8;
        }

        /* دکمه ویرایش */
        .edit-button-wrapper {
            padding: 0.5rem 1.8rem 1.8rem 1.8rem;
            display: flex;
            justify-content: center;
        }

        .edit-btn {
            background-color: #27ECAB;
            color: #1F2943;
            border: none;
            padding: 0.8rem 2.5rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            width: 100%;
            max-width: 200px;
        }

        .edit-btn:hover {
            background-color: #1bcb90;
            transform: scale(0.98);
        }

        .edit-btn:active {
            transform: scale(0.96);
        }

        /* برای نمایش بهتر در موبایل */
        @media (max-width: 550px) {
            body {
                padding: 1rem;
            }

            .info-item {
                flex-direction: column;
                gap: 6px;
            }

            .info-label {
                width: 100%;
            }

            .info-value {
                padding-right: 0;
                text-align: left;
            }

            .header-title {
                font-size: 1.3rem;
            }

            .arrow-only {
                font-size: 1.5rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .edit-btn {
                max-width: 100%;
            }
        }

        /* خط پایانی */
        .footer-note {
            text-align: center;
            padding: 0rem 1.8rem 1.8rem;
            font-size: 0.7rem;
            color: #6DCCF0;
            opacity: 0.5;
        }
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #000000;
            font-family: 'Segoe UI', 'Tahoma', 'Vazir', system-ui, sans-serif;
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 650px;
            width: 100%;
            margin: 0 auto;
            background-color: #1F2943;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.5);
        }

        .header {
            background-color: #221A44;
            padding: 1.2rem 1.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6DCCF0;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .header-title span {
            font-size: 1.8rem;
        }

        .arrow-only {
            color: #6DCCF0;
            font-size: 1.8rem;
            line-height: 1;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .arrow-only:hover {
            transform: translateX(-4px);
        }

        .info-list {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .info-item {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            border-bottom: 1px solid #27ECAB;
            padding-bottom: 0.75rem;
        }

        .info-label {
            width: 140px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #6DCCF0;
            letter-spacing: 0.3px;
        }

        .info-value {
            flex: 1;
            color: #FFFFFF;
            font-size: 1rem;
            font-weight: 500;
            word-break: break-word;
            padding-right: 10px;
            text-align: left;
        }

        .bottom-cards {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .card {
            background-color: #221A44;
            border-radius: 16px;
            padding: 1.2rem 1.5rem;
            transition: all 0.2s;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-title {
            color: #6DCCF0;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .card-value {
            color: #6DCCF0;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .white-text {
            color: #FFFFFF;
            font-size: 0.95rem;
            margin-top: 12px;
            margin-bottom: 6px;
        }

        .blue-label {
            color: #6DCCF0;
            font-weight: 600;
            display: inline-block;
            margin-left: 6px;
        }

        .resume-text-row {
            margin: 12px 0 6px 0;
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
            gap: 5px;
        }

        .resume-text-row .gray-text {
            margin-bottom: 0;
            flex: 1;
        }

        .gray-text {
            color: #9CA3AF;
            font-size: 0.9rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .white-text-bottom {
            color: #FFFFFF;
            font-size: 0.95rem;
            margin-top: 8px;
        }

        /* استایل جدید برای ردیف آپلود فایل */
        .file-upload-row {
            display: flex;
            align-items: start;
            gap: 103px;
            margin: 15px 0 8px 0;
            flex-wrap: wrap;
        }

        .file-label-text {
            color: #FFFFFF;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* ============================================= */
        /* استایل اصلاح شده برای فیلد انتخاب فایل (کوچک‌تر شدن طول) */
        /* ============================================= */
        .custom-file-input {
            background-color: #113E4F;
            border: 2px dashed #27ECAB;
            border-radius: 16px;
            padding: 8px 12px;
            color: #E2E8F0;
            font-family: inherit;
            font-size: 0.85rem;
            cursor: pointer;
            /* تغییرات اصلی برای کوچک‌تر شدن طول */
            width: 360px;
            /* عرض ثابت برای دسکتاپ */
            max-width: 100%;
            /* برای موبایل: حداکثر عرض برابر با والد */
            flex: none;
            /* غیرفعال کردن flex:1 تا عرض کشیده نشود */
            min-width: auto;
            /* حذف min-width قبلی */
            transition: all 0.3s ease;
        }

        .custom-file-input:hover {
            background-color: #0e3442;
            border-color: #1bcb90;
        }

        /* استایل برای دکمه "Choose File" داخل input */
        .custom-file-input::-webkit-file-upload-button {
            background-color: #27ECAB;
            border: none;
            border-radius: 12px;
            padding: 6px 18px;
            color: #1F2943;
            font-weight: bold;
            cursor: pointer;
            margin-left: 12px;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .custom-file-input::-webkit-file-upload-button:hover {
            background-color: #1bcb90;
            transform: scale(0.98);
        }

        /* برای مرورگر فایرفاکس */
        .custom-file-input::file-selector-button {
            background-color: #27ECAB;
            border: none;
            border-radius: 12px;
            padding: 6px 18px;
            color: #1F2943;
            font-weight: bold;
            cursor: pointer;
            margin-left: 12px;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .custom-file-input::file-selector-button:hover {
            background-color: #1bcb90;
            transform: scale(0.98);
        }

        .file-name-display {
            font-size: 0.85rem;
            color: #27ECAB;
            margin-top: 8px;
            padding-right: 5px;
        }

        .double-button-wrapper {
            padding: 0.5rem 1.8rem 1.8rem 1.8rem;
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            flex-wrap: wrap;
        }

        .action-btn {
            border: none;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            min-width: 130px;
            text-align: center;
            background-color: transparent;
        }

        .submit-btn {
            background-color: #27ECAB;
            color: #1F2943;
            box-shadow: 0 4px 10px rgba(39, 236, 171, 0.2);
        }

        .submit-btn:hover {
            background-color: #1bcb90;
            transform: scale(0.97);
            box-shadow: 0 2px 6px rgba(27, 203, 144, 0.3);
        }

        .back-btn {
            background-color: #6DCCF0;
            color: #1F2943;
            box-shadow: 0 4px 10px rgba(109, 204, 240, 0.2);
        }

        .back-btn:hover {
            background-color: #4fb5db;
            transform: scale(0.97);
            box-shadow: 0 2px 6px rgba(79, 181, 219, 0.3);
        }

        .action-btn:active {
            transform: scale(0.95);
        }

        .job-check-list {
            background: transparent;
            border-radius: 24px;
            margin-top: 10px;
            width: 100%;
        }

        .job-check-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-bottom: 1px solid #27ECAB;
        }

        .job-check-item:last-child {
            border-bottom: none;
        }

        .custom-circle-check {
            position: relative;
            display: inline-block;
            width: 22px;
            height: 22px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .custom-circle-check input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            cursor: pointer;
        }

        .circle-mark {
            position: absolute;
            top: 0;
            left: 0;
            width: 22px;
            height: 22px;
            background-color: #FFFFFF;
            border-radius: 50%;
            transition: all 0.2s ease;
            border: 1px solid #475569;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .custom-circle-check input:checked ~ .circle-mark {
            background-color: #27ECAB;
            border-color: #27ECAB;
            box-shadow: 0 0 5px rgba(39, 236, 171, 0.5);
        }

        .custom-circle-check:hover .circle-mark {
            border-color: #27ECAB;
            transform: scale(1.05);
        }

        .job-check-item label {
            flex: 1;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            color: #FFFFFF;
        }

        .job-full-badge {
            background: transparent;
            color: #D85656;
            padding: 0;
            border-radius: 0;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            letter-spacing: 0.3px;
        }

        .job-check-item .full-job-label {
            font-size: 1.05rem;
            font-weight: 600;
            color: #FFFFFF;
        }

        .job-full-badge i {
            margin-left: 4px;
        }

        .job-check-item label span:first-child {
            color: #FFFFFF;
        }

        .job-check-item label span:last-child {
            color: #D85656;
        }

        @media (max-width: 550px) {
            body {
                padding: 1rem;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .info-label {
                width: 100%;
            }

            .info-value {
                padding-right: 0;
                text-align: left;
                width: 100%;
            }

            .header-title {
                font-size: 1.3rem;
            }

            .arrow-only {
                font-size: 1.5rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .double-button-wrapper {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .action-btn {
                width: 100%;
                max-width: 220px;
            }

            .job-check-item label {
                flex-wrap: wrap;
                gap: 8px;
            }

            .file-upload-row {
                flex-direction: column;
                align-items: stretch;
            }

            /* در موبایل، عرض کادر فایل حداکثر 100% شود */
            .custom-file-input {
                width: 100%;
                max-width: 100%;
            }
        }

        .github {
            color: #6DCCF0;
            display: flex;
            justify-content: end;
        }
    </style>
</head>

<body>
<?php
$user = auth()->user();
?>
<div class="container">
    <!-- هدر با بک‌گراند #221A44 -->
    <div class="header">
        <div class="header-title">
            <span>🪪</span>
            <span>مشخصات کامل</span>
        </div>
        <a href="{{ route('job-requested') }}" class="arrow-only">
            ⬅
        </a>
    </div>

    <!-- لیست اطلاعات - یک ستون پشت سر هم -->
    <form action="{{ route('job-requested.info.edit.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <div class="info-list">
                <div class="info-item">
                    <div class="info-label">نام:</div>
                    <div class="info-value">
                        <input type="text" name="firstname"
                               value="{{ old('firstname',$user->personal_info->firstname) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">نام خانوادگی:</div>
                    <div class="info-value">
                        <input type="text" name="lastname" value="{{ old('lastname',$user->personal_info->lastname) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">شماره تلفن :</div>
                    <div class="info-value"><input type="text" name="phone"
                                                   value="{{ old('phone',$user->personal_info->phone) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">کد ملی :</div>
                    <div class="info-value"><input type="text" name="national_code"
                                                   value="{{ old('national_code',$user->personal_info->national_code) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">شماره شناسنامه :</div>
                    <div class="info-value"><input type="text" name="id_number"
                                                   value="{{ old('id_number',$user->personal_info->id_number) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">نام پدر :</div>
                    <div class="info-value"><input type="text" name="father_name"
                                                   value="{{ old('father_name',$user->personal_info->father_name) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">تاریخ تولد :</div>
                    <div class="info-value"><input type="text" name="birthdate"
                                                   value="{{ old('birthdate',$user->personal_info->birthdate) }}"></div>
                </div>
                <div class="info-item">
                    <div class="info-label">محل تولد :</div>
                    <div class="info-value"><input type="text" name="birthplace"
                                                   value="{{ old('birthplace',$user->personal_info->birthplace) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">آدرس محل سکونت :</div>
                    <div class="info-value"><input type="text" name="address"
                                                   value="{{ old('address',$user->personal_info->address) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">کد پستی :</div>
                    <div class="info-value"><input type="text" name="postal_code"
                                                   value="{{ old('postal_code',$user->personal_info->postal_code) }}">
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">نام کاربری :</div>
                    <div class="info-value"><input type="text" name="username"
                                                   value="{{ old('username',$user->username) }}"></div>
                </div>
                <div class="info-item">
                    <div class="info-label">رمز عبور جدید :</div>
                    <div class="info-value"><input type="password" name="password"></div>
                </div>
                <div class="info-item">
                    <div class="info-label">تایید رمز عبور جدید:</div>
                    <div class="info-value"><input type="password" name="password_confirmation"></div>
                </div>
                <div class=" info-item">
                    <div class="info-label">عکس پرسنلی:</div>
                    <div class="info-value"><input type="file" name="personal_image"></div>
                </div>
                <div class="info-item">
                    <div class="info-label">آخرین مدرک:</div>
                    <div class="info-value"><input type="file" name="last_degree"></div>
                </div>
            </div>

            <!-- دو کادر پایین -->
            <div class="bottom-cards">
                <!-- کادر اول: اطلاعات رزومه -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span>📝</span>
                            <span>اطلاعات رزومه : </span>
                        </div>
                        <div class="card-value">
                            <span></span>
                        </div>
                    </div>

                    <!-- بخش متن رزومه -->
                    <span class="blue-label">متن:</span>
                    <span>
                                <textarea name="resume_text" id="">{{ $user->resume->text }}</textarea>
                            </span>

                    <div>
                        @foreach($user->resume->files as $file)
                            <span>
                                        <input type="checkbox" name="delete_resume_files[]" value="{{ $file->id }}">
                                        <a href="{{ route('get-file.resume.file',['file'=>$file]) }}"
                                           download="{{ $file->filename }}">
                                            {{ $file->filename }}
                                        </a>
                                    </span>
                        @endforeach
                    </div>
                    <div class="file-upload-row">
                        <span class="file-label-text">افزودن فایل :</span>
                        <input type="file" id="resumeFileInput" name="new_resume_files[]" class="custom-file-input"
                               accept=".pdf,.doc,.docx,.jpg,.png">
                    </div>
                    <div class="file-name-display" id="fileNameDisplay"></div>
                </div>

                <div class="card" style="padding-bottom: 20px;">
                    <div class="card-header">
                        <div class="card-title">
                            <span>💼</span>
                            <span>فرصت های شغلی :</span>
                        </div>
                    </div>
                    <div id="jobCheckListContainer" class="job-check-list">
                        @foreach($jobOpportunities as $jobOpportunity)
                            @php($isRequested = $user->pending_job_requests->pluck('job_opportunity_id')->contains($jobOpportunity->id))

                            @if($isRequested || !$jobOpportunity->is_full)
                                <label class="job-check-item">
                                        <span class="custom-circle-check">
                                            <input name="job_opportunities[]" type="checkbox"
                                                   class="job-circle-checkbox"
                                                   value="{{ $jobOpportunity->id }}" {{ $isRequested ? 'checked' : '' }}>
                                            <span class="circle-mark"></span>
                                        </span>
                                    <span
                                        style="display: flex; justify-content: space-between; align-items: center; width: 100%; cursor: pointer;">
                                            <span style="color: #FFFFFF;">{{ $jobOpportunity->title }}</span>
                                            <span style="color:#27ECAB; font-size: 0.85rem;"> ({{ $jobOpportunity->remaining_capacity }} ظرفیت)</span>
                                        </span>
                                </label>

                            @else
                                <label class="job-check-item">
                                        <span class="custom-circle-check" style="opacity:0.5; cursor:not-allowed;">
                                            <input type="checkbox" disabled>
                                            <span class="circle-mark"
                                                  style="background-color:#64748B; border-color:#475569;"></span>
                                        </span>
                                    <span
                                        style="cursor:default; display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                            <span
                                                style="font-size: 1.05rem; font-weight: 600; color: #FFFFFF;">{{ $jobOpportunity->title }}</span>
                                            <span class="job-full-badge"
                                                  style="font-size: 1rem; font-weight: 600; background: transparent; padding: 0;"><i
                                                    class="fas fa-ban"></i> ظرفیت تکمیل شد</span>
                                        </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="double-button-wrapper">
                <button class="action-btn submit-btn" id="submitDataBtn" name="updateInfoSubmit">ثبت</button>
                <a href="{{ route('job-requested.info') }}" class="action-btn back-btn" id="returnActionBtn">بازگشت</a>
            </div>

        </div>
    </form>
</div>
</body>

</html>
