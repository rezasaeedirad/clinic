{{-- resources/views/patient/register.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ثبت‌نام بیمار</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Font -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">
    <!-- CSS اختصاصی -->
    <link rel="stylesheet" href="{{ asset('css/patient register.css') }}">
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('role') }}">ثبت‌نام</a></li>
            </ul>
        </div>
    </nav>
</header>

<section class="container form-section">
    <h2 class="mb-4 text-center fw-bold">ثبت‌نام بیمار</h2>

    {{-- نمایش خطاها --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- نمایش پیام موفقیت --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('patient.register') }}" class="row g-3 shadow form-box">
        @csrf

        <div class="col-md-6">
            <label class="form-label">نام</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autocomplete="off" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">نام خانوادگی</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" autocomplete="off" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">شماره تماس</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" autocomplete="off" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">جنسیت</label>
            <select class="form-select" name="gender" required>
                <option value="" disabled selected>انتخاب کنید</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>مرد</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>زن</option>
            </select>
        </div>

        {{-- افزودن فیلد تاریخ تولد --}}
        <div class="col-md-6">
            <label class="form-label">تاریخ تولد</label>
            <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">ایمیل</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">سابقه پزشکی</label>
            <select class="form-select" id="hasHistory" name="has_history" required>
                <option value="" disabled selected>انتخاب کنید</option>
                <option value="yes" {{ old('has_history') == 'yes' ? 'selected' : '' }}>بله</option>
                <option value="no" {{ old('has_history') == 'no' ? 'selected' : '' }}>خیر</option>
            </select>
        </div>

        <div class="col-md-12 history-box" id="historyBox" style="display: {{ old('has_history') == 'yes' ? 'block' : 'none' }}">
            <label class="form-label">توضیحات سابقه پزشکی</label>
            <textarea class="form-control" rows="4" name="history_details" placeholder="مثال: سابقه فشار خون، حساسیت به دارو، بیماری قلبی و...">{{ old('history_details') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label">رمز عبور</label>
            <div class="input-group">
                <input type="password" class="form-control password-field" id="password" name="password" required>
                <span class="input-group-text password-toggle" data-target="password">
                    <i class="bi bi-eye-fill"></i>
                </span>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">تکرار رمز عبور</label>
            <div class="input-group">
                <input type="password" class="form-control password-field" id="passwordConfirm" name="password_confirmation" required>
                <span class="input-group-text password-toggle" data-target="passwordConfirm">
                    <i class="bi bi-eye-fill"></i>
                </span>
            </div>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg w-100">ثبت‌نام</button>
        </div>

        <div class="text-center mt-2">
            <small>
                حساب دارید؟ 
                <a href="{{ url('/login') }}">ورود</a>
            </small>
        </div>
    </form>
</section>

<footer class="main-footer">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/patient-register.js') }}"></script>
<script>
    // نمایش/مخفی کردن باکس سابقه پزشکی
    document.getElementById('hasHistory').addEventListener('change', function() {
        document.getElementById('historyBox').style.display = this.value === 'yes' ? 'block' : 'none';
    });

    // نمایش/مخفی کردن رمز عبور
    document.querySelectorAll('.password-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
            // تغییر آیکون چشم
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-fill');
        });
    });
</script>

</body>
</html>
