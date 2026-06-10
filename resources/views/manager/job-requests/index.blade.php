<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>درخواست‌های جدید | داشبورد متقاضیان</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1F2943;
            font-family: system-ui, 'Segoe UI', 'Tahoma', 'Roboto', 'Vazirmatn', sans-serif;
            line-height: 1.5;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .dashboard-container {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
        }

        .header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            border-bottom: none;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #27ECAB;
            letter-spacing: -0.3px;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            background: none;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .left-controls {
            display: flex;
            align-items: center;
            gap: 6rem;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
        }

        .search-input {
            background-color: #FFFFFF;
            border: 1px solid rgba(39, 236, 171, 0.4);
            border-radius: 60px;
            padding: 0.7rem 1.5rem;
            font-family: inherit;
            font-size: 0.95rem;
            color: #f0f3fa;
            width: 520px;
            backdrop-filter: blur(2px);
            transition: all 0.2s ease;
            outline: none;
            direction: rtl;
        }

        .search-input::placeholder {
            color: #707070;
            font-weight: 400;
            opacity: 0.8;
            letter-spacing: -0.2px;
        }

        .search-input:focus {
            border-color: #27ECAB;
            background-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0 0 0 2px rgba(39, 236, 171, 0.25);
        }

        .arrow-only {
            color: #6DCCF0;
            font-size: 2.2rem;
            line-height: 1;
            cursor: pointer;
            transition: transform 0.2s ease;
            text-align: end;
            display: flex;
            align-items: center;
        }

        .arrow-only:hover {
            transform: translateX(-4px);
        }

        .requests-table {
            width: 100%;
            border-collapse: collapse;
            background-color: transparent;
        }

        .requests-table th {
            font-size: 1.05rem;
            font-weight: 700;
            padding: 1rem 1.2rem;
            color: #6DCCF0;
            border: none;
            background-color: #1F2943;
        }

        .requests-table th {
            border-bottom: 2px solid #27ECAB;
        }

        .requests-table td {
            background-color: #1F2943;
            padding: 1rem 1rem;
            border: none;
            color: #f0f3fa;
            font-weight: 500;
        }

        .requests-table td:first-child {
            text-align: right;
        }

        /*.requests-table td:nth-child(2) {*/
        /*    text-align: center;*/
        /*}*/

        .requests-table td:nth-child(2) .job-text {
            display: block;
            direction: rtl;
            text-align: right;
        }

        .requests-table td:last-child {
            text-align: center;
            vertical-align: middle;
        }

        .requests-table th:first-child {
            text-align: right;
        }

        /*.requests-table th:nth-child(2) {*/
        /*    text-align: center;*/
        /*}*/

        /*.requests-table th:last-child {*/
        /*    text-align: center;*/
        /*}*/

        .requests-table tbody tr {
            border: none;
        }

        .requests-table tbody tr:hover td {
            background-color: #2a345a;
            transition: background-color 0.2s ease;
        }

        .detail-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #27ECAB;
            color: #221A44;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.55rem 1.2rem;
            border-radius: 40px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform 0.1s ease, background-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.3px;
            font-family: inherit;
            white-space: nowrap;
        }

        .detail-btn:hover {
            transform: scale(0.97);
            background-color: #1ad48a;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .no-result {
            text-align: center;
            padding: 2rem;
            background-color: #1F2943;
            color: #b9c8ff;
            font-size: 1rem;
            border-radius: 20px;
            width: 100%;
        }

        @media (max-width: 700px) {
            body {
                padding: 1.2rem;
            }

            .header-area {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
                margin-bottom: 1.8rem;
            }

            .page-title {
                font-size: 1.65rem;
            }

            .left-controls {
                justify-content: space-between;
                width: 100%;
            }

            .search-input {
                width: 100%;
                padding: 0.6rem 1.2rem;
            }

            .requests-table th,
            .requests-table td {
                padding: 0.8rem 0.6rem;
                font-size: 0.85rem;
            }

            .detail-btn {
                padding: 0.4rem 0.9rem;
                font-size: 0.7rem;
            }

            .arrow-only {
                font-size: 1.8rem;
            }

            .pagination-wrapper {
                gap: 0;
            }

            .pagination-square {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .pagination-dots {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }
        }

        .requests-table th,
        .requests-table td {
            outline: none;
        }

        .table-wrapper {
            background-color: transparent;
            border-radius: 0;
            overflow-x: auto;
        }

        .requests-table tbody td {
            border-top: none;
            border-bottom: none;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0;
            margin-top: 3rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }

        .pagination-square {
            background-color: #221A44;
            color: #27ECAB;
            border: 1.5px solid #27ECAB;
            border-right: none;
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            font-family: inherit;
            box-shadow: none;
        }

        .pagination-square:first-child {
            border-right: 1.5px solid #27ECAB;
        }

        .pagination-square:hover:not(.active-page):not(.disabled-nav) {
            background-color: #2c234f;
            color: #4fffc7;
            border-color: #4fffc7;
            position: relative;
            z-index: 1;
        }

        .pagination-square.active-page {
            background-color: #27ECAB;
            color: #221A44;
            border-color: #27ECAB;
            font-weight: 800;
            cursor: default;
            transform: none;
            z-index: 2;
        }

        .pagination-square.disabled-nav {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
            pointer-events: none;
        }

        .pagination-dots {
            background-color: #221A44;
            color: #27ECAB;
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            border-top: 1.5px solid #27ECAB;
            border-bottom: 1.5px solid #27ECAB;
            border-right: none;
            border-left: none;
            letter-spacing: 2px;
        }

        @media (max-width: 600px) {
            .pagination-square {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .pagination-dots {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <div class="header-area">
        <h1 class="page-title">درخواست‌های {{ __("job-request.manager.status.$status->value") }}</h1>
        <div class="left-controls">
            <form action="" class="search-wrapper">
                <input name="search" value="{{ request('search') }}" type="text" id="searchJobInput"
                       class="search-input" placeholder="جست و جو ..... "
                       aria-label="جستجوی فرصت شغلی یا نام">
            </form>
            <a href="{{ route('manager.index') }}" class="arrow-only" id="backArrowBtn">
                ⬅
            </a>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="requests-table" id="requestsTable">
            <thead>
            <tr>
                <th>نام و نام خانوادگی</th>
                <th>فرصت شغلی</th>
                <th>وضعیت</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            @foreach($jobRequests as $jobRequest)

                <tr>
                    <td>{{ $jobRequest->user->fullname }}</td>
                    <td><span class="job-text">{{ $jobRequest->job_opportunity->title }}</span></td>
                    <td><a href="{{ route('manager.job-requests.show',['job_request' => $jobRequest->id]) }}"
                           class="detail-btn">مشاهده درخواست ها</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $jobRequests->links() }}
</div>

</body>
</html>
