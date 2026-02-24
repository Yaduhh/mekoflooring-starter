<x-layouts.app :title="__('Tambah Door Model 3D')">
    <div class="max-w-4xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('admin.door-models.index') }}" class="text-gray-400 hover:text-[#543A14] transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Door Model 3D</h2>
                <p class="text-sm text-gray-500 mt-1">Upload model 3D pintu lengkap (door + handle jadi satu)</p>
            </div>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4 mb-8">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-600 text-lg mt-0.5"></i>
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    Upload file <strong>.glb</strong> atau <strong>.gltf</strong>. Pastikan semua texture sudah embedded di dalam file GLB. Ukuran maksimal <strong>100MB</strong>.
                </p>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.door-models.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- SECTION: Informasi Pintu --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                    <i class="fas fa-door-open mr-2 text-[#543A14]"></i>Informasi Pintu
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Door Type <span class="text-red-500">*</span>
                        </label>
                        <select name="door_type_id"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            <option value="">-- Pilih Door Type --</option>
                            @foreach($doorTypes as $type)
                                <option value="{{ $type->id }}" {{ old('door_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('door_type_id')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Dasar Pintu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="door_base_name" value="{{ old('door_base_name') }}"
                               placeholder="Contoh: Meko Classic, Meko Modern"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Dipakai untuk mengelompokkan variasi handle</p>
                        @error('door_base_name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Handle <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_name" value="{{ old('handle_name') }}"
                               placeholder="Contoh: Gold Round, Silver Bar"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                        @error('handle_name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Kode Handle <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_code" value="{{ old('handle_code') }}"
                               placeholder="Contoh: H001, GR-01" maxlength="20"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                        @error('handle_code')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Kompleksitas Model <span class="text-red-500">*</span>
                        </label>
                        <select name="model_complexity"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            <option value="low" {{ old('model_complexity') == 'low' ? 'selected' : '' }}>Low (&lt; 10MB)</option>
                            <option value="medium" {{ old('model_complexity', 'medium') == 'medium' ? 'selected' : '' }}>Medium (10–30MB)</option>
                            <option value="high" {{ old('model_complexity') == 'high' ? 'selected' : '' }}>High (&gt; 30MB)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3"
                                  class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-zinc-700 text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                  placeholder="Deskripsi singkat model pintu ini...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECTION: Upload File --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                    <i class="fas fa-upload mr-2 text-[#543A14]"></i>Upload File
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            File 3D Model (.glb / .gltf) <span class="text-red-500">*</span>
                        </label>
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-[#543A14] transition-colors">
                            <i class="fas fa-cube text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-500 text-sm mb-3">Upload file GLB atau GLTF (maks. 100MB)</p>
                            <input type="file" name="model_file" accept=".glb,.gltf" required
                                   class="w-full text-gray-800 dark:text-white">
                        </div>
                        @error('model_file')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Gambar Katalog <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="catalog_image" accept="image/jpeg,image/png,image/jpg,image/webp" required
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white">
                        <p class="text-xs text-gray-500 mt-1">Gambar untuk daftar produk</p>
                        @error('catalog_image')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Viewer Thumbnail <span class="text-gray-400 text-xs">(opsional)</span>
                        </label>
                        <input type="file" name="viewer_thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white">
                        <p class="text-xs text-gray-500 mt-1">Jika kosong, akan pakai gambar katalog</p>
                        @error('viewer_thumbnail')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                <button type="submit"
                        class="flex-1 bg-[#543A14] text-white py-4 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Simpan Model 3D
                </button>
                <a href="{{ route('admin.door-models.index') }}"
                   class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
