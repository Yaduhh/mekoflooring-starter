@if (Route::has('login'))
    <nav class="flex items-center justify-between">
        <div class="flex items-center gap-6">
            <!-- Logo or Brand Name -->
            <a href="/" class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                <img src="{{ asset('assets/img/logoMekoFlooring.png') }}" alt="logo" />
            </a>
        </div>

        <div class="flex items-center gap-6 font-semibold text-lg">
            <a href="#home"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] hover:cursor-pointer">
                Home
            </a>
            <a href="#product"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] hover:cursor-pointer">
                Product
            </a>
            <a href="#longue"
                class="block px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#19140035] hover:cursor-pointer">
                Longue
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <div class="hidden lg:flex items-center gap-4">
            <!-- Dark Mode Button -->
            <button id="darkModeToggle"
                class="bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded">
                Change Mode
            </button>

            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
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
