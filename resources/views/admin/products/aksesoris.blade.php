<x-layouts.app :title="__('Door Handles')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">All Handles</h1>
            <a href="{{ route('products.create') }}" class="bg-[#543A14] text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Create Handle
            </a>
        </div>

        <!-- Notifikasi Success -->
        @if (session('success'))
            <div id="successNotification"
                class="bg-emerald-700 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-check-circle text-2xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if (session('error'))
            <div id="errorNotification"
                class="bg-red-600 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-exclamation-circle text-2xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filter Tabs -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 mb-4">
            <div class="flex gap-4">
                <button onclick="filterHandles('all')"
                    class="filter-btn active px-6 py-2 rounded-lg font-semibold transition-all"
                    data-filter="all">
                    All Handles
                </button>
                <button onclick="filterHandles('3d')"
                    class="filter-btn px-6 py-2 rounded-lg font-semibold transition-all"
                    data-filter="3d">
                    <i class="fas fa-cube mr-2"></i>3D Models
                </button>
                <button onclick="filterHandles('2d')"
                    class="filter-btn px-6 py-2 rounded-lg font-semibold transition-all"
                    data-filter="2d">
                    <i class="fas fa-image mr-2"></i>2D Images
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="handle-card relative bg-white dark:bg-zinc-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300"
                     data-type="{{ $product->is_3d ? '3d' : '2d' }}">

                    <!-- Thumbnail -->
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        @if($product->thumbnail_3d)
                            <img src="{{ Storage::url($product->thumbnail_3d) }}"
                                 alt="{{ $product->nama }}"
                                 class="w-full h-full object-cover">
                        @elseif($product->mockup_image)
                            <img src="{{ Storage::url($product->mockup_image) }}"
                                 alt="{{ $product->nama }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <i class="fas fa-image text-6xl"></i>
                            </div>
                        @endif

                        <!-- Badge 2D/3D -->
                        <div class="absolute top-4 right-4">
                            @if($product->is_3d)
                                <span class="bg-[#543A14] text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2">
                                    <i class="fas fa-cube"></i>
                                    3D Model
                                </span>
                            @else
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2">
                                    <i class="fas fa-image"></i>
                                    2D Image
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                            {{ $product->nama }}
                        </h3>

                        @if($product->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                        @endif

                        <!-- Model Info -->
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                            @if($product->is_3d && $product->model_3d)
                                <i class="fas fa-file-code"></i>
                                <span>{{ strtoupper(pathinfo($product->model_3d, PATHINFO_EXTENSION)) }}</span>
                                <span class="mx-1">•</span>
                                <span>{{ number_format(Storage::size('public/' . $product->model_3d) / 1024, 2) }} KB</span>
                            @elseif($product->model_2d)
                                <i class="fas fa-file-image"></i>
                                <span>2D Image</span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="flex-1 bg-amber-600 text-white text-center py-2 rounded-lg hover:bg-amber-700 transition-colors text-sm">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this handle?')"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors text-sm">
                                    <i class="fas fa-trash-alt mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-2">No Handles Yet</h3>
                <p class="text-gray-500 dark:text-gray-500 mb-6">Create your first door handle</p>
                <a href="{{ route('products.create') }}" class="inline-block bg-[#543A14] text-white px-6 py-3 rounded-lg hover:bg-[#6B4E1A]">
                    <i class="fas fa-plus mr-2"></i>Create Handle
                </a>
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        // Filter functionality
        function filterHandles(type) {
            const cards = document.querySelectorAll('.handle-card');
            const buttons = document.querySelectorAll('.filter-btn');

            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active', 'bg-[#543A14]', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });

            const activeBtn = document.querySelector(`[data-filter="${type}"]`);
            activeBtn.classList.add('active', 'bg-[#543A14]', 'text-white');
            activeBtn.classList.remove('bg-gray-200', 'text-gray-700');

            // Filter cards
            cards.forEach(card => {
                if (type === 'all') {
                    card.style.display = 'block';
                } else {
                    if (card.dataset.type === type) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        }

        // Auto-hide notifications
        setTimeout(() => {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
            if (errorNotification) {
                errorNotification.style.display = 'none';
            }
        }, 5000);
    </script>

    <style>
        .filter-btn {
            background: #e5e7eb;
            color: #374151;
        }

        .filter-btn.active {
            background: #543A14 !important;
            color: white !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layouts.app>
