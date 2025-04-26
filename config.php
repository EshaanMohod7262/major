<?php
$host = '46.202.182.96'; // or the Hostinger MySQL host, often like "mysql.hostinger.in"
$db = "u493446868_health_users";
$user = "u493446868_users_databse";
$pass = "Eshaan7262965104";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
