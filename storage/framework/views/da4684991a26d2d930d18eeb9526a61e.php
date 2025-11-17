<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>خوش آمدید</title>
  <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>">
</head>
<body dir="rtl">

  <div class="welcome-container">
    <h1 id="welcomeMessage">
      <?php if(isset($role) && $role === 'پزشک'): ?>
        به صفحه کاربری پزشک خوش آمدید، <?php echo e($username ?? 'کاربر'); ?>!
      <?php elseif(isset($role) && $role === 'بیمار'): ?>
        به صفحه مراجعه‌کننده خوش آمدید، <?php echo e($username ?? 'کاربر'); ?>!
      <?php else: ?>
        به سایت خوش آمدید، <?php echo e($username ?? 'کاربر'); ?>!
      <?php endif; ?>

    </h1>
  </div>

</body>
</html>
<?php /**PATH Z:\Xampp\htdocs\Clinic_System\clinic\resources\views/welcome.blade.php ENDPATH**/ ?>