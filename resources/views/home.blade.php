{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کلینیک آنلاین | صفحه اصلی</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    <!-- Font فارسی -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">

    <!-- CSS اختصاصی -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<!-- هدر -->
<header class="main-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="{{ url('/home') }}">کلینیک آنلاین</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">ورود</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('role') }}">ثبت‌نام</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- HERO -->
<section class="hero container text-center">
    <h1 class="title">نوبت‌دهی آنلاین کلینیک</h1>
    <p class="subtitle">پزشک خود را انتخاب کنید، زمان‌های خالی را ببینید و نوبت رزرو کنید.</p>

    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-3">رزرو نوبت</a>
</section>

<!-- مراحل -->
<section class="container steps-section mt-5">
    <h3 class="section-title mb-4">چطور نوبت رزرو کنم؟</h3>

    <div class="row text-center">
        <div class="col-md-4 mb-3">
            <div class="step-card shadow">
                <h5>۱. ثبت‌نام یا ورود</h5>
                <p>ورود به حساب کاربری یا ساخت حساب جدید.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="step-card shadow">
                <h5>۲. انتخاب پزشک</h5>
                <p>مشاهده پروفایل و زمان‌های آزاد پزشکان.</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="step-card shadow">
                <h5>۳. رزرو نوبت</h5>
                <p>رزرو ساده، سریع و بدون نیاز به تماس تلفنی.</p>
            </div>
        </div>
    </div>
</section>

<!-- فوتر -->
<footer class="main-footer mt-5 text-center">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
