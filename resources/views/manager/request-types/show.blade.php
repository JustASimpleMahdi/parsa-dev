<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>کارت ویرایش درخواست</title>
    @vite(['resources/css/Vazirmatn-Variable-font-face.css'])
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #221A44;
            border: 1px solid #334155;
            max-width: 550px;
            width: 100%;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            overflow: hidden;
            padding: 32px 28px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        /* بخش سمت راست هدر - شامل نوع درخواست و فلش */
        .header-left-area {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .header-label {
            font-weight: 400;
            color: #27ECAB;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .header-value {
            color: #6DCCF0;
            font-size: 1.3rem;
            font-weight: 500;
            background: transparent;
            border: none;
            font-family: inherit;
            width: auto;
            display: inline-block;
        }

        .header-edit-wrapper {
            display: flex;
            align-items: baseline;
            gap: 8px;
            flex-wrap: wrap;
        }

        .back-icon {
            font-size: 3rem;
            cursor: pointer;
            color: #6DCCF0;
            flex-shrink: 0;
            margin-top: -50px;
        }

        /* خط توضیحات - حالت جدید بدون فاصله اضافی */
        .desc-line {
            display: flex;
            align-items: baseline;
            margin-bottom: 32px;
            gap: 8px; /* فاصله کم بین برچسب و مقدار */
            flex-wrap: wrap;
        }

        .desc-label {
            font-weight: 400;
            color: #27ECAB;
            font-size: 1.3rem;
            flex-shrink: 0;
            white-space: nowrap; /* جلوگیری از شکستن برچسب */
        }

        .desc-value {
            color: #6DCCF0;
            font-size: 1.1rem;
            font-weight: 500;

            word-break: break-word;
            display: inline-block;
            flex: 1;
        }

        /* استایل ورودی‌ها */
        .info-input {
            background-color: #221A44;
            border: 1px solid #64748b;
            border-radius: 20px;
            padding: 8px;
            color: #ffffff;
            font-size: 1.1rem;
            font-family: inherit;
            transition: all 0.2s ease;
            width: 100%;
        }

        .request-input {
            width: auto;
            min-width: 400px;
        }

        .info-input:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 2px rgba(39, 236, 171, 0.2);
        }

        textarea.info-input {
            width: 100%;
            resize: vertical;
            font-size: 1rem;
            margin-top: 0;
        }

        /* دکمه‌ها */
        .btn-wrapper {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 16px;
        }

        .edit-btn, .save-btn, .cancel-btn {
            border: none;
            border-radius: 28px;
            padding: 10px 32px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .edit-btn {
            background-color: #6DCCF0;
            color: #221A44;
        }

        .edit-btn:hover {
            background-color: #5bb8da;
            transform: scale(1.02);
        }

        .save-btn {
            background-color: #27ECAB;
            color: #221A44;
            border: 1px solid #221A44;
        }

        .save-btn:hover {
            background-color: #1fcf93;
            transform: scale(1.02);
        }

        .cancel-btn {
            background-color: #221A44;
            color: #D85656;
            border: 1px solid #D85656;
        }

        .cancel-btn:hover {
            background-color: rgba(216, 86, 86, 0.15);
            transform: scale(1.02);
        }

        .hidden {
            display: none !important;
        }

        /* استایل ردیف ویرایش */

        .edit-row-label {
            font-weight: 400;
            color: #27ECAB;
            font-size: 1.3rem;
            display: block;
        }

        .edit-row-input {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <!-- بخش سمت راست: نوع درخواست + فلش در کنار هم -->
        <div class="header-left-area">
            <div id="requestTypeContainer" style="flex:1;">
                <!-- حالت نمایش عادی -->
                <div id="requestTypeDisplay" class="header-edit-wrapper">
                    <span class="header-label">نوع درخواست :</span>
                    <span class="header-value" id="requestTypeValue">{{ $requestType->title }}</span>
                </div>

            </div>
            <a href="{{ route('manager.request-types.index') }}" class="back-icon">⬅</a>
        </div>
    </div>

    <!-- خط توضیحات - برچسب و متن بدون فاصله اضافی -->
    <div id="descContainer">
        <!-- حالت نمایش عادی - اکنون برچسب و مقدار در کنار هم با فاصله‌ی کم قرار دارند -->
        <div id="descDisplay" class="desc-line">
            <span class="desc-label">توضیحات :</span>
            <span class="desc-value" id="descText">{{ $requestType->description }}</span>
        </div>
    </div>

    <div class="btn-wrapper" id="btnWrapper">
        <a href="{{ route('manager.request-types.edit',['request_type'=>$requestType]) }}" class="edit-btn"
           id="editBtn">ویرایش</a>
    </div>
</div>

</body>
</html>
