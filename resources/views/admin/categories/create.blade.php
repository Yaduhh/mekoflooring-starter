<x-layouts.app :title="__('Tambah Kategori Baru')">
    <div class="flex flex-col gap-8 py-10 px-4 sm:px-6 lg:px-8 xl:px-16 mx-auto">
        <div class="bg-white dark:bg-zinc-800 p-8">
            <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6">{{ __('Tambah Kategori Baru') }}</h2>

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Nama Kategori -->
                <div class="space-y-2">
                    <label for="name_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Kategori') }}</label>
                    <input type="text" name="name_category" id="name_category" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" required>
                </div>

                <!-- Slug Kategori (akan diisi otomatis) -->
                <div class="space-y-2 hidden">
                    <label for="slug_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Slug Kategori') }}</label>
                    <input type="text" name="slug_category" id="slug_category" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" required readonly>
                </div>

                <!-- Gambar Kategori -->
                <div class="space-y-2">
                    <label for="image_category" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Gambar Kategori') }}</label>
                    <input type="file" name="image_category" id="image_category" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300" onchange="previewImage()">
                </div>

                <!-- Preview Gambar -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pratinjau Gambar:') }}</p>
                    <img id="preview" class="w-full h-auto rounded-lg shadow-lg" src="" alt="Pratinjau Gambar" />
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit" class="w-full py-5 hover:cursor-pointer mt-12 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 transition duration-300">{{ __('Simpan Kategori') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript untuk membuat slug otomatis berdasarkan name_category
        const nameCategoryInput = document.getElementById('name_category');
        const slugCategoryInput = document.getElementById('slug_category');

        nameCategoryInput.addEventListener('input', function() {
            let slug = nameCategoryInput.value
                .toLowerCase()
                .replace(/\s+/g, '-') // Gantilah spasi dengan tanda "-"
                .replace(/[^\w\-]+/g, '') // Hapus karakter selain huruf, angka, dan dash
                .replace(/\-\-+/g, '-') // Menghindari spasi ganda
                .replace(/^-+/, '') // Menghapus dash di depan
                .replace(/-+$/, ''); // Menghapus dash di belakang

            slugCategoryInput.value = slug; // Masukkan slug ke input slug_category
        });

        // Fungsi untuk menampilkan pratinjau gambar setelah memilih gambar
        function previewImage() {
            const file = document.getElementById('image_category').files[0];
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-layouts.app>
