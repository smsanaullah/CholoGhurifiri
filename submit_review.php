<?php
session_start();
include 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);



if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $customer_id = $_SESSION['customer_id'];

    // Validate form data
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
    $review_text = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    if ($booking_id > 0 && !empty($review_text) && $rating >= 1 && $rating <= 5) {

        $stmt = $connection->prepare("INSERT INTO reviews (customer_id, booking_id, review_text, rating, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iisi", $customer_id, $booking_id, $review_text, $rating);

        if ($stmt->execute()) {
            header("Location: dashboard.php"); // Success redirect
            exit;
        } else {
            echo "Database error: " . $stmt->error;
        }

    } else {
        echo "Please fill all fields correctly.";
    }
} else {
    echo "Invalid request.";
}
?>
