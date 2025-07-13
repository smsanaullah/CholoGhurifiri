<?php
session_start();
include 'db_connection.php';

if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];

    $stmt = $connection->prepare("SELECT customer_id FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $otp = rand(100000, 999999); 
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_otp'] = $otp;

        $subject = "OTP for Password Reset - Cholo GhuriFiri";
        $message = "Your OTP is: $otp. Use this to reset your password.";
        $headers = "From: ssm01886@gmail.com";

        mail($email, $subject, $message, $headers); 

        header("Location: verify_otp.php");
        exit;
    } else {
        echo "Email not found!";
    }
}
?>
