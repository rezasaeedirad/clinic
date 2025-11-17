<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت‌نام مراجعه‌کننده</title>

  <!-- اتصال CSS از public -->
  <link rel="stylesheet" href="<?php echo e(asset('css/signup-patient.css')); ?>">
</head>
<body dir="rtl">

  <div class="signup-container">
    <div class="form-box">
      <h2>ثبت‌نام مراجعه‌کننده</h2>

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

      <!-- فرم ثبت‌نام -->
      <form id="signupForm" method="POST" action="<?php echo e(url('/register/patient')); ?>">
        <?php echo csrf_field(); ?>

        <!-- ردیف اول: نام و ایمیل -->
        <div class="form-row">
          <input type="text" name="uname" placeholder="نام کامل" value="<?php echo e(old('uname')); ?>" required>
          <input type="email" name="email" placeholder="ایمیل" value="<?php echo e(old('email')); ?>" required>
        </div>

        <!-- ردیف دوم: جنسیت و تلفن همراه -->
        <div class="form-row">
          <select name="gender" required>
            <option value="" disabled selected hidden>جنسیت</option>
            <option value="مرد" <?php echo e(old('gender')=='مرد' ? 'selected' : ''); ?>>مرد</option>
            <option value="زن" <?php echo e(old('gender')=='زن' ? 'selected' : ''); ?>>زن</option>
          </select>

          <input type="tel" name="phone" placeholder="تلفن همراه" value="<?php echo e(old('phone')); ?>" required>
        </div>

        <!-- ردیف سوم: سابقه بیماری -->
        <div class="form-row disease-section">
          <label>سابقه بیماری:</label>
          <div class="disease-options">
            <label><input type="radio" name="disease" value="yes"> دارم</label>
            <label><input type="radio" name="disease" value="no" checked> ندارم</label>
          </div>
        </div>

        <!-- توضیحات بیماری -->
        <textarea name="medical_history" id="diseaseDetails" placeholder="توضیحات بیماری" rows="5" disabled><?php echo e(old('medical_history')); ?></textarea>

        <!-- ردیف چهارم: رمز عبور و تکرار رمز عبور -->
        <div class="form-row">
          <input type="password" name="password" placeholder="رمز عبور" required>
          <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required>
        </div>

        <!-- دکمه ثبت‌نام -->
        <button type="submit">ثبت‌نام</button>
      </form>

      <div class="signup-links">
        <p>حساب کاربری دارید؟ 
            <a href="<?php echo e(url('/login/patient')); ?>">ورود</a>
        </p>
      </div>
    </div>
  </div>

  <!-- اسکریپت فعال/غیرفعال کردن textarea -->
  <script>
    window.addEventListener('DOMContentLoaded', () => {

      const diseaseRadios = document.querySelectorAll('input[name="disease"]');
      const diseaseDetails = document.getElementById('diseaseDetails');

      diseaseRadios.forEach(radio => {
        radio.addEventListener('change', () => {
          if (radio.value === 'yes') {
            diseaseDetails.disabled = false;
            diseaseDetails.focus();
          } else {
            diseaseDetails.disabled = true;
            diseaseDetails.value = '';
          }
        });
      });

    });
  </script>

</body>
</html>
<?php /**PATH Z:\Xampp\htdocs\Clinic_System\clinic\resources\views/registerpatient.blade.php ENDPATH**/ ?>