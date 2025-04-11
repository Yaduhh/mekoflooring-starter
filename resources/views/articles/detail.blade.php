@extends('layouts.detail')

@section('title', 'Artikel - ' . $article->title)

@section('content')
    <section class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto max-sm:px-6">
            <!-- Artikel Utama -->
            <div class="mb-12">
                <!-- Thumbnail Image -->
                <div class="my-6">
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                        class="w-full h-auto object-cover">
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-10">{{ $article->title }}</h1>

                <!-- Article Content -->
                <div class="text-pretty text-gray-800 dark:text-white leading-relaxed text-justify ">
                    {!! $article->content !!}
                </div>

                <!-- Tombol Share Social Media dengan Teks Menarik -->
                <div class="mt-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-400 mb-4">Share Article</h2>
                    <div
                        class="flex max-sm:flex-wrap max-sm:gap-6 max-sm:mt-6 lg:space-x-12 justify-center lg:justify-start items-center">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/?text={{ urlencode('Check out this article: ' . url()->current()) }}"
                            target="_blank"
                            class="flex items-center gap-4 text-green-500 hover:text-green-600 dark:text-white">
                            <i class="fab fa-whatsapp fa-2x"></i> WhatsApp
                        </a>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode('Check out this article: ' . $article->title) }}"
                            target="_blank"
                            class="flex items-center gap-4 text-blue-500 hover:text-blue-600 dark:text-white">
                            <i class="fab fa-telegram fa-2x"></i> Telegram
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="flex items-center gap-4 dark:text-white text-pink-600 hover:text-pink-700">
                            <i class="fab fa-instagram fa-2x"></i> Instagram
                        </a>

                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/share?url={{ urlencode(url()->current()) }}" target="_blank"
                            class="flex items-center gap-4 text-black dark:text-white hover:text-gray-800 dark:hover:text-gray-300">
                            <i class="fab fa-tiktok fa-2x"></i> TikTok
                        </a>
                    </div>
                </div>
            </div>

            <!-- Artikel Terkait -->
            <div class="mt-20">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-400 mb-6">Other Articles</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($relatedArticles as $relatedArticle)
                        <div
                            class="bg-white dark:bg-[#131010]/30 rounded-xl shadow-md hover:shadow-xl transition-all dark:border dark:border-white">
                            <img src="{{ Storage::url($relatedArticle->thumbnail) }}" alt="{{ $relatedArticle->title }}"
                                class="w-full h-80 object-cover rounded-lg">
                            <div class="p-6 h-auto flex flex-col justify-between">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    {{ $relatedArticle->title }}</h3>
                                <p class="text-sm text-gray-600 mt-2 dark:text-gray-400">
                                    {{ Str::limit($relatedArticle->sinopsis, 100) }}</p>
                                <a href="{{ route('articles.public.show', $relatedArticle->slug) }}"
                                    class="text-[#1D72B8] dark:text-[#F0BB78] font-semibold hover:underline mt-4 inline-block">
                                    Read More
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
