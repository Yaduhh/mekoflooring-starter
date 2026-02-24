<x-layouts.app :title="__('Edit Door Model')">
    <div class="max-w-4xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('admin.door-models.index') }}" class="text-gray-400 hover:text-[#543A14] transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Door Model</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $doorModel->door_base_name }} — {{ $doorModel->handle_name }}</p>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.door-models.update', $doorModel) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

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
                                class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            @foreach($doorTypes as $type)
                                <option value="{{ $type->id }}" {{ old('door_type_id', $doorModel->door_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Dasar Pintu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="door_base_name" value="{{ old('door_base_name', $doorModel->door_base_name) }}"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nama Handle <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_name" value="{{ old('handle_name', $doorModel->handle_name) }}"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Kode Handle <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_code" value="{{ old('handle_code', $doorModel->handle_code) }}"
                               maxlength="20"
                               class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select name="status"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            <option value="1" {{ old('status', $doorModel->status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $doorModel->status) == '0' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kompleksitas Model</label>
                        <select name="model_complexity"
                                class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                                required>
                            <option value="low" {{ old('model_complexity', $doorModel->model_complexity) == 'low' ? 'selected' : '' }}>Low (&lt; 10MB)</option>
                            <option value="medium" {{ old('model_complexity', $doorModel->model_complexity) == 'medium' ? 'selected' : '' }}>Medium (10–30MB)</option>
                            <option value="high" {{ old('model_complexity', $doorModel->model_complexity) == 'high' ? 'selected' : '' }}>High (&gt; 30MB)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3"
                                  class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3">{{ old('description', $doorModel->description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SECTION: File 3D --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                    <i class="fas fa-cube mr-2 text-[#543A14]"></i>File 3D Model
                </h3>
                @if($doorModel->model_file)
                    <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-sm text-gray-600 dark:text-gray-300">
                        <p><i class="fas fa-file mr-2"></i><strong>File saat ini:</strong> {{ basename($doorModel->model_file) }}</p>
                        <p class="mt-1"><i class="fas fa-hdd mr-2"></i><strong>Ukuran:</strong> {{ $doorModel->formatted_file_size }}</p>
                    </div>
                @endif
                <input type="file" name="model_file" accept=".glb,.gltf"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk mempertahankan file saat ini</p>
                @error('model_file')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
            </div>

            {{-- SECTION: Gambar --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                    <i class="fas fa-image mr-2 text-[#543A14]"></i>Gambar
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        @if($doorModel->catalog_image)
                            <p class="text-xs text-gray-500 mb-2">Gambar katalog saat ini:</p>
                            <img src="{{ Storage::url($doorModel->catalog_image) }}"
                                 class="w-full max-w-xs rounded-xl shadow mb-3">
                        @endif
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Update Gambar Katalog</label>
                        <input type="file" name="catalog_image" accept="image/*"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk mempertahankan</p>
                    </div>
                    <div>
                        @if($doorModel->viewer_thumbnail)
                            <p class="text-xs text-gray-500 mb-2">Viewer thumbnail saat ini:</p>
                            <img src="{{ Storage::url($doorModel->viewer_thumbnail) }}"
                                 class="w-full max-w-xs rounded-xl shadow mb-3">
                        @endif
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Update Viewer Thumbnail</label>
                        <input type="file" name="viewer_thumbnail" accept="image/*"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk mempertahankan</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                <button type="submit"
                        class="flex-1 bg-[#543A14] text-white py-4 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Update Model
                </button>
                <a href="{{ route('admin.door-models.index') }}"
                   class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
