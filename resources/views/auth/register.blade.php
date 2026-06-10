<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ثبت نام | شرکت برنامه نویسی پارسا</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* استایل مخصوص مودال مانند کد اول */
        .register-modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            padding: 20px;
        }

        .register-card {
            background: #1F2943;
            border: 1px solid #334155;
            max-width: 900px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            animation: fadeUp 0.3s ease;
        }

        .register-card::-webkit-scrollbar {
            width: 6px;
        }

        .register-card::-webkit-scrollbar-track {
            background: #0F172A;
            border-radius: 10px;
        }

        .register-card::-webkit-scrollbar-thumb {
            background: #27ECAB;
            border-radius: 10px;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            padding: 24px 28px 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: #1F2943;
            z-index: 10;
        }

        .register-header h3 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #38BDF8;
            margin: 0;
        }

        .close-register {
            font-size: 28px;
            cursor: pointer;
            color: #ef4444;
            transition: 0.2s;
        }

        .close-register:hover {
            color: #ff6666;
        }

        .form-container {
            padding: 28px;
        }

        body {
            background: #1F2943;
            margin: 0;
            padding: 0;
            font-family: 'Vazirmatn', 'Segoe UI', monospace;
        }
        .error-text {
    color: #ff6b6b;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}
input.error {
    border-color: #ff6b6b !important;
}
    </style>
</head>

<body>

<div class="register-modal-container">
    <div class="register-card">
        <div class="register-header">
            <h3><i class="fas fa-user-plus"></i> ثبت نام</h3>
            <a href="{{ route('index') }}" class="close-register">&times;</a>
        </div>
        <form action="{{ route('register-submit') }}" method="post" enctype="multipart/form-data" class="form-container">
    @csrf
    @php($user = auth()->user())
    <div class="auth-form">
        <div class="form-row">
            <div class="form-group"><label>نام :</label><input name="firstname" value="{{ old('firstname',$user?->personal_info->firstname) }}" type="text" id="regName" placeholder="نام"><div class="error-text" id="firstname-error"></div>@error('firstname')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>نام خانوادگی :</label><input name="lastname" value="{{ old('lastname',$user?->personal_info->lastname) }}" type="text" id="regFamily" placeholder="نام خانوادگی"><div class="error-text" id="lastname-error"></div>@error('lastname')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>نام پدر :</label><input name="father_name" value="{{ old('father_name',$user?->personal_info->father_name) }}" type="text" id="regFatherName" placeholder="نام پدر"><div class="error-text" id="fathername-error"></div>@error('father_name')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>تاریخ تولد :</label><input name="birthdate" value="{{ old('birthdate',$user?->personal_info->birthdate) }}" type="text" placeholder="1382/01/01" id="regBirthDate"><div class="error-text" id="birthdate-error"></div>@error('birthdate')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>شماره تلفن :</label><input name="phone" value="{{ old('phone',$user?->personal_info->phone) }}" type="tel" id="regPhone" placeholder="۰۹۱۲۳۴۵۶۷۸۹"><div class="error-text" id="phone-error"></div>@error('phone')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>شماره شناسنامه :</label><input name="id_number" value="{{ old('id_number',$user?->personal_info->id_number) }}" type="text" id="regIdNumber" placeholder="شماره شناسنامه"><div class="error-text" id="idnumber-error"></div>@error('id_number')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>کد ملی :</label><input name="national_code" value="{{ old('national_code',$user?->personal_info->national_code) }}" type="text" id="regNationalCode" placeholder="کد ملی ۱۰ رقمی"><div class="error-text" id="national-error"></div>@error('national_code')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>محل تولد :</label><input name="birthplace" value="{{ old('birthplace',$user?->personal_info->birthplace) }}" type="text" id="regBirthPlace" placeholder="شهر محل تولد"><div class="error-text" id="birthplace-error"></div>@error('birthplace')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-group"><label>آدرس محل سکونت :</label><input name="address" value="{{ old('address',$user?->personal_info->address) }}" type="text" id="regAddress" placeholder="آدرس کامل"><div class="error-text" id="address-error"></div>@error('address')<div class="error-text">{{ $message }}</div>@enderror</div>
        <div class="form-row">
            <div class="form-group"><label>کد پستی :</label><input name="postal_code" value="{{ old('postal_code',$user?->personal_info->postal_code) }}" type="text" id="regPostalCode" placeholder="کد پستی ۱۰ رقمی"><div class="error-text" id="postal-error"></div>@error('postal_code')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>نام کاربری :</label><input name="username" value="{{ old('username',$user?->username) }}" type="text" id="regUsername" placeholder="نام کاربری"><div class="error-text" id="username-error"></div>@error('username')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-row">
            <div class="form-group"><label>رمز عبور :</label><div class="password-wrapper"><input name="password" value="{{ old('password') }}" type="password" id="regPassword" placeholder="حداقل ۴ کاراکتر"></div><div class="error-text" id="password-error"></div>@error('password')<div class="error-text">{{ $message }}</div>@enderror</div>
            <div class="form-group"><label>تکرار رمز عبور :</label><div class="password-wrapper"><input name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" id="regPasswordConfirm" placeholder="تکرار رمز عبور"></div><div class="error-text" id="confirm-error"></div>@error('password_confirmation')<div class="error-text">{{ $message }}</div>@enderror</div>
        </div>
        <div class="form-group"><label>عکس پرسنلی (4*3) :</label><input name="personal_image" value="{{ old('personal_image') }}" type="file" id="regPhoto" accept="image/*"><div class="error-text" id="photo-error"></div>@error('personal_image')<div class="error-text">{{ $message }}</div>@enderror</div>
        <div class="form-group"><label>عکس آخرین مدرک تحصیلی :</label><input name="last_degree" value="{{ old('last_degree') }}" type="file" id="regDegree" accept="image/*,pdf"><div class="error-text" id="degree-error"></div>@error('last_degree')<div class="error-text">{{ $message }}</div>@enderror</div>
        <button id="doRegisterBtn">مرحله بعد: ثبت رزومه و انتخاب شغل</button>
    </div>
</form>
    </div>
</div>
<script>
// تابع اعتبارسنجی تلفن
function validatePhone() {
    let phone = document.getElementById('regPhone').value.trim();
    if(phone && !/^\d{11}$/.test(phone)) {
        document.getElementById('phone-error').innerHTML = 'شماره تلفن باید 11 رقم باشد';
        document.getElementById('regPhone').classList.add('error');
        return false;
    } else {
        document.getElementById('phone-error').innerHTML = '';
        document.getElementById('regPhone').classList.remove('error');
        return true;
    }
}

// تابع اعتبارسنجی کد ملی
function validateNationalCode() {
    let nationalCode = document.getElementById('regNationalCode').value.trim();
    if(nationalCode && !/^\d{10}$/.test(nationalCode)) {
        document.getElementById('national-error').innerHTML = 'کد ملی باید 10 رقم باشد';
        document.getElementById('regNationalCode').classList.add('error');
        return false;
    } else {
        document.getElementById('national-error').innerHTML = '';
        document.getElementById('regNationalCode').classList.remove('error');
        return true;
    }
}

// تابع اعتبارسنجی شماره شناسنامه
function validateIdNumber() {
    let idNumber = document.getElementById('regIdNumber').value.trim();
    if(idNumber && !/^\d+$/.test(idNumber)) {
        document.getElementById('idnumber-error').innerHTML = 'شماره شناسنامه فقط عدد باشد';
        document.getElementById('regIdNumber').classList.add('error');
        return false;
    } else {
        document.getElementById('idnumber-error').innerHTML = '';
        document.getElementById('regIdNumber').classList.remove('error');
        return true;
    }
}

// تابع اعتبارسنجی کد پستی
function validatePostalCode() {
    let postalCode = document.getElementById('regPostalCode').value.trim();
    if(postalCode && !/^\d{10}$/.test(postalCode)) {
        document.getElementById('postal-error').innerHTML = 'کد پستی باید 10 رقم باشد';
        document.getElementById('regPostalCode').classList.add('error');
        return false;
    } else {
        document.getElementById('postal-error').innerHTML = '';
        document.getElementById('regPostalCode').classList.remove('error');
        return true;
    }
}

// تابع اعتبارسنجی رمز عبور
function validatePassword() {
    let password = document.getElementById('regPassword').value;
    if(password.length > 0 && password.length < 4) {
        document.getElementById('password-error').innerHTML = 'رمز عبور حداقل 4 کاراکتر باشد';
        document.getElementById('regPassword').classList.add('error');
        return false;
    } else {
        document.getElementById('password-error').innerHTML = '';
        document.getElementById('regPassword').classList.remove('error');
        return true;
    }
}

// تابع تطابق رمز عبور
function validatePasswordMatch() {
    let password = document.getElementById('regPassword').value;
    let confirm = document.getElementById('regPasswordConfirm').value;
    if(confirm && password !== confirm) {
        document.getElementById('confirm-error').innerHTML = 'رمز عبور و تکرار آن مطابقت ندارد';
        document.getElementById('regPasswordConfirm').classList.add('error');
        return false;
    } else {
        document.getElementById('confirm-error').innerHTML = '';
        document.getElementById('regPasswordConfirm').classList.remove('error');
        return true;
    }
}

// اتصال رویدادهای لحظه‌ای
document.getElementById('regPhone').addEventListener('input', validatePhone);
document.getElementById('regNationalCode').addEventListener('input', validateNationalCode);
document.getElementById('regIdNumber').addEventListener('input', validateIdNumber);
document.getElementById('regPostalCode').addEventListener('input', validatePostalCode);
document.getElementById('regPassword').addEventListener('input', function() {
    validatePassword();
    validatePasswordMatch();
});
document.getElementById('regPasswordConfirm').addEventListener('input', validatePasswordMatch);

// اعتبارسنجی هنگام ثبت نهایی
document.querySelector('form').addEventListener('submit', function(e) {
    let isValid = true;
    
    isValid = validatePhone() && isValid;
    isValid = validateNationalCode() && isValid;
    isValid = validateIdNumber() && isValid;
    isValid = validatePostalCode() && isValid;
    isValid = validatePassword() && isValid;
    isValid = validatePasswordMatch() && isValid;
    
    if(!isValid) {
        e.preventDefault();
    }
});
</script>
</body>

</html>
