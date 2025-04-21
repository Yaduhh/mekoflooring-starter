<section id="produk">
    <div class="w-full flex flex-col gap-6  mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl pb-10"  data-aos="fade-up" data-aos-duration="1500">
        <div>
            <h1 class="text-xl font-semibold capitalize max-lg:px-6">
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
                            <a href="{{ route('product.show', ['slug' => $product->slug_produk]) }}" class="relative w-full h-full block">
                                <div class="relative w-full h-full">
                                    @if ($product->image_produk)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full pb-14 object-cover rounded-lg transition duration-300 group-hover:scale-105 group-hover:opacity-75">
                                    @else
                                        <p class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">{{ __('Tidak ada gambar produk') }}</p>
                                    @endif
                                </div>
                            </a>

                            <!-- Nama Produk -->
                            <div class="absolute inset-x-0 bottom-0 flex flex-col items-center justify-center">
                                <div class="text-xs grid grid-cols-1 lg:grid-cols-2 p-4 place-content-between w-full text-white bg-[#543A14]">
                                    <p>Width : {{ $product->width }}mm</p>
                                    <p>Length : {{ $product->length }}mm</p>
                                    <p>Thickness : {{ $product->thickness }}mm</p>
                                </div>
                            </div>

                            <p class="text-xs bg-[#131010] text-white rounded-xl px-3 py-1 absolute top-4 left-4">{{ $product->category->name_category }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="w-full mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl">
            <h1 class="text-xl font-semibold capitalize max-lg:px-6">
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
                            <a href="{{ route('product.show', ['slug' => $product->slug_produk]) }}" class="relative w-full h-full block">
                                <div class="relative w-full h-full">
                                    @if ($product->image_produk)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full pb-14 object-cover rounded-lg transition duration-300 group-hover:scale-105 group-hover:opacity-75">
                                    @else
                                        <p class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">{{ __('Tidak ada gambar produk') }}</p>
                                    @endif
                                </div>
                            </a>

                            <!-- Nama Produk -->
                            <div class="absolute inset-x-0 bottom-0 flex flex-col items-center justify-center">
                                <div class="grid grid-cols-1 lg:grid-cols-2 text-xs p-4 place-content-between w-full text-white bg-[#543A14]">
                                    <p>Width : {{ $product->width }}mm</p>
                                    <p>Length : {{ $product->length }}mm</p>
                                    <p>Thickness : {{ $product->thickness }}mm</p>
                                </div>
                            </div>

                            <p class="text-xs bg-[#131010] text-white rounded-xl px-3 py-1 absolute top-4 right-4">{{ $product->category->name_category }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>