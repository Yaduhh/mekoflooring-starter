@extends('layouts.floorView')

@section('title', 'Produk dalam Kategori: ' . $category->name_category)

@section('content')
    <section class="w-full lg:min-h-screen overflow-auto hide-scrollbar">
        <div class="flex flex-col lg:flex-row justify-between">
            <!-- Kolom Kategori Mobile-->
            <div class="w-full lg:hidden block">
                <div class="w-36 p-6">
                    <a href="/">
                        <img src="{{ asset('assets/img/flooringViewLight.png') }}" alt="logo"
                            class="w-full h-auto object-cover" />
                    </a>
                </div>
                <div class="lg:h-screen overflow-hidden lg:hidden flex items-end justify-end">
                    <div class="relative z-0 top-0 right-0 lg:h-screen">
                        <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}"
                            class="w-auto lg:h-screen object-cover">
                        <div class="absolute bottom-0 -z-10 w-full">
                            <img id="category-image-mobile" src="{{ Storage::url($category->image_category) }}"
                                alt="{{ $category->name_category }}" class="w-full h-auto hidden object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Produk -->
            <div class="px-6 lg:px-10 max-sm:pb-6">
                <div class="w-56 py-6 hidden lg:flex">
                    <a href="/">
                        <img src="{{ asset('assets/img/flooringViewLight.png') }}" alt="logo"
                            class="w-full h-auto object-cover" />
                    </a>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 w-full max-sm:mt-6">
                    @foreach ($products as $product)
                        <div class="flex border-2 flex-col items-center gap-2 product-item cursor-pointer relative z-0 justify-center w-full"
                            data-image="{{ Storage::url($product->mockup_image) }}" data-name="{{ $product->nama }}">
                            <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}"
                                class="w-full h-12 object-cover">
                            <h2 class="text-lg font-semibold text-black absolute z-0">{{ $product->nama }}</h2>
                        </div>
                    @endforeach

                </div>

                <div class="py-6 w-full">
                    <h1 class="text-black uppercase text-xl font-bold mb-4">Floor Calculation</h1>

                    <!-- Form untuk input panjang dan lebar ruangan -->
                    <div class="flex flex-col md:flex-row justify-between items-start lg:items-end gap-4">
                        <div class="lg:w-fit w-full">
                            <label for="length" class="text-xs font-semibold">Long (m)</label>
                            <input type="number" id="length" class="px-4 py-1.5 border rounded-xl w-full lg:w-44"
                                placeholder="type long here..." />
                        </div>

                        <div class="lg:w-fit w-full">
                            <label for="length" class="text-xs font-semibold">Wide (m)</label>
                            <input type="number" id="width" class="px-4 py-1.5 border rounded-xl w-full lg:w-44"
                                placeholder="type wide here..." />
                        </div>

                        <div class="lg:w-fit w-full">
                            <button id="calculateBtn"
                                class="lg:mt-4 bg-[#131010] hover:cursor-pointer text-white hover:scale-110 duration-200 transition-all hover:bg-[#543A14] px-4 py-2 rounded-xl">Calculate</button>
                        </div>
                    </div>
                    <p id="estimated" class="mt-4 font-bold text-sm hidden">Estimated Required Quantity</p>
                    <div id="box" class="mt-4 text-4xl text-[#543A14] font-bold"></div>
                    <div id="rumus" class="mt-4"></div>
                    <div id="result" class=""></div>
                    <div id="hasil" class=""></div>
                </div>

                <!-- WhatsApp Button -->
                <a id="whatsappBtn" href="#" target="_blank"
                    class="mt-6 bg-[#25d366] text-white py-2 px-4 rounded-xl hidden">
                    <i class="fab fa-whatsapp"></i> Chat via WhatsApp
                </a>
            </div>

            <!-- Kolom Kategori Desktop-->
            <div class="lg:h-screen overflow-hidden hidden lg:flex items-end justify-end w-full">
                <div class="relative z-0 top-0 right-0 lg:h-screen">
                    <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}"
                        class="w-auto lg:h-screen object-cover">
                    <div class="absolute bottom-0 -z-10 w-full">
                        <img id="category-image-desktop" src="{{ Storage::url($category->image_category) }}"
                            alt="{{ $category->name_category }}" class="w-full h-auto hidden object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambahkan JavaScript untuk menangani klik produk -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productItems = document.querySelectorAll('.product-item');
            const categoryImageDesktop = document.getElementById('category-image-desktop');
            const categoryImageMobile = document.getElementById('category-image-mobile');

            // Fungsi untuk highlight produk berdasarkan nama
            function highlightProduct(productName) {
                productItems.forEach(item => {
                    const currentProductName = item.getAttribute('data-name');

                    // Cek jika nama produk sesuai dengan parameter di URL
                    if (decodeURIComponent(currentProductName) === productName) {
                        // Jika cocok, tambahkan highlight
                        item.classList.add('border-black', 'bg-blue-50');

                        // Update gambar produk
                        const imageUrl = item.getAttribute('data-image');
                        if (categoryImageDesktop) {
                            categoryImageDesktop.src = imageUrl;
                            categoryImageDesktop.classList.remove('hidden');
                        }
                        if (categoryImageMobile) {
                            categoryImageMobile.src = imageUrl;
                            categoryImageMobile.classList.remove('hidden');
                        }
                    } else {
                        // Hapus highlight untuk produk lain
                        item.classList.remove('border-black', 'bg-blue-50');
                    }
                });
            }

            // Ambil query parameter 'product' dari URL
            const urlParams = new URLSearchParams(window.location.search);
            const selectedProductName = urlParams.get('product');

            if (selectedProductName) {
                // Jika ada query 'product', maka highlight produk sesuai
                highlightProduct(selectedProductName);
            }

            // Event listener untuk klik produk
            productItems.forEach(item => {
                item.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image');
                    const productName = this.getAttribute('data-name'); // Mendapatkan nama produk

                    // Ambil URL saat ini tanpa parameter query apapun
                    const currentUrl = window.location.href.split('?')[0];

                    // Encode product name dan ganti '+' dengan '%20'
                    const encodedProductName = encodeURIComponent(productName).replace(/%20/g, '+');

                    // Ganti URL dengan parameter query yang baru sesuai produk yang dipilih
                    const newUrl = currentUrl + '?product=' + encodedProductName;

                    // Ganti URL di browser dengan produk yang dipilih tanpa reload halaman
                    window.history.replaceState({}, '', newUrl);

                    // Ganti source dan tampilkan untuk desktop
                    if (categoryImageDesktop) {
                        categoryImageDesktop.src = imageUrl;
                        categoryImageDesktop.classList.remove('hidden');
                    }

                    // Ganti source dan tampilkan untuk mobile
                    if (categoryImageMobile) {
                        categoryImageMobile.src = imageUrl;
                        categoryImageMobile.classList.remove('hidden');
                    }

                    // Highlight produk yang dipilih
                    productItems.forEach(p => p.classList.remove('border-black', 'bg-blue-50'));
                    this.classList.add('border-black', 'bg-blue-50');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const calculateBtn = document.getElementById('calculateBtn');
            const result = document.getElementById('result');
            const box = document.getElementById('box');
            const rumus = document.getElementById('rumus');
            const hasil = document.getElementById('hasil');
            const estimated = document.getElementById('estimated');

            calculateBtn.addEventListener('click', function() {
                // Ambil nilai input panjang dan lebar ruangan
                const length = parseFloat(document.getElementById('length').value);
                const width = parseFloat(document.getElementById('width').value);

                if (isNaN(length) || isNaN(width)) {
                    result.textContent = 'Harap masukkan nilai panjang dan lebar yang valid!';
                    return;
                }

                // Hitung luas ruangan dalam m²
                const area = length * width;

                // Luas per box adalah 2.2 m²
                const boxArea = 2.22;

                let areaDivided = area / boxArea;
                let beforeArea = area / boxArea;
                beforeArea = beforeArea.toFixed(2);
                areaDivided = Math.ceil(areaDivided);

                box.textContent = ` ${areaDivided} Box`;
                rumus.textContent = `= ${length}m x ${width}m = ${area} m²`;
                result.textContent = `= ${area} m² / ${boxArea} m²/box`;
                hasil.textContent = `= ${beforeArea} = ${areaDivided} Box.`;

                estimated.classList.remove('hidden');
                const message =
                    `Hi, Admin\nPanjang Ruangan = ${length}m\nLebar Ruangan = ${width}m\nJumlah Box = ${areaDivided}\n\nSaya ingin mengetahui informasi lebih lanjut`;

                whatsappBtn.href = `https://wa.me/+628119112416?text=${encodeURIComponent(message)}`;
                whatsappBtn.classList.remove('hidden');
            });
        });
    </script>
@endsection
