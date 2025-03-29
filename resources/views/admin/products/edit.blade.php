<x-layouts.app :title="__('Edit Produk')">
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        <!-- Formulir untuk mengedit produk -->
        <div class="mx-auto bg-white dark:bg-zinc-800 rounded-xl">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-8">{{ __('Edit Produk') }}</h2>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Grid Dua Kolom untuk Inputan -->
                <div class="grid grid-cols-3 gap-8">
                    <div class="col-span-1">
                        <div class="relative z-0 flex items-center justify-center w-full min-h-[280px] overflow-hidden rounded-xl group">
                            @if ($product->image_produk)
                                <div class="relative group">
                                    <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-auto rounded-xl group-hover:scale-125 transition duration-300">
                                    <!-- Hover Area with "Change Image" Button -->
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/30 bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300">
                                        <p class="text-white font-semibold cursor-pointer">Change Image</p>
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="image_produk" id="image_produk" class="absolute inset-0 mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-md opacity-0 cursor-pointer focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4">
                            @error('image_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!-- Gambar Produk -->

                    <div class="col-span-2 space-y-6">
                        <div class="flex gap-8 justify-between">
                            <!-- Nama Produk -->
                            <div class="w-full">
                                <label for="nama" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Produk') }}</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $product->nama) }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required oninput="generateSlug()">
                                @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
        
                            <div class="hidden">
                                <label for="slug_produk" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Slug Produk') }}</label>
                                <input type="text" name="slug_produk" id="slug_produk" value="{{ old('slug_produk', $product->slug_produk) }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required readonly>
                                @error('slug_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
        
                            <!-- Select Kategori -->
                            <div class="w-full">
                                <label for="id_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Kategori Produk') }}</label>
                                <select name="id_category" id="id_category" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required>
                                    <option value="" disabled selected>{{ __('Pilih Kategori') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>{{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                                @error('id_category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
    
                        <div class="flex gap-8 justify-between">
                            <!-- Width Produk -->
                            <div class="w-full">
                                <label for="width" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Length (mm)') }}</label>
                                <input type="number" name="width" id="width" value="{{ old('width', $product->width) }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required>
                                @error('width') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>  
        
                            <!-- Length Produk -->
                            <div class="w-full">
                                <label for="length" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Width (mm)')}}</label>
                                <input type="number" name="length" id="length" value="{{ old('length', $product->length) }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required>
                                @error('length') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
        
                            <!-- Thickness Produk -->
                            <div class="w-full">
                                <label for="thickness" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Thickness (mm)') }}</label>
                                <input type="number" name="thickness" id="thickness" value="{{ old('thickness', $product->thickness) }}" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required>
                                @error('thickness') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
    
                        <!-- Mockup Image -->
                        <div>
                            @error('mockup_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            @if ($product->mockup_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}"  class="w-full h-auto rounded-xl">
                            </div>
                            @endif
                            <input type="file" name="mockup_image" id="mockup_image" class="mt-1 block w-full text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600 rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4">
                        </div>
    
                        <!-- Deskripsi Produk -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Deskripsi Produk') }}</label>
                            <textarea name="description" id="description" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4">{{ old('description', $product->description) }}</textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <!-- Status Produk -->
                        <div>
                            <label for="status" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Status Produk') }}</label>
                            <select name="status" id="status" class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-md focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none py-3 px-4" required>
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>{{ __('Aktif') }}</option>
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>{{ __('Non-Aktif') }}</option>
                            </select>
                        </div>
                        <!-- Tombol Submit -->
                        <div>
                            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500 focus:outline-none">{{ __('Simpan Produk') }}</button>
                        </div>
                    </div>
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
