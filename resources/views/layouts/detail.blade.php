<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (isset($product))
        <title>Meko Flooring - {{ $product->nama }}</title>
        <!-- Meta Description for Product -->
        <meta name="description" content="{{ $product->description }}">

        <!-- Meta Keywords for Product -->
        <meta name="keywords"
            content="{{ $product->category->name_category }}, {{ $product->nama }}, flooring, {{ $product->category->name_category }}, wood flooring, premium flooring">

        <!-- Open Graph Meta Tags for Product -->
        <meta property="og:title" content="Meko Flooring - {{ $product->nama }}">
        <meta property="og:description" content="{{ $product->description }}">
        <meta property="og:image"
            content="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}">
        <meta property="og:url" content="{{ url()->current() }}">

        <!-- Twitter Card Meta Tags for Product -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Meko Flooring - {{ $product->nama }}">
        <meta name="twitter:description" content="{{ $product->description }}">
        <meta name="twitter:image"
            content="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}">
    @elseif (isset($article))
        <title>{{ $article->title }} - Meko Flooring</title>
        <!-- Meta Description for Article -->
        <meta name="description" content="{{ $article->content }}">

        <!-- Meta Keywords for Article -->
        <meta name="keywords" content="{{ $article->title }}, flooring tips, flooring articles">

        <!-- Open Graph Meta Tags for Article -->
        <meta property="og:title" content="{{ $article->title }} - Meko Flooring">
        <meta property="og:description" content="{{ $article->content }}">
        <meta property="og:image"
            content="{{ route('article.image', ['filename' => basename($article->thumbnail)]) }}">
        <meta property="og:url" content="{{ url()->current() }}">

        <!-- Twitter Card Meta Tags for Article -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $article->title }} - Meko Flooring">
        <meta name="twitter:description" content="{{ $article->content }}">
        <meta name="twitter:image"
            content="{{ route('article.image', ['filename' => basename($article->thumbnail)]) }}">
    @endif

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
</head>

<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#1b1b18] flex items-center lg:justify-between min-h-screen flex-col">
    <header
        class="w-full lg:max-w-[90rem] text-sm pb-6 pt-6 px-6 lg:px-12 lg:rounded-2xl fixed top-0 lg:top-5 z-10 bg-transparent transition-all duration-300"
        id="navbar">
        @component('components.navbar.navbar')
        @endcomponent
    </header>

    <main class="w-full mx-auto lg:max-w-7xl py-24 lg:py-32">
        @yield('content')
    </main>

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

                // Only change the background color after scroll
                if (window.scrollY > 0) {
                    let backgroundColor = darkModeActive ? 'rgba(84, 58, 20, 0)' : 'rgba(255, 255, 255, 0)';
                    navbar.style.backgroundColor = backgroundColor;
                }

                // Update text color based on the mode
                if (darkModeActive) {
                    navbar.classList.add("text-white"); // Text white in dark mode
                    navbar.classList.remove("text-[#543A14]"); // Remove default text color in dark mode
                } else {
                    navbar.classList.remove("text-white"); // Remove text-white in light mode
                    navbar.classList.add("text-[#543A14]"); // Text color in light mode
                }
            }

            // Check dark mode status from localStorage
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

                    // Update navbar background and text color when theme changes (but only after scroll)
                    updateNavbarBackground();
                }, 300);
            });

            // Add event listener for scroll
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;

                // Adjust navbar background opacity based on scroll position
                if (scrollPosition > 0) {
                    navbar.classList.add("backdrop-blur");
                    navbar.classList.add("shadow-lg");
                    const opacityValue = Math.min(scrollPosition / 200, 0.7);
                    const darkModeActive = html.classList.contains("dark");

                    // Adjust background color opacity based on scroll position and dark mode
                    if (darkModeActive) {
                        navbar.style.backgroundColor = `rgba(84, 58, 20, ${opacityValue})`;
                    } else {
                        navbar.style.backgroundColor = `rgba(255, 255, 255, ${opacityValue})`;
                    }
                } else {
                    navbar.classList.remove("backdrop-blur");
                    navbar.classList.remove("shadow-lg");
                    updateNavbarBackground(); // Keep background update when scrolled to top
                }
            });

            // Initial navbar background update based on theme and scroll
            updateNavbarBackground();
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</body>

</html>
