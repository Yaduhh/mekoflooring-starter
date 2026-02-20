{{-- resources/views/admin/categories/edit.blade.php --}}
<x-layouts.app :title="__('Edit Door Type Category')">
    <div class="max-w-2xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
            {{ __('Edit Door Type Category') }}
        </h2>

        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Door Type Name -->
            <div>
                <label for="name_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Door Type Name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name_category" id="name_category"
                    value="{{ old('name_category', $category->name_category) }}"
                    class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                    required oninput="generateSlug()">
                @error('name_category')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Slug (Auto-generated, hidden) -->
            <input type="hidden" name="slug_category" id="slug_category"
                value="{{ old('slug_category', $category->slug_category) }}">

            <!-- Current Image -->
            @if($category->image_category)
            <div>
                <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Current Image') }}
                </label>
                <div class="mb-4">
                    <img src="{{ Storage::url($category->image_category) }}"
                        alt="{{ $category->name_category }}"
                        class="w-full max-w-md h-auto rounded-xl shadow-lg">
                </div>
            </div>
            @endif

            <!-- Update Image -->
            <div>
                <label for="image_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Update Door Type Image') }}
                </label>
                <input type="file" name="image_category" id="image_category"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                    accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                @error('image_category')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Description') }}
                </label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-[#543A14] text-white px-6 py-3 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('Update Category') }}
                </button>
                <a href="{{ route('categories.index') }}"
                    class="px-8 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>

    <script>
        function generateSlug() {
            const name = document.getElementById('name_category').value;
            const slug = name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug_category').value = slug;
        }
    </script>
</x-layouts.app>
