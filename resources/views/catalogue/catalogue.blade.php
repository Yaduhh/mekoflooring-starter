@extends('layouts.pages')

@section('title', 'Catalogue Product')

@section('content')
    <section class="pt-6">
        <div class="xl:max-w-6xl 2xl:max-w-7xl mx-auto max-sm:px-6">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-8">
                @foreach ($catalogueSPC as $item)
                    <div
                        class="relative bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden hover:scale-110 duration-300 hover:shadow-2xl">
                        <div class="w-full aspect-square bg-gray-200 dark:bg-neutral-700">
                            @if ($item->images)
                                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                    class="w-full h-auto object-cover cursor-pointer fullscreen-image" 
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

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-8">
                @foreach ($catalogueVinyl as $item)
                    <div
                        class="relative bg-white dark:bg-zinc-800 rounded-lg shadow-lg overflow-hidden hover:scale-110 duration-300 hover:shadow-2xl">
                        <div class="w-full aspect-square bg-gray-200 dark:bg-neutral-700">
                            @if ($item->images)
                                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                    class="w-full h-auto object-cover cursor-pointer fullscreen-image"
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