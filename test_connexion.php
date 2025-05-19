<?php
$host = "127.0.0.1:4307";  // هنا المنفذ الصحيح
$user = "root";
$password = "";
$dbname = "meteo_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("❌ فشل الاتصال: " . $conn->connect_error);
}
echo "✅ تم الاتصال بنجاح بقاعدة البيانات!";
?>
