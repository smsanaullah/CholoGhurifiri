<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connection.php'; 

if (isset($_GET['logout'])) {
    session_destroy(); 
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Admin login
    if ($email === 'sanaullah@admin.com' && $password === 'sana0') {
        $_SESSION['admin'] = true;
        $_SESSION['admin_name'] = 'Sanaullah';
        header("Location: admin_dashboard.php");
        exit;
    }

    // Customer login
    $query = "SELECT * FROM customers WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['customer_id'] = $user['customer_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php");
            exit;
        } else {
            header("Location: login.php?error=invalid");
            exit;
        }
    } else {
        header("Location: login.php?error=notfound");
        exit;
    }
}

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO customers (name, email, phone_number, address, password) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $phone_number, $address, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            echo "<script>alert('Error during registration: " . $stmt->error . "');</script>";
        }
    }
}

$connection->close();
?>
