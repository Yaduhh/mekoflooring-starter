@extends('layouts.detail')

@section('title', 'Detail Produk - ' . $product->nama)

@section('content')
    <div class="bg-[#FFF0DC] lg:py-10 max-sm:px-6 w-full">
        <div class="container mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Gambar Produk -->
                <div class="col-span-1 lg:col-span-4 max-md:hidden">
                    <div class="relative w-full overflow-hidden">
                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                            alt="{{ $product->nama }}" class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="col-span-1 lg:col-span-8">
                    <div class="mb-6 flex gap-4">
                        <a href="/#produk" class="text-[#543A14] dark:text-[#F0BB78]">
                            <i class="fas fa-chevron-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                    <!-- Kategori Produk -->
                    <div class="w-full sm:w-1/2">
                        <p class="mt-2 text-amber-800 text-sm font-semibold">{{ $product->category->name_category }}</p>
                    </div>
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-[#FFF0DC]">{{ $product->nama }}</h1>

                    <!-- Gambar Produk -->
                    <div class="lg:w-1/2 lg:hidden py-6">
                        <div class="relative h-full bg-gray-200 overflow-hidden">
                            <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                                alt="{{ $product->nama }}" class="w-full h-auto object-cover">
                        </div>
                    </div>

                    <div class="mt-4 text-lg text-black">
                        <h3 class="text-xl text-gray-800 font-semibold">Deskripsi</h3>
                        <p class="text-justify mt-2">{{ $product->description }}</p>
                    </div>

                    <div class="mt-6">
                        <p class="bg-[#131010] w-fit text-white text-lg font-semibold px-6 py-2 rounded-r-full">
                            {{ __('WPC DOOR BOARD') }}</p>

                        <table class="table-auto w-full mt-4 overflow-auto">
                            <thead>
                                <tr class="bg-[#131010] text-white">
                                    <th class="px-4 py-2 text-left">Dimension</th>
                                    <th class="px-4 py-2 text-left">CM</th>
                                    <th class="px-4 py-2 text-left"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <td class="px-4 py-2 font-semibold">TALL</td>
                                    <td class="px-4 py-2">190/200/210</td>
                                    <td class="px-4 py-2">210/220/240</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="px-4 py-2 font-semibold">WIDE</td>
                                    <td class="px-4 py-2">60</td>
                                    <td class="px-4 py-2">3/8</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="px-4 py-2 font-semibold">THICKNESS</td>
                                    <td class="px-4 py-2">72/82/83/94</td>
                                    <td class="px-4 py-2">3.8/5/7</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-12">
                        <p class="bg-[#131010] w-fit text-white text-lg font-semibold px-6 py-2 rounded-r-full">
                            {{ __('WPC DOOR FRAME') }}</p>

                        <div class="overflow-auto">
                            <table class="table-auto w-full mt-4">
                                <thead>
                                    <tr class="bg-[#131010] text-white">
                                        <th class="px-4 py-2 text-left">CM</th>
                                        <th class="px-4 py-2 text-left">MKK-A</th>
                                        <th class="px-4 py-2 text-left">MKK-B</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-300">
                                        <td class="px-4 py-2 font-semibold">TALL</td>
                                        <td class="px-4 py-2">230/250/310/350</td>
                                        <td class="px-4 py-2">230/250/310/350</td>
                                    </tr>
                                    <tr class="border-b border-gray-300">
                                        <td class="px-4 py-2 font-semibold">WIDE</td>
                                        <td class="px-4 py-2">Custom</td>
                                        <td class="px-4 py-2">9</td>
                                    </tr>
                                    <tr class="border-b border-gray-300">
                                        <td class="px-4 py-2 font-semibold">THICKNESS</td>
                                        <td class="px-4 py-2">9.5</td>
                                        <td class="px-4 py-2">3</td>
                                    </tr>
                                    <tr class="border-b border-gray-300">
                                        <td class="px-4 py-2 font-semibold">SCREW</td>
                                        <td class="px-4 py-2">Not Visible</td>
                                        <td class="px-4 py-2">Not Visible</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="mt-6 flex gap-4 max-sm:mb-10">
                        <a href="{{ route('floor.product.show', ['slug' => $product->category->slug_category]) }}?product={{ urlencode($product->nama) }}"
                            class="bg-[#543A14] text-white hover:scale-110 duration-150 transition-all px-4 py-1.5 rounded-xl">
                            <i class="fas fa-object-group mr-2"></i>
                            Door View
                        </a>

                        <a target="_blank"
                            href="https://wa.me/08990656996?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($product->nama) }}%2C%20saya%20ingin%20menanyakan%20hal%20terkait%20lebih%20lanjut."
                            class="bg-emerald-600 text-white hover:scale-110 duration-150 transition-all px-4 py-1.5 rounded-xl">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Whatsapp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
