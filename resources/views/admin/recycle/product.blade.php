<x-layouts.app :title="__('Produk')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
         <div class="flex justify-between items-center mb-2 lg:mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Recycle Product') }}</h2>
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

        <!-- Mengecek apakah ada produk -->
        @if ($products->isEmpty())
            <div class="p-4 text-center text-gray-600 dark:text-gray-300">
                <p>{{ __('Tidak ada produk yang ditampilkan') }}</p>
            </div>
        @else
            <div class="grid auto-rows-min gap-6 md:grid-cols-4">
                @foreach ($products as $product)
                    <div
                        class="relative z-0 flex items-center justify-center w-full min-h-[380px] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 group">
                        <x-placeholder-pattern
                            class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />

                        <!-- Menampilkan Gambar Produk -->
                        <div class="relative w-full h-full">
                            @if ($product->image_produk)
                                <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                                    alt="{{ $product->nama }}"
                                    class="w-full h-full object-cover rounded-lg transition duration-300 group-hover:scale-105 group-hover:opacity-75">
                            @else
                                <p
                                    class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">
                                    {{ __('Tidak ada gambar produk') }}</p>
                            @endif
                        </div>

                        <!-- Nama Produk -->
                        <div
                            class="absolute inset-x-0 bottom-0 flex flex-col items-center justify-center bg-gradient-to-t from-black to-transparent">
                            <div class="flex items-center justify-center flex-col p-4">
                                <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}"
                                    class="w-14 h-14 object-cover rounded-full opacity-70 transition duration-300 group-hover:opacity-100 border border-white">
                                <h2 class="text-white font-semibold text-center px-4 pt-2">{{ $product->nama }}</h2>
                            </div>

                            <div class="text-xs grid grid-cols-2 p-4 place-content-between w-full">
                                <p>Width : {{ $product->width }}mm</p>
                                <p>Length : {{ $product->length }}mm</p>
                                <p>Thickness : {{ $product->thickness }}mm</p>
                            </div>
                        </div>

                        <p class="text-xs bg-orange-700 rounded-xl px-3 py-1 absolute top-4 right-4">
                            {{ $product->category->name_category }}</p>

                        <!-- Tombol Edit dan Pulihkan -->
                        <div
                            class="absolute z-0 flex gap-4 opacity-0 group-hover:opacity-100 transition duration-300 pb-20">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="bg-black/30 backdrop-blur py-1 px-3 rounded-full text-xs flex items-center gap-2 h-fit">
                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                            </a>
                            <button onclick="openRestoreModal('{{ $product->id }}')"
                                class="bg-amber-800 text-white py-1 px-3 rounded-full text-xs flex items-center gap-2 h-fit hover:bg-amber-600">
                                <i class="fas fa-recycle"></i> {{ __('Pulihkan') }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Konfirmasi Pulihkan Produk -->
    <div id="restoreModal"
        class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('Konfirmasi Pulihkan Produk') }}
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Apakah Anda yakin ingin memulihkan produk ini?') }}
            </p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeRestoreModal()"
                    class="btn btn-secondary text-gray-700 dark:text-white text-sm py-1 px-3 rounded-md hover:bg-gray-300 transition-colors">{{ __('Cancel') }}</button>
                <form id="restoreForm" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="btn btn-primary text-white text-sm py-1 px-3 rounded-md hover:bg-amber-800 transition-colors">{{ __('Pulihkan') }}</button>
                </form>
            </div>
        </div>
    </div>

</x-layouts.app>

<script>
    // Fungsi untuk membuka modal restore
    function openRestoreModal(productId) {
        // Set the action URL for the restore form
        const restoreForm = document.getElementById('restoreForm');
        restoreForm.action = '/products/' + productId + '/restore';

        // Tampilkan modal
        document.getElementById('restoreModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal restore
    function closeRestoreModal() {
        document.getElementById('restoreModal').classList.add('hidden');
    }
</script>
