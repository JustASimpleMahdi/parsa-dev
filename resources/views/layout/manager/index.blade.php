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
            <a href="{{ route('manager.announcements.index') }}" class="notification-icon">
                <i class="fas fa-bell"></i>
            </a>
            <div class="avatar-circle">👤</div>
        </div>
    </div>
</div>

<div class="dashboard-layout">
    <aside class="sidebar">
        <div class="sidebar-menu">
            <a href="{{ route('manager.index') }}"
                @class(['menu-item', 'active' => request()->routeIs('manager.index')])>
                <span>📄 درخواست‌ها</span>
            </a>

            <a href="{{ route('manager.announcements.index') }}"
                @class(['menu-item', 'active' => request()->routeIs('manager.announcements.*')])>
                <span>📢 اطلاعیه‌ها</span>
            </a>

            <div @class(['menu-item', 'active' => request()->routeIs('manager.profile')])>
                <span>🪪 مشخصات</span>
            </div>

            <div @class(['edit-requests-menu-btn', 'active' => request()->routeIs('manager.edit-requests')])>
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

@stack('scripts')
</body>

</html>
