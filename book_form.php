<?php
session_start();
include 'db_connection.php'; 

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

$customer_id = $_SESSION['customer_id']; 

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $travel_by = mysqli_real_escape_string($connection, $_POST['travel_by']);
    $hotelType = mysqli_real_escape_string($connection, $_POST['hotelType']);
    $hotelName = mysqli_real_escape_string($connection, $_POST['hotelName']);
    $days = mysqli_real_escape_string($connection, $_POST['days']);
    $guests = mysqli_real_escape_string($connection, $_POST['guests']);
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $totalCost = mysqli_real_escape_string($connection, $_POST['totalCost']);

    $query = "INSERT INTO bookings (customer_id, name, email, phone, address, location, travel_by, hotelType, hotelName, days, guests, arrivals, totalCost)
              VALUES ('$customer_id', '$name', '$email', '$phone', '$address', '$location', '$travel_by', '$hotelType', '$hotelName', '$days', '$guests', '$arrivals', '$totalCost')";

    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Booking Successful!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
