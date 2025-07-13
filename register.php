<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <div class="auth-container">
        <h2>Register</h2>
        <form action="auth.php" method="POST">
            <input type="text" name="name" placeholder="Enter Full Name" required>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="text" name="phone_number" placeholder="Enter Phone Number" required>
            <textarea name="address" placeholder="Enter Address"></textarea>
            <input type="password" name="password" placeholder="Enter Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>


<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("Error: All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match.");
    }
    if (strlen($password) < 6) {
        die("Error: Password must be at least 6 characters long.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: Registration failed.";
    }

    $stmt->close();
    $conn->close();
}
?>

