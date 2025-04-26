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

// Handle sign up
if (isset($_POST['signup'])) {
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    // Check if admin already exists
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_name = ?");
    $stmt->execute([$admin_name]);
    if ($stmt->rowCount() > 0) {
        $error = "Admin name already taken.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO admin (admin_name, admin_pass) VALUES (?, ?)");
        if ($stmt->execute([$admin_name, $admin_pass])) {
            $success = "Admin account created successfully. Please login.";
        } else {
            $error = "Failed to create admin account.";
        }
    }
}

// Handle login
if (isset($_POST['login'])) {
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_name = ?");
    $stmt->execute([$admin_name]);
    $admin = $stmt->fetch();

    if ($admin && $admin['admin_pass'] === $admin_pass) {
        $_SESSION['admin_name'] = $admin_name;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid admin name or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel Login</title>
    <style>
        /* You can reuse the same CSS from your previous file */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0px 0;
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

        .main-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 70px);
            padding-top: 30px;
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

        input[type="text"],
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
    <h1>Admin Portal</h1>
</nav>

<div class="main-wrapper">
    <div class="container">
        <h2>Admin Login / Sign Up</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

        <div class="form-section">
            <form method="post">
                <h3>Create Admin Account</h3>
                <input type="text" name="admin_name" placeholder="Enter admin name" required>
                <input type="password" name="admin_pass" placeholder="Create a password" required>
                <button type="submit" name="signup">Sign Up</button>
            </form>

            <form method="post">
                <h3>Admin Login</h3>
                <input type="text" name="admin_name" placeholder="Enter admin name" required>
                <input type="password" name="admin_pass" placeholder="Enter password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
