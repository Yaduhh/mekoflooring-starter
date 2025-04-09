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

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
</head>

<body class="bg-[#FDFDFC] dark:bg-[#131010] text-[#1b1b18] flex items-center lg:justify-between min-h-screen flex-col">
    <header class="w-full lg:max-w-7xl text-sm pb-6 pt-6 max-sm:px-6">
        @component('components.navbar.navbar')
        @endcomponent
    </header>
    <!-- Mobile Menu -->
    <div id="mobileMenu"
       class="lg:hidden hidden bg-[#FDFDFC] dark:bg-[#131010] text-[#1b1b18] dark:text-[#EDEDEC] w-full py-4 px-6 transition-all duration-300 ease-in-out transform -translate-y-0">
        @auth
            <a href="{{ url('/dashboard') }}"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] dark:hover:text-gray-400">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] dark:hover:text-gray-400">
                Log in
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] dark:hover:text-gray-400">
                    Register
                </a>
            @endif
        @endauth
    </div>

    <main class="w-full mx-auto lg:max-w-7xl">
        @yield('content')
    </main>

    @component('components.footer.footer')
    @endcomponent

      <script>
        document.addEventListener("DOMContentLoaded", function() {
            const html = document.documentElement;
            const darkModeToggle = document.getElementById("darkModeToggle");

            // Cek status dark mode dari localStorage
            if (localStorage.getItem("theme") === "dark") {
                html.classList.add("dark");
            }

            darkModeToggle.addEventListener("click", function() {
                if (html.classList.contains("dark")) {
                    html.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                } else {
                    html.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</body>
</html>
