<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("LOGIN_REQUIRED");
}

$uid = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "vishal@2006#", "digital_memory");

$res = $conn->query("SELECT * FROM memories WHERE user_id='$uid' ORDER BY id DESC");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css" />


    <style>
        .nav {
            background: #0a2a43;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 20px;
            border-radius: 10px;
        }

        .nav .main {
            color: #fff;
            font-size: 22px;
            font-weight: bold;
            margin-right: auto;
        }

        .nav a {
            color: #cfd9e1;
            font-size: 16px;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
        }

        .nav a:hover {
            background: #154b70;
            color: #fff;
        }
    </style>

</head>

<body>

    <div class="nav">
        <div class="main">Digital Memory Box</div>
        <a href="dashboard.php">Home</a>
        <a href="upload.html">Upload</a>
        <a href="memories.php">Memories</a>
        <a href="profile.php">Profile</a>
        <a href="login.html">Logout</a>
    </div>

    <div class="dashboard">
        <h1>Welcome To The Digital Memory Box!</h1>
        <h2>Your Memories</h2>

        <div id="memories-container">
            <?php
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo "<div class='memory'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";

                    if ($row['image'] != "") {
                        echo "<img src='uploads/" . $row['image'] . "' />";
                    }

                    echo "</div>";

                }
            } else {
                echo "<p>No memories found.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>