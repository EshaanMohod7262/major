<?php 
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: admin.php");
    exit();
}

// Database connection
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

// Fetch data from users and profile tables
$query = "
    SELECT 
        users.id AS user_id, users.email, users.pass, users.time,
        profile.name, profile.address, profile.age, 
        profile.phone_no, profile.phone_no_1, profile.phone_no_2,
        profile.blood_pressure, profile.sugar, profile.blood_group
    FROM users
    LEFT JOIN profile ON users.id = profile.id
    ORDER BY users.id ASC
";
$stmt = $pdo->query($query);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: #f6f8fb;
            color: #333;
        }

        header {
            background-color: #0d6efd;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #b02a37;
        }

        .container {
            padding: 30px 40px;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #0d6efd;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 1000px;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #0d6efd;
            color: white;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tr:hover {
            background-color: #f1f5ff;
            transition: 0.3s;
        }

        @media screen and (max-width: 768px) {
            header, .container {
                padding: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
</header>

<div class="container">
    <h2>Users and Profile Data</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Registered Time</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Phone No</th>
                    <th>Phone No 1</th>
                    <th>Phone No 2</th>
                    <th>Blood Pressure</th>
                    <th>Sugar</th>
                    <th>Blood Group</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['pass']); ?></td>
                    <td><?php echo htmlspecialchars($row['time']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_no_1']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_no_2']); ?></td>
                    <td><?php echo htmlspecialchars($row['blood_pressure']); ?></td>
                    <td><?php echo htmlspecialchars($row['sugar']); ?></td>
                    <td><?php echo htmlspecialchars($row['blood_group']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
