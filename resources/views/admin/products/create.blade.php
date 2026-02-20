<x-layouts.app :title="__('Buat Produk Baru')">
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        <!-- Formulir untuk membuat produk baru -->
        <div class="w-full mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8">{{ __('Buat Produk Baru') }}</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Grid Dua Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Produk -->
                    <div>
                        <label for="nama"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Nama Produk') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4"
                            required oninput="generateSlug()">
                        @error('nama')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Slug Produk (Auto-generated, hidden) -->
                    <input type="hidden" name="slug_produk" id="slug_produk" value="{{ old('slug_produk') }}">

                    <!-- Kategori Produk - FIXED: Visible & Optional -->
                    <div>
                        <label for="id_category"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Kategori Produk') }}
                            <span class="text-sm text-gray-500">(Opsional)</span>
                        </label>
                        <select name="id_category" id="id_category"
                            class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                            <option value="" class="bg-white dark:bg-zinc-700 text-gray-800 dark:text-white">
                                {{ __('Tanpa Kategori (Produk Umum)') }}
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('id_category') == $category->id ? 'selected' : '' }}
                                    class="bg-white dark:bg-zinc-700 text-gray-800 dark:text-white">
                                    {{ $category->name_category }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle"></i>
                            Kategori hanya diperlukan untuk produk berkaitan dengan door types
                        </p>
                        @error('id_category')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status Produk -->
                    <div class="w-full">
                        <label for="status"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Status Produk') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4"
                            required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}
                                class="bg-white dark:bg-zinc-700 dark:text-white">{{ __('Aktif') }}</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}
                                class="bg-white dark:bg-zinc-700 dark:text-white">{{ __('Non-Aktif') }}</option>
                        </select>
                    </div>

                    <!-- Tipe Produk -->
                    <div class="w-full">
                        <label for="product_type"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Tipe Produk') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="product_type" id="product_type"
                            class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4"
                            required onchange="toggleProductTypeInfo()">
                            <option value="0" {{ old('product_type') == '0' ? 'selected' : '' }}
                                class="bg-white dark:bg-zinc-700 dark:text-white">{{ __('Produk Biasa (Floor, SPC, dll)') }}</option>
                            <option value="1" {{ old('product_type') == '1' ? 'selected' : '' }}
                                class="bg-white dark:bg-zinc-700 dark:text-white">{{ __('Aksesoris 2D (Homepage)') }}</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle"></i>
                            <span id="product-type-hint">Produk yang ditampilkan di homepage</span>
                        </p>
                    </div>

                    <!-- Gambar Produk -->
                    <div>
                        <label for="image_produk"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Gambar Produk') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="image_produk" id="image_produk"
                            class="mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4"
                            accept="image/*" required>
                        @error('image_produk')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mockup Image -->
                    <div>
                        <label for="mockup_image"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Gambar Mockup Produk') }}
                        </label>
                        <input type="file" name="mockup_image" id="mockup_image"
                            class="mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                        <p class="text-xs text-gray-500 mt-1">Opsional - untuk preview tambahan</p>
                        @error('mockup_image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Dimensions (Width, Length, Thickness) -->
                    <div class="col-span-2 border-t-2 border-gray-200 dark:border-gray-600 pt-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                            {{ __('Dimensi Produk (Opsional)') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="width"
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Tall (cm)') }}
                                </label>
                                <input type="number" name="width" id="width" value="{{ old('width') }}" step="0.01"
                                    class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                                @error('width')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="length"
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Width (cm)') }}
                                </label>
                                <input type="number" name="length" id="length" value="{{ old('length') }}" step="0.01"
                                    class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                                @error('length')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="thickness"
                                    class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Thickness (cm)') }}
                                </label>
                                <input type="number" name="thickness" id="thickness" value="{{ old('thickness') }}" step="0.01"
                                    class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                                @error('thickness')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Produk -->
                    <div class="w-full col-span-2 border-t-2 border-gray-200 dark:border-gray-600 pt-6">
                        <label for="description"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Deskripsi Produk') }}
                        </label>
                        <textarea name="description" id="description" rows="5"
                            class="mt-1 block w-full bg-white dark:bg-zinc-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-[#543A14] text-white p-4 rounded-xl hover:bg-[#6B4E1A] focus:ring-4 focus:ring-blue-500 focus:outline-none transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        {{ __('Simpan Produk') }}
                    </button>
                    <a href="{{ route('products.index') }}"
                        class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                        <i class="fas fa-times mr-2"></i>
                        {{ __('Batal') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function generateSlug() {
            let nama = document.getElementById('nama').value;
            let slug = nama.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug_produk').value = slug;
        }

        function toggleProductTypeInfo() {
            const productType = document.getElementById('product_type').value;
            const hint = document.getElementById('product-type-hint');

            if (productType === '0') {
                hint.textContent = 'Produk regular (floor, SPC, dll) untuk homepage';
            } else if (productType === '1') {
                hint.textContent = 'Aksesoris 2D untuk tampilan di homepage';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleProductTypeInfo();
        });
    </script>
</x-layouts.app>
