<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$host = '46.202.182.96';
$db = 'u493446868_health_users';
$user = 'u493446868_users_databse';
$pass = 'Eshaan7262965104';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$email = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    die("User not found.");
}

$user_id = $user['id'];

$stmt = $pdo->prepare("SELECT * FROM profile WHERE id = ?");
$stmt->execute([$user_id]);
$profile = $stmt->fetch();

if (!$profile) {
    echo "<p style='text-align:center; color:red;'>Profile not found. Please create your profile.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ffc107;
        }

        .profile-container {
            background-color: white;
            max-width: 700px;
            margin: 50px auto;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 26px;
        }

        .profile-row {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
        }

        .material-icons {
            color: #007bff;
            margin-right: 15px;
        }

        .label {
            font-weight: 600;
            min-width: 160px;
            color: #444;
        }

        .value {
            color: #555;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 20px;
                margin: 30px 15px;
            }

            .profile-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<nav>
    <h1>My Health Monitor</h1>
    <div class="nav-links">
        <a href="dashboard.php">Dashboard</a>
        <a href="real_time.php">Real Time</a>
        <a href="all_data.php">All Data</a>
        <a href="graph.php">Graph</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="profile-container">
    <h2>Your Profile</h2>

    <div class="profile-row"><span class="material-icons">person</span><span class="label">Name:</span><span class="value"><?= htmlspecialchars($profile['name']) ?></span></div>
    <div class="profile-row"><span class="material-icons">home</span><span class="label">Address:</span><span class="value"><?= htmlspecialchars($profile['address']) ?></span></div>
    <div class="profile-row"><span class="material-icons">calendar_today</span><span class="label">Age:</span><span class="value"><?= htmlspecialchars($profile['age']) ?></span></div>
    <div class="profile-row"><span class="material-icons">call</span><span class="label">Phone No:</span><span class="value"><?= htmlspecialchars($profile['phone_no']) ?></span></div>
    <div class="profile-row"><span class="material-icons">contact_phone</span><span class="label">Alternate Phone 1:</span><span class="value"><?= htmlspecialchars($profile['phone_no_1']) ?></span></div>
    <div class="profile-row"><span class="material-icons">contact_phone</span><span class="label">Alternate Phone 2:</span><span class="value"><?= htmlspecialchars($profile['phone_no_2']) ?></span></div>
    <div class="profile-row"><span class="material-icons">favorite</span><span class="label">Blood Pressure:</span><span class="value"><?= $profile['blood_pressure'] ? 'Yes' : 'No' ?></span></div>
    <div class="profile-row"><span class="material-icons">opacity</span><span class="label">Sugar:</span><span class="value"><?= $profile['sugar'] ? 'Yes' : 'No' ?></span></div>
    <div class="profile-row"><span class="material-icons">local_hospital</span><span class="label">Blood Group:</span><span class="value"><?= htmlspecialchars($profile['blood_group']) ?></span></div>
</div>

</body>
</html>
