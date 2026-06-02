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
        <div class="logo">PARSA_DEV</div>
        <div class="nav-actions">
            <div class="notification-icon">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
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
