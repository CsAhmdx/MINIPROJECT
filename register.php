<?php
$servername = "localhost";
$username = "root"; // اسم المستخدم الافتراضي
$password = ""; // كلمة المرور الافتراضية
$dbname = "user_auth"; // اسم قاعدة البيانات

$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// معالجة تسجيل الحساب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        echo "تم تسجيل الحساب بنجاح!";
        // يمكنك توجيه المستخدم إلى صفحة تسجيل الدخول بعد التسجيل
        header("Location: تسجيل الدخول.html");
        exit();
    } else {
        echo "خطأ في تسجيل الحساب: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>