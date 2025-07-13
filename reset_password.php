<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tours_management";


session_start();
if (!isset($_SESSION['email'])) {
    header("Location: forgot.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password === $cpassword) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $connection = new mysqli($servername, $username, $password, $dbname);

        $email = $_SESSION['email'];
        
        $update = $connection->query("UPDATE customers SET password='$hashed_password' WHERE email='$email'");

        if ($update) {
            unset($_SESSION['otp']);
            unset($_SESSION['email']);
            echo "Password updated successfully! <a href='login.php'>Login now</a>";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>

<div class="auth-container">
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="cpassword" placeholder="Confirm New Password" required>
        <button type="submit">Reset Password</button>
    </form>
    </div>
</body>
</html>
