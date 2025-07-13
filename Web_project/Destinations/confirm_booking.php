<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: package.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$package_id = $_GET['id'];

$sql = "INSERT INTO bookings (user_id, package_name, status) VALUES ('$user_id', '$package_id', 'pending')";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Booking request sent!'); window.location.href='dashboard.php';</script>";
} else {
    echo "Error: " . $conn->error;
}
?>
