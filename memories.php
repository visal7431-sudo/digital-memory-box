<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "vishal@2006#", "digital_memory");
$res = $conn->query("SELECT * FROM memories WHERE user_id=$user_id ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>

<head>
  <title>My Memories</title>
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

    /* memory pic */

.memory {
  width: 330px;
  background: #fff;
  padding: 0;
  margin: 65px;
  border-radius: 15px;
  font-family: 'Times New Roman', Times, serif;
  display: flex;
  float: left;

}

.memory h3 {
  margin: 15px;
  font-size: 20px;
  color: #222;
}

.memory p {
  margin: 0 15px 15px 15px;
  color: #666;
  font-size: 14px;
}

.memory img {
  width: 100%;
  height: 220px;
  object-fit: cover;
  display: block;
  float: left;
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


  <h1>All Uploaded Memories</h1>

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

</body>

</html>