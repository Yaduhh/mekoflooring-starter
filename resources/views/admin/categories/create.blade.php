{{-- resources/views/admin/categories/create.blade.php --}}
<x-layouts.app :title="__('Create Door Type Category')">
    <div class="max-w-2xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">
            {{ __('Create Door Type Category') }}
        </h2>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Door Type Name -->
            <div>
                <label for="name_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Door Type Name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name_category" id="name_category"
                    value="{{ old('name_category') }}"
                    class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                    placeholder="e.g., Classic Oak Doors, Modern Steel Doors"
                    required oninput="generateSlug()">
                @error('name_category')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
                <p class="text-sm text-gray-500 mt-1">This will be shown to users as a door category</p>
            </div>

            <!-- Auto-generated Slug (hidden) -->
            <input type="hidden" name="slug_category" id="slug_category" value="{{ old('slug_category') }}">

            <!-- Representative Image (2D Only) -->
            <div>
                <label for="image_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Door Type Image (2D Photo)') }} <span class="text-red-500">*</span>
                </label>
                <input type="file" name="image_category" id="image_category"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                    accept="image/*" required>
                <p class="text-sm text-gray-500 mt-1">
                    <i class="fas fa-info-circle"></i>
                    Upload a representative 2D photo of this door type (not a 3D model). This is for browsing only.
                </p>
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
                    class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                    placeholder="Describe this door type...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
                    <div class="text-sm text-blue-800 dark:text-blue-200">
                        <p class="font-semibold mb-1">About Door Type Categories:</p>
                        <p>This category will only store a 2D image and description. Actual 3D models (door + handle combinations) will be created separately in the "Complete Door Models" section.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                    class="flex-1 bg-[#543A14] text-white px-6 py-3 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('Create Category') }}
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
