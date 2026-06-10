@extends('layout.manager.index')
@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a{
            text-decoration: none;
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

        .notification-badge {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 20px;
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
        }

        .logout-text {
            all:unset;
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
            box-sizing: border-box;
            background: transparent;
            border-radius: 18px;
            text-align: right;
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
            border: 1px solid #515151;
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
        }

        .request-input {
            width: 100%;
            background-color: #221A44;
            border: 1px solid #64748b;
            border-radius: 20px;
            padding: 12px 16px;
            color: #E2E8F0;
            font-size: 0.9rem;
            font-family: inherit;
            resize: vertical;
            transition: all 0.2s ease;
            margin-bottom: 16px;
        }

        .request-input:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 2px rgba(39, 236, 171, 0.2);
        }

        .request-textarea {
            min-height: 80px;
        }

        .description-placeholder {
            display: none;
        }

        .submit-request-btn {
            background-color: #27ECAB;
            color: #1F2943;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
        }

        .submit-request-btn:hover {
            background-color: #1fcf93;
            transform: scale(1.02);
        }

        .card-footer {
            display: flex;
            justify-content: flex-start;
        }

        .requests-list-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 8px;
        }

        .request-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 16px 0px 0px 0px;
            border-radius: 20px;
            transition: all 0.2s ease;
        }

        .request-text {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.55;
            color: #E2E8F0;
            font-weight: 500;
        }

        .request-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .edit-btn {
            background-color: #6DCCF0;
            color: #221A44;
            border: 1px solid #6DCCF0;
            border-radius: 28px;
            padding: 8px 22px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            white-space: nowrap;
        }

        .edit-btn:hover {
            background-color: #5bb8da;
            color: #221A44;
            transform: scale(1.02);
            border-color: #5bb8da;
        }

        .edit-btn i {
            font-size: 0.9rem;
        }

        .delete-btn {
            background-color: #221A44;
            color: #D85656;
            border: 1px solid #D85656;
            border-radius: 28px;
            padding: 8px 22px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            white-space: nowrap;
        }

        .delete-btn:hover {
            background-color: rgba(216, 86, 86, 0.15);
            color: #ff7a7a;
            border-color: #ff7a7a;
            transform: scale(1.02);
        }

        .delete-btn i {
            font-size: 0.9rem;
        }

        @media (max-width: 640px) {
            .request-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .request-actions {
                align-self: flex-start;
            }

            .edit-btn, .delete-btn {
                padding: 6px 18px;
            }

            .requests-list-container {
                gap: 16px;
            }
        }

        .old-h33 {
            display: none;
        }

        .profile-card {
            background: #221A44;
            border: 1px solid #1E293B;
            border-radius: 24px;
            padding: 28px 32px;
            margin-bottom: 24px;
        }

        .profile-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #27ECAB;
            margin-bottom: 24px;
        }

        .profile-input {
            width: 100%;
            background-color: #221A44;
            border: 1px solid #707070;
            border-radius: 20px;
            padding: 12px 18px;
            color: #E2E8F0;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s ease;
            margin-bottom: 20px;
        }

        .profile-input:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 2px rgba(39, 236, 171, 0.2);
        }

        .profile-input::placeholder {
            color: #707070;
            font-weight: 400;
        }

        .profile-btn {
            background-color: #27ECAB;
            color: #1F2943;
            border: none;
            border-radius: 20px;
            padding: 10px 28px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            margin-top: 8px;
        }

        .profile-btn:hover {
            background-color: #1fcf93;
            transform: scale(1.02);
        }

        .info-card {
            background: #221A44;
            border: 1px solid #1E293B;
            border-radius: 24px;
            padding: 28px 32px;
            margin-bottom: 24px;
        }

        /* استایل جدید گرید بدون خطوط بوردر */
        .profile-grid {
            display: grid;

            grid-template-columns: repeat(4, 1fr);
            gap: 28px 24px;
            background: #221A44;
            border-radius: 24px;
            padding: 20px 20px 20px 0;
            margin-bottom: 12px;
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
        }

        .info-row {
            display: none;
        }
    </style>
@endpush

@section('main')
    <div id="profileSection" class="content-section">
        <div class="section-header">
            <h2 class="requests-title">🪪 مشخصات و تنظیمات</h2>
            <div class="sub-request-label">پروفایل شخصی</div>
        </div>

        <div class="profile-grid">
            <div class="grid-item">
                <div class="grid-label">نام و نام خانوادگی</div>
                <div class="grid-value">{{ $manager->personal_info->fullname }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">شماره تلفن</div>
                <div class="grid-value">{{ $manager->personal_info->phone }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">کد ملی</div>
                <div class="grid-value">{{ $manager->personal_info->national_code }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">شماره شناسنامه</div>
                <div class="grid-value">{{ $manager->personal_info->id_number }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">نام پدر</div>
                <div class="grid-value">{{ $manager->personal_info->father_name }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">تاریخ تولد</div>
                <div class="grid-value">{{ $manager->personal_info->birthdate }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">محل تولد</div>
                <div class="grid-value">{{ $manager->personal_info->birthplace }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">آدرس محل سکونت</div>
                <div class="grid-value">{{ $manager->personal_info->address }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">کد پستی</div>
                <div class="grid-value">{{ $manager->personal_info->postal_code }}</div>
            </div>
            <div class="grid-item">
                <div class="grid-label">نقش شما</div>
                <div class="grid-value">مدیر</div>
            </div>
        </div>

        <br>
        <br>
        <form action="{{ route('manager.profile.update') }}" method="post" class="profile-card">
            @csrf
            @method('PATCH')
            <div class="profile-title">تغییر نام کاربری</div>
            <input name="username" type="text" class="profile-input" placeholder="نام کاربری جدید"
                   value="{{ old('username',$manager->username) }}">
            @error('username')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <button class="profile-btn">تغییر نام کاربری</button>
        </form>

        <form action="{{ route('manager.profile.update') }}" method="post" class="profile-card">
            @csrf
            @method('PATCH')
            <div class="profile-title">تغییر رمز عبور</div>
            <input name="current_password" type="password" class="profile-input" placeholder="رمز عبور فعلی" value="">
            @error('current_password')
            <div class="error-message">{{ $message }}</div>
            @enderror
            <input name="password" type="password" class="profile-input" placeholder="رمز عبور جدید" value="">
            <input name="password_confirmation" type="password" class="profile-input" placeholder="تکرار رمز عبور جدید"
                   value="">
            <button class="profile-btn">تغییر رمز عبور</button>
        </form>
    </div>
@endsection
