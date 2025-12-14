# 🏥 سیستم نوبت‌دهی آنلاین پزشکی (Clinic)

یک سیستم کامل برای مدیریت نوبت‌های آنلاین بیماران و پزشکان با استفاده از **Laravel** و رابط کاربری مدرن **Bootstrap RTL**.

---

## 💻 فناوری‌ها و ابزارها

* **Frontend:** HTML, CSS, JavaScript, Bootstrap (RTL)
* **Backend:** PHP 8.1+, Laravel Framework
* **Database:** MySQL
* **Version Control:** Git
* **Environment:** XAMPP

---

## ⚙️ راه‌اندازی پروژه

### 1️⃣ پیش‌نیازها

* PHP 8.1+
* Composer
* XAMPP (Apache + MySQL)
* Git (اختیاری)

---

### 2️⃣ تنظیم محیط XAMPP

1. XAMPP را نصب کرده و Apache و MySQL را اجرا کنید.
2. پروژه را در مسیر زیر قرار دهید:

```
C:\Xampp\htdocs\clinic
```

---

### 3️⃣ ایجاد دیتابیس

1. وارد phpMyAdmin شوید: `http://localhost/phpmyadmin`
2. دیتابیس جدید بسازید:

```
clinicdb
```

3. فایل `clinicdb.sql` را در تب **Import** آپلود کنید.
4. مطمئن شوید **Collation** دیتابیس روی `utf8mb4_persian_ci` تنظیم شده است.

---

### 4️⃣ دریافت پروژه از GitHub

```bash
git clone https://github.com/rezasaeedirad/clinic.git
cd clinic
```

---

### 5️⃣ نصب وابستگی‌ها

```bash
composer install
```

---

### 6️⃣ تنظیم فایل محیطی

1. `.env.example` را کپی کنید و نام آن را به `.env` تغییر دهید:

```bash
cp .env.example .env
```

2. مقادیر دیتابیس و دیگر تنظیمات را در `.env` ویرایش کنید:

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinicdb
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
```

---

### 7️⃣ اجرای سرور Laravel

```bash
php artisan serve
```

سپس مرورگر را باز کنید و وارد شوید:

```
http://127.0.0.1:8000
```

---

## 📁 ساختار پروژه

```text
clinic/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── Controller.php
│   │   │   ├── DoctorAuthController.php
│   │   │   ├── DoctorDashboardController.php
│   │   │   ├── DoctorProfileController.php
│   │   │   ├── PatientAuthController.php
│   │   │   ├── PatientDashboardController.php
│   │   │   └── PatientAppointmentController.php
│   │   └── Middleware/
│   │       └── PreventBackHistory.php
│   ├── Models/
│   │   ├── Appointment.php
│   │   ├── Doctor.php
│   │   ├── Patient.php
│   │   ├── Schedule.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2025_12_08_200000_add_extra_fields_to_users_table.php.php
│   │   ├── 2025_12_08_221853_create_doctors_table.php
│   │   ├── 2025_12_09_000307_create_appointments_table.php
│   │   ├── 2025_12_09_095216_add_birthdate_gender_to_patients_table.php
│   │   ├── 2025_12_10_202107_add_role_to_users_table.php
│   │   ├── 2025_12_10_210205_add_is_logged_in_to_users_table.php
│   │   └── 2025_12_13_061442_create_schedules_table.php
│   ├── seeders/
│   │   └── DatabaseSeeder.php
│   └── factories/
│       └── UserFactory.php
├── public/
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── resources/
│   └── views/
│       ├── home.blade.php
│       ├── login.blade.php
│       ├── register.blade.php
│       ├── role.blade.php
│       ├── welcome.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── doctor/
│       │   ├── dashboard.blade.php
│       │   ├── profile.blade.php
│       │   └── register.blade.php
│       └── patient/
│           ├── dashboard.blade.php
│           └── register.blade.php
├── routes/
│   ├── console.php
│   └── web.php
├── .env
├── database/.gitignore
├── composer.json
├── clinicdb.sql
└── README.md
```

---

## 👀 ویژگی‌ها

* **داشبورد پزشک:** مشاهده نوبت‌ها، تأیید و لغو نوبت‌ها، اضافه کردن زمان‌های آزاد.
* **داشبورد بیمار:** مشاهده نوبت‌ها، جستجوی پزشکان، رزرو نوبت.
* **جستجوی پیشرفته پزشکان:** بر اساس نام، تخصص و آدرس.
* **نمایش مشخصات پزشک:** اطلاعات کامل به صورت مودال و زیبا.
* **سیستم نوبت‌دهی امن:** استفاده از احراز هویت و مدیریت نقش‌ها.

---

## 👥 نویسندگان

* رضا سعیدی‌راد
* سجاد ربیعی

---

## 📎 لینک‌ها

* GitHub پروژه: [https://github.com/rezasaeedirad/clinic](https://github.com/rezasaeedirad/clinic)
