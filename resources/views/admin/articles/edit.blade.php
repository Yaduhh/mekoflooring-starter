<x-layouts.app :title="__('Edit Artikel')">
    <div class="mx-auto p-8 bg-white dark:bg-zinc-800">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">{{ __('Edit Artikel') }}</h2>

        <!-- Tampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="space-y-6" id="articleForm" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menggunakan PUT untuk update data -->

            <div>
                <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Judul Artikel') }}</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" placeholder="type title article here" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 rounded-xl" required>
            </div>

            <div>
                <label for="sinopsis" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Sinopsis') }}</label>
                <textarea name="sinopsis" id="sinopsis" placeholder="type synopsis article here" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 rounded-xl" required>{{ old('sinopsis', $article->sinopsis) }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Konten Artikel') }}</label>
                <textarea name="content" id="content" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 rounded-xl" style="display: none;">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label for="status" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
                <select name="status" id="status" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 rounded-xl">
                    <option value="draft" class="dark:bg-zinc-700 dark:text-white" {{ $article->status == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                    <option value="published" class="dark:bg-zinc-700 dark:text-white" {{ $article->status == 'published' ? 'selected' : '' }}>{{ __('Published') }}</option>
                </select>
            </div>

            <!-- Preview Thumbnail -->
            <div>
                <label for="thumbnail" class="block text-lg font-medium text-gray-700 dark:text-gray-300">{{ __('Thumbnail') }}</label>
                <input type="file" name="thumbnail" id="thumbnail" class="w-full p-4 bg-transparent border-2 border-gray-300 dark:border-gray-600 rounded-xl" onchange="previewThumbnail(event)">
                <!-- Preview Gambar -->
                <div id="thumbnail-preview-container" class="mt-4" style="display: {{ $article->thumbnail ? 'block' : 'none' }}">
                    <img id="thumbnail-preview" src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : '' }}" alt="Thumbnail Preview" class="w-full h-auto rounded-md">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-500">{{ __('Update Artikel') }}</button>
            </div>
        </form>
    </div>

    <!-- Script CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.0/classic/ckeditor.js"></script>
    <script>
        window.onload = function() {
            let editor;

            ClassicEditor
                .create(document.querySelector('#content'), {
                    height: 500, // Atur tinggi editor menjadi 500px
                    toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                })
                .then(newEditor => {
                    editor = newEditor;
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });

            // Menangani submit form dan memperbarui nilai textarea dengan data dari CKEditor
            document.getElementById('articleForm').addEventListener('submit', function(event) {
                const contentField = document.querySelector('#content');
                contentField.value = editor.getData(); // Ambil data dari CKEditor dan masukkan ke dalam textarea

                // Cek apakah konten kosong dan mencegah form untuk disubmit jika kosong
                if (contentField.value.trim() === '') {
                    event.preventDefault(); // Mencegah form dikirim jika konten kosong
                    alert('Konten artikel tidak boleh kosong');
                }
            });
        };

        // Fungsi untuk preview gambar thumbnail
        function previewThumbnail(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const previewContainer = document.getElementById('thumbnail-preview-container');
            const previewImage = document.getElementById('thumbnail-preview');

            // Jika ada file, buat URL objek gambar dan tampilkan
            if (file) {
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block'; // Menampilkan preview container
                };
                reader.readAsDataURL(file); // Membaca file sebagai URL data
            }
        }
    </script>

</x-layouts.app>
