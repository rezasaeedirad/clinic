<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ویرایش پروفایل پزشک — کلینیک آنلاین</title>

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- فونت فارسی -->
    <link href="https://fonts.bunny.net/css?family=vazirmatn:300,400,500,700" rel="stylesheet">

    <style>
        body { font-family: Vazirmatn, sans-serif; }
        .main-header, .main-footer { background: #fff; padding: 15px 0; }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="main-header shadow-sm mb-4">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand fw-bold logo" href="{{ url('/home') }}">کلینیک آنلاین</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">

                <!-- خروج -->
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link p-0 m-0 align-baseline">خروج</button>
                    </form>
                </li>

            </ul>
        </div>
    </nav>
</header>

<!-- MAIN -->
<main class="container">

    <h3 class="mb-4">ویرایش پروفایل پزشک</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('doctor.profile.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">تخصص</label>
            <input type="text" name="specialty" value="{{ old('specialty', $doctor->specialty) }}" class="form-control">
            @error('specialty') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">بیوگرافی</label>
            <textarea name="bio" class="form-control" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
            @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">آدرس مطب</label>
            <input type="text" name="address" value="{{ old('address', $doctor->address) }}" class="form-control">
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">شماره تماس</label>
            <input type="text" name="phone" value="{{ old('phone', $doctor->phone) }}" class="form-control">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">ذخیره تغییرات</button>
        <a href="{{ route('doctor.dashboard') }}" class="btn btn-secondary">بازگشت</a>
    </form>

</main>

<!-- FOOTER -->
<footer class="main-footer mt-4 text-center">
    <p>© 2025 کلینیک آنلاین — تمامی حقوق محفوظ است.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
