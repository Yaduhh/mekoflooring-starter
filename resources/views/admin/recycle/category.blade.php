<x-layouts.app :title="__('Recycle Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex justify-between items-center mb-2 lg:mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Recycle Category') }}</h2>
        </div>
        <!-- Notifikasi Success -->
        @if (session('success'))
            <div id="successNotification"
                class="bg-emerald-700 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-check-circle text-2xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if (session('error'))
            <div id="errorNotification"
                class="bg-red-600 text-white dark:text-black p-4 rounded-xl shadow-md flex items-center space-x-3 opacity-100 transition-opacity duration-500 mb-4">
                <i class="fas fa-exclamation-circle text-2xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($categories->isEmpty())
            <div class="text-center py-20">
                <p>Tidak ada data yang ditampilkan</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div
                        class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800 shadow-md hover:shadow-lg transition-all duration-300">
                        <!-- Kategori Image -->
                        <div class="w-full h-48 bg-gray-100 dark:bg-neutral-700">
                            @if ($category->image_category)
                                <img src="{{ Storage::url($category->image_category) }}"
                                    alt="{{ $category->name_category }}" class="w-full h-full object-cover">
                            @else
                                <div
                                    class="flex items-center justify-center h-full text-center text-gray-500 dark:text-neutral-400">
                                    {{ __('Tidak ada gambar kategori') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <!-- Nama Kategori -->
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">
                                {{ $category->name_category }}</h3>

                            <!-- Edit and Delete Buttons -->
                            <div class="mt-4 flex justify-between items-center gap-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-warning text-white text-sm py-1 px-3 rounded-md hover:bg-yellow-600 transition-colors">{{ __('Edit') }}
                                    </a>
                                    <button onclick="openRestoreModal('{{ $category->id }}')"
                                        class="btn btn-danger text-white text-sm py-1 px-3 rounded-md hover:bg-red-600 transition-colors">{{ __('Pulihkan') }}
                                    </button>
                                </div>
                                <button onclick="openDeleteModal('{{ $category->id }}')"
                                    class="btn btn-danger text-white text-sm py-1 px-3 rounded-md hover:bg-red-600 transition-colors">{{ __('Hapus Permanent') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Konfirmasi Pulihkan -->
    <div id="restoreModal"
        class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                {{ __('Konfirmasi Pulihkan Kategori') }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                {{ __('Apakah Anda yakin ingin memulihkan kategori ini?') }}</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeRestoreModal()"
                    class="btn btn-secondary text-gray-700 dark:text-white text-sm py-1 px-3 rounded-md hover:bg-gray-300 transition-colors">{{ __('Cancel') }}</button>
                <form id="restoreForm" method="POST" class="inline">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT karena kita melakukan update -->
                    <button type="submit"
                        class="btn btn-primary text-white text-sm py-1 px-3 rounded-md hover:bg-amber-800 transition-colors">{{ __('Pulihkan') }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Pulihkan -->
    <div id="deleteModal"
        class="fixed inset-0 bg-black/30 bg-opacity-75 flex items-center justify-center z-50 hidden backdrop-blur">
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl shadow-lg w-96">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                {{ __('Konfirmasi Delete Kategori') }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                {{ __('Apakah Anda yakin ingin menghapus permanent kategori ini?') }}</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()"
                    class="btn btn-secondary text-gray-700 dark:text-white text-sm py-1 px-3 rounded-md hover:bg-gray-300 transition-colors">{{ __('Cancel') }}</button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT karena kita melakukan update -->
                    <button type="submit"
                        class="btn btn-primary text-white text-sm py-1 px-3 rounded-md hover:bg-amber-800 transition-colors">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Fungsi untuk membuka modal restore
        function openRestoreModal(categoryId) {
            // Set the action URL for the restore form
            const restoreForm = document.getElementById('restoreForm');
            restoreForm.action = '/categories/' + categoryId + '/restore';

            // Tampilkan modal
            document.getElementById('restoreModal').classList.remove('hidden');
        }

        function openDeleteModal(categoryId) {
            // Set the action URL for the restore form
            const restoreForm = document.getElementById('deleteForm');
            restoreForm.action = '/categories/' + categoryId + '/delete';

            // Tampilkan modal
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal restore
        function closeRestoreModal() {
            document.getElementById('restoreModal').classList.add('hidden');
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
