<?php
if (isset($_POST['reset_request'])) {
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "tour_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50)); // Generate random token
        $expire_time = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store token in database
        $sql = "UPDATE users SET reset_token='$token', reset_expire='$expire_time' WHERE email='$email'";
        $conn->query($sql);

        // Send email (This part needs a real mail server)
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        echo "Password reset link: <a href='$reset_link'>$reset_link</a>"; // For testing purpose

    } else {
        echo "No account found with this email!";
    }
}
?>
