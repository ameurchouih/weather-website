<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "اسم المستخدم موجود بالفعل.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['success'] = "تم التسجيل بنجاح، يمكنك تسجيل الدخول الآن.";
            header("Location: login.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء التسجيل.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background: #f8f0f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px #cba1c4;
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #a11d4a;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #a11d4a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #8e1940;
        }

        .msg {
            text-align: center;
            margin-bottom: 10px;
            color: green;
        }

        .error {
            color: red;
            text-align: center;
        }

        a {
            color: #a11d4a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>تسجيل مستخدم جديد</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        <?php if (!empty($_SESSION['success'])) {
            echo "<div class='msg'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        } ?>

        <form method="post">
            <label>اسم المستخدم:</label>
            <input type="text" name="username" required>

            <label>كلمة المرور:</label>
            <input type="password" name="password" required>

            <button type="submit">سجل الآن</button>
        </form>

        <p style="text-align:center;">هل لديك حساب؟ <a href="login.php">تسجيل الدخول</a></p>
    </div>
</body>
</html>
