<!DOCTYPE html>
<html>
<head>
    <title>ثبت‌نام</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>ثبت‌نام</h1>
    <form method="POST" action="/register">
        @csrf
        <label>نام:</label><br>
        <input type="text" name="name" required><br><br>

        <label>ایمیل:</label><br>
        <input type="email" name="email" required><br><br>

        <label>رمز عبور:</label><br>
        <input type="password" name="password" required><br><br>

        <label>تایید رمز عبور:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">ثبت‌نام</button>
    </form>
    <p>قبلاً ثبت‌نام کرده‌اید؟ <a href="/login">ورود</a></p>
</body>
</html>
