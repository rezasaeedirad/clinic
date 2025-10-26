<?php
$host = 'localhost';
$dbname = 'ClinicDB';
$username = 'root';
$password = ''; // در XAMPP به‌صورت پیش‌فرض خالی است

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_persian_ci'");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>