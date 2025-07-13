<?php
session_start();

$discountOptions = [10, 20, 25, 30];
$randomDiscount = $discountOptions[array_rand($discountOptions)];

if (!isset($_GET['id'])) {
    header("Location: package.php");
    exit();
}

$package_id = $_GET['id'];
$packages = [
    "coxsbazar" => [
        "title" => "Cox’s Bazar Tour Package",
        "image" => "../images/cox'sbazar.jpg",
        "description" => "Cox’s Bazar, বিশ্বের দীর্ঘতম সমুদ্র সৈকত, এটি বাংলাদেশের সবচেয়ে জনপ্রিয় পর্যটন গন্তব্য।",
        "travel_date" => "10 March TO 13 March",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Budget",
        "hotel_type" => "3 Star",
        "hotel_name" => "Sayeman Beach Resort",
        "places_to_explore" => [
            "Laboni Beach",
            "Himchari Waterfall",
            "Inani Beach",
            "Marine Drive"
        ],
        "price" => "BDT 5,000 per person"
    ],

    "saintmartin" => [
        "title" => "Saint Martin's Island Tour Package",
        "image" => "../images/saint-martin.jpg",
        "description" => "Saint Martin’s Island, বাংলাদেশের একমাত্র প্রবাল দ্বীপ, যেখানে নীল জলরাশি, প্রবাল পাথর ও প্রাকৃতিক সৌন্দর্য মিলেমিশে এক অপূর্ব দৃশ্য তৈরি করেছে।",
        "travel_date" => "15 March TO 18 March",
        "travel_time" => "11:00 PM - 7:00 AM",
        "travel_type" => "Luxury & Standard",
        "hotel_type" => "Resort / Budget",
        "hotel_name" => "Blue Marine Resort / Coral View Resort",
        "places_to_explore" => [
            "Chhera Dwip",
            "West Beach",
            "Coral Reef Area",
            "Fishing Village",
            "Sea Turtle Hatchery"
        ],
        "price" => "BDT 6,000 per person"
    ],

    "sundarbans" => [
        "title" => "Sundarbans Tour Package",
        "image" => "../images/Sundarban.jpg",
        "description" => "Sundarban পৃথিবীর বৃহত্তম ম্যানগ্রোভ বন, যা রয়েল বেঙ্গল টাইগারের জন্য বিখ্যাত। এটি ঘন জঙ্গলে পরিপূর্ণ এবং বিভিন্ন বন্যপ্রাণীর আশ্রয়স্থল। কটকা, হিরণ পয়েন্ট ও দুবলার চর এখানে অন্যতম আকর্ষণ।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Boat Tour",
        "hotel_type" => "3 Star",
        "hotel_name" => "Forest Eco Lodge",
        "places_to_explore" => [
            "Kotka Beach",
            "Hiron Point",
            "Dublar Char"
        ],
        "price" => "BDT 11,000 per person"
    ],

    "srimangal" => [
        "title" => "Srimangal",
        "image" => "../images/Sreemangal.jpg",
        "description" => "Srimangal বাংলাদেশের ‘চায়ের রাজধানী’ হিসেবে পরিচিত। এখানকার বিস্তীর্ণ চা বাগান, লাউয়াছড়া জাতীয় উদ্যান, মাধবপুর লেক এবং স্থানীয় ক্ষুদ্র নৃগোষ্ঠীর জীবনধারা পর্যটকদের আকর্ষণ করে।",
        "travel_date" => "15 May 2025 ",
        "travel_time" => "10:00 PM - 6:00 Ap ",
        "travel_type" => "Eco-Tour ",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Tea Resort & Eco Park ",
        "places_to_explore" => [
            "Lawachara National Park  ",
            "Madhabpur Lake "
        ],
        "price" => "BDT 4800 per person"
    ],

    "kuakata" => [
        "title" => "Kuakata",
        "image" => "../images/kuakata.jpg",
        "description" => "Kuakata ‘সাগর কন্যা’ নামে পরিচিত এবং এটি বাংলাদেশের একমাত্র সমুদ্রসৈকত, যেখান থেকে একসাথে সূর্যোদয় ও সূর্যাস্ত দেখা যায়। লেবুর চর ও ফাতরার বন এখানকার দর্শনীয় স্থান।",
        "travel_date" => "15 May 2025 ",
        "travel_time" => "10:00 PM - 6:00 Ap ",
        "travel_type" => "Beach Tour ",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Kuakata Grand Hotel ",
        "places_to_explore" => [
            "Lebur Char ",
            "Fatrar Char"
        ],
        "price" => "BDT 3500 per person"
    ],

    "amiakhum" => [
        "title" => "Amiakhum Waterfall",
        "image" => "../images/amiakhum.jpg",
        "description" => "Amiakhum Waterfall বান্দরবানের অন্যতম সুন্দর প্রাকৃতিক জলপ্রপাত। ট্রেকিংপ্রেমীদের জন্য এটি একটি জনপ্রিয় গন্তব্য। পথটি বেশ চ্যালেঞ্জিং হলেও প্রকৃতির সৌন্দর্য অসাধারণ।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Adventure Trek ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Local Homestay ",
        "places_to_explore" => [
            "Amiakhum Falls  ",
            "Nafakhum Falls"
        ],
        "price" => "BDT 5500 per person"
    ],

    "sonargaon" => [
        "title" => "Sonargaon",
        "image" => "../images/sonargaon.jpg",
        "description" => "Sonargaon বাংলার প্রাচীন রাজধানী। এখানে পানাম নগর, লোক ও কারুশিল্প জাদুঘর, এবং ঐতিহ্যবাহী স্থাপত্য রয়েছে, যা ইতিহাসপ্রেমীদের আকর্ষণ করে।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Historical Tour",
        "hotel_type" => "3 Star ",
        "hotel_name" => "Sonargaon Heritage Inn ",
        "places_to_explore" => [
            "Panam City  ",
            "Folk Art Museum  "
        ],
        "price" => "BDT 2000 per person"
    ],

    "jaflong" => [
        "title" => "Jaflong",
        "image" => "../images/jaflong.jpg",
        "description" => "Jaflong সিলেটের একটি জনপ্রিয় পর্যটন কেন্দ্র, যা মেঘালয় পাহাড়ের পাদদেশে অবস্থিত। এখানে স্বচ্ছ পানির নদী, পাথর সংগ্রহ এলাকা এবং শিলং পাহাড়ের অপরূপ দৃশ্য দেখা যায়।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Nature Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Jaflong View Resort ",
        "places_to_explore" => [
            "Zero Point ",
            "Stone Collection Area  "
        ],
        "price" => "BDT 3500 per person"

    ],

    "sylhet" => [
        "title" => "Sylhet",
        "image" => "../images/sylhet.jpg",
        "description" => "Sylhet চা বাগান, হযরত শাহ জালাল (র.) ও হযরত শাহ পরান (র.) এর মাজার এবং রাতারগুল সোয়াম্প ফরেস্টের জন্য বিখ্যাত। এর প্রাকৃতিক সৌন্দর্য ও আধ্যাত্মিক পরিবেশ পর্যটকদের আকৃষ্ট করে।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Cultural Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Rose View Hotel ",
        "places_to_explore" => [
            "Hazrat Shah Jalal Mazar  ",
            "Ratargul Swamp Forest "
        ],
        "price" => "BDT 0 per person"

    ],

    "sajek" => [
        "title" => "Sajek Valley",
        "image" => "../images/sajek.jpg",
        "description" => "Sajek Valley 'পাহাড়ের রানি' নামে পরিচিত। এটি মেঘের রাজ্য হিসেবে পরিচিত, যেখানে আপনি পাহাড়, সবুজ বন, এবং মনোমুগ্ধকর সূর্যোদয় ও সূর্যাস্ত উপভোগ করতে পারেন।",
        "travel_date" => "10 April TO 12 April",
        "travel_time" => "10:00 PM - 6:00 AM",
        "travel_type" => "Hill Tour ",
        "hotel_type" => "5 Star ",
        "hotel_name" => "Sajek Hill Resort ",
        "places_to_explore" => [
            "Konglak Hill  ",
            "Ruilui Para  "
        ],
        "price" => "BDT 8000 per person"
    ]

];






