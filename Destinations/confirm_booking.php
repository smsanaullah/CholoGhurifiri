<?php
session_start();
include '../db_connection.php'; 

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../package.php");
    exit();
}

$package_id = $_GET['id'];
$discount = $_GET['discount'];
$discount_price = $_GET['discount_price'];


$packages = [
    "coxsbazar" => [
        "title" => "Cox’s Bazar Tour Package",
        "travel_date" => "10 March TO 13 March",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Luxury & Standard",
        "hotel_name" => "Sayeman Beach Resort",
    ],
    "saintmartin" => [
        "title" => "Saint Martin's Island Tour Package",
        "travel_date" => "15 March TO 18 March",
        "travel_time" => "11:00 PM - 7:00 AM",
        "travel_type" => "Luxury & Standard",
        "hotel_name" => "Blue Marine Resort / Coral View Resort",    
    ],
    "sundarbans" => [
        "title" => "Sundarbans Tour Package",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Boat Tour",
        "hotel_type" => "3 Star",
        "hotel_name" => "Forest Eco Lodge"
    ],

    "srimangal" => [
        "title" => "Srimangal",
        "travel_date" => "15 May 2025 ",
        "travel_time" => "10:00 PM - 6:00 Ap ",
        "travel_type" => "Eco-Tour ",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Tea Resort & Eco Park "
    ],

    "kuakata" => [
        "title" => "Kuakata",
        "travel_date" => "15 May 2025 ",
        "travel_time" => "10:00 PM - 6:00 Ap ",
        "travel_type" => "Beach Tour ",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Kuakata Grand Hotel "
    ],

    "amiakhum" => [
        "title" => "Amiakhum Waterfall",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Adventure Trek ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Local Homestay "
    ],

    "sonargaon" => [
        "title" => "Sonargaon",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Historical Tour",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Sonargaon Heritage Inn "
    ],

    "jaflong" => [
        "title" => "Jaflong",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Nature Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Jaflong View Resort "

    ],

    "sylhet" => [
        "title" => "Sylhet",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Cultural Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Rose View Hotel "

    ],

    "sajek" => [
        "title" => "Sajek Valley",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Hill Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Sajek Hill Resort "
    ]
];

if (!isset($packages[$package_id])) {
    echo "Package not found!";
    exit();
}

$package = $packages[$package_id];
$customer_id = $_SESSION['customer_id'];

$stmt = $connection->prepare("INSERT INTO book (customer_id, location, travel_date, travel_time, hotel_name, price, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$status = 'Pending';
$stmt->bind_param("issssss", $customer_id, $package['title'], $package['travel_date'], $package['travel_time'], $package['hotel_name'], $discount_price , $status);



if ($stmt->execute()) {
    echo "<h2 style='color: green; text-align: center; margin-top: 50px;'>Your booking was successful!</h2>";
    echo "<p style='text-align: center;'>Redirecting to your dashboard...</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = '../dashboard.php';
            }, 2500); 
          </script>";
    exit();
} else {
    echo "<h2 style='color: red; text-align: center; margin-top: 50px;'>Booking Failed: " . htmlspecialchars($stmt->error) . "</h2>";
}
?>