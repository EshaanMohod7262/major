<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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

if (isset($_POST['submit_profile'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $phone_no = $_POST['phone_no'];
    $phone_no_1 = $_POST['phone_no_1'];
    $phone_no_2 = $_POST['phone_no_2'];
    $blood_pressure = isset($_POST['blood_pressure']) ? 1 : 0;
    $sugar = isset($_POST['sugar']) ? 1 : 0;
    $blood_group = $_POST['blood_group'];

    $stmt = $pdo->prepare("INSERT INTO profile (id, name, address, age, phone_no, phone_no_1, phone_no_2, blood_pressure, sugar, blood_group)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$user_id, $name, $address, $age, $phone_no, $phone_no_1, $phone_no_2, $blood_pressure, $sugar, $blood_group])) {
        unset($_SESSION['user_id']);
        header("Location: index.php?success=1");
        exit();
    } else {
        $error = "Failed to save profile.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
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
            text-align: center;
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            padding: 40px 10px;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s ease;
        }

        .form-group input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .checkbox-group {
            margin-bottom: 15px;
            display: flex;
            gap: 20px;
        }

        .checkbox-group label {
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #3a7bd5;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 25px;
            }

            .checkbox-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <h1>My Health Monitor</h1>
    </nav>

    <div class="wrapper">
        <div class="form-container">
            <h2>Create Your Profile</h2>
            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <input type="number" name="age" placeholder="Age" required>
                </div>
                <div class="form-group">
                    <input type="number" name="phone_no" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <input type="number" name="phone_no_1" placeholder="Alternate Phone Number 1">
                </div>
                <div class="form-group">
                    <input type="number" name="phone_no_2" placeholder="Alternate Phone Number 2">
                </div>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="blood_pressure"> Blood Pressure</label>
                    <label><input type="checkbox" name="sugar"> Sugar</label>
                </div>
                <div class="form-group">
                    <input type="text" name="blood_group" placeholder="Blood Group" required>
                </div>
                <button type="submit" name="submit_profile" class="btn-submit">Submit Profile</button>

            </form>
        </div>
    </div>

</body>
</html>
