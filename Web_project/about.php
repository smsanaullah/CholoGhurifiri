<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<section class="header">

<a href="index.php" class="logo">Cholo GhuriFiri.</a>
<nav class="navbar">
    <a href="index.php">home</a>
    <a href="about.php">about</a>
    <a href="package.php">package</a>
    <a href="tour.php">Make a Tour</a>
    <?php if (isset($_SESSION['user_id'])) : ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</section>

<div class="heading" style="background:url(images/img-12.jpg) no-repeat">
    <h1>about us</h1>
</div>






<section class="about">
    <div class="image">
        <img src="images/about-img-1.jpg" alt="">
    </div>
    <div class="content">
        <h3>why choose us?</h3>
        <p>Welcome to Cholo Ghurifiri, your trusted travel management platform! We are dedicated to making your travel experiences seamless, enjoyable, and memorable. Whether you're planning a solo adventure, a family trip, or a corporate getaway, we've got you covered.</p>
        <h3>Our Mission</h3>
        <p>Our mission is to provide a hassle-free and personalized travel experience by offering well-designed tour packages, secure bookings, and excellent customer service.</p>

        <div class="icons-container">
            <div class="icons">
                <i class="fas fa-map"></i>
                <span>top destinations</span>
            </div>

            <div class="icons">
                <i class="fas fa-hand-holding-usd"></i>
                <span>affordable price</span>
            </div>

            <div class="icons">
                <i class="fas fa-headset"></i>
                <span>24/7 guide service</span>
            </div>
        </div>
    </div>
</section>









<section class="reviews">
    <h1 class="heading-title">Clients Reviews</h1>

    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure mollitia earum sit, nulla pariatur reiciendis porro corrupti.</p>
                <h3>Abdul Nafye</h3>
                <span>Traveler</span>
                <img src="images/pic-1.jpg" alt="Abdul Nafye">
            </div>
            <div class="swiper-slide slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores sapiente, ex explicabo suscipit consequatur quod.</p>
                <h3>Abdul Rohim</h3>
                <span>Traveler</span>
                <img src="images/pic-2.jpg" alt="Abdul Rohim">
            </div>
            <div class="swiper-slide slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta accusamus quo rem natus unde a distinctio.</p>
                <h3>Abdul Sakandar</h3>
                <span>Traveler</span>
                <img src="images/pic-3.jpg" alt="Abdul Sakandar">
            </div>
            <div class="swiper-slide slide">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, sequi est corporis iusto beatae.</p>
                <h3>Abdul Niko</h3>
                <span>Traveler</span>
                <img src="images/pic-4.jpg" alt="Abdul Niko">
            </div>
        </div>
    </div>
</section>


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

    <div class="credit">created by <span>Sanaullah, Rahat, Sazzad</span> || Web Programming_Project </div>
</section>





<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>
</body>
</html>