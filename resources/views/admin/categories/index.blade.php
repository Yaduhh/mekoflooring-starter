<x-layouts.app :title="__('Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Kategori') }}</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary text-white px-4 py-2 rounded-md">{{ __('Tambah Kategori Baru') }}</a>
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800 shadow-md hover:shadow-lg transition-all duration-300">
                    <!-- Kategori Image -->
                    <div class="w-full h-48 bg-gray-100 dark:bg-neutral-700">
                        @if ($category->image_category)
                            <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                {{ __('Tidak ada gambar kategori') }}
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <!-- Nama Kategori -->
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $category->name_category }}</h3>

                        <!-- Edit and Delete Buttons -->
                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning text-white text-sm py-1 px-3 rounded-md hover:bg-yellow-600 transition-colors">{{ __('Edit') }}</a>
                            
                            <!-- Delete Button with Confirmation -->
                            <button onclick="openDeleteModal('{{ $category->id }}')" class="btn btn-danger text-white text-sm py-1 px-3 rounded-md hover:bg-red-600 transition-colors">{{ __('Delete') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ __('Konfirmasi Hapus Kategori') }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('Apakah Anda yakin ingin menghapus kategori ini?') }}</p>
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
        // Fungsi untuk membuka modal delete
        function openDeleteModal(categoryId) {
            // Set the action URL for the delete form
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '/categories/' + categoryId;

            // Tampilkan modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal delete
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Auto-hide notification after 5 seconds
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
