@if (Route::has('login'))
    <nav class="flex items-center justify-between">
        <div class="flex items-center gap-6">
            <!-- Logo or Brand Name -->
            <a href="/" class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] w-16 lg:w-auto">
                <img src="{{ asset('assets/img/logoMegadoor.png') }}" alt="logo" />
            </a>
        </div>

        <div class="hidden lg:flex items-center gap-6 font-semibold text-lg">
            <a href="/#home" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Beranda
            </a>
            <a href="/#gallery" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Galeri
            </a>
            <a href="{{ route('catalogue.public.show') }}" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Katalog
            </a>
            <a href="/#produk" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Produk
            </a>
            <a href="/#about" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Tentang
            </a>
            <a href="{{ route('floor.index') }}" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
                Door View
            </a>
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
        <a href="/#home" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Beranda
        </a>
        <a href="/#gallery" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Galeri
        </a>
        <a href="{{ route('catalogue.public.show') }}" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Katalog
        </a>
        <a href="/#produk" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Produk
        </a>
        <a href="/#about" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Tentang
        </a>
        <a href="#comingSoon" class="block px-5 py-1.5 hover:text-[#F0BB78] hover:cursor-pointer">
            Door View
        </a>
    </div>
</div>
