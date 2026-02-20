<x-layouts.app :title="__('Buat Complete Door Model 3D')">
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        <div class="w-full mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">

            <div class="flex items-center gap-3 mb-8">
                <a href="{{ route('admin.products.complete-doors') }}" class="text-gray-500 hover:text-[#543A14] transition-colors">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ __('Buat Complete Door Model 3D') }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Upload model pintu 3D lengkap (door + handle sudah jadi satu)</p>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-8">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
                    <div>
                        <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-1">Petunjuk Upload</h3>
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            Upload file <strong>.glb</strong> atau <strong>.gltf</strong> — pastikan bukan file <strong>.bin</strong>.
                            File GLB sudah include semua texture di dalamnya. Ukuran maksimal 100MB.
                        </p>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 mb-6">
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <input type="hidden" name="product_type" value="3">

                <!-- Informasi Dasar -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                        <i class="fas fa-door-open mr-2 text-[#543A14]"></i>Informasi Pintu
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Kategori -->
                        <div>
                            <label for="id_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Kategori Pintu <span class="text-red-500">*</span>
                            </label>
                            <select name="id_category" id="id_category"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Door Base Name -->
                        <div>
                            <label for="door_base_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nama Dasar Pintu <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="door_base_name" id="door_base_name"
                                value="{{ old('door_base_name') }}"
                                placeholder="Contoh: Meko Classic, Meko Modern"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Nama pintu tanpa handle (dipakai untuk grouping variasi)</p>
                            @error('door_base_name')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Handle Name -->
                        <div>
                            <label for="handle_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Nama Handle <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="handle_name" id="handle_name"
                                value="{{ old('handle_name') }}"
                                placeholder="Contoh: Gold Round, Silver Bar"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                            @error('handle_name')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Handle Code -->
                        <div>
                            <label for="handle_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Kode Handle <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="handle_code" id="handle_code"
                                value="{{ old('handle_code') }}"
                                placeholder="Contoh: H001, GR-01"
                                maxlength="10"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                            @error('handle_code')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Model Complexity -->
                        <div>
                            <label for="model_complexity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Kompleksitas Model <span class="text-red-500">*</span>
                            </label>
                            <select name="model_complexity" id="model_complexity"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                required>
                                <option value="low" {{ old('model_complexity') == 'low' ? 'selected' : '' }}>Low (< 10MB)</option>
                                <option value="medium" {{ old('model_complexity', 'medium') == 'medium' ? 'selected' : '' }}>Medium (10–30MB)</option>
                                <option value="high" {{ old('model_complexity') == 'high' ? 'selected' : '' }}>High (> 30MB)</option>
                            </select>
                            @error('model_complexity')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                                placeholder="Deskripsi singkat model pintu ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Upload File -->
                <div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                        <i class="fas fa-upload mr-2 text-[#543A14]"></i>Upload File
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- File 3D Model -->
                        <div class="md:col-span-2">
                            <label for="complete_model_3d" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                File 3D Model (.glb / .gltf) <span class="text-red-500">*</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-[#543A14] transition-colors">
                                <i class="fas fa-cube text-4xl text-gray-400 mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">Upload file GLB atau GLTF (maks. 100MB)</p>
                                <input type="file" name="complete_model_3d" id="complete_model_3d"
                                    class="w-full text-gray-800 dark:text-white"
                                    accept=".glb,.gltf"
                                    required>
                                <p class="text-xs text-red-500 mt-2 font-semibold">upload .glb atau .gltf</p>
                            </div>
                            @error('complete_model_3d')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Catalog Image -->
                        <div>
                            <label for="catalog_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gambar Katalog <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="catalog_image" id="catalog_image"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                required>
                            <p class="text-xs text-gray-500 mt-1">Gambar yang ditampilkan di daftar produk (jpg, png, webp)</p>
                            @error('catalog_image')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Viewer Thumbnail -->
                        <div>
                            <label for="viewer_thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Viewer Thumbnail
                            </label>
                            <input type="file" name="viewer_thumbnail" id="viewer_thumbnail"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                                accept="image/jpeg,image/png,image/jpg,image/webp">
                            <p class="text-xs text-gray-500 mt-1">Opsional — jika kosong, akan pakai gambar katalog</p>
                            @error('viewer_thumbnail')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                    <button type="submit"
                        class="flex-1 bg-[#543A14] text-white p-4 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                        <i class="fas fa-save mr-2"></i>Simpan Model 3D
                    </button>
                    <a href="{{ route('admin.products.complete-doors') }}"
                        class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
