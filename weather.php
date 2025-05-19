<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <title>الطقس في الجزائر</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fff7f7;
      color: #333;
    }
    header {
      background-color: #8B0000;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
      font-weight: bold;
    }
    header .user-info a {
      color: white;
      text-decoration: none;
      margin-left: 15px;
      background: #b22222;
      padding: 6px 10px;
      border-radius: 5px;
      font-weight: normal;
      font-size: 14px;
    }
    .welcome-box {
      background-color: #f8d7da;
      color: #721c24;
      margin: 25px auto;
      width: 85%;
      border-radius: 10px;
      padding: 25px;
      text-align: center;
      font-family: 'Cairo', sans-serif;
      font-size: 22px;
      font-weight: 700;
      position: relative;
    }
    .welcome-box::before {
      content: "🌤️ ";
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 28px;
    }
    .container-wrapper {
      display: flex;
      justify-content: space-around;
      margin: 0 5%;
      gap: 20px;
      flex-wrap: wrap;
    }
    .box, .weather-display, .date-time-box {
      background-color: #fff;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 0 12px rgb(178 34 34 / 0.3);
      min-width: 300px;
    }
    .date-time-box {
      width: 100%;
      margin-bottom: 20px;
      color: #8B0000;
      font-family: 'Cairo', sans-serif;
    }
    .date-time-box h3 {
      margin-top: 0;
      border-bottom: 2px solid #b22222;
      padding-bottom: 8px;
    }
    #dateTimeInfo p {
      font-size: 18px;
      margin: 12px 0;
    }
    .box {
      width: 40%;
      max-width: 400px;
    }
    .box h3 {
      margin-top: 0;
      margin-bottom: 12px;
      color: #8B0000;
      font-family: 'Cairo', sans-serif;
      font-weight: 700;
      font-size: 20px;
    }
    select, button {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 7px;
      border: 1.5px solid #8B0000;
      font-size: 16px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    button {
      margin-top: 22px;
      background-color: #8B0000;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #b22222;
    }
    .weather-display {
      width: 50%;
      max-width: 500px;
      color: #8B0000;
      font-family: 'Cairo', sans-serif;
    }
    .weather-display h2 {
      margin-top: 0;
      border-bottom: 2px solid #b22222;
      padding-bottom: 8px;
    }
    .weather-display p {
      font-size: 18px;
      margin: 10px 0;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body>

<header>
  <div>METEO EN ALGERIE</div>
  <div class="user-info">
    <?php echo htmlspecialchars($username); ?> |
    <a href="logout.php">خروج 🚪</a>
  </div>
</header>

<div class="welcome-box">
  مرحبًا <strong><?php echo htmlspecialchars($username); ?></strong>! <br />
  اعرف الطقس في ولايتك الآن بفضل موقعنا الإلكتروني 🌍
</div>

<div class="container-wrapper">
  <div class="date-time-box">
    <h3>التاريخ والوقت ⏳</h3>
    <div id="dateTimeInfo">
      <p>التاريخ الميلادي: <span id="gregorianDate">--</span></p>
      <p>التاريخ الهجري: <span id="hijriDate">--</span></p>
      <p>الوقت الحالي: <span id="currentTime">--</span></p>
    </div>
  </div>

  <div class="box">
    <h3>اختر ولايتك 📍</h3>
    <select id="wilaya">
      <option value="Algiers">الجزائر</option>
      <option value="Oran">وهران</option>
      <option value="Constantine">قسنطينة</option>
      <option value="Annaba">عنابة</option>
      <option value="Batna">باتنة</option>
      <option value="Setif">سطيف</option>
      <option value="Tlemcen">تلمسان</option>
      <option value="Blida">بليدة</option>
      <option value="Bejaia">بجاية</option>
      <option value="Mostaganem">مستغانم</option>
    </select>

    <button onclick="showWeather()">Afficher la météo ☀️</button>
  </div>

  <div class="weather-display hidden" id="weatherResult">
    <h2>الطقس الحالي</h2>
    <p>المقر: <span id="locationDisplay">--</span></p>
    <p>الحالة الجوية: <span id="weatherCondition">--</span></p>
    <p>درجة الحرارة: <span id="temperature">--</span></p>
    <p>الرطوبة: <span id="humidity">--</span></p>
    <p>سرعة الرياح: <span id="windSpeed">--</span></p>
  </div>
</div>

<script>
  // وظيفة عرض الطقس
  async function showWeather() {
    const wilaya = document.getElementById("wilaya").value;
    const locationDisplay = document.getElementById("locationDisplay");
    const weatherCondition = document.getElementById("weatherCondition");
    const temperature = document.getElementById("temperature");
    const humidity = document.getElementById("humidity");
    const windSpeed = document.getElementById("windSpeed");
    const weatherResult = document.getElementById("weatherResult");

    locationDisplay.textContent = wilaya;

    const API_KEY = "XXXXXXXXXXXXXXXXXXXXXXXX";
    const city = encodeURIComponent(wilaya);
    const country = "DZ";

    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city},${country}&appid=${API_KEY}&units=metric&lang=ar`;

    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error("فشل جلب بيانات الطقس");

      const data = await response.json();

      weatherCondition.textContent = data.weather[0].description + " 🌤️";
      temperature.textContent = data.main.temp + " °C 🌡️";
      humidity.textContent = data.main.humidity + " % 💧";
      windSpeed.textContent = data.wind.speed + " m/s 💨";

      weatherResult.classList.remove("hidden");
    } catch (error) {
      alert(error.message);
      weatherResult.classList.add("hidden");
    }
  }

  // وظيفة تحديث التاريخ والوقت
  function updateDateTime() {
    const now = new Date();
    
    // التاريخ الميلادي
    const gregOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('gregorianDate').textContent = now.toLocaleDateString('ar-DZ', gregOptions);
    
    // التاريخ الهجري
    const hijriOptions = { calendar: 'islamic', year: 'numeric', month: 'long', day: 'numeric' };
    const hijriDate = new Intl.DateTimeFormat('ar-SA-u-ca-islamic', hijriOptions).format(now);
    document.getElementById('hijriDate').textContent = hijriDate;
    
    // الوقت الحالي
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    document.getElementById('currentTime').textContent = now.toLocaleTimeString('ar-DZ', timeOptions);
  }

  // تحديث البيانات كل ثانية
  setInterval(updateDateTime, 1000);
  updateDateTime(); // التشغيل الأولي
</script>

</body>
</html>