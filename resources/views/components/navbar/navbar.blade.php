@if (Route::has('login'))
    <nav class="flex items-center justify-between">
        <div class="flex items-center gap-6">
            <!-- Logo or Brand Name -->
            <a href="/" class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] w-16 lg:w-auto">
                <img src="{{ asset('assets/img/logoMekoFlooring.png') }}" alt="logo" />
            </a>
        </div>

        <div class="hidden lg:flex items-center gap-6 font-semibold text-lg">
            <a href="#home" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Home
            </a>
            <a href="#gallery" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Gallery
            </a>
            <a href="#produk" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Product
            </a>
            <a href="#about" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                About Us
            </a>
            <a href="{{ route('floor.index') }}" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Floor View
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <div class="hidden lg:flex items-center gap-4">
            <!-- Tombol Dark Mode -->
            <button id="darkModeToggle"
                class="bg-gray-200 dark:bg-[#131010] text-gray-800 dark:text-white px-4 py-2 rounded-full flex items-center gap-2">
                <svg id="moonIcon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9 18C6.5 18 4.375 17.125 2.625 15.375C0.875 13.625 0 11.5 0 9C0 6.5 0.875 4.375 2.625 2.625C4.375 0.875 6.5 0 9 0C9.23333 0 9.46267 0.00833343 9.688 0.0250001C9.91333 0.0416668 10.134 0.0666666 10.35 0.0999999C9.66667 0.583333 9.12067 1.21267 8.712 1.988C8.30333 2.76333 8.09933 3.60067 8.1 4.5C8.1 6 8.625 7.275 9.675 8.325C10.725 9.375 12 9.9 13.5 9.9C14.4167 9.9 15.2583 9.69567 16.025 9.287C16.7917 8.87833 17.4167 8.33267 17.9 7.65C17.9333 7.86667 17.9583 8.08733 17.975 8.312C17.9917 8.53667 18 8.766 18 9C18 11.5 17.125 13.625 15.375 15.375C13.625 17.125 11.5 18 9 18ZM9 16C10.4667 16 11.7833 15.5957 12.95 14.787C14.1167 13.9783 14.9667 12.9243 15.5 11.625C15.1667 11.7083 14.8333 11.775 14.5 11.825C14.1667 11.875 13.8333 11.9 13.5 11.9C11.45 11.9 9.704 11.179 8.262 9.737C6.82 8.295 6.09933 6.54933 6.1 4.5C6.1 4.16667 6.125 3.83333 6.175 3.5C6.225 3.16667 6.29167 2.83333 6.375 2.5C5.075 3.03333 4.02067 3.88333 3.212 5.05C2.40333 6.21667 1.99933 7.53333 2 9C2 10.9333 2.68333 12.5833 4.05 13.95C5.41667 15.3167 7.06667 16 9 16Z"
                        fill="currentColor" />
                </svg>


                <!-- Ikon Light Mode (Matahari) -->
                <svg id="sunIcon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 14C12.2091 14 14 12.2091 14 10C14 7.79086 12.2091 6 10 6C7.79086 6 6 7.79086 6 10C6 12.2091 7.79086 14 10 14Z"
                        stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    <path
                        d="M18 10H19M1 10H2M10 18V19M10 1V2M15.657 15.657L16.364 16.364M3.636 3.636L4.343 4.343M4.343 15.657L3.636 16.364M16.364 3.636L15.657 4.343"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>


                <span id="modeText"></span>
            </button>
        </div>

        <!-- Mobile Hamburger Menu -->
        <div class="lg:hidden">
            <button id="navbarToggle" class="text-[#1b1b18] dark:text-[#EDEDEC]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </nav>
@endif

<!-- Mobile Menu -->
<div id="mobileMenu"
    class="lg:hidden hidden rounded-xl bg-white/30 backdrop-blur mt-6 py-6 dark:bg-[#131010]/30 text-[#1b1b18] dark:text-[#EDEDEC] w-full transition-all duration-300 ease-in-out transform -translate-y-0">
    <div class="lg:hidden flex flex-col items-center gap-6 font-semibold text-lg">
        <a href="#home" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Home
        </a>
        <a href="#gallery" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Gallery
        </a>
        <a href="#produk" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Product
        </a>
        <a href="#about" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            About Us
        </a>
        <a href="{{ route('floor.index') }}" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Floor View
        </a>
    </div>
</div>
