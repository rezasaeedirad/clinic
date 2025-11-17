<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت‌نام پزشک</title>
  <link rel="stylesheet" href="<?php echo e(asset('css/signup-doctor.css')); ?>">
</head>
<body dir="rtl">

  <div class="signup-container">
    <div class="form-box">
      <h2>ثبت‌نام پزشک</h2>

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

      <!-- فرم ثبت‌نام پزشک -->
      <form id="signupDoctorForm" method="POST" action="<?php echo e(url('/register/doctor')); ?>">
        <?php echo csrf_field(); ?>

        <!-- نام و ایمیل -->
        <div class="form-row">
          <input type="text" name="uname" placeholder="نام کامل" value="<?php echo e(old('uname')); ?>" required>
          <input type="email" name="email" placeholder="ایمیل" value="<?php echo e(old('email')); ?>" required>
        </div>

        <!-- جنسیت و تلفن همراه -->
        <div class="form-row">
          <select name="gender" required>
            <option value="" disabled selected hidden>جنسیت</option>
            <option value="مرد" <?php echo e(old('gender') == 'مرد' ? 'selected' : ''); ?>>مرد</option>
            <option value="زن" <?php echo e(old('gender') == 'زن' ? 'selected' : ''); ?>>زن</option>
          </select>
          <input type="tel" name="phone" placeholder="تلفن همراه" value="<?php echo e(old('phone')); ?>" required>
        </div>

        <!-- تخصص و بیوگرافی -->
        <div class="form-row">
          <select name="skill" required>
            <option value="" disabled selected hidden>تخصص</option>
            <option value="کودکان" <?php echo e(old('skill') == 'کودکان' ? 'selected' : ''); ?>>کودکان</option>
            <option value="گوارش" <?php echo e(old('skill') == 'گوارش' ? 'selected' : ''); ?>>گوارش</option>
            <option value="مغز و اعصاب" <?php echo e(old('skill') == 'مغز و اعصاب' ? 'selected' : ''); ?>>مغز و اعصاب</option>
            <option value="دندان پزشک" <?php echo e(old('skill') == 'دندان پزشک' ? 'selected' : ''); ?>>دندان پزشک</option>
            <option value="جراح زیبایی" <?php echo e(old('skill') == 'جراح زیبایی' ? 'selected' : ''); ?>>جراح زیبایی</option>
          </select>

          <textarea name="bio" placeholder="بیوگرافی" rows="2"><?php echo e(old('bio')); ?></textarea>
        </div>

        <!-- آدرس -->
        <div class="form-row">
          <input type="text" name="address" placeholder="آدرس" value="<?php echo e(old('address')); ?>">
        </div>

        <!-- رمز عبور -->
        <div class="form-row">
          <input type="password" name="password" placeholder="رمز عبور" required>
          <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required>
        </div>

        <!-- دکمه ثبت‌نام -->
        <button type="submit">ثبت‌نام</button>
      </form>

      <div class="signup-links">
        <p>حساب کاربری دارید؟ <a href="<?php echo e(url('/login/doctor')); ?>">ورود</a></p>
      </div>
    </div>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      document.body.classList.add('fade-in');

      const links = document.querySelectorAll('a');
      links.forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const href = this.getAttribute('href');
          document.body.classList.add('fade-out');
          setTimeout(() => { window.location.href = href; }, 400);
        });
      });
    });
  </script>

</body>
</html>
<?php /**PATH Z:\Xampp\htdocs\Clinic_System\clinic\resources\views/signup-doctor.blade.php ENDPATH**/ ?>