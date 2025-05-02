<x-layouts.app :title="__('Catalogue')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Catalogue') }}</h2>
            <a href="{{ route('admin.catalogue.create') }}" class="btn btn-primary bg-amber-800 text-white px-4 py-2 rounded-md">{{ __('Create') }}</a>
        </div>

        <!-- Notifikasi Success -->
        @if (session('success'))
            <div id="successNotification" class="bg-emerald-700 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-check-circle text-2xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if (session('error'))
            <div id="errorNotification" class="bg-red-600 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-exclamation-circle text-2xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($catalogues as $catalogue)
                <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800 shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="w-full aspect-square bg-gray-100 dark:bg-neutral-700">
                        @if ($catalogue->images)
                            <img src="{{ Storage::url($catalogue->images) }}" alt="{{ $catalogue->deskripsi }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                {{ __('No Image Available') }}
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.catalogue.edit', $catalogue) }}" class="btn btn-warning text-white text-sm py-1 px-3 rounded-md hover:bg-yellow-600 transition-colors">{{ __('Edit') }}</a>
                             <button onclick="openDeleteModal('{{ $catalogue->id }}')" class="btn btn-danger text-white text-sm py-1 px-3 rounded-md hover:bg-red-600 transition-colors">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $catalogues->links() }}
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('Confirm Deletion') }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Are you sure you want to delete this catalogue?') }}</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()" class="btn btn-secondary text-gray-700 dark:text-white text-sm py-1 px-3 rounded-md hover:bg-gray-300 transition-colors">{{ __('Cancel') }}</button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-white text-sm py-1 px-3 rounded-md hover:bg-red-600 transition-colors">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(catalogueId) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '/admin/catalogue/' + catalogueId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        setTimeout(() => {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            if (successNotification) {
                successNotification.classList.remove('opacity-100');
                successNotification.classList.remove('flex');
                successNotification.classList.add('opacity-0');
                successNotification.classList.add('hidden');
            }
            if (errorNotification) {
                errorNotification.classList.remove('flex');
                errorNotification.classList.remove('opacity-100');
                errorNotification.classList.add('opacity-0');
                errorNotification.classList.add('hidden');
            }
        }, 5000);
    </script>
</x-layouts.app>
