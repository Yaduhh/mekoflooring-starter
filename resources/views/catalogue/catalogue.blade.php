@extends('layouts.pages')

@section('title', 'Catalogue Product')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 lg:py-24">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23f1f5f9" fill-opacity="0.4"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        <div class="relative xl:max-w-6xl 2xl:max-w-7xl mx-auto px-6">
            <div class="text-center space-y-6">
                <div class="inline-block px-6 py-3 bg-gradient-to-r from-[#543A14] to-[#6B4E1A] text-white text-sm font-semibold rounded-full shadow-lg" data-aos="fade-up" data-aos-duration="800">
                    🏆 Premium Collection
                </div>
                <h1 class="text-4xl lg:text-6xl font-extrabold text-[#131010] leading-tight" data-aos="fade-up" data-aos-duration="1000">
                    <span class="bg-gradient-to-r from-[#131010] to-[#543A14] bg-clip-text text-transparent">Katalog Pintu WPC</span>
                </h1>
                <p class="text-xl text-[#666666] max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-duration="1200">
                    Jelajahi koleksi lengkap pintu WPC berkualitas premium dengan berbagai pilihan desain dan finishing yang elegan untuk kebutuhan hunian modern Anda
                </p>
                <div class="flex justify-center items-center gap-4 text-sm text-[#666666]" data-aos="fade-up" data-aos-duration="1400">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span>{{ count($catalogueSPC) + count($catalogueVinyl) + count($catalogueLaminate) }} Produk Tersedia</span>
                    </div>
                    <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span>Kualitas Premium</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 lg:py-20">
        <div class="xl:max-w-6xl 2xl:max-w-7xl mx-auto px-6">
            <!-- Category Tabs -->
            <div class="mb-12" data-aos="fade-up" data-aos-duration="600">
                <div class="flex justify-center">
                    <div class="bg-gray-100 p-2 rounded-2xl inline-flex gap-2">
                        <button onclick="showCategory('spc')" id="spc-tab" class="category-tab active px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                            Standard Color
                        </button>
                        <button onclick="showCategory('vinyl')" id="vinyl-tab" class="category-tab px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                            Extra Finishing
                        </button>
                        <button onclick="showCategory('laminate')" id="laminate-tab" class="category-tab px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                            Laminate Finishing
                        </button>
                    </div>
                </div>
            </div>

            <!-- Standard Color Collection -->
            <div id="spc-collection" class="category-content">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#131010] mb-4">Standard Color</h2>
                    <p class="text-[#666666] text-base">Koleksi pintu WPC dengan warna standar yang cocok untuk berbagai gaya hunian dengan harga terjangkau</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 lg:gap-8">
                    @foreach ($catalogueSPC as $item)
                        <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                            <div class="relative w-full bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                @if ($item->images)
                                    <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                        class="w-full h-full cursor-pointer transition-transform duration-500 group-hover:scale-110" 
                                        onclick="openFullscreen('{{ Storage::url($item->images) }}', '{{ $item->deskripsi }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg">
                                            <svg class="w-4 h-4 text-[#543A14]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center h-full text-center text-gray-400">
                                        <div class="space-y-2">
                                            <svg class="w-12 h-12 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="text-sm font-medium">{{ __('No Image Available') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if ($item->kode_produk)
                                <div class="p-4">
                                    <h3 class="font-semibold text-[#131010] text-sm leading-tight">{{ $item->kode_produk }}</h3>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Extra Finishing Collection -->
            <div id="vinyl-collection" class="category-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#131010] mb-4">Extra Finishing</h2>
                    <p class="text-[#666666] text-base">Koleksi pintu WPC dengan finishing premium yang memberikan tampilan lebih eksklusif dan berkelas</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8">
                    @foreach ($catalogueVinyl as $item)
                        <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                            <div class="relative w-full bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                @if ($item->images)
                                    <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                        class="w-full h-full cursor-pointer transition-transform duration-500 group-hover:scale-110"
                                        onclick="openFullscreen('{{ Storage::url($item->images) }}', '{{ $item->deskripsi }}')">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg">
                                            <svg class="w-4 h-4 text-[#543A14]" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center h-full text-center text-gray-400">
                                        <div class="space-y-2">
                                            <svg class="w-12 h-12 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="text-sm font-medium">{{ __('No Image Available') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if ($item->kode_produk)
                                <div class="p-4">
                                    <h3 class="font-semibold text-[#131010] text-sm leading-tight">{{ $item->kode_produk }}</h3>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Laminate Finishing Collection -->
             <div id="laminate-collection" class="category-content hidden">
                 <div class="mb-8">
                     <h2 class="text-2xl font-bold text-[#131010] mb-4">Laminate Finishing</h2>
                     <p class="text-[#666666] text-base">Koleksi pintu WPC dengan finishing laminate yang tahan lama dan mudah perawatan dengan berbagai pilihan tekstur</p>
                 </div>
                 <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8">
                     @foreach ($catalogueLaminate as $item)
                         <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                             <div class="relative w-full bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                 @if ($item->images)
                                     <img src="{{ Storage::url($item->images) }}" alt="{{ $item->deskripsi }}"
                                         class="w-full h-full cursor-pointer transition-transform duration-500 group-hover:scale-110" 
                                         onclick="openFullscreen('{{ Storage::url($item->images) }}', '{{ $item->deskripsi }}')">
                                     <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                     <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                         <div class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-lg">
                                             <svg class="w-4 h-4 text-[#543A14]" fill="currentColor" viewBox="0 0 20 20">
                                                 <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                 <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                             </svg>
                                         </div>
                                     </div>
                                 @else
                                     <div class="flex items-center justify-center h-full text-center text-gray-400">
                                         <div class="space-y-2">
                                             <svg class="w-12 h-12 mx-auto text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                 <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                             </svg>
                                             <p class="text-sm font-medium">{{ __('No Image Available') }}</p>
                                         </div>
                                     </div>
                                 @endif
                             </div>
                             @if ($item->deskripsi)
                                 <div class="p-4">
                                     <h3 class="font-semibold text-[#131010] text-sm leading-tight">{{ $item->deskripsi }}</h3>
                                 </div>
                             @endif
                         </div>
                     @endforeach
                 </div>
             </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-gradient-to-br from-[#543A14] to-[#6B4E1A] relative overflow-hidden rounded-xl">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        <div class="relative xl:max-w-6xl 2xl:max-w-7xl mx-auto px-6">
            <div class="text-center space-y-8">
                <div class="space-y-4">
                    <h3 class="text-3xl lg:text-4xl font-bold text-white">Butuh Konsultasi?</h3>
                    <p class="text-xl text-white/90 max-w-2xl mx-auto">Dapatkan konsultasi gratis dari ahli kami untuk memilih produk yang tepat sesuai kebutuhan dan budget Anda</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="https://wa.me/6281112016231" target="_blank"
                        class="group inline-flex items-center gap-3 bg-white text-[#543A14] px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-xl">
                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <span>Konsultasi Gratis</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <div class="flex items-center gap-2 text-white/80">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium">Online 24/7</span>
                    </div>
                </div>
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
        // Tab switching functionality
        function showCategory(category) {
            // Hide all category contents
            document.querySelectorAll('.category-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected category content
            document.getElementById(category + '-collection').classList.remove('hidden');
            
            // Add active class to selected tab
            document.getElementById(category + '-tab').classList.add('active');
        }

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

        // Initialize AOS (Animate On Scroll) if available
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true
                });
            }
        });
    </script>

    <style>
        /* Tab styling */
        .category-tab {
            color: #666666;
            background: transparent;
        }
        
        .category-tab.active {
            background: linear-gradient(135deg, #543A14, #6B4E1A);
            color: white;
            box-shadow: 0 4px 15px rgba(84, 58, 20, 0.3);
        }
        
        .category-tab:hover:not(.active) {
            background: rgba(84, 58, 20, 0.1);
            color: #543A14;
        }
        
        /* Smooth transitions for content switching */
        .category-content {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Enhanced card hover effects */
        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }
        
        /* Gradient text effect */
        .bg-clip-text {
            -webkit-background-clip: text;
            background-clip: text;
        }
        
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #543A14, #6B4E1A);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #6B4E1A, #543A14);
        }
    </style>
@endsection