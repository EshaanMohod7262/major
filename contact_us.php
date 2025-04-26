<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Health Monitor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        /* Contact Section */
        .contact-section {
                        background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            padding: 120px 20px 80px 20px; /* Extra top padding to avoid overlap with fixed navbar */
            text-align: center;
        }

        .contact-section h1 {
            font-size: 48px;
            color: #0A1828;
            font-weight: bold;
            margin-bottom: 60px;
        }

        .contact-cards {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact-card {
            background: linear-gradient(90deg, #FFF1BF, #EAD196, #D4B06A);
            width: 300px;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-bottom: 4px solid #178582;
        }

        .contact-card i {
            font-size: 40px;
            color: #178582;
            margin-bottom: 20px;
        }

        .contact-card h3 {
            font-size: 20px;
            color: #0A1828;
            margin-bottom: 15px;
        }

        .contact-card p {
            color: #333;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .contact-card a,
        .button-help {
            display: inline-block;
            background-color: #178582;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .contact-card a:hover,
        .button-help:hover {
            background-color: #0A1828;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="brand">My Health Monitor</div>
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="about_us.php">About Us</a>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <h1>Contact Us</h1>

        <div class="contact-cards">
            <!-- First Contact Card -->
            <div class="contact-card">
                <i class="fas fa-phone-alt"></i>
                <h3>Talk to our Team</h3>
                <p>Need help with health tracking or alerts? Our team is here to assist you.</p>
                <a href="mailto:support@myhealthmonitor.com">Contact Support</a>
            </div>

            <!-- Second Contact Card -->
            <div class="contact-card">
                <i class="fas fa-info-circle"></i>
                <h3>Help Center</h3>
                <p>Find answers to common questions about your health monitoring system.</p>
                <button type="button" class="button-help">
                    Go to Help Center
                </button>
            </div>
        </div>
    </div>

</body>
</html>
