import './bootstrap';

import '../scss/app.scss';

import * as bootstrap from 'bootstrap';

import Alpine from 'alpinejs';
import Swiper from 'swiper/bundle';
// Swiper.use([Autoplay, Navigation, Pagination]);

import 'swiper/css/bundle';
import 'bootstrap/dist/css/bootstrap.min.css';

document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.mySwiperClass', {
        spaceBetween: 15,
        slidesPerView: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        speed: 1000,
        loop: true,
        autoplay: {
            delay: 7500,
            disableOnInteraction: false,
        }
    });
});


window.Alpine = Alpine;

Alpine.start();
