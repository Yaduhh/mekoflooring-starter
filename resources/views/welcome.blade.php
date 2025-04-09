<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Meko Flooring</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/navbar.js')

    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#131010] dark:text-white flex items-center min-h-screen flex-col">
    <header
        class="w-full lg:max-w-[90rem] text-sm pb-6 pt-6 px-6 lg:px-12 lg:rounded-2xl fixed top-0 lg:top-5 z-10 bg-transparent transition-all duration-300"
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

            @component('components.product.product', ['products' => $products])
            @endcomponent

            @component('components.articles.article', ['articles' => $articles])
            @endcomponent

            @component('components.about.about')
            @endcomponent
        </main>
    </div>
    @component('components.footer.footer')
    @endcomponent

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html = document.documentElement;
            const darkModeToggle = document.getElementById("darkModeToggle");
            const moonIcon = document.getElementById("moonIcon");
            const sunIcon = document.getElementById("sunIcon");
            const modeText = document.getElementById("modeText");

            // Cek status dark mode dari localStorage
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

                    // Update navbar background when theme changes
                    updateNavbarBackground();
                }, 300);
            });

            // Function to update navbar background based on theme
            function updateNavbarBackground() {
                const navbar = document.getElementById('navbar');
                const darkModeActive = html.classList.contains("dark");
                let backgroundColor = darkModeActive ? '#543A14' : 'rgba(255, 255, 255, 0)';
                navbar.style.backgroundColor = backgroundColor;
                navbar.classList.remove("backdrop-blur");
            }

            // Initial navbar background update based on theme
            updateNavbarBackground();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navbar = document.getElementById('navbar');
            const html = document.documentElement;

            // Function to update navbar background based on theme
            function updateNavbarBackground() {
                const darkModeActive = html.classList.contains("dark");
                let backgroundColor = darkModeActive ? 'rgba(84, 58, 20, 0)' : 'rgba(255, 255, 255, 0)';
                navbar.style.backgroundColor = backgroundColor;
            }
            navbar.classList.add("text-white");

            // Ketika halaman di-scroll
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

            // Initial navbar background update based on theme
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
