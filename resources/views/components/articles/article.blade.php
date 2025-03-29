<section id="produk" class="w-full min-h-[300px] bg-[#543A14]">
    <div class="w-full flex flex-col gap-6 mx-auto lg:max-w-7xl py-10">
        <div data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-xl font-semibold capitalize text-white">
                Articles
            </h1>
        </div>

        @foreach($articles as $article)
        <!-- Thumbnail Section -->
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-1/3">
                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg shadow-md" />
            </div>
            <!-- Articles Content Section -->
            <div class="w-full md:w-2/3 flex flex-col justify-between">
                <div class="flex flex-col">
                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-[#333] mb-4">{{ $article->title }}</h2>
                    <!-- Sinopsis -->
                    <p class="text-[#555] text-lg mb-4">{{ Str::limit($article->sinopsis, 150) }}</p>
                    <!-- Full Articles Content -->
                    <div class="article-content">
                        <p class="text-[#444]">{{ $article->content }}</p>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <a href="{{ route('articles.show', $article->id) }}" class="text-[#1D72B8] font-semibold hover:underline">
                        Read more
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
