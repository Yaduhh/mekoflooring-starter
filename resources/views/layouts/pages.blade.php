<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Temukan produk SPC dan vinyl premium dan terjangkau kami. Jelajahi katalog kami untuk solusi lantai berkualitas terbaik dengan harga terbaik.">
    <meta name="keywords" content="SPC, lantai vinyl, kualitas terbaik, vinyl premium, lantai terjangkau, katalog SPC, katalog lantai vinyl, solusi lantai">
    <meta name="author" content="Meko Flooring">

    <!-- Open Graph Meta Tags (untuk berbagi di media sosial) -->
    <meta property="og:title" content="Katalog Lantai SPC dan Vinyl Premium">
    <meta property="og:description" content="Jelajahi berbagai produk lantai SPC dan vinyl dengan kualitas terbaik dan harga terbaik. Ideal untuk penggunaan rumah dan komersial.">
    <meta property="og:image" content="https://mekoflooring.id/assets/img/logoMekoFlooring.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Katalog Lantai SPC dan Vinyl Premium">
    <meta name="twitter:description" content="Jelajahi berbagai produk lantai SPC dan vinyl dengan kualitas terbaik dan harga terbaik. Ideal untuk penggunaan rumah dan komersial.">
    <meta name="twitter:image" content="https://mekoflooring.id/assets/img/logoMekoFlooring.png">

    <!-- Title Tag -->
    <title>Katalog Produk - Lantai SPC & Vinyl</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/navbar.js')

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C28QH1R9GK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C28QH1R9GK');
</script>
</head>


<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#1b1b18] flex items-center lg:justify-between min-h-screen flex-col relative z-0">
    <header
        class="w-full lg:max-w-[90rem] xl:max-w-[75rem] 2xl:max-w-[90rem] text-sm pb-6 pt-6 px-6 lg:px-12 lg:rounded-2xl fixed top-0 lg:top-5 z-10 bg-transparent transition-all duration-300"
        id="navbar">
        @component('components.navbar.navbar')
        @endcomponent
    </header>

    <main class="w-full mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl pt-24 max-sm:pb-6 lg:pt-32 lg:pb-20">
        @yield('content')
    </main>

    @component('components.wa.wa')
    @endcomponent

    @component('components.footer.footer')
    @endcomponent

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html = document.documentElement;
            const navbar = document.getElementById('navbar');
            const darkModeToggle = document.getElementById("darkModeToggle");
            const moonIcon = document.getElementById("moonIcon");
            const sunIcon = document.getElementById("sunIcon");
            const modeText = document.getElementById("modeText");

            // Function to update navbar background and text color based on theme
            function updateNavbarBackground() {
                const darkModeActive = html.classList.contains("dark");

                if (window.scrollY > 0) {
                    let backgroundColor = darkModeActive ? 'rgba(84, 58, 20, 0)' : 'rgba(255, 255, 255, 0)';
                    navbar.style.backgroundColor = backgroundColor;
                }

                if (darkModeActive) {
                    navbar.classList.add("text-white");
                    navbar.classList.remove("text-[#543A14]");
                } else {
                    navbar.classList.remove("text-white");
                    navbar.classList.add("text-[#543A14]");
                }
            }

            if (localStorage.getItem("theme") === "dark") {
                html.classList.add("dark");
                sunIcon.classList.add("hidden");
                moonIcon.classList.remove("hidden");
                modeText.innerText = "Dark";
            } else {
                html.classList.remove("dark");
                sunIcon.classList.remove("hidden");
                moonIcon.classList.add("hidden");
                modeText.innerText = "Light";
            }

            // Dark mode toggle
            darkModeToggle.addEventListener("click", function() {
                moonIcon.style.transform = "rotate(180deg)";
                sunIcon.style.transform = "rotate(180deg)";
                setTimeout(function() {
                    if (html.classList.contains("dark")) {
                        html.classList.remove("dark");
                        localStorage.setItem("theme", "light");
                        sunIcon.classList.remove("hidden");
                        moonIcon.classList.add("hidden");
                        modeText.innerText = "Light";
                    } else {
                        html.classList.add("dark");
                        localStorage.setItem("theme", "dark");
                        sunIcon.classList.add("hidden");
                        moonIcon.classList.remove("hidden");
                        modeText.innerText = "Dark";
                    }
                    moonIcon.style.transform = "rotate(0deg)";
                    sunIcon.style.transform = "rotate(0deg)";

                    updateNavbarBackground();
                }, 300);
            });

            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;

                if (scrollPosition > 0) {
                    navbar.classList.add("backdrop-blur");
                    navbar.classList.add("shadow-lg");
                    const opacityValue = Math.min(scrollPosition / 200, 0.7);
                    const darkModeActive = html.classList.contains("dark");

                    if (darkModeActive) {
                        navbar.style.backgroundColor = `rgba(84, 58, 20, ${opacityValue})`;
                    } else {
                        navbar.style.backgroundColor = `rgba(255, 255, 255, ${opacityValue})`;
                    }
                } else {
                    navbar.classList.remove("backdrop-blur");
                    navbar.classList.remove("shadow-lg");
                    updateNavbarBackground();
                }
            });

            updateNavbarBackground();
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</body>

</html>
