<section id="article" class="w-full">
    <!-- Hero Section -->
    <div class="relative w-full min-h-[300px] bg-gradient-to-br from-[#543A14] to-[#6B4E1A] overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        <div class="relative w-full flex flex-col gap-8 mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl py-20 max-lg:px-6">
            <div class="text-center space-y-6">
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                    <span class="bg-gradient-to-r from-white to-[#F0BB78] bg-clip-text text-transparent">Artikel & Tips</span>
                </h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto leading-relaxed">
                    Temukan informasi terbaru, tips perawatan, dan panduan lengkap seputar pintu WPC berkualitas premium
                </p>
            </div>
    
        </div>
    </div>

    <!-- Articles Section -->
    <section class="py-16 lg:py-20 bg-gray-50">
        <div class="xl:max-w-6xl 2xl:max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
                @foreach ($articles as $article)
                    <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 border border-gray-100">
                        <div class="relative overflow-hidden">
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                                class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute top-4 left-4">
                                <span class="inline-block px-3 py-1 bg-[#543A14] text-white text-xs font-semibold rounded-full">
                                    📖 Artikel
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                                        {{ $article->created_at->locale('id')->translatedFormat('d F Y') }}
                                    </time>
                                </div>
                                <a href="{{ route('articles.public.show', $article->slug) }}">
                                    <h2 class="text-xl font-bold text-[#131010] mb-3 line-clamp-2 group-hover:text-[#543A14] transition-colors duration-300">
                                        {{ $article->title }}
                                    </h2>
                                </a>
                                <p class="text-gray-600 text-base mb-4 line-clamp-3 text-justify">
                                    {{ $article->sinopsis }}
                                </p>

                                <p class="text-sm font-semibold text-[#543A14] text-right">
                                    <a href="{{ route('articles.public.show', $article->slug) }}">
                                        Baca Selengkapnya
                                    </a>
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
    
            <!-- Pagination -->
            @if ($articles->hasPages())
                <div class="flex justify-center mt-12">
                    <nav class="inline-flex items-center bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        {{-- Previous Button --}}
                        @if ($articles->currentPage() > 1)
                            <a href="{{ $articles->previousPageUrl() }}"
                                class="flex items-center gap-2 px-6 py-3 text-sm font-medium text-[#543A14] hover:bg-[#543A14] hover:text-white transition-all duration-300 border-r border-gray-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Sebelumnya</span>
                            </a>
                        @else
                            <span class="flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-400 cursor-not-allowed border-r border-gray-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Sebelumnya</span>
                            </span>
                        @endif
        
                        {{-- Page Numbers --}}
                        @php
                            $start = max(1, $articles->currentPage() - 2);
                            $end = min($articles->lastPage(), $articles->currentPage() + 2);
                        @endphp
                        
                        @if ($start > 1)
                            <a href="{{ $articles->url(1) }}"
                                class="px-4 py-3 text-sm font-medium text-[#543A14] hover:bg-[#543A14] hover:text-white transition-all duration-300 border-r border-gray-200">
                                1
                            </a>
                            @if ($start > 2)
                                <span class="px-4 py-3 text-sm text-gray-400 border-r border-gray-200">...</span>
                            @endif
                        @endif
                        
                        @for ($i = $start; $i <= $end; $i++)
                            <a href="{{ $articles->url($i) }}"
                                class="px-4 py-3 text-sm font-medium transition-all duration-300 border-r border-gray-200 last:border-r-0
                                {{ $i == $articles->currentPage() ? 'bg-[#543A14] text-white' : 'text-[#543A14] hover:bg-[#543A14] hover:text-white' }}">
                                {{ $i }}
                            </a>
                        @endfor
                        
                        @if ($end < $articles->lastPage())
                            @if ($end < $articles->lastPage() - 1)
                                <span class="px-4 py-3 text-sm text-gray-400 border-r border-gray-200">...</span>
                            @endif
                            <a href="{{ $articles->url($articles->lastPage()) }}"
                                class="px-4 py-3 text-sm font-medium text-[#543A14] hover:bg-[#543A14] hover:text-white transition-all duration-300 border-r border-gray-200">
                                {{ $articles->lastPage() }}
                            </a>
                        @endif
        
                        {{-- Next Button --}}
                        @if ($articles->hasMorePages())
                            <a href="{{ $articles->nextPageUrl() }}"
                                class="flex items-center gap-2 px-6 py-3 text-sm font-medium text-[#543A14] hover:bg-[#543A14] hover:text-white transition-all duration-300">
                                <span>Selanjutnya</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </a>
                        @else
                            <span class="flex items-center gap-2 px-6 py-3 text-sm font-medium text-gray-400 cursor-not-allowed">
                                <span>Selanjutnya</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </section>
</section>

<style>
    /* Custom styles for article component */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .article-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .article-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .pagination-nav {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem !important;
        }
        
        .pagination-nav {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .pagination-nav a,
        .pagination-nav span {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem;
        }
    }
    
    @media (max-width: 640px) {
        .hero-title {
            font-size: 2rem !important;
        }
        
        .grid {
            grid-template-columns: 1fr;
        }
        
        .pagination-nav a span,
        .pagination-nav span span {
            display: none;
        }
        
        .pagination-nav svg {
            margin: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS if available
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }
        
        // Add smooth scroll behavior for pagination
        const paginationLinks = document.querySelectorAll('nav a[href*="page="]');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Smooth scroll to top of articles section
                const articlesSection = document.getElementById('article');
                if (articlesSection) {
                    setTimeout(() => {
                        articlesSection.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 100);
                }
            });
        });
    });
</script>
