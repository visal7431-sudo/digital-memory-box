<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$conn = new mysqli("localhost", "root", "vishal@2006#", "digital_memory");
if ($conn->connect_error) {
  die("DB_ERROR");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT username, email FROM users WHERE id = $user_id LIMIT 1";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Profile</title>
  <link rel="stylesheet" href="profile.css"> 
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
    <a href="logout.php">Logout</a>
  </div>

  <div class="dashboard">
    <h1>My Profile</h1>

    <div style="background: #f0f0f0; padding: 20px; border-radius: 10px; margin: 20px 0;">
      <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <h3>Update Profile</h3>

    <form method="post" action="update_profile.php">
      <input type="text" name="full_name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <button type="submit">Update Profile</button>
    </form>
  </div>

</body>

</html>