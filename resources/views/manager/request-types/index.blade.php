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

        .menu-item:hover {
            background: rgba(45, 212, 191, 0.15);
            color: #27ECAB;
            transform: translateX(-5px);
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
        a{
            text-decoration: none;
        }

        .logout-text:hover {
            background: rgba(255, 80, 80, 0.12);
            transform: translateX(-5px);
            color: #ff7b7b;
        }

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

        .edit-requests-menu-btn:hover {
            background: rgba(45, 212, 191, 0.15);
            color: #27ECAB;
            transform: translateX(-5px);
        }

        .menu-item.active, .edit-requests-menu-btn.active {
            background: linear-gradient(135deg, rgba(45, 212, 191, 0.2), rgba(56, 189, 248, 0.15));
            color: #27ECAB;
            border: 1px solid rgba(45, 212, 191, 0.4);
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

            .edit-requests-menu-btn span {
                font-size: 0.7rem;
                white-space: nowrap;
            }

            .edit-requests-menu-btn {
                justify-content: center;
                padding: 12px 6px;
            }
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
            font-size: 1.8rem;
            font-weight: 700;
            color: #27ECAB;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-align: center;
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

        .submit-request-btn {
            background-color: #221A44;
            color: #27ECAB;
            border: 1px solid #27ECAB;
            border-radius: 20px;
            padding: 4px 28px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: inherit;
            width: auto;
            min-width: 100px;
            justify-content: center;
            height: 36px;
        }

        .submit-request-btn:hover {
            background-color: #27ECAB;
            color: #1E293B;
            transform: scale(1.02);
        }

        .new-request-btn {
            background-color: #27ECAB;
            color: #1F2943;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 0;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: end;
            gap: 8px;
            font-family: inherit;
            width: auto;
            min-width: 120px;
            justify-content: center;
        }

        .new-request-btn:hover {
            background-color: #1fcf93;
            transform: scale(1.02);
        }

        .card-footer {
            display: flex;
            justify-content: center;
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

        .cards-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .cards-row .card {
            min-width: 250px;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        @media (max-width: 900px) {
            .cards-row {
                flex-direction: column;
            }

            .cards-row .card {
                width: 100%;
            }
        }

        .delete-icon-card {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 28px;
            height: 28px;
            background-color: #FF0707;
            border-radius: 50%;
            border: 2px solid #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }

        .delete-icon-card:hover {
            transform: scale(1.08);
            background-color: #e00606;
        }

        .white-rect {
            width: 14px;
            height: 2px;
            background-color: #FFFFFF;
            border-radius: 2px;
            display: block;
        }

        .new-request-card .card-title {
            text-align: right;
            justify-content: flex-start;
        }

        .new-request-card .card-footer {
            justify-content: flex-start;
        }
    </style>
@endpush

@section('main')
    <div id="requestsSection" class="content-section">
        <div class="section-header">
            <h2 class="requests-title">✏️ نوع درخواست‌ها</h2>
            <div class="sub-request-label">درخواست ها</div>
        </div>

        <div class="cards-row">
            @foreach($requestTypes as $type)
                <div class="card">
                    @if(!$type->readonly)
                        <a href="{{ route('manager.request-type.delete',['request_type' => $type]) }}"
                           class="delete-icon-card"><span class="white-rect"></span></a>
                    @endif
                    <div class="card-title">{{ $type->title }}</div>
                    <div class="card-footer">
                        <a href="{{ route('manager.request-types.show',['request_type' => $type]) }}"
                           class="submit-request-btn">ویرایش</a>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('manager.request-types.store') }}" method="post" class="card new-request-card">
            @csrf
            <div class="card-title">درخواست جدید</div>
            <input name="title" value="{{ old('title') }}" type="text" class="request-input"
                   placeholder=". عنوان درخواست جدید خود را بنویسید">
            <textarea name="description" class="request-input request-textarea"
                      placeholder=". توضیحات خود را وارد کنید">{{ old('description') }}</textarea>
            <div class="card-footer">
                <button class="new-request-btn">ثبت</button>
            </div>
        </form>
    </div>
@endsection
