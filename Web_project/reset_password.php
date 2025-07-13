<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "tour_db");

    $sql = "SELECT * FROM users WHERE reset_token='$token' AND reset_expire > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        if (isset($_POST['reset_password'])) {
            $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $sql = "UPDATE users SET password='$new_password', reset_token=NULL, reset_expire=NULL WHERE reset_token='$token'";
            $conn->query($sql);
            echo "Password reset successful! <a href='login.php'>Login here</a>";
        }
    } else {
        echo "Invalid or expired reset link!";
    }
} else {
    echo "Invalid request!";
}
?>

<form method="POST">
    <input type="password" name="password" placeholder="Enter New Password" required>
    <button type="submit" name="reset_password">Reset Password</button>
</form>
