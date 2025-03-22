import Splide from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

document.addEventListener('DOMContentLoaded', function () {
    // Carousel pertama
    const splide1 = new Splide('#product-carousel-1', {
        type   : 'loop',
        drag   : 'free',
        focus  : 'center',
        gap    : '30px',
        autoStart: true,
        perPage: 3,
        autoScroll: {
            speed: 1,
        },
        pauseOnHover: true,
    });

    splide1.mount({ AutoScroll });

    // Carousel kedua
    const splide2 = new Splide('#product-carousel-2', {
        type   : 'loop',
        drag   : 'free',
        focus  : 'center',
        gap    : '30px',
        autoStart: true,
        perPage: 3,
        autoScroll: {
            speed: -1,
        },
        pauseOnHover: true,
    });

    splide2.mount({ AutoScroll });
});
