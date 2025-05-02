<x-layouts.app :title="__('Edit Catalogue')">
      @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <div class="flex h-full w-full flex-1 flex-col gap-8 rounded-xl p-6 bg-white dark:bg-zinc-800 dark:text-white">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Edit Catalogue') }}</h2>

        <form action="{{ route('admin.catalogue.update', $catalogue) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Kode Produk -->
                <div>
                    <label for="kode_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Kode Produk') }}</label>
                    <input type="text" name="kode_produk" id="kode_produk" value="{{ old('kode_produk', $catalogue->kode_produk) }}" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md p-3 shadow-sm focus:ring-amber-800 focus:border-amber-800" required>
                </div>

                <!-- Image -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Image') }}</label>
                    <input type="file" name="images" id="images" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md p-3 shadow-sm focus:ring-amber-800 focus:border-amber-800">
                    @if ($catalogue->images)
                        <div class="mt-3">
                            <img src="{{ Storage::url($catalogue->images) }}" alt="{{ $catalogue->deskripsi }}" class="w-32 h-32 object-cover rounded-md shadow-md">
                        </div>
                    @endif
                </div>

                <!-- Status -->
                <div>
                    <label for="product_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tipe Produk') }}</label>
                    <select name="product_type" id="product_type" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md p-3 shadow-sm focus:ring-amber-800 focus:border-amber-800" required>
                        <option value="0" @if($catalogue->product_type == '0') selected @endif>{{ __('SPC') }}</option>
                        <option value="1" @if($catalogue->product_type == '1') selected @endif>{{ __('Vinyl') }}</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
                    <select name="status" id="status" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md p-3 shadow-sm focus:ring-amber-800 focus:border-amber-800" required>
                        <option value="active" @if($catalogue->status == 'active') selected @endif>{{ __('Active') }}</option>
                        <option value="inactive" @if($catalogue->status == 'inactive') selected @endif>{{ __('Inactive') }}</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full border border-gray-300 dark:border-neutral-700 rounded-md p-3 shadow-sm focus:ring-amber-800 focus:border-amber-800" required>{{ old('deskripsi', $catalogue->deskripsi) }}</textarea>
                </div>

                <!-- Views (Hidden Field) -->
                <input type="hidden" name="views" value="0">
            </div>

            <button type="submit" class="btn bg-amber-800 text-white px-6 py-3 rounded-md shadow-lg hover:bg-amber-600 transition duration-300">{{ __('Update') }}</button>
        </form>
    </div>
</x-layouts.app>
