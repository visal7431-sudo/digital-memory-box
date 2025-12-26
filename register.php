<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "vishal@2006#";
$dbname = "digital_memory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

$sql = "INSERT INTO users (username, email, password) 
        VALUES ('$user', '$email', '$pass')";

if ($conn->query($sql) === TRUE) {

    $user_id = $conn->insert_id;

    $_SESSION['user_id'] = $user_id;

    header("Location: dashboard.php");
    exit();
    
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
