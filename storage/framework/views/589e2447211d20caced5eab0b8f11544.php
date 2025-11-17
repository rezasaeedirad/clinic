<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود پزشک</title>
  <link rel="stylesheet" href="<?php echo e(asset('css/login-doctor.css')); ?>">
</head>
<body dir="rtl">

  <div class="login-container fade-in">
    <div class="form-box">
      <h2>ورود پزشک</h2>

      <!-- نمایش خطاها -->
      <?php if($errors->any()): ?>
          <div class="alert alert-danger">
              <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      <?php endif; ?>

      <!-- فرم ورود -->
      <form id="loginForm" method="POST" action="<?php echo e(url('/login/doctor')); ?>">
        <?php echo csrf_field(); ?>

        <input type="email" name="email" placeholder="ایمیل" value="<?php echo e(old('email')); ?>" required>

        <input type="password" name="password" id="password" placeholder="رمز عبور" required>

        <div class="show-password">
          <input type="checkbox" id="showPassword">
          <label for="showPassword">نمایش رمز عبور</label>
        </div>

        <button type="submit">ورود</button>
      </form>

      <div class="signup-links">
        <p>ثبت‌نام نکرده‌اید؟</p>
        <a href="<?php echo e(url('/signup/doctor')); ?>" class="fade-link">ثبت‌نام</a>
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
<?php /**PATH Z:\Xampp\htdocs\Clinic_System\clinic\resources\views/logindoctor.blade.php ENDPATH**/ ?>