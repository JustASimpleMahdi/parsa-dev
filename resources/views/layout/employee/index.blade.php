<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>پنل مدیریت | شرکت برنامه نویسی پارسا</title>
    <!-- Font Awesome 6 (only essential icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')
</head>

<body>

<div class="top-navbar">
    <div class="nav-container">
        <a href="{{ route('index') }}" class="logo">PARSA_DEV</a>
        <div class="nav-actions">
            @include('layout.employee.announcement-icon')
            <div class="avatar-circle">👤</div>
        </div>
    </div>
</div>

<div class="dashboard-layout">
    <aside class="sidebar">
        <div class="sidebar-menu">
            <a href="{{ route('employee.index') }}" @class(['menu-item','active'=> request()->routeIs('employee.index')])>
                <span>📄 درخواست‌ها</span>
            </a>
            <a href="{{ route('employee.announcements.index') }}" @class(['menu-item','active'=> request()->routeIs('employee.announcements.*')])>
                <span>📢 اطلاعیه‌ها</span>
            </a>
            <a href="{{ route('employee.profile.index') }}" @class(['menu-item','active'=> request()->routeIs('employee.profile.*')])>
                <span>🪪 مشخصات</span>
            </a>
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
