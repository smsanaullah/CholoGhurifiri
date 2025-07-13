<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tours_management";
    
    $connection = new mysqli($servername, $username, $password, $dbname);
    
    $result = $connection->query("SELECT * FROM customers WHERE email='$email'");
    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        $subject = "Password Reset OTP";
        $message = "Your OTP code is: $otp";
        $headers = "From: your_email@example.com";

        if (mail($email, $subject, $message, $headers)) {
            header("Location: verify_otp.php");
            exit();
        } else {
            echo "Failed to send OTP!";
        }
    } else {
        echo "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/log.css">

</head>
<body>
<div class="auth-container">
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter your Email" required>
        <button type="submit">Send OTP</button>
    </form>
    </div>
</body>
</html>
