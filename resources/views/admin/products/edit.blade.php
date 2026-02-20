{{-- resources/views/admin/products/edit-complete.blade.php --}}
<x-layouts.app :title="__('Edit Complete Door Model')">
    <div class="max-w-4xl mx-auto p-8 bg-white dark:bg-zinc-800 rounded-xl">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
            {{ __('Edit Complete Door Model') }}
        </h2>
        <p class="text-gray-600 dark:text-gray-400 mb-8">
            {{ $product->nama }}
        </p>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <input type="hidden" name="product_type" value="3">

            <!-- Basic Info -->
            <div class="border-b-2 border-gray-200 dark:border-gray-600 pb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                    <i class="fas fa-info-circle mr-2 text-[#543A14]"></i>
                    Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category -->
                    <div>
                        <label for="id_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Door Type Category') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="id_category" id="id_category"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                            <option value="">Select category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_category }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_category')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Status') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                            <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Door & Handle Info -->
            <div class="border-b-2 border-gray-200 dark:border-gray-600 pb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                    <i class="fas fa-door-open mr-2 text-[#543A14]"></i>
                    Door & Handle Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Door Base Name -->
                    <div>
                        <label for="door_base_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Door Base Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="door_base_name" id="door_base_name"
                            value="{{ old('door_base_name', $product->door_base_name) }}"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                        @error('door_base_name')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Handle Name -->
                    <div>
                        <label for="handle_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Handle Name') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_name" id="handle_name"
                            value="{{ old('handle_name', $product->handle_name) }}"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                        @error('handle_name')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Handle Code -->
                    <div>
                        <label for="handle_code" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Handle Code') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="handle_code" id="handle_code"
                            value="{{ old('handle_code', $product->handle_code) }}"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                        @error('handle_code')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Current 3D Model -->
            <div class="border-b-2 border-gray-200 dark:border-gray-600 pb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                    <i class="fas fa-cube mr-2 text-[#543A14]"></i>
                    3D Model
                </h3>

                @if($product->complete_model_3d)
                <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                    <p class="text-sm text-gray-600 dark:text-gray-300">
                        <i class="fas fa-file mr-2"></i>
                        <strong>Current file:</strong> {{ basename($product->complete_model_3d) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                        <i class="fas fa-hdd mr-2"></i>
                        <strong>File size:</strong> {{ $product->formatted_file_size }}
                    </p>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Update 3D Model -->
                    <div class="md:col-span-2">
                        <label for="complete_model_3d" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Update 3D Model File') }}
                        </label>
                        <input type="file" name="complete_model_3d" id="complete_model_3d"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                            accept=".glb,.gltf">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current model</p>
                        @error('complete_model_3d')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Model Complexity -->
                    <div>
                        <label for="model_complexity" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Model Complexity') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="model_complexity" id="model_complexity"
                            class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]"
                            required>
                            <option value="low" {{ old('model_complexity', $product->model_complexity) == 'low' ? 'selected' : '' }}>Low (&lt; 10MB)</option>
                            <option value="medium" {{ old('model_complexity', $product->model_complexity) == 'medium' ? 'selected' : '' }}>Medium (10-30MB)</option>
                            <option value="high" {{ old('model_complexity', $product->model_complexity) == 'high' ? 'selected' : '' }}>High (&gt; 30MB)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Display Images -->
            <div class="border-b-2 border-gray-200 dark:border-gray-600 pb-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">
                    <i class="fas fa-image mr-2 text-[#543A14]"></i>
                    Display Images
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Catalog Image -->
                    <div>
                        @if($product->catalog_image)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Current catalog image:</p>
                            <img src="{{ Storage::url($product->catalog_image) }}"
                                alt="Catalog"
                                class="w-full max-w-xs h-auto rounded-xl shadow-lg">
                        </div>
                        @endif

                        <label for="catalog_image" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Update Catalog Image') }}
                        </label>
                        <input type="file" name="catalog_image" id="catalog_image"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                            accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                        @error('catalog_image')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Viewer Thumbnail -->
                    <div>
                        @if($product->viewer_thumbnail)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Current viewer thumbnail:</p>
                            <img src="{{ Storage::url($product->viewer_thumbnail) }}"
                                alt="Thumbnail"
                                class="w-full max-w-xs h-auto rounded-xl shadow-lg">
                        </div>
                        @endif

                        <label for="viewer_thumbnail" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Update Viewer Thumbnail') }}
                        </label>
                        <input type="file" name="viewer_thumbnail" id="viewer_thumbnail"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-3 text-gray-800 dark:text-white"
                            accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                        @error('viewer_thumbnail')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Description') }}
                </label>
                <textarea name="description" id="description" rows="5"
                    class="w-full border border-gray-300 dark:border-gray-600 bg-transparent text-gray-800 dark:text-white rounded-xl px-4 py-3 focus:ring-[#543A14] focus:border-[#543A14]">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 pt-4 border-t-2 border-gray-200 dark:border-gray-600">
                <button type="submit"
                    class="flex-1 bg-[#543A14] text-white px-6 py-4 rounded-xl hover:bg-[#6B4E1A] transition-colors font-semibold text-lg">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('Update Model') }}
                </button>
                <a href="{{ route('admin.products.complete-doors') }}"
                    class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
