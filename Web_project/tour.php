<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Tour plan</title>
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


<div class="heading" style="background:url(images/img-9.jpg) no-repeat">
    <h1>make your tour</h1>
</div>



<section class="booking">
    <h1 class="heading-title">make your trip!</h1>
    
    <form action="book_form.php" method="post" class="book-form">

    <div class="flex">
        <div class="inputBox">
            <span>name :</span>
            <input type="text" placeholder="enter your name" name="name">
        </div>
        <div class="inputBox">
            <span>email :</span>
            <input type="email" placeholder="enter your email" name="email">
        </div>
        <div class="inputBox">
            <span>phone :</span>
            <input type="number" placeholder="enter your number" name="phone">
        </div>
        <div class="inputBox">
            <span>address :</span>
            <input type="address" placeholder="enter your address" name="address">
        </div>
        <div class="inputBox" >
            <span>where to :</span>
            <select name="location" id="location">
                <option value="">Select Your Destination</option>
                <option value="cox">Cox's Bazar</option>
                <option value="sajek">Sajek Valley</option>
                <option value="saint">Saint Martin</option>
                <option value="sundarban">Sundarban</option>
                <option value="sylhet">Selhet</option>
            </select>
        </div>
        
        <div class="inputBox">
            <span>Travel By :</span>
            <select name="travel_by" id="travel_by">
                <option value="">Select Travel By</option>
                <option value="Bus">Non AC Bus</option>
                <option value="Ac Bus">AC Bus</option>
                <option value="Train">Train</option>
                <option value="Air">Air</option>
            </select>
        </div>

        <div class="inputBox">
            <span>Hotel Type :</span>
            <select name="hotelType" id="hotelType">
                <option value="">Select Hotel</option>
                <option value="3 Star">3-Star Hotel</option>
                <option value="5 Star">5-Star Hotel</option>
            </select>
        </div>


        <div class="inputBox">
            <span>Hotel Names :</span>
            <select name="hotelName" id="hotelName">
                <option value="">Selete Hotel Name</option>
            </select>
        </div>






        <div class="inputBox">
            <span>How Many Days :</span>
            <select name="days" id="days">
                <option value="">Select Days</option>
                <option value="1day">1 Day</option>
                <option value="3days">3 Days</option>
                <option value="5days">5 Days</option>
                <option value="7days">7 Days</option>
                <option value="10days">10 Days</option>
            </select>
        </div>


        <div class="inputBox">
            <span>how many :</span>
            <input type="number" placeholder="number of guests" name="guests">
        </div>
        <div class="inputBox">
            <span>arrivals :</span>
            <input type="date" name="arrivals">
        </div>


        <div class="inputBox">
            <span>Total Cost :</span>
            <input type="text" id="totalCost" name="totalCost" readonly>
        </div>


    <input type="submit" value="submit" class="btn" name="send">
    </form>
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

<script src="../js/script.js"></script>
</body>
</html>


<script>

