<x-layouts.app :title="__('Artikel')">
    <div class="mx-auto lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Daftar Artikel') }}</h2>
            <a href="{{ route('articles.create') }}" class="bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 text-sm lg:text-base">{{ __('Create') }}</a>
        </div>

        <!-- Alert Success or Error -->
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-200 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mt-4 p-4 bg-red-200 text-red-800 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($articles as $article)
                <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-white">
                    <!-- Display Thumbnail if exists -->
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Thumbnail" class="w-full h-48 object-cover rounded-md mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-zinc-600 rounded-md mb-4 flex justify-center items-center text-gray-500 dark:text-gray-300">
                            {{ __('No Thumbnail') }}
                        </div>
                    @endif

                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $article->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300 text-justify line-clamp-2 mt-4">{{ $article->sinopsis }}</p>
                    <div class="mt-4 flex justify-end gap-8">
                        <!-- Edit Button with Icon -->
                        <a href="{{ route('articles.edit', $article) }}" class="text-white hover:underline">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <!-- Delete Button with Icon -->
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline hover:cursor-pointer">
                                <i class="fas fa-trash-alt mr-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
