<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود — کلینیک آنلاین</title>

    <!-- جلوگیری از Cache و ذخیره فرم توسط مرورگر -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- CSS اختصاصی فقط برای این صفحه -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body>

<header class="main-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="{{ url('/home') }}">کلینیک آنلاین</a>
    </nav>
</header>

<div class="login-container fade-in">
    <div class="form-box">
        <h2 class="mb-4">ورود</h2>

        <!-- نمایش خطا -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm" autocomplete="off">
            @csrf
            <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}" required autocomplete="off">

            <div class="password-wrapper" style="position: relative; display: flex; align-items: center;">
                <input type="password" name="password" placeholder="رمز عبور" required style="padding-right: 40px; flex: 1;" autocomplete="new-password">
                <span id="togglePass" style="position: absolute; right: 10px; cursor: pointer; user-select: none; font-size: 18px;">👁</span>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">ورود</button>
        </form>

        <div class="signup-links mt-3 text-center">
            <p>حساب ندارید؟</p>
            <a href="{{ url('/role') }}">ثبت‌نام</a>
        </div>
    </div>
</div>

<footer class="main-footer">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<script>
    // نمایش/مخفی کردن رمز عبور بدون تغییر سایز باکس
    const togglePass = document.getElementById('togglePass');
    const passwordInput = document.querySelector('input[name="password"]');

    togglePass.addEventListener('click', function() {
        if(passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>

</body>
</html>
