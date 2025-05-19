<?php
$host = "127.0.0.1:4307";  // عدل المنفذ حسب جهازك
$user = "root";
$password = "";
$dbname = "meteo_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
