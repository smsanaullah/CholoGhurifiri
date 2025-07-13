<?php
session_start();
include 'db_connection.php';

// Count pending bookings from both 'book' and 'bookings' tables
$pending_book_count = $connection->query("SELECT COUNT(*) as total FROM book WHERE status = 'Pending'")->fetch_assoc()['total'];
$pending_booking_count = $connection->query("SELECT COUNT(*) as total FROM bookings WHERE status = 'Pending'")->fetch_assoc()['total'];


error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$admin_name = $_SESSION['admin_name'] ?? 'Admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_status'])) {
        $booking_id = intval($_POST['booking_id']);
        $new_status = $_POST['status'];
        $table = $_POST['table'] ?? 'bookings'; 

        if ($booking_id > 0 && in_array($table, ['book', 'bookings'])) {
            
            if ($table === 'book') {
                $query = "UPDATE book SET status = ? WHERE id = ?";
            } else {
                $query = "UPDATE bookings SET status = ? WHERE id = ?";
            }

            $stmt = $connection->prepare($query);
            $stmt->bind_param("si", $new_status, $booking_id);

            if ($stmt->execute()) {
                echo "<h2 style='color: green; text-align: center; margin-top: 50px;'>Booking Status Updated Successfully!</h2>";
                echo "<p style='text-align: center;'>Redirecting to your dashboard...</p>";
                echo "<script>
                        setTimeout(function(){
                            window.location.href = 'admin_dashboard.php';
                        }, 2500);
                      </script>";
                exit();
            } else {
                echo "<h2 style='color: red; text-align: center; margin-top: 50px;'>Error Updating Booking: " . htmlspecialchars($stmt->error) . "</h2>";
                echo "<p style='text-align: center;'>Please try again later.</p>";
            }
            $stmt->close();
        }
    }

    if (isset($_POST['approve_review'])) {
        $review_id = intval($_POST['review_id']);
        $connection->query("UPDATE reviews SET status = 'approved' WHERE review_id = $review_id");
        header("Location: admin_dashboard.php");
        exit();
    }

    if (isset($_POST['delete_review'])) {
        $review_id = intval($_POST['review_id']);
        $connection->query("DELETE FROM reviews WHERE review_id = $review_id");
        header("Location: admin_dashboard.php");
        exit();
    }
}


$packageResult = $connection->query("SELECT * FROM book ORDER BY id DESC");

$bookingsQuery = "
    SELECT b.id, b.location, b.travel_by, b.hotelType, b.hotelName, b.days, 
           b.guests, b.arrivals, b.leaving, b.status, b.totalCost,
           c.name AS customer_name, c.email AS customer_email 
    FROM bookings b 
    JOIN customers c ON b.customer_id = c.customer_id";

$bookings = mysqli_query($connection, $bookingsQuery)->fetch_all(MYSQLI_ASSOC);

$customersQuery = "SELECT * FROM customers";
$customers = mysqli_query($connection, $customersQuery)->fetch_all(MYSQLI_ASSOC);

$reviewsQuery = "
    SELECT r.review_id, r.review_text, r.rating, r.created_at, r.status,
           c.name AS customer_name, b.id AS booking_id, b.location 
    FROM reviews r 
    JOIN customers c ON r.customer_id = c.customer_id 
    JOIN bookings b ON r.booking_id = b.id";

$reviews = mysqli_query($connection, $reviewsQuery)->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
        <a href="logout.php" class="btn">Logout</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="dashboard-container">
    <h1>Welcome Admin, <?= htmlspecialchars($admin_name, ENT_QUOTES, 'UTF-8') ?></h1>

    <div class="admin-tabs" style="text-align:center; margin: 20px 0;">
    <button onclick="showSection('package')">
    Package Bookings
    <?php if ($pending_book_count > 0): ?>
        <span class="notif-badge"><?= $pending_book_count ?></span>
    <?php endif; ?>
</button>

    <button onclick="showSection('booking')">
    All Bookings
    <?php if ($pending_booking_count > 0): ?>
        <span class="notif-badge"><?= $pending_booking_count ?></span>
    <?php endif; ?>
