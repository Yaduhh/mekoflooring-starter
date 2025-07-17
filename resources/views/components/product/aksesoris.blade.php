<section id="produk" class="h-auto bg-[#FFF0DC] flex flex-col justify-center overflow-hidden">
    <div class="w-full mx-auto xl:xl:max-w-6xl 2xl:max-w-7xl flex flex-col gap-2 md:gap-8 py-0 lg:pt-14">
        <div class="max-sm:pt-6">
            <p class="text-sm text-[#F0BB78] font-semibold capitalize max-lg:px-6">
                {{ __('Our Accessories') }}
            </p>
            <h1 class="text-xl text-black font-bold capitalize max-lg:px-6">
                {{ __('Our Accessories Collection') }}
            </h1>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 lg:col-span-1 max-sm:px-20">
                <img src="{{ asset('assets/img/logoHandle.png') }}" alt="logo" />
            </div>

            <div class="col-span-3 lg:col-span-2">
                @if ($aksesories->isEmpty())
                    <div class="text-center py-80">
                        <p class="text-black">Aksesoris Tidak Ada</p>
                    </div>
                @else
                    <!-- Carousel for products -->
                    <div id="product-carousel-1" class="splide pb-6" aria-live="polite">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($aksesories as $product)
                                    <li
                                        class="splide__slide w-full relative z-0 overflow-hidden group hover:scale-105 duration-200 pt-6 lg:py-10 lg:pb-14">
                                        <a href="{{ route('aksesoris.public.show', ['slug' => $product->slug_produk]) }}"
                                            class="relative w-full h-full block aspect-square" role="link"
                                            aria-label="View details for {{ $product->nama }}">
                                            <div class="relative w-full h-full">
                                                @if ($product->image_produk)
                                                    <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                                                        alt="{{ $product->nama }}"
                                                        class="w-full h-full object-cover rounded-lg transition duration-300">
                                                @else
                                                    <p
                                                        class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">
                                                        {{ __('Tidak ada gambar produk') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="text-black pt-2">
                                                <p class="text-sm font-semibold">
                                                    {{ $product->nama }}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

<!-- Add this JavaScript snippet to make sure the page scrolls to #produk after clicking -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash === "#produk") {
            const produkSection = document.getElementById('produk');
            produkSection.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
</script>
