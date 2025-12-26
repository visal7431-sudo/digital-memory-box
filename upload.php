<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Login first.");
}
$conn = new mysqli("localhost", "root", "vishal@2006#", "digital_memory");

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$memory_date = $_POST['memory_date'];

$fileName = "";
if (!empty($_FILES['file']['name'])) {
    $fileName = time() . "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $fileName);
}
$sql = "INSERT INTO memories (user_id, title, description, image, memory_date) VALUES ('$user_id', '$title', '$description', '$fileName', '$memory_date')";
if ($conn->query($sql)) {
    header("Location: dashboard.php");
} else {
    echo "Error: " . $conn->error;
} ?>