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
    <title>All ThingSpeak Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Responsive meta tag -->
    <style>
        body {
            font-family: sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            margin: 0;
            padding-top: 70px;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        nav {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
        }

        nav h1 {
            margin: 0;
            font-size: 24px;
        }

        nav .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-end;
        }

        nav a.nav-link,
        nav a.logout-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 6px;
        }

        nav a.nav-link:hover {
            color: #ffd700;
        }

        nav a.logout-link:hover {
            background-color: #dc3545;
        }

        .data-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 960px;
            margin: auto;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .timestamp {
            font-size: 0.9em;
            color: #777;
        }

        .error-message, .no-data-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<nav>
    <h1>My Health Monitor</h1>
    <div class="nav-links">
        <a href="profile.php" class="nav-link">Profile</a>
        <a class="nav-link" href="dashboard.php">Dashboard</a>
        <a class="nav-link" href="real_time.php">Real Time</a>
        <a class="nav-link" href="graph.php">Graph</a>
        <a class="logout-link" href="logout.php">Logout</a>
    </div>
</nav>

<div class="data-container">
    <h2>All Readings Data Table</h2>

    <?php
    $channelId = "2918411"; // Replace with your ThingSpeak Channel ID
    $format = "json";
    $apiKey = "G874TJS2Y8864Y8O";
    $url = "https://api.thingspeak.com/channels/" . $channelId . "/feeds." . $format;

    if (!empty($apiKey)) {
        $url .= (strpos($url, '?') === false) ? "?api_key=" . $apiKey : "&api_key=" . $apiKey;
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo '<p class="error-message">cURL error: ' . curl_error($ch) . '</p>';
    } else {
        $data = json_decode($response, true);

        if ($data && isset($data['feeds']) && is_array($data['feeds']) && !empty($data['feeds'])) {
            echo '<table>';
            echo '<thead><tr><th>Entry ID</th><th>Created At</th><th>Temperature</th><th>Heart Rate</th><th>Oxygen Level</th></tr></thead>';
            echo '<tbody>';

            foreach ($data['feeds'] as $feed) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($feed['entry_id']) . '</td>';
                echo '<td>' . htmlspecialchars($feed['created_at']) . '</td>';

                for ($i = 1; $i <= 3; $i++) { // Only displaying the first 3 fields (Temperature, Heart Rate, Oxygen Level)
                    $fieldName = 'field' . $i;
                    if (isset($feed[$fieldName])) {
                        echo '<td>' . htmlspecialchars($feed[$fieldName]) . '</td>';
                    } else {
                        echo '<td>--</td>';
                    }
                }

                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p class="no-data-message">No data received from the ThingSpeak channel.</p>';
        }
    }

    curl_close($ch);
    ?>
</div>

</body>
</html>
