<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>پنل مدیریت | شرکت برنامه نویسی پارسا</title>
    <!-- Font Awesome 6 (only essential icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ========== RESET & BASE ========== */
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

        /* scrollbar - minimal but needed */
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

        /* ========== TOP NAVBAR ========== */
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

        /* ========== DASHBOARD LAYOUT ========== */
        .dashboard-layout {
            display: flex;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
        }

        /* ========== SIDEBAR (RIGHT) ========== */
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

        /* menu item style (icons hidden as original design) */
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

        /* logout section */
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

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            margin-right: 250px;
            padding: 32px 40px;
            overflow-y: auto;
        }

        .content-section {
            display: block;
        }

        /* section header */
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

        /* cards */
        .card {
            background: #221A44;
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #1E293B;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #27ECAB;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* edit-requests button inside sidebar (original style preserved) */
        .edit-requests-menu-btn {
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
            font-size: 1rem;
            margin-top: 8px;
        }

        .edit-requests-menu-btn i {
            display: none;
        }

        .edit-requests-menu-btn:hover {
            background: rgba(45, 212, 191, 0.15);
            color: #27ECAB;
            transform: translateX(-5px);
        }

        /* responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 90px;
            }

            .main-content {
                margin-right: 90px;
                padding: 20px;
            }

            .sidebar-menu .menu-item span {
                display: inline-block;
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .sidebar-menu .menu-item {
                justify-content: center;
                gap: 0;
                padding: 14px 6px;
                text-align: center;
            }

            .logout-text span {
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .logout-text {
                justify-content: center;
                padding: 10px 6px;
            }

            .edit-requests-menu-btn span {
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .edit-requests-menu-btn {
                justify-content: center;
                padding: 12px 6px;
            }
        }

        /* ensure hidden icons in all relevant elements (no unused CSS that creates clutter) */
        .menu-item i,
        .logout-text i,
        .edit-requests-menu-btn i,
        .section-header h2 i {
            display: none;
        }

        /* ----- UPDATED 3-COLUMN 2-ROW+ GRID LAYOUT FOR JOB POSITIONS (SMALLER CARDS) ----- */
        .jobs-grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        /* each job card - SMALLER SIZE: reduced padding, smaller dimensions */
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

        /* delete icon style: red circle with white border and white rectangle inside - slightly smaller */
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

        /* white rectangle (no-entry / prohibited sign style) */
        .delete-icon .white-rect {
            width: 14px;
            height: 2px;
            background-color: #FFFFFF;
            border-radius: 2px;
            display: block;
        }

        /* edit button styles - smaller and compact */
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

        /* smaller card text elements */
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

        /* ADD CARD STYLES - کارت جدید با آیکون بعلاوه (smaller version) */
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

        .add-card-text {
            margin-top: 6px;
            color: #27ECAB;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* responsive for smaller screens: if needed it becomes 2 columns or 1 column */
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

        /* تضمین برای وسط چین شدن همه محتویات درونی کارت‌ها بدون استثنا */
        .job-position-card div,
        .job-position-card .position-card,
        .job-position-card .description-salary,
        .job-position-card .numbers {
            text-align: center;
            justify-content: center;
        }

        /* adjust layout spacing for smaller cards overall card container */
        .card {
            padding: 20px;
        }

        /* ensure delete icon is not overlapping text on very small cards */
        @media (max-width: 480px) {
            .delete-icon {
                width: 20px;
                height: 20px;
                top: 5px;
                left: 5px;
            }

            .delete-icon .white-rect {
                width: 10px;
                height: 2px;
            }

            .position-card {
                font-size: 0.75rem;
            }

            .description-salary {
                font-size: 0.6rem;
            }

            .edit-job-btn {
                padding: 4px 10px;
                font-size: 0.6rem;
                min-width: 60px;
            }

            .plus-icon {
                font-size: 32px;
            }

            .add-job-card,
            .job-position-card {
                padding: 8px 6px;
                min-height: 125px;
            }
        }

        /* ========== TABLE STYLES - COMPLETE REWORK ==========
           تمام تغییرات خواسته شده:
           1- مرزهای سطر و ستون با border: 1px solid #27ECAB (خط جداکننده)
           2- رنگ فونت همه سلول‌ها #27ECAB
           3- رنگ فونت هدرها (th) #6DCCF0
           4- بک‌گراند کل جدول (چه هدر و چه بدنه) #113E4F
           5- بدون جاوااسکریپت و بدون تغییر دیگر بخش‌ها
           ** اضافه شد: اصلاح کامل حاشیه دور جدول (border-collapse جداگانه و اطمینان از border گوشه‌ها)
           ** اصلاح: ستون اول (نام و نام خانوادگی) نیز در مرکز قرار گرفت (text-align: center)
        */

        .termination-table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            margin-top: 8px;
        }

        .termination-table {
            width: 100%;
            border-collapse: separate;
            /* تغییر از collapse به separate برای اطمینان از نمایش تمام حاشیه‌ها و رنگ گوشه‌ها */
            border-spacing: 0;
            background-color: #113E4F;
            /* کل پس‌زمینه جدول #113E4F */
            border-radius: 20px;
            overflow: hidden;
            font-family: inherit;
            border: 1px solid #27ECAB;
            /* اضافه شد: border بیرونی جدول با رنگ #27ECAB تا گوشه‌ها کاملاً رنگ بگیرند */
        }

        /* border برای تمام سلول‌ها: 1px solid #27ECAB */
        .termination-table th,
        .termination-table td {
            border: 1px solid #27ECAB;
            /* خطوط سطر و ستون با رنگ #27ECAB */
            padding: 14px 16px;
            text-align: center;
            /* همه سلول‌ها به طور پیش‌فرض وسط چین — شامل ستون نام و نام خانوادگی نیز */
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* رنگ فونت تمام سلول‌های بدنه (td) برابر #27ECAB */
        .termination-table td {
            color: #27ECAB;
            background-color: #113E4F;
            /* حفظ بک‌گراند یکسان #113E4F */
        }

        /* رنگ فونت هدرها (th) برابر #6DCCF0 ، پس‌زمینه هم #113E4F */
        .termination-table th {
            color: #6DCCF0;
            background-color: #113E4F;
            /* بک‌گراند هدر نیز #113E4F */
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 0.95rem;
        }

        /* حذف استثنای راست‌چینی برای ستون اول: طبق درخواست جدید "ستون نام و نام خانوادگی رو بیار وسط"
           دیگر نیازی به right-align نیست، تمام سلول‌ها و هدرها با text-align: center یکپارچه وسط‌چین می‌شوند */
        .termination-table td:first-child,
        .termination-table th:first-child {
            text-align: center;
            /* وسط چین برای نام و نام خانوادگی (ستون اول) */
            font-weight: 600;
        }

        /* دکمه برکناری با استایل دقیق مطابق خواسته:
           background #1F2943, border #707070, font color #D85656 (بدون تغییر نسبت به خواسته اصلی)
           این دکمه فقط استایل بصری دارد و تابع درخواست شما برای تغییرات جدول تداخل ندارد.
        */
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

        /* hover effect برای سطرها - فقط تغییر پس‌زمینه با کمی شفافیت سفید، اما بک‌گراند اصلی #113E4F */
        .termination-table tbody tr:hover td {
            background-color: rgba(39, 236, 171, 0.08);
            transition: 0.15s;
        }

        /* هدرها هم در صورت hover تغییر نکنند اما قشنگتر می‌شود ثابت بماند */
        .termination-table thead tr:hover th {
            background-color: #113E4F;
        }

        /* responsive table tweaks */
        @media (max-width: 768px) {

            .termination-table th,
            .termination-table td {
                padding: 10px 8px;
                font-size: 0.75rem;
            }

            .terminate-btn {
                padding: 6px 12px;
                font-size: 0.7rem;
            }
        }

        /* حاشیه و فضای خالی برای جدول در کارت */
        .card .card-title + .termination-table-wrapper {
            margin-top: 8px;
        }

        /* اطمینان از اینکه border-radius جدول به درستی کار کند و گوشه‌ها رنگ #27ECAB را نمایش دهند
           با border-collapse: separate و border بیرونی روی .termination-table مشکل گوشه‌ها برطرف شد */
        .termination-table {
            border-radius: 20px;
        }

        /* note: بدون جاوااسکریپت */
        .note-no-js {
            display: none;
        }

        /* اطمینان از عدم هرگونه استایل متعارض دیگر - تمام خواسته‌های مربوط به جدول با دقت پیاده‌سازی شد */
    </style>
</head>

<body>

<div class="top-navbar">
    <div class="nav-container">
        <a href="{{ route('index') }}" class="logo">PARSA_DEV</a>
        <div class="nav-actions">
            <div class="notification-icon">
                <i class="fas fa-bell"></i>
            </div>
            <div class="avatar-circle">👤</div>
        </div>
    </div>
</div>

<div class="dashboard-layout">
    <aside class="sidebar">
        <div class="sidebar-menu">
            <div class="menu-item active">
                <span>📄 درخواست‌ها</span>
            </div>
            <div class="menu-item">
                <span>📢 اطلاعیه‌ها</span>
            </div>
            <div class="menu-item">
                <span>🪪 مشخصات</span>
            </div>
            <div class="edit-requests-menu-btn">
                <span>✏️ ویرایش درخواست‌ها</span>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="post" class="logout-section-bottom">
            @csrf
            @method('DELETE')
            <button class="logout-text">
                <span>🚪 خروج از حساب</span>
            </button>
        </form>
    </aside>

    <main class="main-content">
        @yield('main')
    </main>
</div>

</body>

</html>
