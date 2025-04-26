<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Health Monitor</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        /* Navbar styles */
        .navbar {
            width: 100%;
            background-color: #0A1828;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            color: white;
            position: fixed;
            top: 0;
            z-index: 999;
        }

        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
            color: #EAD196;
        }

        .navbar .nav-links {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .navbar .nav-links a {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .navbar .nav-links a:hover {
            color: #EAD196;
        }

        /* Header section */
        .about-header {
            background: linear-gradient(90deg, #0A1828, #178582);
            padding: 200px 0 80px 0;
            text-align: center;
            position: relative;
            color: white;
        }

        .about-header h1 {
            font-size: 48px;
            font-weight: bold;
            margin: 0;
            transform: translateY(-120px);
            position: relative;
            z-index: 2;
        }

        .about-image-container {
            position: absolute;
            bottom: -80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }

        .about-image-container img {
            width: 400px;
            height: auto;
            border-radius: 12px;
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.15);
        }

        .about-content {
            background-color: #FFFFFF;
            padding: 180px 40px 80px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
                                    background: linear-gradient(to right, #c9d6ff, #e2e2e2);
        }

        .about-card-section {
            padding: 40px 20px;
            text-align: center;
            width: 100%;
        }

        .about-cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1000px;
            width: 100%;
        }

        .about-card {
            background: linear-gradient(90deg, #FFF1BF, #EAD196, #D4B06A);
            width: 300px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-bottom: 4px solid #178582;
            transition: transform 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-5px);
        }

        .about-card h3 {
            font-size: 20px;
            color: #0A1828;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .about-card p {
            color: #333;
            font-size: 16px;
            line-height: 1.7;
        }

        .about-card .highlight {
            color: #7D0A0A;
            font-weight: bold;
        }

        .highlight {
            color: #BFA181;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="brand">My Health Monitor</div>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="contact_us.php">Contact Us</a>
        </div>
    </div>

    <!-- Header Section -->
    <div class="about-header">
        <h1>About Us</h1>
        <div class="about-image-container">
            <img src="Images/about_us_image.jpg" alt="Health Monitoring" />
        </div>
    </div>

    <!-- Card Content Section -->
    <div class="about-content">
        <div class="about-text container">
            <div class="about-card-section">
                <div class="about-cards">
                    <div class="about-card">
                        <h3>Our Mission</h3>
                        <p>We are committed to enabling <span class="highlight">real-time health tracking</span> for timely alerts and life-saving interventions.</p>
                    </div>
                    <div class="about-card">
                        <h3>Vital Monitoring</h3>
                        <p>Track <span class="highlight">Heart Rate</span>, <span class="highlight">SpO2</span>, and <span class="highlight">Body Temperature</span> continuously and accurately.</p>
                    </div>
                    <div class="about-card">
                        <h3>Visual Insights</h3>
                        <p>Graphical dashboards provide <span class="highlight">trend analysis</span> to monitor patient health in real time.</p>
                    </div>
                    <div class="about-card">
                        <h3>Instant Alerts</h3>
                        <p>Receive <span class="highlight">automated alerts</span> when health parameters deviate from safe thresholds.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
