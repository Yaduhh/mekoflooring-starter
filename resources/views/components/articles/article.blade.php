<section id="article" class="w-full min-h-[300px] bg-[#543A14]">
    <div class="w-full flex flex-col gap-6 mx-auto lg:max-w-7xl py-10 max-sm:px-6">
        <div data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-xl font-semibold capitalize text-white">
                Articles
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($articles as $article)
            <!-- Thumbnail Section -->
            <div class="flex flex-col md:flex-row gap-6 bg-white p-6 rounded-xl">
                <div class="w-full md:w-1/2">
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg shadow-md" />
                </div>
                <!-- Articles Content Section -->
                <div class="w-full md:w-2/3 flex flex-col justify-between">
                    <div class="flex flex-col">
                        <!-- Title -->
                        <h2 class="text-2xl font-bold text-[#333] mb-4">{{ $article->title }}</h2>
                        <p class="text-[#555] text-lg mb-4 line-clamp-3">{{ $article->sinopsis }}</p>
                    </div>
                    <div class="mt-auto text-right">
                        <a href="{{ route('articles.public.show', $article->slug) }}" class="text-[#1D72B8] font-semibold hover:underline">
                            Read more
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
