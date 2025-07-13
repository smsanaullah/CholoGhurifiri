<?php
session_start();
if (!isset($_SESSION['otp'])) {
    header("Location: forgot.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = $_POST['otp'];
    if ($user_otp == $_SESSION['otp']) {
        header("Location: reset_password.php");
        exit();
    } else {
        echo "Invalid OTP. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="css/log.css">

</head>
<body>

<div class="auth-container">
    <h2>Verify OTP</h2>
    <form method="POST">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit">Verify</button>
    </form>
    </div>
</body>
</html>
