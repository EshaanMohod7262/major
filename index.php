<?php
session_start();

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

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Email already registered.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (email, pass) VALUES (?, ?)");
        if ($stmt->execute([$email, $password])) {
            $user_id = $pdo->lastInsertId();
            $_SESSION['user_id'] = $user_id;
            header("Location: create_profile.php");
            exit();
        } else {
            $error = "Failed to create user.";
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && $user['pass'] === $password) {
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document Locker | Secure Access</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #c9d6ff, #e2e2e2);
            overflow-x: hidden;
            width: 100%;
        }

        nav {
            background-color: #007bff;
            color: white;
            padding: 20px 40px;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h1 {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            background-color: #0056b3;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #004494;
        }

        .main-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 100px);
            padding-top: 40px;
        }

        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #D8000C;
            background-color: #FFD2D2;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            padding: 10px;
            border-radius: 5px;
        }

        h3 {
            color: #444;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<nav>
    <h1>My Health Monitor</h1>
    <a href="home.php">Home</a>
</nav>

<div class="main-wrapper">
    <div class="container">
        <h2>Welcome to My Health Monitor</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <div class="form-section">
            <form method="post">
                <h3>Create an Account</h3>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Create a password" required>
                <button type="submit" name="signup">Sign Up</button>
            </form>

            <form method="post">
                <h3>Login to Your Account</h3>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
