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
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 pt-6">
        @component('components.navbar.navbar')
        @endcomponent
    </header>
    <!-- Mobile Menu -->
    <div id="mobileMenu"
        class="lg:hidden hidden bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] w-full py-4 px-6">
        @auth
            <a href="{{ url('/dashboard') }}"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035]">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035]">
                Log in
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035]">
                    Register
                </a>
            @endif
        @endauth
    </div>

    <div class="w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main>
            @component('components.home.home')
            @endcomponent

            @component('components.hilightProduk.hilightProduk')
            @endcomponent

            @component('components.gallery.gallery')
            @endcomponent

            @component('components.product.product')
            @endcomponent
        </main>
    </div>

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
</body>

</html>
