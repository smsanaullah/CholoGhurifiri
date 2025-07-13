<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <?php if (isset($_SESSION['admin'])) : ?>
        <a href="admin_dashboard.php" class="btn">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    <?php elseif (isset($_SESSION['customer_id'])) : ?>
        <a href="tour.php">Make a Tour</a>
        <a href="dashboard.php" class="btn">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    <?php else : ?>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Register</a>
    <?php endif; ?>
</nav>




<div id="menu-btn" class="fas fa-bars"></div>
</section>


<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide" style="background:url(images/home-slide-20.jpg) no-repeat">
                <div class="overly"></div>
                <div class="content">
                    <span>Explore, discover, travel</span>
                    <h3>travel arround the world</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
                <div class="content">
                    <span>Explore, discover, travel</span>
                    <h3>discover the new places</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
                <div class="content">
                    <span>Explore, discover, travel</span>
                    <h3>make your tour worthwhile</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>


<section class="services">
    <h1 class="heading-title">Our services</h1>
    <div class="box-container">
        <div class="box">
            <img src="images/icon-1.png" alt="" >
            <h3>adventure</h3>
        </div>

        <div class="box">
            <img src="images/icon-2.png" alt="" ">
            <h3>tour guide</h3>
        </div>

        <div class="box">
            <img src="images/icon-3.png" alt="" >
            <h3>trekking</h3>
        </div>

        <div class="box">
            <img src="images/icon-4.png" alt="" >
            <h3>camp fire</h3>
        </div>

        <div class="box">
            <img src="images/icon-5.png" alt="" >
            <h3>off road</h3>
        </div>

        <div class="box">
            <img src="images/icon-6.png" alt="" >
            <h3>camping</h3>
        </div>

    </div>
</section>


<section class="home-about">
    <div class="image">
        <img src="images/about-img.jpg" alt="">
    </div>

    <div class="content">
        <h3>about us</h3>
        <p>Welcome to Cholo Ghurifiri, your trusted travel management platform! We are dedicated to making your travel experiences seamless, enjoyable, and memorable. Whether you're planning a solo adventure, a family trip, or a corporate getaway, we've got you covered.</p>
        <a href="about.php" class="btn">read more</a>
    </div>
</section>


<section class="home-packages">
    <h1 class="heading-title">our packages </h1>
    <div class="box-container">
        <div class="box">
            <div class="image">
                <img src="images/cox'sbazar.jpg" alt="">
            </div>
            <div class="content">
                <h3>Cox’s Bazar</h3>
                <p>Cox’s Bazar, located in the southeastern part of Bangladesh, is home to the world’s longest unbroken sandy sea beach, stretching over 120 kilometers along the Bay of Bengal.</p>
                <a href="Destinations/book.php?id=coxsbazar" class="btn">book now</a>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="images/saint-martin.jpg" alt="">
            </div>
            <div class="content">
                <h3>Saint Martin's Island</h3>
                <p>Saint Martin's Island, the only coral island in Bangladesh, is a tropical paradise known for its crystal-clear blue waters, white sandy beaches, and rich marine biodiversity. </p>
                <a href="Destinations/book.php?id=saintmartin" class="btn">book now</a>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="images/Sundarban.jpg" alt="">
            </div>
            <div class="content">
                <h3>Sundarbans</h3>
                <p>The Sundarbans, the world's largest mangrove forest, is a UNESCO World Heritage Site known for its rich biodiversity and the famous Royal Bengal Tiger.</p>
                <a href="Destinations/book.php?id=sundarbans" class="btn">Book Now</a>
            </div>
        </div>
    </div>
    <div class="more-package"><a href="package.php" class="btn">More Package</a></div>
</section>


<section class="home-offer">
    <div class="content">
        <h3>upto 50% discounts🎉</h3>
        <p>Enjoy exclusive discounts on travel packages and make your dream trip more affordable. Book now and save big on your next journey!</p>
        <a href="package.php" class="btn">book now</a>
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

    <div class="credit">created by <span>Sanaullah, Jihad</span> || Software_Project </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>


</body>
</html>