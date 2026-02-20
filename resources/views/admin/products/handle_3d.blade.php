<x-layouts.app :title="__('Handle 3D Management')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Handle 3D untuk Door Viewer</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola handle 3D yang dipakai di door customizer</p>
            </div>
            <a href="{{ route('products.create') }}?product_type=2" class="bg-[#543A14] text-white px-4 py-2 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                <i class="fas fa-plus mr-2"></i>Create Handle 3D
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

        <!-- Info Box -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-4">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
                <div>
                    <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-1">Tentang Handle 3D</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        Handle 3D ini khusus digunakan di <strong>Door Customizer (3D Viewer)</strong>.
                        Berbeda dengan aksesoris 2D yang ditampilkan di homepage.
                        Pastikan upload file .glb dengan textures embedded.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="handle-card relative bg-white dark:bg-zinc-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300">

                    <!-- Thumbnail -->
                    <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 overflow-hidden">
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
                                <i class="fas fa-grip-horizontal text-6xl"></i>
                            </div>
                        @endif

                        <!-- 3D Badge -->
                        <div class="absolute top-4 right-4">
                            @if($product->is_3d && $product->model_3d)
                                <span class="bg-[#543A14] text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg">
                                    <i class="fas fa-cube"></i>
                                    3D Model
                                </span>
                            @else
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-2 shadow-lg">
                                    <i class="fas fa-image"></i>
                                    2D Image
                                </span>
                            @endif
                        </div>

                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            @if($product->status)
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    Active
                                </span>
                            @else
                                <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 truncate">
                            {{ $product->nama }}
                        </h3>

                        @if($product->description)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                        @endif

                        <!-- Model Info -->
                        <div class="flex flex-col gap-2 text-xs text-gray-500 dark:text-gray-400 mb-4">
                            @if($product->is_3d && $product->model_3d)
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file-code text-[#543A14]"></i>
                                    <span>{{ strtoupper(pathinfo($product->model_3d, PATHINFO_EXTENSION)) }} File</span>
                                </div>
                                @php
                                    $fileSize = Storage::disk('public')->exists($product->model_3d)
                                        ? Storage::disk('public')->size($product->model_3d)
                                        : 0;
                                @endphp
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hdd text-gray-400"></i>
                                    <span>{{ number_format($fileSize / 1024 / 1024, 2) }} MB</span>
                                </div>
                            @endif

                            @if($product->compatible_doors)
                                @php
                                    $compatibleCount = is_array($product->compatible_doors)
                                        ? count($product->compatible_doors)
                                        : count(json_decode($product->compatible_doors, true) ?? []);
                                @endphp
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-door-open text-blue-500"></i>
                                    <span>{{ $compatibleCount }} Compatible Doors</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                    <span>All Doors Compatible</span>
                                </div>
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
            @empty
                <div class="col-span-full text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                    <i class="fas fa-grip-horizontal text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-2">No Handle 3D Yet</h3>
                    <p class="text-gray-500 dark:text-gray-500 mb-6">Create your first 3D handle for door viewer</p>
                    <a href="{{ route('products.create') }}?product_type=2" class="inline-block bg-[#543A14] text-white px-6 py-3 rounded-lg hover:bg-[#6B4E1A]">
                        <i class="fas fa-plus mr-2"></i>Create Handle 3D
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>

    <script>
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
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layouts.app>
