<section id="produk" class="h-auto bg-[#131010] flex flex-col justify-center overflow-hidden">
    <div class="w-full flex flex-col py-10 lg:py-20" data-aos="fade-up" data-aos-duration="1500">
        <div class="text-center">
            <p class="text-sm text-[#F0BB78] font-semibold capitalize max-lg:px-6">
                {{ __('Our Accessories') }}
            </p>
            <h1 class="text-xl text-white font-bold capitalize max-lg:px-6">
                {{ __('Our Accessories Collection') }}
            </h1>
        </div>

        @if ($aksesories->isEmpty())
        <div class="text-center py-80">
            <p class="text-white">Aksesoris Tidak Ada</p>
        </div>
        @else
        <!-- Carousel for products -->
        <div id="product-carousel-1" class="splide" aria-live="polite">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($aksesories as $product)
                        <li class="splide__slide w-full relative z-0 overflow-hidden group hover:scale-105 duration-200 pt-6 lg:pt-10">
                            <a href="{{ route('product.show', ['slug' => $product->slug_produk]) }}" class="relative w-full h-full block" role="link" aria-label="View details for {{ $product->nama }}">
                                <div class="relative w-full h-full">
                                    @if ($product->image_produk)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full pb-14 object-cover rounded-lg transition duration-300">
                                    @else
                                        <p class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">
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
        <!-- Carousel for products -->
        <div id="product-carousel-3" class="splide" aria-live="polite">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($aksesories as $product)
                        <li class="splide__slide w-full relative z-0 overflow-hidden group hover:scale-105 duration-200 pt-6 lg:pt-10">
                            <a href="{{ route('product.show', ['slug' => $product->slug_produk]) }}" class="relative w-full h-full block" role="link" aria-label="View details for {{ $product->nama }}">
                                <div class="relative w-full h-full">
                                    @if ($product->image_produk)
                                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full pb-14 object-cover rounded-lg transition duration-300">
                                    @else
                                        <p class="absolute inset-0 flex items-center justify-center text-white bg-gray-600 bg-opacity-60 text-lg">
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
        @endif
    </div>
</section>

<!-- Add this JavaScript snippet to make sure the page scrolls to #produk after clicking -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash === "#produk") {
            const produkSection = document.getElementById('produk');
            produkSection.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
