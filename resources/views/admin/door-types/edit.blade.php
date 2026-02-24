<x-layouts.app :title="__('Edit Door Type')">
    <div class="max-w-2xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{ route('admin.door-types.index') }}" class="text-gray-400 hover:text-[#543A14] transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Door Type</h2>
        </div>

        @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 rounded-xl p-4 mb-6">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.door-types.update', $doorType) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama Door Type <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $doorType->name) }}"
                       class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Update Gambar</label>
                @if($doorType->image)
                    <div class="mb-3">
                        <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                        <img src="{{ Storage::url($doorType->image) }}" alt="{{ $doorType->name }}"
                             class="w-full max-w-xs rounded-xl shadow">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                       onchange="previewImg(this)">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk mempertahankan gambar saat ini</p>
                <img id="imgPreview" class="mt-3 w-full max-w-xs rounded-xl hidden">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3">{{ old('description', $doorType->description) }}</textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="flex-1 bg-[#543A14] text-white py-3 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
                <a href="{{ route('admin.door-types.index') }}"
                   class="px-8 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImg(input) {
            const preview = document.getElementById('imgPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layouts.app>
