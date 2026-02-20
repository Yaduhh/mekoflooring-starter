<x-layouts.app :title="__('Door Type Categories')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Header -->
        <div class="flex justify-between items-center mb-2 lg:mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Door Type Categories') }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage door categories (2D images only, no 3D models)</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="btn btn-primary bg-[#543A14] hover:bg-[#6B4E1A] text-white px-4 py-2 rounded-md transition-colors">
                <i class="fas fa-plus mr-2"></i>{{ __('Create Category') }}
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div id="successNotification" class="bg-emerald-700 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-check-circle text-2xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div id="errorNotification" class="bg-red-600 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-exclamation-circle text-2xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800 shadow-md hover:shadow-lg transition-all duration-300">
                    <!-- Category Image -->
                    <div class="w-full aspect-square bg-gray-100 dark:bg-neutral-700">
                        @if ($category->image_category)
                            <img src="{{ Storage::url($category->image_category) }}"
                                alt="{{ $category->name_category }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                <div>
                                    <i class="fas fa-door-open text-4xl mb-2"></i>
                                    <p class="text-sm">{{ __('No Image') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Category Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate mb-2">
                            {{ $category->name_category }}
                        </h3>

                        <!-- Product Count Badge -->
                        <div class="mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                {{ $category->complete_models_count > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                <i class="fas fa-cube mr-2"></i>
                                {{ $category->complete_models_count }} 3D Model{{ $category->complete_models_count != 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-3">
                            <a href="{{ route('categories.edit', $category) }}"
                                class="flex-1 btn btn-warning bg-amber-600 hover:bg-amber-700 text-white text-sm py-2 px-3 rounded-md transition-colors text-center">
                                <i class="fas fa-edit mr-1"></i>{{ __('Edit') }}
                            </a>

                            <button onclick="openDeleteModal('{{ $category->id }}')"
                                class="flex-1 btn btn-danger bg-red-600 hover:bg-red-700 text-white text-sm py-2 px-3 rounded-md transition-colors">
                                <i class="fas fa-trash mr-1"></i>{{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($categories->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                <i class="fas fa-door-open text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-2">No Door Categories Yet</h3>
                <p class="text-gray-500 dark:text-gray-500 mb-6">Create your first door type category</p>
                <a href="{{ route('categories.create') }}"
                    class="inline-block bg-[#543A14] text-white px-6 py-3 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Category
                </a>
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('Confirm Delete Category') }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Are you sure you want to delete this category? All associated 3D models will remain but won\'t be visible in this category.') }}</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()"
                    class="btn btn-secondary text-gray-700 dark:text-white bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-sm py-2 px-4 rounded-md transition-colors">
                    {{ __('Cancel') }}
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-danger bg-red-600 hover:bg-red-700 text-white text-sm py-2 px-4 rounded-md transition-colors">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(categoryId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '/categories/' + categoryId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Auto-hide notifications
        setTimeout(() => {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            if (successNotification) {
                successNotification.classList.add('opacity-0');
                setTimeout(() => successNotification.remove(), 500);
            }
            if (errorNotification) {
                errorNotification.classList.add('opacity-0');
                setTimeout(() => errorNotification.remove(), 500);
            }
        }, 5000);
    </script>
</x-layouts.app>
