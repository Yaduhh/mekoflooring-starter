<section id="produk" class="min-h-screen bg-[#131010] flex flex-col justify-center">
    <div class="w-full flex flex-col py-20" data-aos="fade-up"
        data-aos-duration="1500">
        <div class="text-center">
            <p class="text-sm text-[#F0BB78] font-semibold capitalize max-lg:px-6">
                {{ __('Our Products') }}
            </p>
            <h1 class="text-xl text-white font-bold capitalize max-lg:px-6">
                {{ __('Our Products Collection') }}
            </h1>
        </div>

        <div class="w-full flex flex-col gap-6 mx-auto lg:xl:max-w-6xl 2xl:max-w-7xl">
            <div class="text-white flex gap-4 justify-between max-w-5xl w-full mx-auto py-6">
                <div
                    class="px-8 py-2 border border-white bg-white/30 backdrop-blur w-fit rounded-full hover:cursor-pointer hover:scale-110 duration-200">
                    <p>Semua Produk </p>
                </div>
                @foreach ($categories as $category)
                    <div
                        class="px-8 py-2 border border-white bg-white/30 backdrop-blur w-fit rounded-full hover:cursor-pointer hover:scale-110 duration-200">
                        <p>{{ $category->name_category }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Carousel 2 -->
        <div id="product-carousel-2" class="splide" aria-live="polite">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($productsSPC as $product)
                        <li class="splide__slide w-full relative z-0 overflow-hidden group hover:scale-105 duration-200 pt-10"
                            role="presentation">
                            <!-- Menampilkan Gambar Produk -->
                            <a href="{{ route('product.show', ['slug' => $product->slug_produk]) }}"
                                class="relative w-full h-full block" role="link"
                                aria-label="View details for {{ $product->nama }}">
                                <div class="relative w-full h-full">
                                    @if ($product->image_produk)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                                            alt="{{ $product->nama }}"
                                            class="w-full h-full pb-14 object-cover rounded-lg transition duration-300">
                                    @else
                                        <p
                                            class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">
                                            {{ __('Tidak ada gambar produk') }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                            <div class="absolute bottom-5 z-0 text-white">
                                <p class="text-xl font-semibold">
                                    {{ $product->category->name_category }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
