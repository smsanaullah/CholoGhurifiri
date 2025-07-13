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

    // Validate form inputs
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
    $review_text = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    // Basic Validation
    if ($booking_id > 0 && !empty($review_text) && $rating >= 1 && $rating <= 5) {

        // Prepare Insert Query
        $stmt = $connection->prepare("INSERT INTO reviews (customer_id, booking_id, review_text, rating, created_at) VALUES (?, ?, ?, ?, NOW())");

        if ($stmt) {
            $stmt->bind_param("iisi", $customer_id, $booking_id, $review_text, $rating);

            if ($stmt->execute()) {
                // Success - Redirect to dashboard
                header("Location: dashboard.php?success=Review submitted successfully!");
                exit;
            } else {
                echo "Database error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to prepare statement.";
        }

    } else {
        echo "Please fill all fields correctly.";
    }
} else {
    echo "Invalid request.";
}
?>
