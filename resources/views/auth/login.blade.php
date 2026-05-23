<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>ورود | شرکت برنامه نویسی پارسا</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        }

        .login-modal-container {
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

        .login-card {
            background: #1E293B;
            border: 1px solid #334155;
            max-width: 500px;
            width: 100%;
            border-radius: 36px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(45, 212, 191, 0.2);
            animation: fadeUp 0.3s ease;
            overflow: hidden;
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

        .login-header {
            padding: 24px 28px 0 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1E293B;
            border-radius: 36px 36px 0 0;
        }

        .login-header h3 {
            font-size: 1.7rem;
            font-weight: 700;
            color: #38BDF8;
            margin: 0;
        }

        .close-login {
            font-size: 28px;
            cursor: pointer;
            color: #ef4444;
            transition: 0.2s;
        }

        .close-login:hover {
            color: #ff6666;
        }

        .form-container {
            padding: 28px;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .password-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            width: 100%;
        }

        .auth-form input[type="text"],
        .auth-form input[type="password"] {
            padding: 12px 16px;
            border: 1px solid #334155;
            border-radius: 20px;
            font-size: 0.95rem;
            font-family: 'Vazirmatn', monospace;
            background: #113E4F;
            color: #F1F5F9;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .auth-form input:focus {
            outline: none;
            border-color: #27ECAB;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.2);
        }

        .auth-form input::placeholder {
            color: #94A3B8;
        }

        /* لینک فراموشی رمز عبور - در سمت راست (چون راست‌چین هستیم، right یعنی سمت راست) */
        .forgot-link {
            text-align: right;
            width: 100%;
        }

        .forgot-link a {
            color: #38BDF8;
            font-size: 0.75rem;
            text-decoration: underline;
            cursor: pointer;
            background: none;
            border: none;
            display: inline-block;
        }

        .forgot-link a:hover {
            color: #27ECAB;
        }

        .auth-form button {
            background: #27ECAB;
            border: none;
            padding: 14px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1rem;
            color: #0B1120;
            cursor: pointer;
            transition: 0.2s;
            font-family: 'Vazirmatn', monospace;
            margin-top: 8px;
        }

        .auth-form button:hover {
            background: #1bc49a;
            transform: scale(0.98);
            box-shadow: 0 5px 12px rgba(45, 212, 191, 0.3);
        }

        .toast-msg {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: #1E293B;
            border-left: 5px solid #27ECAB;
            color: #E2E8F0;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 500;
            z-index: 1100;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            display: none;
            font-family: monospace;
        }
    </style>
</head>

<body>

<div class="login-modal-container">
    <div class="login-card">
        <div class="login-header">
            <h3>ورود به حساب</h3>
            <a href="{{ route('index') }}" class="close-login">&times;</a>
        </div>
        <form action="{{ route('login-submit') }}" method="post" class="form-container">
            @csrf
            <div class="auth-form">
                <input name="username" value="{{ old('username') }}" type="text" id="loginUsername"
                       placeholder="نام کاربری">

                <div class="password-field">
                    <div class="password-wrapper">
                        <input name="password" type="password" id="loginPassword" placeholder="رمز عبور">
                    </div>

                    <!-- لینک فراموشی رمز عبور دقیقاً در سمت راست -->
                    <div class="forgot-link">
                        <a id="forgotPasswordLink">فراموشی رمز عبور</a>
                    </div>
                </div>

                <button id="doLoginBtn">ورود به داشبورد</button>
            </div>
        </form>
    </div>
</div>

<div id="toastMessage" class="toast-msg"></div>

<script>
    function showToast(msg, isError = false) {
        const toast = document.getElementById("toastMessage");
        toast.style.display = "block";
        toast.innerText = msg;
        toast.style.backgroundColor = isError ? "#7F1D1D" : "#064E3B";
        toast.style.borderLeftColor = isError ? "#F43F5E" : "#27ECAB";
        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }

    @if($errors->hasAny(['username','password']))
    showToast("نام کاربری و رمز عبور را وارد کنید", true)
    @endif

    @error('login')
    showToast("نام کاربری یا رمز عبور اشتباه است", true)
    @enderror
</script>
</body>

</html>
