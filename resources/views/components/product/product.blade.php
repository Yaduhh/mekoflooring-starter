<section>
    <div class="w-full flex flex-col gap-6  mx-auto lg:max-w-4xl pb-10">
        <div>
            <h1 class="text-xl font-semibold capitalize">
                MekoFlooring SPC Product
            </h1>
        </div>
        
        <!-- Carousel 1 -->
        <div id="product-carousel-1" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($products as $product)
                        <li class="splide__slide relative z-0 w-full min-h-[380px] overflow-hidden border border-neutral-200 dark:border-neutral-700 group">
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
                                    <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}" class="w-14 h-14 object-cover rounded-full opacity-70 transition duration-300 group-hover:opacity-100 border border-white">
                                    <h2 class="text-white font-semibold text-center px-6 pt-2">{{ $product->nama }}</h2>
                                </div>

                                <div class="text-xs grid grid-cols-2 p-4 place-content-between w-full text-white">
                                    <p>Width : {{ $product->width }}mm</p>
                                    <p>Length : {{ $product->length }}mm</p>
                                    <p>Thickness : {{ $product->thickness }}mm</p>
                                </div>
                            </div>

                            <p class="text-xs bg-orange-700 text-white rounded-xl px-3 py-1 absolute top-4 right-4">{{ $product->category->name_category }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="w-full mx-auto lg:max-w-4xl">
            <h1 class="text-xl font-semibold capitalize">
                MekoFlooring Vinyl Product
            </h1>
        </div>
        <!-- Carousel 2 -->
        <div id="product-carousel-2" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($products as $product)
                        <li class="splide__slide relative z-0 w-full min-h-[380px] overflow-hidden border border-neutral-200 dark:border-neutral-700 group">
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
                                    <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}" class="w-14 h-14 object-cover rounded-full opacity-70 transition duration-300 group-hover:opacity-100 border border-white">
                                    <h2 class="text-white font-semibold text-center px-6 pt-2">{{ $product->nama }}</h2>
                                </div>

                                <div class="text-xs grid grid-cols-2 p-4 place-content-between w-full text-white">
                                    <p>Width : {{ $product->width }}mm</p>
                                    <p>Length : {{ $product->length }}mm</p>
                                    <p>Thickness : {{ $product->thickness }}mm</p>
                                </div>
                            </div>

                            <p class="text-xs bg-orange-700 text-white rounded-xl px-3 py-1 absolute top-4 right-4">{{ $product->category->name_category }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>