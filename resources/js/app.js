import Splide from "@splidejs/splide";
import { AutoScroll } from "@splidejs/splide-extension-auto-scroll";

document.addEventListener("DOMContentLoaded", function () {
    // Carousel kedua
    const splide2 = new Splide("#product-carousel-2", {
        type: "loop",
        drag: "free",
        focus: "center",
        gap: "100px",
        autoStart: true,
        perPage: 5,
        autoScroll: {
            speed: -1,
        },
        pauseOnHover: true,
        breakpoints: {
            768: {
                perPage: 2,
                gap: "10px",
            },
        },
    });
    splide2.mount({ AutoScroll });

    const splide1 = new Splide("#product-carousel-1", {
        type: "loop",
        drag: "free",
        focus: "center",
        gap: "10px",
        autoStart: true,
        perPage: 3,
        autoScroll: {
            speed: -0.5,
        },
        pauseOnHover: true,
        breakpoints: {
            768: {
                perPage: 2,
                gap: "10px",
            },
        },
    });

    splide1.mount({ AutoScroll });
});
