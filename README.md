# 🏥 سیستم نوبت‌دهی آنلاین پزشکی (Clinic)

## 💻 ابزارها و فناوری‌ها
- Frontend: HTML, CSS, JavaScript, Bootstrap
- Backend: PHP (Laravel Framework)
- Database: MySQL
- Version Control: Git
- Environment: XAMPP

## ⚙️ !راهنمای راه‌اندازی

### 1️⃣ پیش‌نیازها
قبل از شروع، مطمئن شوید موارد زیر نصب هستند:
- PHP 8.1+
- Composer
- XAMPP (شامل Apache و MySQL)

### 2️⃣ راه‌اندازی محیط XAMPP
1. XAMPP را نصب کنید و سرویس‌های Apache و MySQL را فعال کنید.
2. پروژه را در مسیر زیر قرار دهید:
C:\Xampp\htdocs\Clinic_System

### 3️⃣ ایجاد دیتابیس
1. مرورگر را باز کرده و وارد phpMyAdmin شوید:
http://localhost/phpmyadmin
2. دیتابیس جدید با نام زیر بسازید:
clinicdb
3. فایل clinicdb.sql را در تب Import آپلود کنید.
4. اطمینان حاصل کنید collation دیتابیس روی utf8mb4_persian_ci تنظیم شده باشد.

### 4️⃣ دانلود پروژه از GitHub
git clone https://github.com/rezasaeedirad/clinic.git
cd clinic

### 5️⃣ نصب وابستگی‌ها
composer install

### 6️⃣ تنظیم فایل محیطی .env
1. فایل .env.example را کپی کرده و نام آن را به .env تغییر دهید:
cp .env.example .env
2. مقادیر زیر را در فایل .env تنظیم کنید:
```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinicdb
DB_USERNAME=root
DB_PASSWORD=      # اگر رمز دارد، وارد کنید
SESSION_DRIVER=file
```

### 7️⃣ اجرای سرور Laravel
php artisan serve

سپس در مرورگر وارد شوید:
http://127.0.0.1:8000

## 📁 ساختار پوشه‌ها
```text
clinic/
├── public/
│   ├── css/
│   │   └── front.css
│   │   └── login-doctor.css
│   │   └── login-patient.css
│   │   └── signup-patient.css
│   │   └── signup-doctor.css
│   │   └── welcome-doctor.css
│   │   └── welcome-patient.css
├── resources/
│   └── views/
│       └── v1front.blade.php
│       └── loginpatient.blade.php
│       └── logindoctor.blade.php
│       └── registerdoctor.blade.php
│       └── registerpatient.blade.php
│       └── welcomedoctor.blade.php
│       └── welcomepatient.blade.php
├── routes/
│   └── web.php
├── .env
├── clinicdb.sql
└── README.md
```

## 👥 نویسندگان
- رضا سعیدی‌راد
- سجاد ربیعی

📎 لینک GitHub پروژه:
https://github.com/rezasaeedirad/clinic