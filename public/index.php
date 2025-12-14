<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| این فایل نقطه ورود به برنامه لاراول است. درخواست HTTP گرفته شده،
| از طریق Kernel پردازش می‌شود و پاسخ به مرورگر ارسال می‌شود.
|
*/

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

// گرفتن کرنل
$kernel = $app->make(Kernel::class);

// گرفتن درخواست HTTP
$request = Request::capture();

// پردازش درخواست و گرفتن پاسخ
$response = $kernel->handle($request);

// ارسال پاسخ به مرورگر
$response->send();

// اجرای terminate برای Middleware ها و پاکسازی‌ها
$kernel->terminate($request, $response);
