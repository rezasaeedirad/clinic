<!DOCTYPE html>
<html>
<head>
    <title>ورود</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>ورود</h1>
    <form method="POST" action="/login">
        @csrf
        <label>ایمیل:</label><br>
        <input type="email" name="email" required><br><br>

        <label>رمز عبور:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">ورود</button>
    </form>
    <p>حساب کاربری ندارید؟ <a href="/register">ثبت‌نام</a></p>
</body>
</html>
