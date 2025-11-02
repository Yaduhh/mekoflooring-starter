<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">

    <!-- Title -->
    <title>Meko Flooring - Solusi Lantai Berkualitas untuk Rumah Anda</title>

    <!-- Meta Description -->
    <meta name="description"
        content="Meko Flooring menawarkan solusi lantai premium untuk ruang rumah dan komersial. Temukan berbagai material berkualitas tinggi, layanan pemasangan, dan desain kustom untuk mengubah ruang Anda.">
    <meta name="author" content="Meko Flooring">
    <!-- Meta Keywords -->
    <meta name="keywords"
        content="lantai, solusi lantai, spc termurah, spc premium berkualitas, lantai spc, lantai komersial, lantai vinyl, Meko Flooring">

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="Meko Flooring - Solusi Lantai Berkualitas untuk Rumah Anda">
    <meta property="og:description"
        content="Meko Flooring menawarkan solusi lantai premium dengan berbagai material dan layanan pemasangan profesional. Tingkatkan ruang hidup atau kerja Anda hari ini!">
    <meta property="og:image" content="https://mekoflooring.id/assets/img/logoMekoFlooring.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Meko Flooring - Solusi Lantai Berkualitas untuk Rumah Anda">
    <meta name="twitter:description"
        content="Meko Flooring menyediakan solusi lantai terbaik dan layanan pemasangan untuk rumah dan bisnis. Jelajahi berbagai pilihan lantai berkualitas tinggi.">
    <meta name="twitter:image" content="https://mekoflooring.id/assets/img/logoMekoFlooring.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/navbar.js')

    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C28QH1R9GK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-C28QH1R9GK');
</script>
</head>

<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#131010] dark:text-white flex items-center min-h-screen flex-col relative z-0">
    <header
        class="w-full lg:max-w-[90rem] xl:max-w-[75rem] 2xl:max-w-[90rem] text-sm pb-6 pt-6 px-6 lg:px-12 lg:rounded-2xl fixed top-0 lg:top-5 z-10 bg-transparent transition-all duration-300"
        id="navbar">
        @component('components.navbar.navbar')
        @endcomponent
    </header>

    <div class="w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main>
            @component('components.home.home')
            @endcomponent

            @component('components.hilightProduk.hilightProduk')
            @endcomponent

            @component('components.gallery.gallery')
            @endcomponent

            @component('components.product.product', ['productsSPC' => $productsSPC, 'productsVinyl' => $productsVinyl])
            @endcomponent

            @component('components.articles.article', ['articles' => $articles])
            @endcomponent

            @component('components.about.about')
            @endcomponent

            @component('components.subscription.subscription')
            @endcomponent
        </main>
    </div>
    @component('components.wa.wa')
    @endcomponent

    @component('components.footer.footer')
    @endcomponent

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html = document.documentElement;
            const darkModeToggle = document.getElementById("darkModeToggle");
            const moonIcon = document.getElementById("moonIcon");
            const sunIcon = document.getElementById("sunIcon");
            const modeText = document.getElementById("modeText");

            if (localStorage.getItem("theme") === "dark") {
                html.classList.add("dark");
                sunIcon.classList.add("hidden");
                moonIcon.classList.remove("hidden");
                modeText.innerText = "Dark Mode";
            } else {
                html.classList.remove("dark");
                sunIcon.classList.remove("hidden");
                moonIcon.classList.add("hidden");
                modeText.innerText = "Light Mode";
            }

            darkModeToggle.addEventListener("click", function() {
                moonIcon.style.transform = "rotate(180deg)";
                sunIcon.style.transform = "rotate(180deg)";
                setTimeout(function() {
                    if (html.classList.contains("dark")) {
                        html.classList.remove("dark");
                        localStorage.setItem("theme", "light");
                        sunIcon.classList.remove("hidden");
                        moonIcon.classList.add("hidden");
                        modeText.innerText = "Light Mode";
                    } else {
                        html.classList.add("dark");
                        localStorage.setItem("theme", "dark");
                        sunIcon.classList.add("hidden");
                        moonIcon.classList.remove("hidden");
                        modeText.innerText = "Dark Mode";
                    }
                    moonIcon.style.transform = "rotate(0deg)";
                    sunIcon.style.transform = "rotate(0deg)";

                    updateNavbarBackground();
                }, 300);
            });

            function updateNavbarBackground() {
                const navbar = document.getElementById('navbar');
                const darkModeActive = html.classList.contains("dark");
                let backgroundColor = darkModeActive ? '#543A14' : 'rgba(255, 255, 255, 0)';
                navbar.style.backgroundColor = backgroundColor;
                navbar.classList.remove("backdrop-blur");
            }

            updateNavbarBackground();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById('navbar');
            const html = document.documentElement;

            function updateNavbarBackground() {
                const darkModeActive = html.classList.contains("dark");
                let backgroundColor = darkModeActive ? 'rgba(84, 58, 20, 0)' : 'rgba(255, 255, 255, 0)';
                navbar.style.backgroundColor = backgroundColor;
            }
            navbar.classList.add("text-white");

            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                if (scrollPosition > 0) {
                    navbar.classList.add("backdrop-blur");
                    navbar.classList.add("shadow-lg");
                    const opacityValue = Math.min(scrollPosition / 200, 0.7);
                    const darkModeActive = html.classList.contains("dark");
                    navbar.classList.remove("text-white");

                    if (darkModeActive) {
                        navbar.style.backgroundColor = `rgba(84, 58, 20, ${opacityValue})`;
                    } else {
                        navbar.style.backgroundColor = `rgba(255, 255, 255, ${opacityValue})`;
                    }
                } else {
                    navbar.classList.remove("backdrop-blur");
                    navbar.classList.remove("shadow-lg");
                    navbar.classList.add("text-white");
                    updateNavbarBackground();
                }
            });

            updateNavbarBackground();
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>
