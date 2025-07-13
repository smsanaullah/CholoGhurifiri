<?php
session_start();
include 'db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

$customer_id = $_SESSION['customer_id'];

$query = "SELECT * FROM customers WHERE customer_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

if (!$customer) {
    echo "<script>alert('Customer not found. Please login again.');</script>";
    header("Location: login.php");
    exit;
}

$query = "SELECT b.* FROM bookings b JOIN customers c ON b.customer_id = c.customer_id WHERE c.customer_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$bookings_result = $stmt->get_result();
$bookings = $bookings_result->fetch_all(MYSQLI_ASSOC);


$query = "SELECT r.*, b.location FROM reviews r JOIN bookings b ON r.booking_id = b.id WHERE r.customer_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$reviews_result = $stmt->get_result();
$reviews = $reviews_result->fetch_all(MYSQLI_ASSOC);


$stmt = $connection->prepare("SELECT * FROM book WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<section class="header">
    <a href="index.php" class="logo">Cholo GhuriFiri.</a>
    <nav class="navbar">
        <a href="index.php">home</a>
        <a href="about.php">about</a>
        <a href="package.php">package</a>
        <a href="tour.php">Make a Tour</a>
        <?php if (isset($_SESSION['customer_id'])) : ?>
            <?php if (basename($_SERVER['PHP_SELF']) !== 'dashboard.php'): ?>
                <a href="dashboard.php" class="btn">Dashboard</a>
            <?php endif; ?>
            <a href="logout.php" class="btn">Logout</a>
        <?php else : ?>
            <a href="login.php" class="btn">Login</a>
            <a href="register.php" class="btn">Register</a>
        <?php endif; ?>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</section>




<div class="dashboard-container">
    <h1>Welcome, <?= htmlspecialchars($customer['name']) ?></h1>
    <p>Email: <?= htmlspecialchars($customer['email']) ?></p>
    <p>Phone: <?= htmlspecialchars($customer['phone_number']) ?></p>
    <p>Address: <?= htmlspecialchars($customer['address']) ?></p>




    <h2>Package Bookings:</h2>
    <?php if ($result->num_rows > 0): ?>
    <table border="1">
    <tr>
        <th>Location</th>
        <th>Travel Date</th>
        <th>Travel Time</th>
        <th>Hotel Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Booking Time</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo htmlspecialchars($row['travel_date']); ?></td>
            <td><?php echo htmlspecialchars($row['travel_time']); ?></td>
            <td><?php echo htmlspecialchars($row['hotel_name']); ?></td>
            <td><?php echo htmlspecialchars($row['price']); ?> BDT</td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td><?php echo htmlspecialchars($row['booking_time']); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p>No bookings found. Start planning your next trip!</p>
<?php endif; ?>


    <h2>You Make The Tours:</h2>
<?php if (!empty($bookings)): ?>
    <div style="overflow-x:auto;">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Location</th>
                    <th>Travel By</th>
                    <th>Hotel Type</th>
                    <th>Hotel Name</th>
                    <th>Days</th>
                    <th>Guests</th>
                    <th>Arrival Date</th>
                    <th>Total Cost (Tk)</th>
                    <th>Status</th> <!-- new column -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['location'])) ?></td>
                        <td><?= htmlspecialchars($row['travel_by']) ?></td>
                        <td><?= htmlspecialchars($row['hotelType']) ?></td>
                        <td><?= htmlspecialchars($row['hotelName']) ?></td>
                        <td><?= htmlspecialchars($row['days']) ?></td>
                        <td><?= htmlspecialchars($row['guests']) ?></td>
                        <td><?= htmlspecialchars($row['arrivals']) ?></td>
                        <td><?= htmlspecialchars($row['totalCost']) ?> Tk</td>
                        <td><?= htmlspecialchars($row['status']) ?></td> <!-- new cell -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No bookings found. Start planning your next trip!</p>
<?php endif; ?>


<h2>Your Reviews</h2>
<?php if (count($reviews) > 0): ?>
    <table border="1">
        <tr>
            <th>Location</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Date</th>
        </tr>
        <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?= htmlspecialchars($review['location']) ?></td>
            <td><?= htmlspecialchars($review['review_text']) ?></td>
            <td><?= htmlspecialchars($review['rating']) ?>/5</td>
            <td><?= htmlspecialchars($review['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No reviews yet. Share your experience!</p>
<?php endif; ?>




<h2>Submit a Review</h2>
<form action="submit_review.php" method="POST">
    <select name="booking_id" required>
        <option value="" disabled selected>Select Booking</option>
        <?php foreach ($bookings as $booking): ?>
            <option value="<?= $booking['id'] ?>"><?= htmlspecialchars($booking['location']) ?></option>
        <?php endforeach; ?>
    </select>
    <textarea name="review_text" placeholder="Write your review here..." required></textarea>
    <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
    <button type="submit" class="btn">Submit Review</button>
</form>


</div>

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="index.php"><i class="fas fa-angle-right"></i> home</a>
            <a href="about.php"><i class="fas fa-angle-right"></i> about</a>
            <a href="package.php"><i class="fas fa-angle-right"></i> package</a>
            <a href="book.php"><i class="fas fa-angle-right"></i> book</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="#"><i class="fas fa-angle-right"></i> ask questions</a>
            <a href="#"><i class="fas fa-angle-right"></i> about us</a>
            <a href="#"><i class="fas fa-angle-right"></i> privacy policy</a>
            <a href="#"><i class="fas fa-angle-right"></i> terms of use</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="#"><i class="fas fa-phone"></i> +8801815463141</a>
            <a href="#"><i class="fas fa-phone"></i> +8801715463141</a>
            <a href="#"><i class="fas fa-envelope"></i> chuloghurifiri@gmail.com</a>
            <a href="#"><i class="fas fa-map"></i> mohammadpur, dhaka, bangladesh - 1200</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
            <a href="#"><i class="fab fa-twitter"></i>twitter</a>
            <a href="#"><i class="fab fa-instagram"></i>instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
        </div>
    </div>

    <div class="credit">created by <span>Sanaullah, Jihad</span> || Software_Project </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
