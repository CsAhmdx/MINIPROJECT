<?php
session_start();
session_destroy(); // تفريغ الجلسة
header("Location: تسجيل الدخول.html"); // إعادة التوجيه إلى صفحة تسجيل الدخول
exit();
?>