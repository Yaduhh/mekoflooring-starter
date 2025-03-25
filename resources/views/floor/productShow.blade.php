@extends('layouts.floorView')

@section('title', 'Produk dalam Kategori: ' . $category->name_category)

@section('content')
    <section class="w-full min-h-screen overflow-auto hide-scrollbar">
        <div class="flex justify-between">
            <!-- Kolom Produk -->
            <div class="px-10">
                <div class="w-full">
                    <header class="py-6 w-32">
                        <img src="{{ asset('assets/img/flooringViewLight.png') }}" alt="logo" class="w-full h-full object-cover" />
                    </header>
                </div>
                <div class="grid grid-cols-3 gap-4 w-full">
                    @foreach ($products as $product)
                        <div class="flex border-2 flex-col items-center gap-2 product-item cursor-pointer relative z-0 justify-center w-full" data-image="{{ Storage::url($product->mockup_image) }}">
                            <img src="{{ Storage::url($product->mockup_image) }}" alt="{{ $product->mockup_image }}" class="w-full h-12 object-cover">                        
                            <h2 class="text-lg font-semibold text-black absolute z-0">{{ $product->nama }}</h2>
                        </div>
                    @endforeach
                </div>

                <div class="py-6 w-full">
                    <h1 class="text-black uppercase text-xl font-bold mb-4">Floor Calculation</h1>

                    <!-- Form untuk input panjang dan lebar ruangan -->
                    <div class="flex justify-between items-end gap-4">
                        <div class="w-fit">
                            <label for="length" class="text-xs font-semibold">Long (m)</label>
                            <input type="number" id="length" class="px-4 py-1.5 border rounded-xl w-44" placeholder="type long here..." />
                        </div>

                        <div class="w-fit">
                            <label for="length" class="text-xs font-semibold">Wide (m)</label>
                            <input type="number" id="width" class="px-4 py-1.5 border rounded-xl w-44" placeholder="type wide here..." />
                        </div>

                        <div class="w-fit">
                            <button id="calculateBtn" class="mt-4 bg-[#131010] hover:cursor-pointer text-white hover:scale-110 duration-200 transition-all hover:bg-[#543A14] px-4 py-2 rounded-xl">Calculate</button>                
                        </div>
                    </div>                    
                    <p id="estimated" class="mt-4 font-bold text-sm hidden">Estimated Required Quantity</p>
                    <div id="box" class="mt-4 text-4xl text-[#543A14] font-bold"></div>
                    <div id="rumus" class="mt-4"></div>
                    <div id="result" class=""></div>
                    <div id="hasil" class=""></div>
                </div>

            </div>

            <!-- Kolom Kategori -->
            <div class="h-screen overflow-hidden flex items-end justify-end w-full">
                <div class="relative z-0 top-0 right-0 h-screen">
                    <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}"
                        class="w-auto h-full group-hover:scale-110 duration-150 transition-all border object-contain">
                    <div class="absolute bottom-0 -z-10 w-full">
                        <img id="category-image" src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}"
                            class="w-full h-auto group-hover:scale-110 duration-150 transition-all hidden object-contain">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambahkan JavaScript untuk menangani klik produk -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productItems = document.querySelectorAll('.product-item');
            const categoryImage = document.getElementById('category-image');

            productItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Ambil data gambar mockup dari atribut data-image
                    const imageUrl = this.getAttribute('data-image');
                    
                    // Update gambar kategori dengan gambar produk
                    categoryImage.src = imageUrl;

                    // Hapus kelas 'active' dari semua produk
                    productItems.forEach(p => p.classList.remove('border-black', 'bg-blue-50'));

                    // Tambahkan kelas 'active' pada produk yang diklik
                    this.classList.add('border-black', 'bg-blue-50'); // Menandai produk yang dipilih

                    // Tampilkan gambar kategori jika ada produk yang diklik
                    categoryImage.classList.remove('hidden');
                });
            });
        });

       document.addEventListener('DOMContentLoaded', function () {
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
                const boxArea = 2.2;

                // Pembagian luas dengan luas per box (2.2 m²)
                let areaDivided = area / boxArea;
                let beforeArea = area / boxArea;
                beforeArea = beforeArea.toFixed(2);
                // Pembulatan ke atas dengan faktor pembulatan
                areaDivided = Math.ceil(areaDivided);

                // Tampilkan hasil perhitungan
                box.textContent = ` ${areaDivided} Box`;
                rumus.textContent = `= ${length}m x ${width}m = ${area} m²`;
                result.textContent = `= ${area} m² / ${boxArea} m²/box`;
                hasil.textContent = `= ${beforeArea} = ${areaDivided} Box.`;

                // Menampilkan Estimated setelah perhitungan
                estimated.classList.remove('hidden');
            });
        });
    </script>
@endsection