if (!isset($packages[$package_id])) {
    echo "Package not found!";
    exit();
}

$package = $packages[$package_id];

// Get original price
$price_str = $package["price"];
$original_price = (int) filter_var($price_str, FILTER_SANITIZE_NUMBER_INT);

// Calculate discount
$discount_price = $original_price - ($original_price * ($randomDiscount / 100));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $package["title"]; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/book.css">

</head>
<body>


<section class="header">

            <a href="../index.php" class="logo">Cholo GhuriFiri.</a>
            <nav class="navbar">
                <a href="../index.php">home</a>
                <a href="../about.php">about</a>
                <a href="../package.php">package</a>

                <?php if (isset($_SESSION['admin'])) : ?>
                    <a href="../admin_dashboard.php" class="btn">Dashboard</a>
                    <a href="../logout.php" class="btn">Logout</a>
                <?php elseif (isset($_SESSION['customer_id'])) : ?>
                    <a href="../tour.php">Make a Tour</a>
                    <a href="../dashboard.php" class="btn">Dashboard</a>
                    <a href="../logout.php" class="btn">Logout</a>
                <?php else : ?>
                    <a href="../login.php" class="btn">Login</a>
                    <a href="../register.php" class="btn">Register</a>
                <?php endif; ?>
            </nav>

            <div id="menu-btn" class="fas fa-bars"></div>
