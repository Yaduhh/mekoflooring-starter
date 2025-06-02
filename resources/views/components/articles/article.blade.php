<section id="article" class="w-full min-h-[300px] dark:bg-[#131010] bg-[#543A14]">
    <div class="w-full flex flex-col gap-6 mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl py-16 max-lg:px-6">
        <div data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-xl font-semibold capitalize text-white">
                Articles
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($articles as $article)
                <div
                    class="flex flex-col md:flex-row gap-6 lg:gap-0 bg-white dark:bg-[#131010] rounded-xl overflow-hidden dark:border dark:border-white">
                    <div class="w-full md:w-1/2">
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover shadow-md" />
                    </div>
                    <div class="w-full md:w-2/3 flex flex-col justify-between p-6">
                        <div class="flex flex-col">
                            <h2 class="text-2xl font-bold text-[#333] dark:text-white mb-4">{{ $article->title }}</h2>
                            <p class="text-[#555] dark:text-gray-300 text-lg mb-4 line-clamp-3 text-justify">
                                {{ $article->sinopsis }}</p>
                        </div>
                        <div class="mt-auto text-right">
                            <a href="{{ route('articles.public.show', $article->slug) }}"
                                class="text-[#1D72B8] dark:text-[#F0BB78] font-semibold hover:underline">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <div class="inline-flex items-center space-x-2">
                {{-- Previous Button --}}
                @if ($articles->currentPage() > 1)
                    <a href="{{ $articles->previousPageUrl() }}#article"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#F0BB78] border border-[#F0BB78] rounded-lg hover:bg-[#F0A34B] hover:text-white transition duration-300">
                        &laquo; Previous
                    </a>
                @else
                    <span
                        class="px-4 py-2 text-sm font-medium text-white bg-transparent border border-[#ddd] rounded-lg cursor-not-allowed">
                        &laquo; Previous
                    </span>
                @endif

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                    <a href="{{ $articles->url($i) }}#article"
                        class="px-4 py-2 text-sm font-medium text-[#F0BB78] dark:text-white border border-[#F0BB78] dark:border-[#F0BB78] rounded-lg hover:bg-[#F0BB78] hover:text-white transition duration-300 
                {{ $i == $articles->currentPage() ? 'bg-[#F0BB78] text-white' : 'bg-transparent' }}">
                        {{ $i }}
                    </a>
                @endfor

                {{-- Next Button --}}
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}#article"
                        class="px-4 py-2 text-sm font-medium text-white bg-[#F0BB78] border border-[#F0BB78] rounded-lg hover:bg-[#F0A34B] hover:text-white transition duration-300">
                        Next &raquo;
                    </a>
                @else
                    <span
                        class="px-4 py-2 text-sm font-medium text-white bg-transparent border border-[#ddd] rounded-lg cursor-not-allowed">
                        Next &raquo;
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>
