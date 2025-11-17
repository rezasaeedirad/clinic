<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود مراجعه‌کننده</title>
  <link rel="stylesheet" href="{{ asset('css/login-patient.css') }}">
</head>
<body dir="rtl">

  <div class="login-container fade-in">
    <div class="form-box">
      <h2>ورود مراجعه‌کننده</h2>

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

      <!-- فرم ورود -->
      <form id="loginForm" method="POST" action="{{ url('/login/patient') }}">
        @csrf

        <input type="email" name="email" placeholder="ایمیل" value="{{ old('email') }}" required>

        <input type="password" name="password" id="password" placeholder="رمز عبور" required>

        <div class="show-password">
          <input type="checkbox" id="showPassword">
          <label for="showPassword">نمایش رمز عبور</label>
        </div>

        <button type="submit">ورود</button>
      </form>

      <div class="signup-links">
        <p>ثبت‌نام نکرده‌اید؟</p>
        <a href="{{ url('/signup/patient') }}" class="fade-link">ثبت‌نام</a>
      </div>
    </div>
  </div>

  <script>
    // نمایش / مخفی کردن رمز عبور
    const passwordInput = document.getElementById('password');
    const showPassword  = document.getElementById('showPassword');

    showPassword.addEventListener('change', () => {
      passwordInput.type = showPassword.checked ? 'text' : 'password';
    });
  </script>

</body>
</html>
