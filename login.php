<?php
session_start(); // بدء الجلسة

$servername = "localhost";
$username = "root"; // اسم المستخدم الافتراضي
$password = ""; // كلمة المرور الافتراضية
$dbname = "user_auth"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// معالجة تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // التحقق من كلمة المرور
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email; // تخزين البريد الإلكتروني في الجلسة
            header("Location: dashboard.php"); // توجيه المستخدم إلى لوحة التحكم
            exit();
        } else {
            echo "<p>كلمة المرور غير صحيحة.</p>";
        }
    } else {
        echo "<p>البريد الإلكتروني غير موجود.</p>";
    }
    $stmt->close();
}

$conn->close();
?>