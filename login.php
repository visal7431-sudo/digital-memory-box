<?php
session_start();

$conn = new mysqli("localhost", "root", "vishal@2006#", "digital_memory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    if ($password === $row['password']) {

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        header("Location: dashboard.php");
        exit();
    } 
    else {
        echo "<script>alert('Incorrect Password!'); window.location='login.html';</script>";
    }

} 
else {
    echo "<script>alert('User not found! Please register.'); window.location='register.html';</script>";
}

$conn->close();
?>
