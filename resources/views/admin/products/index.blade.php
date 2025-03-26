<x-layouts.app :title="__('Produk')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1>All Product</h1>
        <div class="grid auto-rows-min gap-6 md:grid-cols-4">
            @foreach ($products as $product)
                <div class="relative z-0 flex items-center justify-center w-full min-h-[380px] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 group">
                    <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                    
                    <!-- Menampilkan Gambar Produk -->
                    <div class="relative w-full h-full">
                        @if ($product->image_produk)
                            <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover rounded-lg transition duration-300 group-hover:scale-105 group-hover:opacity-75">
                        @else
                            <p class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">{{ __('Tidak ada gambar produk') }}</p>
                        @endif
                    </div>

                    <!-- Nama Produk -->
                    <div class="absolute inset-x-0 bottom-0 flex flex-col items-center justify-center bg-gradient-to-t from-black to-transparent">
                        <div class="flex items-center justify-center flex-col p-4">
                            <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}"  class="w-14 h-14 object-cover rounded-full opacity-70 transition duration-300 group-hover:opacity-100 border border-white">
                            <h2 class="text-white font-semibold text-center px-4 pt-2">{{ $product->nama }}</h2>
                        </div>

                        <div class="text-xs grid grid-cols-2 p-4 place-content-between w-full">
                            <p>Width : {{ $product->width }}mm</p>
                            <p>Length : {{ $product->length }}mm</p>
                            <p>Thickness : {{ $product->thickness }}mm</p>
                        </div>
                    </div>

                    <p class="text-xs bg-orange-700 rounded-xl px-3 py-1 absolute top-4 right-4">{{ $product->category->name_category }}</p>

                    <!-- Tombol Edit dan Delete -->
                    <div class="absolute z-0 flex gap-4 opacity-0 group-hover:opacity-100 transition duration-300 pb-20">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-black/30 backdrop-blur py-1 px-3 rounded-full text-xs flex items-center gap-2 h-fit">
                            <i class="fas fa-edit"></i> {{ __('Edit') }}
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus produk ini?') }}')"  class="bg-red-500/70 backdrop-blur py-1 px-3 rounded-full text-xs flex items-center gap-2 h-fit hover:cursor-pointer">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 hover:cursor-pointer">
                                <i class="fas fa-trash-alt"></i> {{ __('Hapus') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
