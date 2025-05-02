<x-layouts.app :title="__('Create Catalogue')">
    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">{{ __('Create Catalogue') }}</h2>

        <form action="{{ route('admin.catalogue.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kode_produk" class="block text-sm font-medium text-gray-700">{{ __('kode_produk') }}</label>
                    <input type="text" name="kode_produk" id="kode_produk"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                    <input type="file" name="images" id="images"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <div>
                    <label for="product_type" class="block text-sm font-medium text-gray-700">{{ __('Type Product') }}</label>
                    <select name="product_type" id="product_type"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                        <option value="0">{{ __('SPC') }}</option>
                        <option value="1">{{ __('Vinyl') }}</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                        <option value="active">{{ __('Active') }}</option>
                        <option value="inactive">{{ __('Inactive') }}</option>
                    </select>
                </div>

                <div>
                    <label for="deskripsi"
                        class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                        required></textarea>
                </div>

                <!-- Views input is removed and default 0 is used in the store method -->
                <input type="hidden" name="views" value="0">
            </div>

            <button type="submit"
                class="btn btn-primary bg-amber-800 text-white px-6 py-3 mt-6 rounded-md">{{ __('Create') }}</button>
        </form>
    </div>
</x-layouts.app>