function validateForm() {
    let name = document.querySelector('input[name="name"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let phone = document.querySelector('input[name="phone"]').value;

    if (name === "" || email === "" || phone === "") {
        alert("Please fill out all required fields.");
        return false;
    }

    if (!/^\d+$/.test(phone)) {
        alert("Please enter a valid phone number.");
        return false;
    }

    if (!/^\S+@\S+\.\S+$/.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

document.querySelector('.book-form').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});



document.addEventListener("DOMContentLoaded", function() {
    let locationSelect = document.getElementById('location');
    let hotelTypeSelect = document.getElementById('hotelType');
    let hotelNameSelect = document.getElementById('hotelName');

    

    let hotelsByLocation = {
        "cox": {
            "3 Star": ["Hotel Beach Way", "Hill Tower Hotel & Resort", "Royal Beach Resort", "Sea Crown Hotel", "Hotel The Cox Today"],
            "5 Star": ["Sayyman Beach Resort", "Ocean Paradise Hotel & Resort", "Long Beach Hotel", "Seagull Hotel", "Radisson Blu Chattogram Bay View"]
        },
        "sajek": {
            "3 Star": ["Megh Machang Resort", "Runmoy Resort", "Sajek Valley Cottage", "Hill Queen Resort", "Green Peak Resort"],
            "5 Star": ["Sajek Valley Resort", "Cloud View Resort", "Luxury Hilltop Resort", "Sajek Grand Palace", "Sky View Luxury Resort"]
        },
        "saint": {
            "3 Star": ["Blue Marine Hotel", "Saint Martin Eco Resort", "Coral Reef Resort", "Island View Hotel", "Paradise Beach Resort"],
            "5 Star": ["Coral View Resort", "Saint Martin Grand Resort", "Oceanic Luxury Resort", "Seafront Hotel & Spa", "Golden Horizon Resort"]
        },
        "sundarban": {
            "3 Star": ["Royal Bengal Resort", "Tiger Garden Hotel", "Mangrove Eco Resort", "Wildlife Inn", "Sundarban Cottage"],
            "5 Star": ["Sundarban Luxury Cruise", "Green Paradise Hotel", "Jungle Emperor Resort", "Eco Forest Resort", "Mangrove Retreat"]
        },
        "sylhet": {
            "3 Star": ["Hotel Noorjahan Grand", "Rose View Hotel", "Sylhet Continental Hotel", "Grand Surma Hotel", "Garden Inn"],
            "5 Star": ["Grand Sultan Tea Resort", "Nazimgarh Resort", "The Palace Luxury Resort", "Royal River View", "Infinity Hill Resort"]
        }
    };

    function updateHotelList() {
        let selectedLocation = locationSelect.value;
        let selectedHotelType = hotelTypeSelect.value;

        hotelNameSelect.innerHTML = '<option value="">Select Hotel Name</option>'; // Reset options

        if (selectedLocation && selectedHotelType && hotelsByLocation[selectedLocation] && hotelsByLocation[selectedLocation][selectedHotelType]) {
            hotelsByLocation[selectedLocation][selectedHotelType].forEach(hotel => {
                let option = document.createElement('option');
                option.value = hotel;
                option.textContent = hotel;
                hotelNameSelect.appendChild(option);
            });
        }
    }

    locationSelect.addEventListener("change", updateHotelList);
    hotelTypeSelect.addEventListener("change", updateHotelList);
});



document.addEventListener("DOMContentLoaded", function() {
    let locationSelect = document.getElementById('location');
    let travelSelect = document.getElementById('travel_by');
    let hotelSelect = document.getElementById('hotelType');
    let daysSelect = document.getElementById('days');
    let guestsInput = document.querySelector('input[name="guests"]');
    let totalCostInput = document.getElementById('totalCost');

    function calculateCost() {
        let locationCost = {
            "cox": 1000,
            "sajek": 1200,
            "saint": 1500,
            "sundarban": 2000,
            "sylhet": 800
        };

        let travelCost = {
            "Bus": 450,
            "Ac Bus": 1200,
            "Train": 650,
            "Air": 2500
        };

        let hotelCost = {
            "3 Star": 1500,
            "5 Star": 3000
        };

        let daysMultiplier = {
            "1day": 1,
            "3days": 3,
            "5days": 5,
            "7days": 7,
            "10days": 10
        };

        let guests = parseInt(guestsInput.value) || 1;
        let days = daysMultiplier[daysSelect.value] || 1;
        let locCost = locationCost[locationSelect.value] || 0;
        let travel = travelCost[travelSelect.value] || 0;
        let hotel = hotelCost[hotelSelect.value] || 0;

        let total = (locCost + travel + hotel) * days * guests;
        totalCostInput.value = total.toLocaleString() + " Tk";
    }

    locationSelect.addEventListener("change", calculateCost);
    travelSelect.addEventListener("change", calculateCost);
    hotelSelect.addEventListener("change", calculateCost);
    daysSelect.addEventListener("change", calculateCost);
    guestsInput.addEventListener("input", calculateCost);
});

</script>