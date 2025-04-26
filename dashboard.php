<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$uploadDir = __DIR__ . "/uploads/";
$webPath = "uploads/";
$metadataFile = $uploadDir . "metadata.json";

if (!is_dir($uploadDir)) mkdir($uploadDir);
$metadata = file_exists($metadataFile) ? json_decode(file_get_contents($metadataFile), true) : [];

// Handle delete
if (isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']);
    $filePath = $uploadDir . $fileToDelete;
    if (file_exists($filePath)) {
        unlink($filePath);
        unset($metadata[$fileToDelete]);
        file_put_contents($metadataFile, json_encode($metadata));
        header("Location: dashboard.php");
        exit;
    }
}

// Handle upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $uniqueName = uniqid() . '_' . basename($file["name"]);
    $targetFilePath = $uploadDir . $uniqueName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png", "gif", "pdf"];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            $metadata[$uniqueName] = [
                "email" => $email,
                "timestamp" => date("d-m-Y h:i A")
            ];
            file_put_contents($metadataFile, json_encode($metadata));
        }
    }
}

// Prepare user's uploaded files
$files = array_diff(scandir($uploadDir), ['.', '..', 'metadata.json']);
$userFiles = [];

foreach ($files as $file) {
    if (!isset($metadata[$file])) continue;
    if ($metadata[$file]['email'] === $email) {
        $userFiles[filemtime($uploadDir . $file)] = [
            "name" => $file,
            "timestamp" => $metadata[$file]['timestamp']
        ];
    }
}

krsort($userFiles); // Sort by newest
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Document Locker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        nav h1 {
            margin: 0;
            font-size: 30px;
        }

        nav a.nav-link {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.2s ease;
        }

        nav a.nav-link:hover {
            color: #ffd700;
        }

        nav a.logout-link {
            color: white;
            background-color: transparent;
            margin-left: 20px;
            font-weight: bold;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a.logout-link:hover {
            background-color: #dc3545;
            color: white;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 30px;
        }

        input[type="file"] {
            padding: 10px;
            border-radius: 8px;
            background: #f9f9f9;
            border: 1px solid #ccc;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
            width: 300px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card img, .card iframe {
            width: 100%;
            border-radius: 8px;
            height: auto;
            max-height: 400px;
            object-fit: contain;
        }

        .meta {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        .card-actions a {
            text-decoration: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
        }

        .download-btn {
            background: #28a745;
        }

        /* Modal Styles */
        #popupModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #popupModal .modal-content {
            background: white;
            padding: 20px;
            border-radius: 12px;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }

        #popupModal img {
            max-width: 100%;
            max-height: 70vh;
            margin-top: 20px;
            border-radius: 10px;
        }

        .modal-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .close-btn {
            background: #ffc107;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        * {
            box-sizing: border-box;
            max-width: 100%;
        }
    </style>
</head>
<body>

<nav>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">My Health Monitor</h1>
        <div>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="real_time.php" class="nav-link">Real Time</a>
            <a href="all_data.php" class="nav-link">All Data</a>
            <a href="graph.php" class="nav-link">Graph</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($email); ?></h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <div class="grid">
        <?php foreach ($userFiles as $file): 
            $filePath = $webPath . $file['name'];
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $isPdf = strtolower($ext) === 'pdf';
        ?>
        <div class="card">
            <?php if ($isPdf): ?>
                <iframe src="<?php echo $filePath; ?>"></iframe>
            <?php else: ?>
                <img src="<?php echo $filePath; ?>" alt="<?php echo $file['name']; ?>" onclick="openModal('<?php echo $filePath; ?>', '<?php echo urlencode($file['name']); ?>')">
            <?php endif; ?>
            <div class="meta">Uploaded on <?php echo $file['timestamp']; ?></div>
            <div class="card-actions">
                <a class="download-btn" href="<?php echo $filePath; ?>" download>Download</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div id="popupModal">
    <div class="modal-content">
        <button onclick="closeModal()" class="close-btn">Close</button>
        <br>
        <img id="popupImage" src="" />
        <br><br>
        <a id="downloadBtn" class="modal-btn" href="#" download>Download</a>
        <a id="deleteBtn" class="delete-btn" href="#">Delete</a>
    </div>
</div>

<script>
function openModal(imageSrc, fileName) {
    document.getElementById('popupImage').src = imageSrc;
    document.getElementById('downloadBtn').href = imageSrc;
    document.getElementById('deleteBtn').href = '?delete=' + fileName;
    document.getElementById('popupModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('popupModal').style.display = 'none';
}
</script>

</body>
</html>
