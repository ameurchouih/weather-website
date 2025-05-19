<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8" />
<title>تم التسجيل بنجاح</title>
<style>
  body {
    background: #e8f5e9;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .container {
    background: white;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    width: 350px;
    text-align: center;
  }
  h2 {
    color: #388e3c;
  }
  button {
    margin-top: 20px;
    padding: 12px 25px;
    background-color: #1976d2;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
  }
  button:hover {
    background-color: #125ea6;
  }
</style>
</head>
<body>
  <div class="container">
    <h2>تم تسجيلك بنجاح!</h2>
    <p>الآن يمكنك تسجيل الدخول بحسابك الجديد.</p>
    <button onclick="window.location.href='login.php'">العودة لتسجيل الدخول</button>
  </div>
</body>
</html>
