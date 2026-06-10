<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>تکمیل رزومه | شرکت برنامه نویسی پارسا</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .resume-modal-container {
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

        .resume-card {
            background: #1F2943;
            border: 1px solid #1F2943;
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            animation: fadeUp 0.3s ease;
        }

        .resume-card::-webkit-scrollbar {
            width: 6px;
        }

        .resume-card::-webkit-scrollbar-track {
            background: #0F172A;
            border-radius: 10px;
        }

        .resume-card::-webkit-scrollbar-thumb {
            background: #27ECAB;
            border-radius: 10px;
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

        .resume-header {
            padding: 24px 28px 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: #1F2943;
            z-index: 10;
        }

        .resume-header h3 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #38BDF8;
            margin: 0;
        }

        .close-resume {
            font-size: 28px;
            cursor: pointer;
            color: #6DCCF0;
            transition: 0.2s;
            text-decoration: none;
        }

        .close-resume:hover {
            color: #9ee4ff;
        }

        .form-container {
            padding: 28px;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .resume-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 10px;
        }

        .resume-method {
            background: #221A44;
            border: 1px solid #334155;
            border-radius: 24px;
            padding: 20px;
            transition: border-color 0.2s;
        }

        .resume-method:hover {
            border-color: #27ECAB;
        }

        .resume-method h4 {
            color: #27ECAB;
            margin-bottom: 12px;
            font-size: 1.1rem;
        }

        .resume-method input[type="file"] {
            padding: 10px 16px;
            border: 2px dashed #27ECAB;
            border-radius: 20px;
            font-size: 0.9rem;
            font-family: 'Vazirmatn', monospace;
            background: #113E4F;
            color: #F1F5F9;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .resume-method input[type="file"]::file-selector-button {
            background: #27ECAB;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            color: #0B1120;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Vazirmatn', monospace;
            transition: 0.2s;
            margin-left: 12px;
        }

        .resume-method input[type="file"]::file-selector-button:hover {
            background: #1bc49a;
        }

        .resume-method textarea {
            padding: 12px 16px;
            border: 1px solid #334155;
            border-radius: 20px;
            font-size: 0.95rem;
            font-family: 'Vazirmatn', monospace;
            background: #221A44;
            color: #F1F5F9;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
            resize: vertical;
            min-height: 100px;
        }

        .resume-method textarea:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.2);
        }

        .resume-method textarea::placeholder {
            color: #94A3B8;
        }

        .job-check-list {
            background: #221A44;
            border-radius: 24px;
            padding: 20px;
            margin-top: 10px;
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
            border-radius: 0;
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
        }

        .job-full-badge i {
            margin-left: 4px;
        }

        .auth-form button {
            background: #27ECAB;
            border: none;
            padding: 14px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            color: #0B1120;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            margin-top: 8px;
        }

        .auth-form button:hover {
            background: #1bc49a;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(45, 212, 191, 0.3);
        }

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

        @media (max-width: 700px) {
            .resume-options {
                grid-template-columns: 1fr;
            }

            .resume-card {
                max-width: 95%;
            }

            .resume-header h3 {
                font-size: 1.3rem;
            }

            .form-container {
                padding: 20px;
            }
        }
.error-simple {
    color: #ff6b6b;
    font-size: 14px;
    text-align: center;
    background: rgba(255, 107, 107, 0.1);
    padding: 12px;
    border-radius: 12px;
    border-right: 3px solid #ff6b6b;
    font-weight: 500;
    width: auto;
    display: none;
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1001;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    backdrop-filter: blur(8px);
    white-space: nowrap;
}
    </style>
</head>

<body>

<div class="resume-modal-container">
    <div class="resume-card">
        <div class="resume-header">
            <h3><i class="fas fa-file-alt"></i> تکمیل رزومه و انتخاب شغل</h3>
            <a href="{{ route('register') }}" class="close-resume">⬅</a>
        </div>
        <form action="{{ route('register.resume.store') }}" method="post" enctype="multipart/form-data"
              class="form-container">
            @csrf
            <div class="auth-form">
                <h4 style="color:#6DCCF0; margin-bottom:10px;">📝 روش‌های ارسال رزومه (حداقل یک مورد)</h4>
                <div class="resume-options">
                    <div class="resume-method">
                        <h4>آپلود فایل</h4>
                        <input name="resume_files[]" multiple type="file" id="resumeFile"
                               accept=".jpg,.jpeg,.png,.doc,.docx,.pdf">
                    </div>
                    <div class="resume-method">
                        <h4>متن رزومه</h4>
                        <textarea name="resume_text" id="resumeText" rows="4"
                                  placeholder="متن رزومه خود را وارد کنید...">{{ old('resume_text') }}</textarea>
                    </div>
                </div>
                <h4 style="color:#6DCCF0; margin:20px 0 10px;">🎯 موقعیت‌های شغلی مورد نظر (چند گزینه مجاز)</h4>
                <div class="job-check-list" id="jobCheckList">
                    @foreach($jobOpportunities as $jobOpportunity)
                        <div class="job-check-item">
                            @if($jobOpportunity->capacity > $jobOpportunity->full)
                                <label>
                                    <span class="custom-circle-check">
                                        <input name="job_opportunities[]" type="checkbox" class="job-circle-checkbox"
                                               value="{{ $jobOpportunity->id }}">
                                        <span class="circle-mark"></span>
                                    </span>
                                    <span
                                        style="display: flex; justify-content: space-between; align-items: center; width: 100%; cursor: pointer;">
                                        <span>{{ $jobOpportunity->title }}</span>
                                        <span
                                            style="color:#27ECAB; font-size: 0.85rem;"> ({{ $jobOpportunity->remaining_capacity }} ظرفیت)</span>
                                    </span>
                                </label>
                            @else
                                <div class="custom-circle-check" style="opacity:0.5; cursor:not-allowed;">
                                    <input type="checkbox" disabled>
                                    <span class="circle-mark"
                                          style="background-color:#64748B; border-color:#475569;"></span>
                                </div>
                                <label
                                    style="cursor:default; display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                    <span
                                        style="font-size: 1.05rem; font-weight: 600;">{{ $jobOpportunity->title }}</span>
                                    <span class="job-full-badge"
                                          style="font-size: 1rem; font-weight: 600; background: transparent; padding: 0;"><i
                                            class="fas fa-ban"></i> ظرفیت تکمیل شد</span>
                                </label>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button id="submitResumeBtn">تکمیل ثبت نام و ارسال درخواست</button>
            </div>
        </form>
            <div id="resumeError" class="error-simple" style="display: none;"></div>
<div class="resume-options">
    ...
</div>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    let fileInput = document.getElementById('resumeFile');
    let textArea = document.getElementById('resumeText');
    let hasFile = fileInput.files.length > 0;
    let hasText = textArea.value.trim() !== '';
    let errorDiv = document.getElementById('resumeError');
    
    if(!hasFile && !hasText) {
        errorDiv.style.display = 'block';
        errorDiv.innerHTML = 'حداقل یکی از روش‌های ارسال رزومه را پر کنید';
        e.preventDefault();
        
        // بعد ۳ ثانیه محو بشه
        setTimeout(function() {
            errorDiv.style.display = 'none';
        }, 3000);
    } else {
        errorDiv.style.display = 'none';
    }
});
</script>
</body>

</html>