</button>

    <button onclick="showSection('customer')">All Customers</button>
    <button onclick="showSection('review')">Customer Reviews</button>
    </div>

    <div id="package-section" class="dashboard-section">
    <h2>Package Bookings:</h2>
    <div style="overflow-x:auto;">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Travel Date</th>
                    <th>Travel Time</th>
                    <th>Hotel Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Booking Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $packageResult->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['location']) ?></td>
                        <td><?= htmlspecialchars($row['travel_date']) ?></td>
                        <td><?= htmlspecialchars($row['travel_time']) ?></td>
                        <td><?= htmlspecialchars($row['hotel_name']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?> BDT</td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['booking_time']) ?></td>
                        <td>
                            <form action="admin_dashboard.php" method="POST">
                                <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="table" value="book">
                                <select name="status">
                                    <option value="Pending" <?= ($row['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
                                    <option value="Accepted" <?= ($row['status'] === 'Accepted') ? 'selected' : '' ?>>Accepted</option>
                                    <option value="Rejected" <?= ($row['status'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                </select>
                                <button type="submit" name="update_status">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </div>

    <div id="booking-section" class="dashboard-section" style="display:none;">
    <h2>All Bookings</h2>
    <?php if (!empty($bookings)): ?>
        <div style="overflow-x:auto;">
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Booking ID</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Location</th>
                        <th>Travel By</th>
                        <th>Hotel Type</th>
                        <th>Hotel Name</th>
                        <th>Days</th>
                        <th>Guests</th>
                        <th>Arrival Date</th>
                        <th>Status</th>
                        <th>Total Cost (Tk)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['customer_name']) ?></td>
                            <td><?= htmlspecialchars($row['customer_email']) ?></td>
                            <td><?= ucfirst(htmlspecialchars($row['location'])) ?></td>
                            <td><?= htmlspecialchars($row['travel_by']) ?></td>
                            <td><?= htmlspecialchars($row['hotelType']) ?></td>
                            <td><?= htmlspecialchars($row['hotelName']) ?></td>
                            <td><?= htmlspecialchars($row['days']) ?></td>
                            <td><?= htmlspecialchars($row['guests']) ?></td>
                            <td><?= htmlspecialchars($row['arrivals']) ?></td>
                            <td><?= htmlspecialchars($row['status'] ?? 'Pending') ?></td>
                            <td><?= htmlspecialchars($row['totalCost']) ?> Tk</td>
                            <td>
                                <form action="admin_dashboard.php" method="POST">
                                    <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="table" value="bookings">
                                    <select name="status">
                                        <option value="Pending" <?= ($row['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
                                        <option value="Accepted" <?= ($row['status'] === 'Accepted') ? 'selected' : '' ?>>Accepted</option>
                                        <option value="Rejected" <?= ($row['status'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                    <button type="submit" name="update_status">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No bookings found. Start planning your next trip!</p>
    <?php endif; ?>
    </div>

   <div id="customer-section" class="dashboard-section" style="display:none;">
    <h2>All Customers</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= htmlspecialchars($customer['customer_id']) ?></td>
                    <td><?= htmlspecialchars($customer['name']) ?></td>
                    <td><?= htmlspecialchars($customer['email']) ?></td>
                    <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                    <td><?= htmlspecialchars($customer['address']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>


    <div id="review-section" class="dashboard-section" style="display:none;">
    <h2>Customer Reviews</h2>
    <?php if (!empty($reviews)): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Booking Location</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?= htmlspecialchars($review['customer_name']) ?></td>
                        <td><?= htmlspecialchars($review['location']) ?></td>
                        <td><?= htmlspecialchars($review['review_text']) ?></td>
                        <td><?= htmlspecialchars($review['rating']) ?>/5</td>
                        <td><?= htmlspecialchars($review['status']) ?></td>
                        <td>
                            <?php if ($review['status'] === 'pending'): ?>
                                <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
                                    <button type="submit" name="approve_review">Approve</button>
                                </form>
                            <?php endif; ?>
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="review_id" value="<?= $review['review_id'] ?>">
                                <button type="submit" name="delete_review">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>

</div>

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


<script>
function showSection(section) {
    const sections = ['package', 'booking', 'customer', 'review'];
    sections.forEach(s => {
        const div = document.getElementById(`${s}-section`);
        if (div) {
            div.style.display = (s === section) ? 'block' : 'none';
        }
    });
}
</script>


</body>
</html>
