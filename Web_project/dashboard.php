<?php
session_start();
include 'db.php'; 

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

$query = "SELECT * FROM book_form WHERE customer_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$bookings_result = $stmt->get_result();
$bookings = $bookings_result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT r.*, b.location FROM reviews r JOIN book_form b ON r.booking_id = b.id WHERE r.customer_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$reviews_result = $stmt->get_result();
$reviews = $reviews_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reviews.css">

</head>
<body>
    <section class="header">
        <a href="home.php" class="logo">travel.</a>
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="package.php">package</a>
            <a href="book.php">book</a>
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </section>

    <div class="dashboard-container">
        <h1>Welcome, <?= htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?></h1>
        <p>Email: <?= htmlspecialchars($customer['email'], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Phone: <?= htmlspecialchars($customer['phone_number'], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Address: <?= htmlspecialchars($customer['address'], ENT_QUOTES, 'UTF-8') ?></p>

        <h2>Your Bookings</h2>
        <?php if (count($bookings) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Destination</th>
                        <th>Guests</th>
                        <th>Arrival Date</th>
                        <th>Leaving Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($booking['location'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($booking['guests'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($booking['arrivals'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($booking['leaving'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($booking['status'] ?? 'Pending', ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No bookings found. Start planning your next trip!</p>
        <?php endif; ?>

        <h2>Your Reviews</h2>
        <?php if (count($reviews) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Review ID</th>
                        <th>Booking Destination</th>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= htmlspecialchars($review['review_id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($review['location'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($review['rating'], ENT_QUOTES, 'UTF-8') ?>/5</td>
                            <td><?= htmlspecialchars($review['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No reviews found. Submit a review for your bookings!</p>
        <?php endif; ?>

        <h2>Submit a Review</h2>
        <form action="submit_review.php" method="POST">
            <select name="booking_id" required>
                <option value="" disabled selected>Select Booking</option>
                <?php foreach ($bookings as $booking): ?>
                    <option value="<?= $booking['id'] ?>"><?= htmlspecialchars($booking['location'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
            <textarea name="review_text" placeholder="Write your review here..." required></textarea>
            <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
            <button type="submit">Submit Review</button>
        </form>

        <a href="auth.php?logout=true" class="logout-button">Logout</a>
    </div>

    <section class="footer">
        <div class="box-container">
        </div>
        <div class="credit">created by <span>Sanaullah</span> || DBMS_Lab_Project </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
