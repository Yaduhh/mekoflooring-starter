@extends('layouts.pages')

@section('title', 'Catalogue Product')

@section('content')
    <section class="pt-6">
        <div class="xl:max-w-6xl 2xl:max-w-7xl mx-auto max-sm:px-6">
            <div class="mb-12 grid grid-cols-1 lg:grid-cols-2 gap-6 2xl:gap-10">
                <div class="w-full">
                    <img src="{{ asset('assets/img/meko.png') }}" alt="logo" />
                </div>

                <div class="w-full space-y-2 dark:text-white">
                    <p class="text-3xl font-semibold mb-6">
                        Spesifikasi Produk Meko Flooring
                    </p>

                    <div class="flex items-center gap-6">
                        <svg width="34" height="16" viewBox="0 0 34 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.293 1.29297C25.6591 0.926853 26.2381 0.904259 26.6309 1.22461L26.707 1.29297L32.707 7.29297C33.0976 7.68349 33.0976 8.31651 32.707 8.70703L26.707 14.707C26.3165 15.0976 25.6835 15.0976 25.293 14.707C24.9024 14.3165 24.9024 13.6835 25.293 13.293L29.5859 9H4.41406L8.70703 13.293L8.77539 13.3691C9.09574 13.7619 9.07315 14.3409 8.70703 14.707C8.34092 15.0731 7.76191 15.0957 7.36914 14.7754L7.29297 14.707L1.29297 8.70703C0.902444 8.31651 0.902444 7.68349 1.29297 7.29297L7.29297 1.29297C7.68349 0.902444 8.31651 0.902444 8.70703 1.29297C9.09756 1.68349 9.09756 2.31651 8.70703 2.70703L4.41406 7H29.5859L25.293 2.70703L25.2246 2.63086C24.9043 2.23809 24.9269 1.65908 25.293 1.29297Z"
                                fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>

                        <p>Width : 128 mm</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <svg width="33" height="16" viewBox="0 0 33 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.25 16V12.8H18.15C17.765 12.3467 17.4559 11.8533 17.2227 11.32C16.9895 10.7867 16.8036 10.2133 16.665 9.6H11.55V6.4H16.665C16.8025 5.78667 16.9884 5.21333 17.2227 4.68C17.457 4.14667 17.7661 3.65333 18.15 3.2H1.65V0H24.75C27.0325 0 28.9784 0.780267 30.5877 2.3408C32.197 3.90133 33.0011 5.78773 33 8C32.9989 10.2123 32.1943 12.0992 30.5861 13.6608C28.9779 15.2224 27.0325 16.0021 24.75 16H8.25ZM0 9.6V6.4H9.9V9.6H0ZM1.65 16V12.8H6.6V16H1.65Z"
                                fill="currentColor" />
                        </svg>

                        <p>Length : 1228 mm</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <svg width="33" height="16" viewBox="0 0 33 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.54688 0C1.13662 0 0.743164 0.101142 0.453069 0.281177C0.162974 0.461212 0 0.705392 0 0.96C0 1.21461 0.162974 1.45879 0.453069 1.63882C0.743164 1.81886 1.13662 1.92 1.54688 1.92H31.4531C31.8634 1.92 32.2568 1.81886 32.5469 1.63882C32.837 1.45879 33 1.21461 33 0.96C33 0.705392 32.837 0.461212 32.5469 0.281177C32.2568 0.101142 31.8634 0 31.4531 0H1.54688ZM0 6.72C0 5.8368 1.155 5.12 2.57812 5.12H30.4219C31.1056 5.12 31.7614 5.28857 32.2449 5.58863C32.7284 5.88869 33 6.29565 33 6.72C33 7.14435 32.7284 7.55131 32.2449 7.85137C31.7614 8.15143 31.1056 8.32 30.4219 8.32H2.57812C1.155 8.32 0 7.6032 0 6.72ZM0 13.76C0 12.5235 1.617 11.52 3.60938 11.52H29.3906C30.3479 11.52 31.2659 11.756 31.9428 12.1761C32.6197 12.5962 33 13.1659 33 13.76C33 14.3541 32.6197 14.9238 31.9428 15.3439C31.2659 15.764 30.3479 16 29.3906 16H3.60938C2.65211 16 1.73405 15.764 1.05716 15.3439C0.380273 14.9238 0 14.3541 0 13.76Z"
                                fill="currentColor" />
                        </svg>

                        <p>Thickness : 5 mm</p>
                    </div>

                    <div class="space-y-6 text-justify">
                        <p>Hubungi kami untuk mendapatkan penawaran menarik dengan hubungi cs kami melalui WhatsApp.</p>

                        <a href="https://wa.me/628119112416" target="_blank" data-aos="fade-up" data-aos-duration="1600"
                            class="w-fit text-[#131010] dark:text-white flex items-center gap-2 font-semibold hover:scale-110 duration-150 transition-all hover:cursor-pointer">
                            <svg width="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20C8.23277 20.003 6.4966 19.5353 4.97002 18.645L0.00401546 20L1.35602 15.032C0.464974 13.5049 -0.00308163 11.768 1.52687e-05 10C1.52687e-05 4.477 4.47702 0 10 0ZM6.59202 5.3L6.39201 5.308C6.26271 5.31691 6.13636 5.35087 6.02002 5.408C5.91159 5.46951 5.81258 5.5463 5.72602 5.636C5.60602 5.749 5.53802 5.847 5.46502 5.942C5.09514 6.4229 4.89599 7.01331 4.89902 7.62C4.90102 8.11 5.02902 8.587 5.22902 9.033C5.63802 9.935 6.31102 10.89 7.19902 11.775C7.41302 11.988 7.62302 12.202 7.84902 12.401C8.95245 13.3724 10.2673 14.073 11.689 14.447L12.257 14.534C12.442 14.544 12.627 14.53 12.813 14.521C13.1042 14.5056 13.3885 14.4268 13.646 14.29C13.7769 14.2223 13.9047 14.1489 14.029 14.07C14.029 14.07 14.0714 14.0413 14.154 13.98C14.289 13.88 14.372 13.809 14.484 13.692C14.568 13.6053 14.638 13.5047 14.694 13.39C14.772 13.227 14.85 12.916 14.882 12.657C14.906 12.459 14.899 12.351 14.896 12.284C14.892 12.177 14.803 12.066 14.706 12.019L14.124 11.758C14.124 11.758 13.254 11.379 12.722 11.137C12.6663 11.1128 12.6067 11.0989 12.546 11.096C12.4776 11.0888 12.4084 11.0965 12.3432 11.1184C12.278 11.1403 12.2182 11.176 12.168 11.223C12.163 11.221 12.096 11.278 11.373 12.154C11.3315 12.2098 11.2744 12.2519 11.2088 12.2751C11.1433 12.2982 11.0723 12.3013 11.005 12.284C10.9398 12.2666 10.876 12.2446 10.814 12.218C10.69 12.166 10.647 12.146 10.562 12.11C9.98789 11.8599 9.45646 11.5215 8.98702 11.107C8.86102 10.997 8.74402 10.877 8.62402 10.761C8.23063 10.3842 7.88777 9.95799 7.60401 9.493L7.54501 9.398C7.50328 9.3338 7.46905 9.26501 7.44302 9.193C7.40502 9.046 7.50402 8.928 7.50402 8.928C7.50402 8.928 7.74702 8.662 7.86002 8.518C7.97002 8.378 8.06301 8.242 8.12302 8.145C8.24102 7.955 8.27802 7.76 8.21602 7.609C7.93602 6.925 7.64668 6.24467 7.34802 5.568C7.28902 5.434 7.11402 5.338 6.95502 5.319C6.90102 5.31233 6.84701 5.307 6.79302 5.303C6.65874 5.2953 6.52411 5.29664 6.39002 5.307L6.59202 5.3Z"
                                    fill="currentColor" />
                            </svg>
                            <p>
                                Hubungi Kami
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8">{{ __('SPC') }}</h1>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-8">
                @foreach ($catalogueSPC as $item)
                    <div
                        class="relative bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden hover:scale-110 duration-300 hover:shadow-2xl">
                        <div class="w-full aspect-square bg-gray-200 dark:bg-neutral-700">
                            @if ($item->images)
                                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                    class="w-full h-full object-cover cursor-pointer fullscreen-image" 
                                    onclick="openFullscreen('{{ Storage::url($item->images) }}', '{{ $item->deskripsi }}')">
                            @else
                                <div
                                    class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                    {{ __('No Image Available') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Vinyl --}}
            <h1 class="text-3xl font-semibold text-gray-800 dark:text-white max-sm:mt-8 my-0 lg:my-8">{{ __('Vinyl') }}</h1>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-8">
                @foreach ($catalogueVinyl as $item)
                    <div
                        class="relative bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden hover:scale-110 duration-300 hover:shadow-2xl">
                        <div class="w-full aspect-square bg-gray-200 dark:bg-neutral-700">
                            @if ($item->images)
                                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                    class="w-full h-full object-cover cursor-pointer fullscreen-image"
                                    onclick="openFullscreen('{{ Storage::url($item->images) }}', '{{ $item->deskripsi }}')">
                            @else
                                <div
                                    class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                    {{ __('No Image Available') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 lg:mt-12">
                <a href="/floor/view-simulation/show" class="w-full">
                    <img src="{{ asset('assets/img/bannerAds.png') }}" alt="logo" />
                </a>
            </div>
        </div>
    </section>

    <!-- Full-screen image modal -->
    <div id="fullscreenModal" class="fixed inset-0 bg-black/70 backdrop-blur z-50 hidden flex items-center justify-center">
        <div class="relative w-full h-full flex flex-col items-center justify-center p-4">
            <!-- Close button -->
            <button onclick="closeFullscreen()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 focus:outline-none">
                &times;
            </button>
            
            <!-- The fullscreen image -->
            <div class="max-w-full max-h-[80vh] overflow-hidden">
                <img id="fullscreenImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain shadow">
            </div>
        </div>
    </div>

    <!-- JavaScript for fullscreen functionality -->
    <script>
        function openFullscreen(imageSrc, imageAlt) {
            // Set the image source and alt text
            document.getElementById('fullscreenImage').src = imageSrc;
            document.getElementById('fullscreenImage').alt = imageAlt;
            
            // Show the modal
            document.getElementById('fullscreenModal').classList.remove('hidden');
            
            // Prevent scrolling on the body
            document.body.style.overflow = 'hidden';
        }
        
        function closeFullscreen() {
            // Hide the modal
            document.getElementById('fullscreenModal').classList.add('hidden');
            
            // Re-enable scrolling
            document.body.style.overflow = 'auto';
        }
        
        // Close the modal when clicking outside the image
        document.getElementById('fullscreenModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeFullscreen();
            }
        });
        
        // Close the modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFullscreen();
            }
        });
    </script>
@endsection