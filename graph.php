<?php
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Health Monitoring Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0px 0;
        background: linear-gradient(to right, #c9d6ff, #e2e2e2);
    }

    header {
        background-color: #0d47a1;
        padding: 20px 40px;
        color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    header h1 {
        font-size: 28px;
        font-weight: 600;
    }

    nav {
        background-color: #007bff;
        color: white;
        padding: 15px 30px;
        position: sticky;
        top: 0;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        z-index: 1000;
    }

    nav h1 {
        margin: 0;
        font-size: 30px;
    }

    nav a.nav-link {
        color: white;
        margin-left: 20px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        transition: color 0.2s ease;
    }

    nav a.nav-link:hover {
        color: #ffd700;
    }

    nav a.logout-link {
        color: white;
        background-color: transparent;
        margin-left: 20px;
        font-weight: bold;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    nav a.logout-link:hover {
        background-color: #dc3545;
        color: white;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card h2 {
        font-size: 22px;
        margin-bottom: 10px;
        color: #0d47a1;
    }

    .iframe-container {
        width: 100%;
        height: 300px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .chart-section {
        margin-top: 20px;
    }

    .description {
        font-size: 14px;
        color: #555;
    }

    footer {
        text-align: center;
        padding: 20px;
        margin-top: 50px;
        font-size: 14px;
        color: #888;
        background-color: #f1f1f1;
    }

    @media screen and (max-width: 768px) {
        .container {
            margin: 20px;
            padding: 10px;
        }

        .card {
            padding: 20px;
        }

        header h1 {
            font-size: 22px;
        }

        .card h2 {
            font-size: 18px;
        }

        .iframe-container {
            height: 250px;
        }
    }

    .heading {
        text-align: center;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">My Health Monitor</h1>
        <div>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="real_time.php" class="nav-link">Real Time</a>
            <a href="all_data.php" class="nav-link">All Data</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
    </div>
  </nav>


  <!-- Main Content -->
  <div class="container">
    <div class="card">
      <div class="chart-section">
        <h2>Body Temperature</h2>
        <div class="iframe-container">
          <iframe src="https://thingspeak.com/channels/2918411/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
        </div>
      </div>

      <div class="chart-section">
        <h2>Heart Rate</h2>
        <div class="iframe-container">
          <iframe src="https://thingspeak.com/channels/2918411/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
        </div>
      </div>

      <div class="chart-section">
        <h2>Oxygen Level</h2>
        <div class="iframe-container">
          <iframe src="https://thingspeak.com/channels/2918411/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15"></iframe>
        </div>
      </div>

      <p class="description">
        The above graphs show real-time health data including heart rate, body temperature, and oxygen level. The information is continuously monitored and updated every 15 seconds from our IoT-based sensor system.
      </p>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 | Developed by Group 13 | YCCE College Project
  </footer>

</body>
</html>
