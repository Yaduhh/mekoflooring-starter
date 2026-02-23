<x-layouts.app :title="__('Edit Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="mx-auto p-6 bg-white dark:bg-zinc-800 rounded-xl w-full">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">{{ __('Edit Kategori') }}</h2>

            <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Kategori -->
                <div class="space-y-2">
                    <label for="name_category"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Kategori') }}</label>
                    <input type="text" name="name_category" id="name_category"
                        class="mt-1 block w-full bg-transparent border px-5 py-3 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-xl shadow-sm"
                        value="{{ old('name_category', $category->name_category) }}" required>
                </div>

                <!-- Slug Kategori (akan diisi otomatis) -->
                <div class="hidden">
                    <label for="slug_category"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Slug Kategori') }}</label>
                    <input type="text" name="slug_category" id="slug_category"
                        class="mt-1 block w-full bg-transparent border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-md shadow-sm"
                        value="{{ old('slug_category', $category->slug_category) }}" required readonly>
                </div>

                <!-- Gambar Kategori -->
                <div>
                    <label for="image_category"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Gambar Kategori') }}</label>

                    <div class="flex items-start gap-4">
                        <input type="file" name="image_category" id="image_category"
                            class="mt-1 block w-full text-gray-800 px-5 py-3 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md shadow-sm">

                        @if ($category->image_category)
                            <div class="mt-2">
                                <img src="{{ Storage::url($category->image_category) }}"
                                    alt="{{ $category->name_category }}" class="w-full h-auto rounded-lg">
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none">{{ __('Update Kategori') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const nameCategoryInput = document.getElementById('name_category');
        const slugCategoryInput = document.getElementById('slug_category');

        nameCategoryInput.addEventListener('input', function() {
            let slug = nameCategoryInput.value
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');

            slugCategoryInput.value = slug;
        });
    </script>
</x-layouts.app>
