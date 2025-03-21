<x-layouts.app :title="__('Buat Produk Baru')">
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        <!-- Formulir untuk membuat produk baru -->
        <div class="max-w-4xl mx-auto p-8 bg-white dark:bg-zinc-800">
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-8">{{ __('Buat Produk Baru') }}</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Grid Dua Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Produk -->
                    <div>
                        <label for="nama" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required oninput="generateSlug()">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Slug Produk (Akan otomatis terisi) -->
                    <div>
                        <label for="slug_produk" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Slug Produk') }}</label>
                        <input type="text" name="slug_produk" id="slug_produk" value="{{ old('slug_produk') }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required readonly>
                        @error('slug_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Select Kategori -->
                    <div>
                        <label for="id_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Kategori Produk') }}</label>
                        <select name="id_category" id="id_category" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required>
                            <option value="" disabled selected  class="dark:bg-zinc-700 dark:text-white">{{ __('Pilih Kategori') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }} class="dark:bg-zinc-700 dark:text-white">{{ $category->name_category }}</option>
                            @endforeach
                        </select>
                        @error('id_category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>


                    <!-- Gambar Produk -->
                    <div>
                        <label for="image_produk" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Gambar Produk') }}</label>
                        <input type="file" name="image_produk" id="image_produk" class="mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" accept="image/*">
                        @error('image_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Width Produk -->
                    <div>
                        <label for="width" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Width (Lebar Produk)') }}</label>
                        <input type="number" name="width" id="width" value="{{ old('width') }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required>
                        @error('width') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>  

                    <!-- Length -->
                    <div>
                        <label for="length" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Panjang Produk') }}</label>
                        <input type="number" name="length" id="length" value="{{ old('length') }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required>
                        @error('length') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Thickness Produk -->
                    <div>
                        <label for="thickness" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Thickness (Ketebalan Produk)') }}</label>
                        <input type="number" name="thickness" id="thickness" value="{{ old('thickness') }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required>
                        @error('thickness') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Mockup Image -->
                    <div>
                        <label for="mockup_image" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Gambar Mockup Produk') }}</label>
                        <input type="file" name="mockup_image" id="mockup_image" class="mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">
                        @error('mockup_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Deskripsi Produk -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Deskripsi Produk') }}</label>
                        <textarea name="description" id="description" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Status Produk -->
                <div>
                    <label for="status" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Status Produk') }}</label>
                    <select name="status" id="status" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none py-2 px-4" required>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Aktif') }}</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('Non-Aktif') }}</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none">{{ __('Simpan Produk') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript untuk Membuat Slug -->
    <script>
        function generateSlug() {
            let nama = document.getElementById('nama').value;
            let slug = nama.toLowerCase()
                           .replace(/[^a-z0-9]+/g, '-')
                           .replace(/^-+|-+$/g, '');
            document.getElementById('slug_produk').value = slug;
        }
    </script>
</x-layouts.app>
