<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package</title>
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

<div class="heading" style="background:url(images/img-11.jpg) no-repeat">
    <h1>packages</h1>
</div>

<section class="packages">
<div class="package-header">

        <div class="package-buttons">
        <?php if (isset($_SESSION['admin'])) : ?>
            <!-- <a href="#" class="btn">Create Packages</a> -->
        <?php elseif (isset($_SESSION['customer_id'])) : ?>
            <a href="#" class="btn">Existing Packages</a>
            <a href="tour.php" class="btn">Customize Package</a>
        <?php endif; ?>
        </div>
    <h1 class="heading-title">Top Destinations</h1>
        
</div>
    
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
        
        <div class="box">
            <div class="image">
                <img src="images/Sreemangal.jpg" alt="">
            </div>
            <div class="content">
                <h3>Srimangal</h3>
                <p>Srimangal, the tea capital of Bangladesh, is known for its lush tea gardens and wildlife.</p>
                <a href="Destinations/book.php?id=srimangal" class="btn">Book Now</a>
            </div>
        </div>
        
        <div class="box">
            <div class="image">
                <img src="images/kuakata.jpg" alt="Kuakata">
            </div>
            <div class="content">
                <h3>Kuakata</h3>
                <p>Kuakata is the ‘Daughter of the Sea,’ famous for its panoramic sunrise and sunset views.</p>
                <a href="Destinations/book.php?id=kuakata" class="btn">Book Now</a>
            </div>
        </div>
        
        <div class="box">
            <div class="image">
                <img src="images/amiakhum.jpg" alt="Amiakhum Waterfall">
            </div>
            <div class="content">
                <h3>Amiakhum Waterfall</h3>
                <p>One of the most beautiful waterfalls in Bangladesh, located in the Bandarban hills.</p>
                <a href="Destinations/book.php?id=amiakhum" class="btn">Book Now</a>
            </div>
        </div>
        
        <div class="box">
            <div class="image">
                <img src="images/sonargaon.jpg" alt="Sonargaon">
            </div>
            <div class="content">
                <h3>Sonargaon</h3>
                <p>Sonargaon, the ancient capital of Bengal, is rich in historical architecture.</p>
                <a href="Destinations/book.php?id=sonargaon" class="btn">Book Now</a>
            </div>
        </div>
        
        <div class="box">
            <div class="image">
                <img src="images/jaflong.jpg" alt="Jaflong">
            </div>
            <div class="content">
                <h3>Jaflong</h3>
                <p>Jaflong is a picturesque hill station on the India-Bangladesh border in Sylhet.</p>
                <a href="Destinations/book.php?id=jaflong" class="btn">Book Now</a>
            </div>
        </div>
        
        
        <div class="box">
            <div class="image">
                <img src="images/sylhet.jpg" alt="Sylhet">
            </div>
            <div class="content">
                <h3>Sylhet</h3>
                <p>Sylhet is known for its tea gardens, hills, and the shrine of Hazrat Shah Jalal.</p>
                <a href="Destinations/book.php?id=sylhet" class="btn">Book Now</a>
            </div>
        </div>
        

        <div class="box">
            <div class="image">
                <img src="images/sajek.jpg" alt="Sajek Valley">
            </div>
            <div class="content">
                <h3>Sajek Valley</h3>
                <p>Sajek Valley, known as the "Queen of Hills," is famous for its clouds and scenic beauty.</p>
                <a href="Destinations/book.php?id=sajek" class="btn">Book Now</a>
            </div>
        </div>
        
        
        <div class="box">
            <div class="image">
                <img src="images/img-11.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti temporibus, laborum enim</p>
                <a href="book.php" class="btn"> book now</a>
            </div>
        </div>
        
        
        <div class="box">
            <div class="image">
                <img src="images/img-12.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti temporibus, laborum enim</p>
                <a href="book.php" class="btn"> book now</a>
            </div>
        </div>
    </div>

    <div class="more-package"><span class="btn">More Package</span>
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



<script>
    let loadMoreBtn = document.querySelector('.packages .more-package .btn');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
    let boxes = [...document.querySelectorAll('.packages .box-container .box')];
    for (var i = currentItem; i < currentItem + 3; i++){
        boxes[i].style.display = 'inline-block';
    };
    currentItem += 3;
    if(currentItem >= boxes.length){
        loadMoreBtn.style.display = 'none';
    } 
}
</script>