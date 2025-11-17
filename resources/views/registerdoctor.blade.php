<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت‌نام پزشک</title>

  <link rel="stylesheet" href="{{ asset('css/signup-doctor.css') }}">
</head>
<body dir="rtl">

  <div class="signup-container fade-in">
    <div class="form-box">
      <h2>ثبت‌نام پزشک</h2>

      <!-- نمایش خطاها -->
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form id="signupDoctorForm" method="POST" action="{{ url('/register/doctor') }}">
        @csrf

        <!-- نام کامل و ایمیل -->
        <div class="form-row">
          <input type="text" name="uname" placeholder="نام کامل" value="{{ old('uname') }}" required>
          <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}" required>
        </div>

        <!-- جنسیت و تلفن همراه -->
        <div class="form-row">
          <select name="gender" required>
            <option value="" disabled selected hidden>جنسیت</option>
            <option value="مرد" {{ old('gender')=='مرد' ? 'selected':'' }}>مرد</option>
            <option value="زن" {{ old('gender')=='زن' ? 'selected':'' }}>زن</option>
          </select>

          <input type="tel" name="phone" placeholder="تلفن همراه" value="{{ old('phone') }}" required>
        </div>

        <!-- تخصص و بیوگرافی -->
        <div class="form-row">
          <select name="skill" required>
            <option value="" disabled selected hidden>تخصص</option>

            <option value="کودکان" {{ old('skill')=='کودکان' ? 'selected':'' }}>کودکان</option>
            <option value="گوارش" {{ old('skill')=='گوارش' ? 'selected':'' }}>گوارش</option>
            <option value="مغز و اعصاب" {{ old('skill')=='مغز و اعصاب' ? 'selected':'' }}>مغز و اعصاب</option>
            <option value="دندان پزشک" {{ old('skill')=='دندان پزشک' ? 'selected':'' }}>دندان پزشک</option>
            <option value="جراح زیبایی" {{ old('skill')=='جراح زیبایی' ? 'selected':'' }}>جراح زیبایی</option>

          </select>

          <textarea name="bio" placeholder="بیوگرافی" rows="1">{{ old('bio') }}</textarea>
        </div>

        <!-- آدرس -->
        <div class="form-row">
          <input type="text" name="address" placeholder="آدرس مطب" value="{{ old('address') }}">
        </div>

        <!-- رمز عبور و تکرار رمز عبور -->
        <div class="form-row">
          <input type="password" name="password" id="password" placeholder="رمز عبور" required>
          <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required>
        </div>

        <!-- نمایش رمز عبور -->
        <div class="show-password">
          <input type="checkbox" id="showPassword">
          <label for="showPassword">نمایش رمز عبور</label>
        </div>

        <button type="submit">ثبت‌نام</button>
      </form>

      <div class="signup-links">
        <p>حساب کاربری دارید؟ 
            <a href="{{ url('/login/doctor') }}">ورود</a>
        </p>
      </div>
    </div>
  </div>

  <script>
    // نمایش/مخفی کردن رمز عبور
    const passwordInput = document.getElementById('password');
    const showPassword = document.getElementById('showPassword');
    showPassword.addEventListener('change', () => {
      passwordInput.type = showPassword.checked ? 'text' : 'password';
    });
  </script>

</body>
</html>
