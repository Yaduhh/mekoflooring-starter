@extends('layouts.detail')

@section('title', 'Artikel - ' . $article->title)

@section('content')
    <!-- Hero Section with Breadcrumb -->
    <section class="relative bg-gradient-to-br from-[#543A14] to-[#6B4E1A] py-16">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
        <div class="relative xl:max-w-6xl 2xl:max-w-7xl mx-auto px-6">
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-white/80 text-sm mb-8" data-aos="fade-up">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-white">{{ Str::limit($article->title, 50) }}</span>
            </nav>
            
            <!-- Article Meta -->
            <div class="text-center space-y-6" data-aos="fade-up" data-aos-delay="200">
                <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold rounded-full">
                    📖 Artikel
                </div>
                <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-white leading-tight max-w-4xl mx-auto">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center justify-center gap-6 text-white/90">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                            {{ $article->created_at->locale('id')->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ str_word_count(strip_tags($article->content)) }} kata</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Article Content -->
    <section class="py-16">
        <div class="w-full mx-auto">
            <!-- Featured Image -->
            <div class="mb-12" data-aos="fade-up">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- Article Content -->
            <article class="prose prose-lg max-w-none" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                    <div class="article-content text-gray-800 leading-relaxed">
                        {!! $article->content !!}
                    </div>
                </div>
            </article>

            <!-- Social Media Share Section -->
            <div class="mt-12" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-[#543A14] mb-3">Bagikan Artikel Ini</h2>
                        <p class="text-gray-600">Sebarkan informasi bermanfaat ini kepada teman dan keluarga</p>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode('Baca artikel menarik ini: ' . $article->title . ' - ' . url()->current()) }}"
                            target="_blank"
                            class="group flex items-center gap-3 px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                            <span class="font-semibold">WhatsApp</span>
                        </a>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode('Baca artikel menarik: ' . $article->title) }}"
                            target="_blank"
                            class="group flex items-center gap-3 px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                            </svg>
                            <span class="font-semibold">Telegram</span>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="group flex items-center gap-3 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="font-semibold">Facebook</span>
                        </a>

                        <!-- Copy Link -->
                        <button onclick="copyToClipboard('{{ url()->current() }}')"
                            class="group flex items-center gap-3 px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                            </svg>
                            <span class="font-semibold">Salin Link</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles Section -->
    <section class="py-16">
        <div class="w-full mx-auto">
            <div class="text-center mb-12" data-aos="fade-up">
                <div class="inline-block px-4 py-2 bg-[#543A14]/10 text-[#543A14] text-sm font-semibold rounded-full mb-4">
                    📚 Artikel Lainnya
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-[#543A14] mb-4">Baca Juga Artikel Menarik Lainnya</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan lebih banyak informasi dan tips bermanfaat seputar pintu WPC dan renovasi rumah</p>
            </div>
            
            @if($relatedArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($relatedArticles as $index => $relatedArticle)
                        <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100" 
                                data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($relatedArticle->thumbnail) }}" alt="{{ $relatedArticle->title }}"
                                    class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
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
                                        <time datetime="{{ $relatedArticle->created_at->format('Y-m-d') }}">
                                            {{ $relatedArticle->created_at->locale('id')->translatedFormat('d F Y') }}
                                        </time>
                                    </div>
                                    <a href="{{ route('articles.public.show', $relatedArticle->slug) }}">
                                        <h3 class="text-xl font-bold text-[#131010] mb-3 line-clamp-2 group-hover:text-[#543A14] transition-colors duration-300">
                                            {{ $relatedArticle->title }}
                                        </h3>
                                    </a>
                                    <p class="text-gray-600 text-base mb-4 line-clamp-3 leading-relaxed">
                                        {{ $relatedArticle->sinopsis }}
                                    </p>

                                    <a href="{{ route('articles.public.show', $relatedArticle->slug) }}">
                                        <span class="text-[#543A14] font-semibold hover:text-[#6B4E1A] transition-colors duration-300 group/link">
                                            Baca Selengkapnya
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12" data-aos="fade-up">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel Terkait</h3>
                    <p class="text-gray-500">Artikel terkait akan muncul di sini setelah tersedia</p>
                </div>
            @endif
        </div>
    </section>
</section>

<style>
    /* Custom styles for article detail */
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
    
    .article-content {
        font-size: 1.125rem;
        line-height: 1.8;
    }
    
    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        color: #543A14;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .article-content h1 { font-size: 2rem; }
    .article-content h2 { font-size: 1.75rem; }
    .article-content h3 { font-size: 1.5rem; }
    .article-content h4 { font-size: 1.25rem; }
    
    .article-content p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }
    
    .article-content ul,
    .article-content ol {
        margin: 1.5rem 0;
        padding-left: 2rem;
    }
    
    .article-content li {
        margin-bottom: 0.5rem;
    }
    
    .article-content blockquote {
        border-left: 4px solid #543A14;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
    }
    
    .article-content img {
        border-radius: 1rem;
        margin: 2rem 0;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 768px) {
        .article-content {
            font-size: 1rem;
        }
        
        .article-content h1 { font-size: 1.75rem; }
        .article-content h2 { font-size: 1.5rem; }
        .article-content h3 { font-size: 1.25rem; }
    }
</style>

<script>
    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold">Tersalin!</span>
            `;
            button.classList.add('bg-green-600');
            button.classList.remove('bg-gray-600');
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-gray-600');
            }, 2000);
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }
    
    // Initialize AOS if available
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }
    });
</script>
@endsection
