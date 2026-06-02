@php use App\JobRequestStatusEnum; @endphp
    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>مشخصات کاربر</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #221A44;
            color: #E2E8F0;
            line-height: 1.6;
            padding: 40px;
            min-height: 100vh;
        }

        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .back-icon {
            font-size: 2.8rem;
            cursor: pointer;
            color: #6DCCF0;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .back-icon:hover {
            transform: scale(1.1);
            color: #27ECAB;
        }

        .main-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #6DCCF0;
            margin: 0;
            text-align: right;
            flex-grow: 1;
        }

        @media (max-width: 550px) {
            .header-row {
                gap: 12px;
            }

            .back-icon {
                font-size: 2.2rem;
            }

            .main-title {
                font-size: 1.4rem;
            }
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 28px 24px;
            margin-bottom: 30px;
        }

        .grid-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .grid-label {
            color: #6DCCF0;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            opacity: 0.9;
        }

        .grid-value {
            color: #27ECAB;
            font-weight: 500;
            font-size: 1rem;
            word-break: break-word;
            line-height: 1.4;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #6DCCF0;
            margin: 15px 0;
            text-align: center;
        }

        .download-btn {
            background-color: #221A44;
            border: 2px solid #27ECAB;
            color: #27ECAB;
            padding: 10px 30px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            font-family: inherit;
            display: block;
            margin: 20px auto 0 auto;
            transition: all 0.2s ease;
        }

        .download-btn:hover {
            background-color: rgba(39, 236, 171, 0.1);
            transform: scale(1.02);
        }

        hr {
            background-color: #27ECAB;
            height: 2px;
            border: none;
            margin: 20px 0;
        }

        .resume-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #6DCCF0;
            margin: 20px 0 15px 0;
            text-align: right;
        }

        .links-list {
            list-style: none;
            padding: 0;
        }

        .links-list li {
            margin: 12px 0;
            direction: ltr;
            text-align: right;
        }

        .links-list a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: 0.2s;
        }

        .links-list a:hover {
            color: #6DCCF0;
            text-decoration: underline;
        }

        .resume-container {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 30px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .accept-btn {
            background-color: #27ECAB;
            color: #707070;
            border: 2px solid #707070;
            padding: 12px 40px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 30px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
            min-width: 160px;
        }

        .accept-btn:hover {
            transform: scale(1.02);
            opacity: 0.9;
        }

        .reject-btn {
            background-color: #707070;
            color: #27ECAB;
            border: 2px solid #27ECAB;
            padding: 12px 40px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 30px;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
            min-width: 140px;
        }

        .reject-btn:hover {
            transform: scale(1.02);
            opacity: 0.9;
        }

        @media (max-width: 1100px) {
            .profile-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 800px) {
            .profile-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 500px) {
            .profile-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            body {
                padding: 20px;
            }

            .buttons-container {
                gap: 15px;
            }

            .accept-btn, .reject-btn {
                padding: 8px 25px;
                font-size: 1rem;
                min-width: 120px;
            }
        }

        .images {
            display: flex;
            flex-direction: column;
            /*gap: 10px;*/
            align-items: center;
        }

        .perosnal-image {
            width: 300px;
        }

        .accepted-message {
            display: block;
            text-align: center;
            max-width: 350px;
            padding: 10px;
            margin-inline: auto;
            margin-bottom: 20px;
            background-color: limegreen;
            color: white;
            border-radius: 20px;
        }

        .rejected-message {
            display: block;
            text-align: center;
            max-width: 350px;
            padding: 10px;
            margin-inline: auto;
            margin-bottom: 20px;
            background-color: orangered;
            color: white;
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="header-row">
    <div class="main-title">درخواست جدید</div>
    <a href="{{ route('manager.index') }}" class="back-icon">⬅</a>
</div>
@if($jobRequest->status === JobRequestStatusEnum::ACCEPTED)
    <div class="accepted-message">
        درخواست تایید شد.
    </div>
@elseif($jobRequest->status === JobRequestStatusEnum::REJECTED)
    <div class="rejected-message">
        درخواست رد شد.
    </div>
@endif
<div class="profile-grid">
    <div class="grid-item">
        <div class="grid-label">نام و نام خانوادگی</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->fullname }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">شماره تلفن</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->phone }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">کد ملی</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->national_code }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">شماره شناسنامه</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->id_number }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">نام پدر</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->father_name }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">تاریخ تولد</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->birthdate }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">محل تولد</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->birthplace }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">آدرس محل سکونت</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->address }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">کد پستی</div>
        <div class="grid-value">{{ $jobRequest->user->personal_info->postal_code }}</div>
    </div>
    <div class="grid-item">
        <div class="grid-label">نقش شما</div>
        <div class="grid-value">{{ $jobRequest->job_opportunity->title }}</div>
    </div>
</div>

<div class="images">
    <div class="section-title">عکس پرسنلی</div>
    <img class="perosnal-image" src="{{ $jobRequest->user->personal_info->personal_image->url }}" alt="">
    <div class="section-title">آخرین مدرک تحصیلی</div>
    <a href="{{ route('get-file.personal-info.last-degree',['file' => $jobRequest->user->personal_info->last_degree]) }}"
       class="download-btn">دانلود</a>
</div>
<hr>

<div class="resume-title">رزومه ها</div>
<div class="resume-container">
    <ul class="links-list">
        @foreach($jobRequest->user->resume->files as $file)
            <li><a href="{{ route('get-file.resume.file',['file'=>$file]) }}">{{ $file->filename }}</a></li>
        @endforeach
    </ul>
    <div class="resume-text">{{ $jobRequest->user->resume->text }}</div>
</div>
@if($jobRequest->status === JobRequestStatusEnum::PENDING)
    <form action="{{ route('manager.job-requests.accept',['job_request' => $jobRequest]) }}" method="post"
          id="acceptForm">
        @csrf
    </form>
    <form action="{{ route('manager.job-requests.reject',['job_request' => $jobRequest]) }}" method="post"
          id="rejectForm">
        @csrf
    </form>

    <div class="buttons-container">
        <button class="accept-btn" form="acceptForm">پذیرش</button>
        <button class="reject-btn" form="rejectForm">عدم پذیرش</button>
    </div>
@endif
</body>
</html>
