@extends('layouts.detail')

@section('title', 'Detail Produk - ' . $product->nama)

@section('content')
    <div class="bg-gray-50 py-10 w-full">
        <div class="container mx-auto w-full">
            <div class="flex flex-col lg:flex-row gap-8 w-full">
                <!-- Gambar Produk -->
                <div class="lg:w-1/2">
                    <div class="relative h-96 bg-gray-200 overflow-hidden">
                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}" alt="{{ $product->nama }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="lg:w-1/2 flex flex-col">
                    <div class="mb-2 flex gap-4">
                        <a href="/#produk" class="text-[#543A14]">
                            <i class="fas fa-chevron-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                    <!-- Kategori Produk -->
                    <div class="w-full sm:w-1/2">
                        <p class="mt-2 text-gray-400 text-sm font-semibold">{{ $product->category->name_category }}</p>
                    </div>
                    <h1 class="text-3xl font-semibold text-gray-900">{{ $product->nama }}</h1>

                    <div class="mt-4 text-lg text-gray-700">
                        <h3 class="text-xl text-gray-800 font-semibold">Deskripsi</h3>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-6">
                        <!-- Spesifikasi Produk -->
                        <div class="w-full sm:w-1/2">
                            <h3 class="text-xl text-gray-800 font-semibold">Spesifikasi</h3>
                            <ul class="mt-2 text-gray-600">
                                <li class="py-0 flex justify-between">
                                    <span>Width</span>
                                    <span>{{ $product->width }} mm</span>
                                </li>
                                <li class="py-0 flex justify-between">
                                    <span>Length</span>
                                    <span>{{ $product->length }} mm</span>
                                </li>
                                <li class="py-0 flex justify-between">
                                    <span>Thickness</span>
                                    <span>{{ $product->thickness }} mm</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="mt-6 flex gap-4">
                        <a href="/#produk" class="bg-[#543A14] text-white hover:scale-110 duration-150 transition-all px-4 py-1.5 rounded-xl">
                            <i class="fas fa-object-group mr-2"></i>
                            Floor View
                        </a>
                        <a target="_blank" href="https://wa.me/08990656996?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($product->nama) }}%2C%20saya%20ingin%20menanyakan%20hal%20terkait%20lebih%20lanjut." class="bg-emerald-600 text-white hover:scale-110 duration-150 transition-all px-4 py-1.5 rounded-xl">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Whatsapp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
