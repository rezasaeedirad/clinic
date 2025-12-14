<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ثبت‌نام پزشک — کلینیک آنلاین</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- فونت فارسی -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">

    <!-- CSS اختصاصی فقط این صفحه -->
    <link rel="stylesheet" href="{{ asset('css/doctor register.css') }}">
</head>
<body>

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


<main class="container" style="padding-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 col-lg-7">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <!-- نمایش خطاها -->
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

                    <h3 class="mb-3 text-center">ثبت‌نام پزشک</h3>

                    <form method="POST" action="{{ route('doctor.register') }}" novalidate>
                        @csrf

                        <!-- بقیه فرم دقیقا مثل کد خودت -->
                        <!-- نام و ایمیل -->
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label">نام کامل</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" required >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">ایمیل</label>
                                <input type="email" class="form-control" name="email" autocomplete="off" required>
                            </div>
                        </div>

                        <!-- جنسیت و موبایل -->
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label">جنسیت</label>
                                <select class="form-select" name="gender" required>
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    <option value="male">مرد</option>
                                    <option value="female">زن</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">تلفن همراه</label>
                                <input type="tel" class="form-control" name="phone" placeholder="09xxxxxxxxx" autocomplete="off" required>
                            </div>
                        </div>

                        <!-- تخصص و بیوگرافی -->
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label">تخصص</label>
                                <select class="form-select" name="specialty" required>
                                    <option value="" disabled selected>انتخاب کنید</option>
                                    <option value="children">کودکان</option>
                                    <option value="gastroenterology">گوارش</option>
                                    <option value="neurology">مغز و اعصاب</option>
                                    <option value="dentist">دندان‌پزشک</option>
                                    <option value="cosmetic_surgery">جراح زیبایی</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">بیوگرافی کوتاه</label>
                                <textarea class="form-control" name="bio" rows="2"></textarea>
                            </div>
                        </div>

                        <!-- آدرس -->
                        <div class="mb-3">
                            <label class="form-label">آدرس مطب</label>
                            <input type="text" class="form-control" name="clinic_address" autocomplete="off" required>
                        </div>

                        <!-- رمز و تکرار -->
    <div class="row g-3 mb-3">

    <!-- رمز عبور -->
    <div class="col-md-6">
        <label class="form-label">رمز عبور</label>
        <div class="input-group">
            <input type="password" class="form-control" name="password" required>
            <span class="input-group-text toggle-pass" data-target="password" style="cursor:pointer;">
                <i class="bi bi-eye-fill"></i>
            </span>
        </div>
    </div>

    <!-- تکرار رمز عبور -->
    <div class="col-md-6">
        <label class="form-label">تکرار رمز عبور</label>
        <div class="input-group">
            <input type="password" class="form-control" name="password_confirmation" required>
            <span class="input-group-text toggle-pass" data-target="password_confirmation" style="cursor:pointer;">
                <i class="bi bi-eye-fill"></i>
            </span>
        </div>
    </div>

</div>



                        <!-- دکمه -->
                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-primary btn-lg">ثبت‌نام</button>
                        </div>

                        <div class="text-center">
                            <small>حساب دارید؟ <a href="{{ url('/login') }}">ورود</a></small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="main-footer mt-5">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.toggle-pass').forEach(btn => {
    btn.addEventListener('click', function () {
        let inputName = this.getAttribute('data-target');
        let input = document.querySelector(`input[name="${inputName}"]`);

        if (!input) return;

        if (input.type === "password") {
            input.type = "text";
            this.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
        } else {
            input.type = "password";
            this.innerHTML = '<i class="bi bi-eye-fill"></i>';
        }
    });
});
</script>




</body>
</html>
