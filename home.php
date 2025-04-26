<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@ViewBag.Title</title>

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

        body {
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
        }

        /* Updated Navbar styles */
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

        .container1 {
            max-width: 1100px;
            margin: 0 auto;
            padding: 120px 20px 20px 20px; /* Top padding adjusted due to fixed navbar */
            position: relative;
            z-index: 1;
        }

        .hero-section {
            position: relative;
            text-align: center;
            padding: 100px 20px;
            background: rgba(255, 255, 255, 0.5);
            color: #0A1828;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: bold;
        }

        .hero-description {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero-button {
            padding: 10px 20px;
            background-color: #178582;
            color: white;
            font-size: 1.1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .hero-button:hover {
            background-color: #0A1828;
        }

        .services {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .service-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 30%;
            margin: 10px;
        }

        .service-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .service-card h3 {
            margin-top: 15px;
            font-size: 1.3rem;
        }

        .service-card p {
            font-size: 1rem;
            color: #555;
        }

        @media screen and (max-width: 768px) {
            .service-card {
                width: 100%;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar .nav-links {
                flex-direction: column;
                gap: 10px;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="brand">My Health Monitor</div>
        <div class="nav-links">
            <a href="admin.php">Admin Login</a>
            <a href="about_us.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
        </div>
    </div>

    <div class="container1">

        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">Welcome to Health Monitor</h1>
            <p class="hero-description">Stay on top of your health with real-time monitoring and smart alerts.</p>
            <a href="index.php" class="hero-button">Get in Touch</a>
        </div>

        <!-- Services Section -->
        <div class="services">
            <div class="service-card">
                <img src="Images/real_time_1.jpg" alt="Real-Time Monitoring" />
                <h3>Real-Time Monitoring</h3>
                <p>Track your vitals continuously and stay informed about critical health parameters.</p>
            </div>
            <div class="service-card">
                <img src="Images/real_time_2.jpg" alt="Alerts & Notifications" />
                <h3>Alerts & Notifications</h3>
                <p>Receive instant alerts when your health metrics go beyond safe limits.</p>
            </div>
            <div class="service-card">
                <img src="https://img.freepik.com/free-vector/business-report-concept-illustration_114360-2349.jpg" alt="Reports & History" />
                <h3>Reports & History</h3>
                <p>View and download your health records, trends, and reports over time.</p>
            </div>
        </div>

    </div>

</body>
</html>
