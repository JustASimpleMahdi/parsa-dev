@php use App\JobRequestStatusEnum; @endphp
@extends('layout.manager.index')
@push('styles')
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
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #221A44;
        }

        ::-webkit-scrollbar-thumb {
            background: #27ECAB;
            border-radius: 10px;
        }

        .top-navbar {
            background: #221A44;
            border-bottom: 1px solid #221A44;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 12px 0;
        }

        .nav-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.7rem;
            font-weight: 800;
            font-family: 'JetBrains Mono', monospace;
            color: #6DCCF0;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 1.4rem;
            color: #FBBF24;
            transition: 0.2s;
        }

        .notification-icon:hover {
            color: #F59E0B;
        }

        .avatar-circle {
            width: 42px;
            height: 42px;
            background-color: #6DCCF0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .avatar-circle:hover {
            transform: scale(1.05);
            background-color: #5bb8da;
        }

        .dashboard-layout {
            display: flex;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }

        .sidebar {
            width: 250px;
            background: #221A44;
            border-left: 1px solid #221A44;
            padding: 30px 0;
            position: fixed;
            top: 68px;
            right: 0;
            height: calc(100vh - 70px);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            z-index: 900;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 0 20px;
            flex: 1;
        }

        .menu-item {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 18px;
            cursor: pointer;
            transition: all 0.25s ease;
            color: #FFFFFF;
            font-weight: 500;
            text-align: right;
            background: transparent;
            border: none;
            width: 100%;
        }

        .menu-item i {
            display: none;
        }

        .menu-item:hover {
            background: rgba(45, 212, 191, 0.15);
            color: #27ECAB;
            transform: translateX(-5px);
        }

        .menu-item.active {
            background: linear-gradient(135deg, rgba(45, 212, 191, 0.2), rgba(56, 189, 248, 0.15));
            color: #27ECAB;
            border: 1px solid rgba(45, 212, 191, 0.4);
        }

        .logout-section-bottom {
            margin-top: auto;
            padding: 20px 20px 30px 20px;
            background: transparent;
            border-top: none;
        }

        .logout-text {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            padding: 14px 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #FF5A5A;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            background: transparent;
            border-radius: 18px;
            text-align: right;
        }

        .logout-text i {
            display: none;
        }

        .logout-text:hover {
            background: rgba(255, 80, 80, 0.12);
            transform: translateX(-5px);
            color: #ff7b7b;
        }

        .main-content {
            flex: 1;
            margin-right: 250px;
            padding: 32px 40px;
            overflow-y: auto;
        }

        .content-section {
            display: block;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #64748b;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #6DCCF0;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .section-header h2 i {
            display: none;
        }

        .requests-title {
            color: #6DCCF0 !important;
        }

        .sub-request-label {
            font-size: 0.85rem;
            color: #FFFFFF;
            background: transparent;
            padding: 6px 8px;
            font-weight: 400;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        @media (max-width: 640px) {
            .sub-request-label {
                font-size: 0.7rem;
                padding: 4px 0;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .card {
            background: #221A44;
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #1E293B;
        }

        .card-header-with-search {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #27ECAB;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            margin-bottom: 20px;
        }

        .jobs-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .job-position-card {
            background-color: #1F2943;
            border: 1px solid #707070;
            border-radius: 24px;
            padding: 10px 8px;
            transition: all 0.2s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 140px;
        }

        .job-position-card:hover {
            transform: translateY(-2px);
            border-color: #27ECAB;
        }

        .delete-icon {
            position: absolute;
            top: 8px;
            left: 8px;
            width: 24px;
            height: 24px;
            background-color: #FF0707;
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 5;
        }

        .delete-icon:hover {
            transform: scale(1.05);
            background-color: #e00606;
        }

        .delete-icon .white-rect {
            width: 14px;
            height: 2px;
            background-color: #FFFFFF;
            border-radius: 2px;
            display: block;
        }

        .edit-job-btn {
            background-color: #221A44;
            border: 1px solid #707070;
            color: #27ECAB;
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            width: auto;
            min-width: 70px;
            text-align: center;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .edit-job-btn:hover {
            background-color: #2a1f52;
            border-color: #27ECAB;
            transform: scale(0.98);
        }

        .position-card {
            font-size: 0.85rem;
            font-weight: 800;
            color: white;
            margin-bottom: 4px;
            text-align: center;
            width: 100%;
            letter-spacing: -0.2px;
        }

        .description-salary {
            font-size: 0.68rem;
            color: #27ECAB;
            margin: 3px 0;
            text-align: center;
            width: 100%;
            line-height: 1.3;
        }

        .numbers {
            font-size: 0.65rem;
            color: #6DCCF0;
            margin-top: 4px;
            text-align: center;
            width: 100%;
            font-weight: 500;
        }

        .add-job-card {
            background-color: #1F2943;
            border: 1px solid #707070;
            border-radius: 24px;
            padding: 10px 8px;
            transition: all 0.2s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            min-height: 140px;
        }

        .add-job-card:hover {
            background-color: #252f4e;
            border-color: #27ECAB;
            transform: translateY(-2px);
        }

        .plus-icon {
            font-size: 40px;
            color: #27ECAB;
            transition: all 0.2s ease;
        }

        .add-job-card:hover .plus-icon {
            transform: scale(1.05);
            color: #6DCCF0;
        }

        @media (max-width: 880px) {
            .jobs-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
        }

        @media (max-width: 580px) {
            .jobs-grid-container {
                grid-template-columns: 1fr;
            }
        }

        .pie-chart-card {
            background: linear-gradient(135deg, #1a1138, #221A44);
        }

        .pie-chart-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
            margin-top: 10px;
        }

        .pie-svg-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pie-svg {
            width: 200px;
            height: 200px;
            filter: drop-shadow(0 8px 20px rgba(0, 0, 0, 0.4));
            transition: transform 0.3s ease;
        }

        .pie-svg:hover {
            transform: scale(1.03);
        }

        .right-stats-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            min-width: 200px;
        }

        .stat-box {
            background-color: #113E4F;
            border-radius: 20px;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            transition: all 0.2s ease;
            border: 1px solid rgba(39, 236, 171, 0.2);
        }

        .stat-box:hover {
            transform: translateX(-5px);
            border-color: #27ECAB;
            background-color: #0e3646;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: #27ECAB;
            letter-spacing: 0.3px;
        }

        .show-requests-btn {
            background-color: #27ECAB;
            color: #221A44;
            border: none;
            border-radius: 40px;
            padding: 6px 18px;
            font-size: 0.75rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            white-space: nowrap;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .show-requests-btn:hover {
            background-color: #1dbf8a;
            transform: scale(0.97);
            color: #1a1138;
        }

        .pie-legend {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: rgba(34, 26, 68, 0.7);
            padding: 16px 20px;
            border-radius: 24px;
            backdrop-filter: blur(4px);
            min-width: 170px;
        }

        .pie-legend-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #E2E8F0;
        }

        .pie-legend-color {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .pie-legend-text {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            min-width: 140px;
        }

        .pie-legend-text span:first-child {
            font-weight: 700;
            color: #27ECAB;
            font-size: 0.8rem;
        }

        .pie-legend-text span:last-child {
            color: white;
            font-family: monospace;
            font-size: 0.8rem;
        }

        .termination-table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            margin-top: 8px;
        }

        .termination-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #113E4F;
            border-radius: 20px;
            overflow: hidden;
            font-family: inherit;
            border: 1px solid #27ECAB;
        }

        .termination-table th,
        .termination-table td {
            border: 1px solid #27ECAB;
            padding: 14px 16px;
            text-align: center;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .termination-table td {
            color: #27ECAB;
            background-color: #113E4F;
        }

        .termination-table th {
            color: #6DCCF0;
            background-color: #113E4F;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
        }

        .termination-table td:first-child,
        .termination-table th:first-child {
            text-align: center;
            font-weight: 600;
        }

        .terminate-btn {
            background-color: #1F2943;
            border: 1px solid #707070;
            color: #D85656;
            padding: 8px 20px;
            border-radius: 36px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.3px;
        }

        .terminate-btn:hover {
            background-color: #2a3557;
            border-color: #a0a0a0;
            transform: scale(0.98);
        }

        .termination-table tbody tr:hover td {
            background-color: rgba(39, 236, 171, 0.08);
            transition: 0.15s;
        }

        .employee-section-split {
            display: flex;
            gap: 24px;
            margin-top: 16px;
            flex-direction: row;
        }

        .employee-half {
            flex: 1;
            min-width: 0;
        }

        .vertical-divider {
            width: 2px;
            background-color: #27ECAB;
            border-radius: 2px;
            align-self: stretch;
        }

        .employee-subtitle {
            font-size: 1rem;
            font-weight: 700;
            color: #6DCCF0;
            margin-bottom: 16px;
            text-align: center;
        }

        /* اسکرول برای هر دو جدول درخواست‌ها */
        .employee-table-container-scroll {
            max-height: 382px;
            overflow-y: auto;
            border: 1px solid #27ECAB;
            background-color: #113E4F;
            border-radius: 12px;
        }

        .employee-table-container-no-radius {
            max-height: 382px;
            overflow-y: auto;
            border: 1px solid #27ECAB;
            background-color: #113E4F;
            border-radius: 12px;
        }

        .employee-table {
            width: 100%;
            border-collapse: collapse;
            font-family: inherit;
            background-color: #113E4F;
        }

        .employee-table th,
        .employee-table td {
            border: 1px solid #27ECAB;
            padding: 12px 16px;
            text-align: center;
            vertical-align: middle;
            font-size: 0.85rem;
        }

        .employee-table th {
            color: #6DCCF0;
            background-color: #113E4F;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .employee-table td {
            color: #FFFFFF;
            background-color: #113E4F;
        }

        .employee-table tbody tr:hover td {
            background-color: rgba(39, 236, 171, 0.1);
            transition: 0.15s;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .delete-request-btn {
            background-color: #221A44;
            border: 1px solid #D85656;
            color: #D85656;
            border-radius: 30px;
            padding: 6px 14px;
            font-size: 0.7rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .delete-request-btn:hover {
            background-color: #2a1f52;
            transform: scale(0.96);
        }

        .view-request-btn {
            background-color: #27ECAB;
            border: 1px solid #27ECAB;
            color: #221A44;
            border-radius: 30px;
            padding: 6px 14px;
            font-size: 0.7rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .view-request-btn:hover {
            background-color: #1dbf8a;
            transform: scale(0.96);
        }

        @media (max-width: 768px) {
            .employee-section-split {
                flex-direction: column;
            }

            .vertical-divider {
                width: 100%;
                height: 2px;
                margin: 16px 0;
            }

            .employee-table-container-scroll {
                max-height: 300px;
            }

            .employee-table-container-no-radius {
                max-height: 300px;
            }

            .employee-table th,
            .employee-table td {
                padding: 8px 10px;
                font-size: 0.75rem;
            }

            .action-buttons {
                gap: 4px;
            }

            .delete-request-btn, .view-request-btn {
                padding: 4px 10px;
                font-size: 0.65rem;
            }
        }
    </style>
@endpush
@section('main')
    <div id="requestsSection" class="content-section">
        <div class="section-header">
            <h2 class="requests-title">📄 درخواست‌های من</h2>
            <div class="sub-request-label">مدیریت درخواست ها</div>
        </div>

        <div class="card">
            <div class="card-header-with-search">
                <div class="card-title">درخواست های شغلی</div>
            </div>

            <div class="pie-chart-wrapper">
                <div class="right-stats-group">
                    <a href="{{ route('manager.job-requests.index',['status'=>JobRequestStatusEnum::PENDING]) }}"
                       class="stat-box">
                        <span class="stat-label">درخواست های جدید</span>
                        <button class="show-requests-btn">نمایش درخواست ها</button>
                    </a>
                    <a href="{{ route('manager.job-requests.index',['status'=>JobRequestStatusEnum::ACCEPTED]) }}"
                       class="stat-box">
                        <span class="stat-label">درخواست های تایید شده</span>
                        <button class="show-requests-btn">نمایش درخواست ها</button>
                    </a>
                    <a href="{{ route('manager.job-requests.index',['status' => JobRequestStatusEnum::REJECTED]) }}"
                       class="stat-box">
                        <span class="stat-label">درخواست های رد شده</span>
                        <button class="show-requests-btn">نمایش درخواست ها</button>
                    </a>
                </div>

                <div class="pie-legend">
                    <div class="pie-legend-item">
                        <div class="pie-legend-color" style="background: #27ECAB;"></div>
                        <div class="pie-legend-text">
                            <span>درخواست های تایید شده</span>
                        </div>
                    </div>
                    <div class="pie-legend-item">
                        <div class="pie-legend-color" style="background: #F26F6F;"></div>
                        <div class="pie-legend-text">
                            <span>درخواست های رد شده</span>
                        </div>
                    </div>
                    <div class="pie-legend-item">
                        <div class="pie-legend-color" style="background: white;"></div>
                        <div class="pie-legend-text">
                            <span>درخواست های جدید</span>
                        </div>
                    </div>
                </div>
                <div class="pie-svg-container">
                    <!-- دایره کامل با رنگ سفید (پس زمینه کامل) + بخش‌های سبز و قرمز روی آن -->
                    <svg class="pie-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        @php
                            $startAngle = 0;
                            $centerX = 50;
                            $centerY = 50;
                            $radius = 42;
                            $total = $jobRequestsCount['all'];
                            $colors = [
                                JobRequestStatusEnum::PENDING->value => '#FFFFFF',
                                JobRequestStatusEnum::ACCEPTED->value => '#27ECAB',
                                JobRequestStatusEnum::REJECTED->value => '#F26F6F'
                            ];
                        @endphp

                        @foreach($jobRequestsCount->except('all') as $status => $count)
                            @php
                                $percentage = ($count / $total) * 100;
                                $angle = ($percentage / 100) * 360;
                                $endAngle = $startAngle + $angle;

                                // Calculate SVG path for pie slice
                                $startRad = deg2rad($startAngle - 90);
                                $endRad = deg2rad($endAngle - 90);

                                $x1 = $centerX + $radius * cos($startRad);
                                $y1 = $centerY + $radius * sin($startRad);
                                $x2 = $centerX + $radius * cos($endRad);
                                $y2 = $centerY + $radius * sin($endRad);

                                $largeArc = $angle > 180 ? 1 : 0;

                                $color = $colors[$status] ?? '#CCCCCC';

                                $startAngle = $endAngle;
                            @endphp

                            <path
                                d="M {{ $centerX }},{{ $centerY }} L {{ $x1 }},{{ $y1 }} A {{ $radius }},{{ $radius }} 0 {{ $largeArc }},1 {{ $x2 }},{{ $y2 }} Z"
                                fill="{{ $color }}"
                                stroke="#1F2943"
                                stroke-width="1.5"/>
                        @endforeach
                    </svg>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-title">درخواست کارمندان</div>

            <div class="employee-section-split">
                <div class="employee-half">
                    <div class="employee-subtitle">درخواست های جدید</div>
                    <div class="employee-table-container-scroll">
                        <table class="employee-table">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>نوع درخواست</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendingRequests as $request)
                            <tr>
                                <td>{{ $request->employee->personal_info->fullname }}</td>
                                <td>{{ $request->type->title }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('manager.requests.show',['request'=>$request]) }}"
                                       class="view-request-btn">مشاهده درخواست</a>
                                    <button class="delete-request-btn">حذف</button>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="vertical-divider"></div>
                <div class="employee-half">
                    <div class="employee-subtitle">همه درخواست ها</div>
                    <div class="employee-table-container-no-radius">
                        <table class="employee-table">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>نوع درخواست</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($otherRequests as $request)
                                <tr>
                                    <td>{{ $request->employee->personal_info->fullname }}</td>
                                    <td>{{ $request->type->title }}</td>
                                    <td class="action-buttons">

                                        <a href="{{ route('manager.requests.show',['request'=>$request]) }}"
                                           class="view-request-btn">مشاهده درخواست</a>
                                        <button class="delete-request-btn" form="delete-request-{{ $request->id }}">
                                            حذف
                                        </button>
                                        <form
                                            action="{{ route('manager.requests.destroy',['request' => $request]) }}"
                                            method="post"
                                            id="delete-request-{{ $request->id }}"
                                        >
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-title">فرصت های شغلی</div>

            <div class="jobs-grid-container">
                @foreach($jobOpportunities as $jobOpportunity)
                    <div class="job-position-card">


                        <a href="{{ route('manager.job-opportunity.delete',['job_opportunity' => $jobOpportunity]) }}"
                           class="delete-icon">
                            <span class="white-rect"></span>
                        </a>
                        <div class="position-card">{{ $jobOpportunity->title }}</div>
                        <div class="description-salary">{{ $jobOpportunity->description }}</div>
                        <div class="numbers">ظرفیت باقی مانده : {{ $jobOpportunity->remaining_capacity }}
                            از {{ $jobOpportunity->capacity }}</div>
                        <a href="{{ route('manager.job-opportunities.edit',['job_opportunity'=>$jobOpportunity]) }}"
                           class="edit-job-btn">ویرایش</a>
                    </div>
                @endforeach

                <a href="{{ route('manager.job-opportunities.create') }}" class="add-job-card" id="addNewJobBtn">
                    <div class="plus-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-title">برکناری کارمندان</div>
            <div class="termination-table-wrapper">
                <table class="termination-table">
                    <thead>
                    <tr>
                        <th>نام و نام خانوادگی</th>
                        <th>عنوان شغلی</th>
                        <th>شماره تلفن</th>
                        <th>درخواست برکناری</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>مهدی ارکی</td>
                        <td>React Native Developer</td>
                        <td>01234567898</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>المیرا حق نظری</td>
                        <td>فرانت اند جونیور</td>
                        <td>01478523690</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>کوروش خالقی</td>
                        <td>بک اند دولوپر</td>
                        <td>09876543210</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>زهرا برزگران</td>
                        <td>متخصص امنیت</td>
                        <td>07894561230</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>یاسمن جاجرمی</td>
                        <td>بک اند دولوپر</td>
                        <td>03214569874</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
