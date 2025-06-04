@extends('layouts.detail')

@section('title', 'Detail Produk - ' . $product->nama)

@section('content')
    <div class="bg-[#FFF0DC] lg:pt-10 max-sm:px-6 w-full">
        <div class="container mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Gambar Produk -->
                <div class="col-span-1 lg:col-span-4 max-md:hidden">
                    <div class="relative w-full h-full bg-gray-200 overflow-hidden">
                        <img src="{{ route('product.image', ['filename' => basename($product->image_produk)]) }}"
                            alt="{{ $product->nama }}" class="w-full h-full object-cover">
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
                                alt="{{ $product->nama }}" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="mt-4 text-lg text-gray-700 dark:text-[#FFF0DC]">
                        <h3 class="text-xl text-gray-800 dark:text-[#F0BB78] font-semibold">Deskripsi</h3>
                        <p class="text-justify mt-4">{{ $product->description }}</p>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="mt-6 flex gap-4 max-sm:mb-10">
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
