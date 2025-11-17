<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>داشبورد پزشک</title>
  <link rel="stylesheet" href="{{ asset('css/welcome-doctor.css') }}">
</head>
<body dir="rtl">

  <!-- هدر -->
  <header class="header">
    <div class="header-right">
      <span class="title">داشبورد پزشک</span>
    </div>

    <div class="header-left">
      <a href="#" class="header-btn">نوبت‌های امروز</a>
      <a href="#" class="header-btn reserve">مدیریت نوبت‌ها</a>

      <!-- دکمه خروج -->
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
        🙌 خوش آمدید پزشک {{ Auth::user()->uname }} عزیز!
      </h2>
    </div>
  </div>

  <!-- فوتر -->
  <footer class="footer">
    <p>© 2025 تمامی حقوق برای سیستم نوبت‌دهی محفوظ است.</p>
  </footer>

</body>
</html>
