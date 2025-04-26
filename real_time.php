<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thingspeak Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            overflow-x: hidden;
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

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        nav h1 {
            margin: 0;
            font-size: 26px;
            white-space: nowrap;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .nav-link,
        .logout-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.2s ease;
            white-space: nowrap;
        }

        .nav-link:hover {
            color: #ffd700;
        }

        .logout-link {
            padding: 8px 14px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .logout-link:hover {
            background-color: #dc3545;
            color: white;
        }

        .data-container {
            max-width: 500px;
            max-height: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .data-item {
            margin-bottom: 10px;
            color: #555;
        }

        .label {
            font-weight: bold;
            margin-right: 5px;
            color: #333;
        }

        @media (max-width: 768px) {
            nav h1 {
                font-size: 20px;
                margin-bottom: 10px;
            }

            .nav-links {
                gap: 10px;
            }

            .nav-link,
            .logout-link {
                font-size: 14px;
            }

            .data-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-container">
        <h1>My Health Monitor</h1>
        <div class="nav-links">
            <a href="profile.php" class="nav-link">Profile</a>
            <a class="nav-link" href="dashboard.php">Dashboard</a>
            <a class="nav-link" href="all_data.php">All Data</a>
            <a class="nav-link" href="graph.php">Graph</a>
            <a class="logout-link" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="data-container">
    <h2>Latest Sensor Readings</h2>

    <?php
    $apiKey = "G874TJS2Y8864Y8O";
    $url = "https://api.thingspeak.com/channels/2918411/feeds/last.json?api_key=" . $apiKey;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo '<p style="color: red;">cURL error: ' . curl_error($ch) . '</p>';
    } else {
        $data = json_decode($response, true);

        if ($data && !empty($data)) {
            if (isset($data['field1'])) {
                echo '<div class="data-item"><span class="label">Temperature:</span> ' . htmlspecialchars($data['field1']) . ' °C</div>';
            }
            if (isset($data['field2'])) {
                echo '<div class="data-item"><span class="label">Heart Rate:</span> ' . htmlspecialchars($data['field2']) . ' bpm</div>';
            }
            if (isset($data['field3'])) {
                echo '<div class="data-item"><span class="label">Oxygen Level:</span> ' . htmlspecialchars($data['field3']) . ' %</div>';
            }
        } else {
            echo '<p style="color: orange;">No data received or an error occurred while decoding the JSON.</p>';
        }
    }

    curl_close($ch);
    ?>
</div>

</body>
</html>
