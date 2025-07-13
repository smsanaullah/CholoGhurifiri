let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

// document.getElementById('hotelType').addEventListener('change', function (){
//     let hotelName = document.getElementById('hotelName');
//     let hotelType = this.value;

//     hotelName.innerHTML = '<option value="">Selete Hotel Name</option>';


//     if (hotelType === "3 Star"){
//         let hotels = ["Hotel Beach Way", "Hill Tower Hotel & Resort", " Royal Beach Resort"];
//         hotels.forEach(hotel => {
//             let option = document.createElement('option');
//             option.value = hotel;
//             option.textContent = hotel;
//             hotelName.appendChild(option);
//         });
//     } 
    
//     else if (hotelType === "5 Star"){
//             let hotels = ["Sayyman Beach Resort", "Ocean Paradise Hotel & Resort", " Royal Beach Resort"];
//             hotels.forEach(hotel => {
//                 let option = document.createElement('option');
//                 option.value = hotel;
//                 option.textContent = hotel;
//                 hotelName.appendChild(option);
//             });
//         }
// });



window.onclick = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

var swiper = new Swiper(".home-slider",{
    loop:true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
});

var swiper = new Swiper(".reviews-slider", {
    grabCursor: true,
    loop: true,
    autoHeight: true,
    spaceBetween: 20,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        700: {
            slidesPerView: 2,
        },
        1000: {
            slidesPerView: 3,
        },
    },
});



// let loadMoreBtn = document.querySelector('.packages .more-package .btn');
// let currentItem = 3;

// loadMoreBtn.onclick = () =>{
//     let boxes = [...document.querySelectorAll('.packages .box-container .box')];
//     for (var i = currentItem; i < currentItem + 3; i++){
//         boxes[i].style.display = 'inline-block';
//     };
//     currentItem += 3;
//     if(currentItem >= boxes.length){
//         loadMoreBtn.style.display = 'none';
//     } 
// }