<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8" />
<title>موقع الأحوال الجوية - الصفحة الرئيسية</title>
<style>
  body {
    background: #e3f2fd;
    font-family: Arial, sans-serif;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
  }
  .container {
    text-align: center;
    background: white;
    padding: 40px 60px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
  }
  h1 {
    margin-bottom: 30px;
    color: #1976d2;
  }
  button {
    width: 180px;
    padding: 15px;
    margin: 15px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .login-btn {
    background-color: #0288d1;
    color: white;
  }
  .login-btn:hover {
    background-color: #0277bd;
  }
  .signup-btn {
    background-color: #4caf50;
    color: white;
  }
  .signup-btn:hover {
    background-color: #388e3c;
  }
</style>
</head>
<body>
  <div class="container">
    <h1>مرحبًا بك في موقع الأحوال الجوية</h1>
    <button onclick="window.location.href='login.php'" class="login-btn">تسجيل الدخول</button>
    <button onclick="window.location.href='signup.php'" class="signup-btn">إنشاء حساب جديد</button>
  </div>
</body>
</html>
