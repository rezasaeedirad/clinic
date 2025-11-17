<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پذیرش آنلاین پزشک</title>

  <!-- حتماً فایل CSS را از پوشه public با asset لود کن -->
  <link rel="stylesheet" href="<?php echo e(asset('css/front.css')); ?>">
</head>
<body dir="rtl">

  <!-- هدر -->
  <header class="header">

    <!-- سمت راست -->
    <div class="header-right boxed-buttons">
      <div class="dropdown">
        <button class="dropbtn">دسته‌بندی‌ها ▾</button>
        <div class="dropdown-content">
          <a href="#">عمومی</a>
          <a href="#">قلب و عروق</a>
          <a href="#">گوارش</a>
          <a href="#">کودکان</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">پشتیبانی ▾</button>
        <div class="dropdown-content">
          <a href="#">ارتباط با پشتیبانی</a>
          <a href="#">راهنمای رزرو نوبت</a>
        </div>
      </div>
    </div>

    <!-- وسط -->
    <div class="header-center">
      <h1>کلینیک آنلاین پزشک</h1>
    </div>

    <!-- سمت چپ -->
    <div class="header-left">

      <!-- لینک‌های لاراول به جای فایل‌های HTML -->
      <a href="<?php echo e(url('/login/patient')); ?>" class="btn secondary">ورود / ثبت‌نام مراجعه‌کننده</a>
      <a href="<?php echo e(url('/login/doctor')); ?>" class="btn secondary">ورود / ثبت‌نام پزشک</a>

    </div>
  </header>

  <!-- محتوای اصلی -->
  <main class="main">
    <div class="search-box">
      <div class="logo-container">
        <img src="<?php echo e(asset('images/textlogo.png')); ?>" alt="لوگوی متنی" class="logo-text">
        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="لوگو" class="logo-icon">
      </div>

      <div class="search-bar">
        <input type="text" placeholder="جستجوی تخصص یا نام پزشک...">
        <button class="search-btn" onclick="performSearch()">🔍</button>
      </div>
    </div>
  </main>

  <!-- فوتر -->
  <footer class="footer">
    <p>© 2025 پذیرش آنلاین نوبت | تمامی حقوق محفوظ است.</p>
    <div class="footer-links">
      <a href="#">درباره ما</a>
      <a href="#">تماس با ما</a>
      <a href="#">حریم خصوصی</a>
    </div>
  </footer>

  <script>
    function performSearch() {
      const input = document.querySelector('.search-bar input').value;
      if (input.trim() === "") {
        alert("لطفاً چیزی برای جستجو وارد کنید.");
      } else {
        alert("در حال جستجو برای: " + input);
      }
    }
  </script>

</body>
</html>
<?php /**PATH Z:\Xampp\htdocs\Clinic_System\clinic\resources\views/v1front.blade.php ENDPATH**/ ?>