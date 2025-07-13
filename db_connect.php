<?php
$host = 'localhost'; // ডেটাবেস হোস্ট
$dbname = 'travel_management'; // ডেটাবেস নাম
$username = 'root'; // ডেটাবেস ইউজারনেম
$password = ''; // ডেটাবেস পাসওয়ার্ড

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>