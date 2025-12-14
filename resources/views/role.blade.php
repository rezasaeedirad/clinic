<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>انتخاب نقش | کلینیک آنلاین</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    <!-- فونت فارسی -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">

    <!-- CSS اختصاصی فقط برای این صفحه -->
    <link rel="stylesheet" href="{{ asset('css/role.css') }}">
</head>
<body>

<!-- هدر مشترک -->
<header class="main-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="{{ url('/home') }}">کلینیک آنلاین</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">ورود</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/role') }}">ثبت‌نام</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- انتخاب نقش -->
<section class="container role-select text-center mt-5">
    <h2 class="fw-bold mb-4">لطفاً نقش خود را انتخاب کنید</h2>

    <div class="row justify-content-center">

        <!-- کارت بیمار --> 
        <div class="col-md-4 mb-3">
            <div class="role-card shadow"
                 onclick="window.location.href='{{ route('patient.register') }}'">
                <img src="https://cdn-icons-png.flaticon.com/512/3209/3209265.png" class="role-icon">
                <h4 class="mt-3">بیمار</h4>
                <p>ثبت‌نام یا ورود برای دریافت نوبت و مشاهده پزشکان</p>
            </div>
        </div>

        <!-- کارت پزشک -->
        <div class="col-md-4 mb-3">
            <div class="role-card shadow"
                 onclick="window.location.href='{{ route('doctor.register') }}'">
                <img src="https://cdn-icons-png.flaticon.com/512/387/387561.png" class="role-icon">
                <h4 class="mt-3">پزشک</h4>
                <p>ثبت‌نام یا ورود برای مدیریت نوبت‌ها و پروفایل</p>
            </div>
        </div>

    </div>
</section>

<!-- فوتر -->
<footer class="main-footer mt-5">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
