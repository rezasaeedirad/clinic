<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>داشبورد مراجعه‌کننده</title>
  <link rel="stylesheet" href="{{ asset('css/welcome-patient.css') }}">
</head>
<body dir="rtl">

  <!-- هدر -->
  <header class="header">
    <div class="header-right">
      <span class="title">داشبورد مراجعه‌کننده</span>
    </div>

    <div class="header-left">
      <a href="#" class="header-btn">نوبت‌های من</a>
      <a href="#" class="header-btn reserve">رزرو نوبت</a>

      <!-- دکمه خروج واقعی لاراول -->
      <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="header-btn logout-btn">خروج</button>
      </form>
    </div>
  </header>


  <!-- بخش خوش‌آمدگویی -->
  <div class="welcome-container fade-in">
    <div class="welcome-box">
      <h2>
        🙌 خوش آمدید {{ Auth::user()->uname ?? Auth::user()->name }} عزیز!
      </h2>
    </div>
  </div>

  <!-- فوتر -->
  <footer class="footer">
    <p>© 2025 تمامی حقوق برای سیستم نوبت‌دهی محفوظ است.</p>
  </footer>

</body>
</html>
