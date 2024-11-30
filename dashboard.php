<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: تسجيل الدخول.html"); // إبعاد المستخدم إذا لم يكن مسجلاً الدخول
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
</head>
<body>
    <h2>مرحبًا بك في لوحة التحكم</h2>
    <p>لقد قمت بتسجيل الدخول بنجاح!</p>
    <a href="logout.php">تسجيل خروج</a>
</body>
</html>