</section>


<section class="package-details">
    <div class="image">
        <img src="<?php echo $package["image"]; ?>" alt="<?php echo $package["title"]; ?>">
    </div>
    <div class="content">
        <h2><?php echo $package["title"]; ?></h2>
        <p><?php echo $package["description"]; ?></p>
        <ul>
            <li><strong>Travel Date:</strong> <?php echo $package["travel_date"]; ?></li>
            <li><strong>Travel Time:</strong> <?php echo $package["travel_time"]; ?></li>
            <li><strong>Travel Type:</strong> <?php echo $package["travel_type"]; ?></li>
            <li><strong>Hotel Type:</strong> <?php echo $package["hotel_type"]; ?></li>
            <li><strong>Hotel Name:</strong> <?php echo $package["hotel_name"]; ?></li>
        </ul>
        <h3>Places to Explore:</h3>
        <ul>
            <?php foreach ($package["places_to_explore"] as $place) : ?>
                <li><?php echo $place; ?></li>
            <?php endforeach; ?>
        </ul>
        
        <h2>Special Offer! You’ve unlocked <?php echo $randomDiscount; ?>% discount 🎉</h2>

        <h3>Price:
    <?php if (isset($randomDiscount) && $randomDiscount > 0 && isset($original_price) && $original_price > 0): ?>
        <?php
            $discount_price = $original_price - ($original_price * ($randomDiscount / 100));
        ?>
        <span style="text-decoration: line-through; color: red;">BDT <?php echo number_format($original_price); ?> per person</span>
        <span style="color: green;">BDT <?php echo number_format($discount_price); ?> per person (<?php echo $randomDiscount; ?>% OFF)</span>
    <?php else: ?>
        <?php echo $package["price"]; ?>
    <?php endif; ?>
</h3>


        
        <?php if (isset($_SESSION['admin'])) : ?>
        <?php elseif (isset($_SESSION['customer_id'])) : ?>
            <a href="confirm_booking.php?id=<?php echo $package_id; ?>&discount=<?php echo $randomDiscount; ?>&discount_price=<?php echo (int)$discount_price; ?>" class="btn">Confirm Booking</a>
        <?php else : ?>
            <a href="../login.php" class="btn">Login to Book</a>
        <?php endif; ?>

    </div>
</section>


<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="../index.php"><i class="fas fa-angle-right"></i> home</a>
            <a href="../about.php"><i class="fas fa-angle-right"></i> about</a>
            <a href="../package.php"><i class="fas fa-angle-right"></i> package</a>
            <a href="../book.php"><i class="fas fa-angle-right"></i> book</a>
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

<script src="../js/script.js"></script>
</body>
</html>