<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>شرکت برنامه نویسی پارسا | استخدام و فرصت‌های شغلی حرفه‌ای</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<div class="navbar">
    <div class="container nav-flex">
        <div class="logo">PARSA_DEV</div>
        <div class="nav-links">
            <a href="{{ route('index') }}">خانه</a>
            <a href="#jobs-section">فرصت‌های شغلی</a>
            <a href="#about-company">درباره ما</a>
            <div class="auth-buttons" id="authButtonsContainer">
                @auth
                    @php($user = auth()->user())
                    @if($user->role === \App\RoleEnum::MANAGER)
                        <a href="{{ route('manager.index') }}" class="btn-register">مدیریت</a>
                    @elseif($user->isEmployee())
                        <a href="{{ route('employee.index') }}" class="btn-register">داشبورد</a>
                    @else
                        @if($user->register_status !== \App\RegisterStatusEnum::COMPLETE)
                            <a href="{{ route('register.resume') }}" class="btn-register">ادامه ثبت نام</a>
                        @else
                            <a href="{{ route('job-requested') }}" class="btn-register">وضعیت درخواست</a>
                        @endif
                    @endif
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn-logout" id="logoutBtn">🚪 {{ $user->personal_info->fullname }} | خروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login">ورود</a>
                    <a href="{{ route('register') }}" class="btn-register">ثبت نام</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<main>
    <div class="container" id="home">
        <div class="hero">
            <div class="hero-content">
                <h1 id="animatedHeading">
                    <span class="word">ساخت</span>
                    <span class="word">فردای</span>
                    <span class="word">دیجیتال</span>
                    <span class="word">با</span>
                    <span class="word">ما</span>
                </h1>
                <p>ما به دنبال استعدادهای واقعی هستیم. اگر عاشق کدنویسی، حل مسئله و ساخت محصولات تأثیرگذارید، جای شما در
                    تیم پارسا خالیست.</p>
                <div class="code-tagline">
                    <span>React · Node · Python</span>
                    <span>Cloud Native</span>
                    <span>Security First</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container" id="jobs-section">
        <div class="section-title">
            <i class="fas fa-briefcase"></i>
            <span>فرصت‌های شغلی</span>
        </div>
        <div class="jobs-grid" id="jobsContainer">
            @foreach($jobOpportunities as $jobOpportunity)

                <div class="job-card">
                    <div class="job-header"><span class="job-title">{{ $jobOpportunity->title }}</span></div>
                    <div class="job-salary">{{ $jobOpportunity->description }}</div>
                    <div class="capacity-row"><span class="capacity-text">ظرفیت باقی‌مانده: {{ $jobOpportunity->remaining_capacity }} از {{$jobOpportunity->capacity}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container" id="about-company" style="margin-bottom: 50px; scroll-margin-top: 90px;">
        <div class="section-title">
            <i class="fas fa-building"></i>
            <span>درباره شرکت برنامه‌نویسی پارسا</span>
        </div>
        <div style="background: #221A44; border-radius: 32px; padding: 32px; border: 1px solid #1E293B;">
            <p style="font-size: 1.1rem; margin-bottom: 24px;">شرکت پارسا از سال ۱۳۹۸ فعالیت خود را آغاز کرده است. تیم
                ما متشکل از متخصصان بک‌اند، فرانت‌اند، دواپس و هوش مصنوعی است و پروژه‌های بزرگ را پوشش می‌دهیم.</p>
            <div style="display: flex; flex-direction: column; gap: 14px;">
                <p style="font-size: 1rem; color: #ffffff; margin: 0;"><i class="fas fa-check-circle"
                                                                          style="color: #27ECAB; margin-left: 10px;"></i>
                    محیط پویا و یادگیری مستمر</p>
                <p style="font-size: 1rem; color: #ffffff; margin: 0;"><i class="fas fa-check-circle"
                                                                          style="color: #27ECAB; margin-left: 10px;"></i>
                    حقوق رقابتی</p>
                <p style="font-size: 1rem; color: #ffffff; margin: 0;"><i class="fas fa-check-circle"
                                                                          style="color: #27ECAB; margin-left: 10px;"></i>
                    تجهیزات حرفه‌ای</p>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <p>شرکت برنامه نویسی پارسا — <span style="color:#FFFFFF;"> &lt;/&gt; با عشق به کد و نوآوری </span></p>
        <p style="margin-top: 12px; font-size: 0.8rem;"><i class="fas fa-microchip"></i> تیم حرفه‌ای پارسا | فرصت‌های
            شغلی بدون مرز</p>
    </div>
</footer>

<div id="toastMessage" class="toast-msg"></div>

<script>
    const jobListings = [{
        id: 1,
        title: "فرانت اند جونیور",
        salary: "حقوق ماهیانه: ۳۵ تا ۴۷ میلیون تومان",
        capacity: 3,
        hired: 1
    },
        {
            id: 2,
            title: "بک اند دولوپر",
            salary: "حقوق ماهیانه: ۵۵ تا ۷۸ میلیون تومان",
            capacity: 2,
            hired: 1
        },
        {
            id: 3,
            title: "React Native Developer",
            salary: "حقوق ماهیانه: ۶۵ تا ۹۲ میلیون تومان",
            capacity: 4,
            hired: 2
        },
        {
            id: 4,
            title: "کارآموز DevOps",
            salary: "حقوق ماهیانه: ۲۲ تا ۳۰ میلیون تومان",
            capacity: 5,
            hired: 3
        },
        {
            id: 5,
            title: "طراح UI/UX",
            salary: "حقوق ماهیانه: ۵۰ تا ۷۰ میلیون تومان",
            capacity: 2,
            hired: 0
        },
        {
            id: 6,
            title: "متخصص امنیت",
            salary: "حقوق ماهیانه: ۸۵ تا ۱۲۰ میلیون تومان",
            capacity: 3,
            hired: 3
        }
    ];


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

    function renderJobs() {
        const container = document.getElementById("jobsContainer");
        if (!container) return;
        container.innerHTML = "";
        jobListings.forEach(job => {
            const remaining = job.capacity - job.hired;
            const card = document.createElement("div");
            card.className = "job-card";
            card.innerHTML = ``;
            container.appendChild(card);
        });
    }

    const words = document.querySelectorAll('.word');
    words.forEach((word, index) => {
        word.style.animationDelay = `${index * 0.12}s`;
    });

    @auth
    setTimeout(() => showToast(`سلام کاربر عزیز! 👨‍💻 فرصت‌های شغلی را بررسی کن.`), 800);
    @endauth
</script>
</body>

</html>
