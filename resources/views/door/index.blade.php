{{-- resources/views/door/index.blade.php --}}
@extends('layouts.pages')

@section('title', 'Browse Doors')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Browse Door Collections
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Select a door type to explore available handle options
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
            @forelse($categories as $category)
            <a href="{{ route('doors.category', $category->slug_category) }}"
               class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                <!-- Category Image -->
                <div class="relative aspect-square bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                    @if($category->image_category)
                        <img src="{{ Storage::url($category->image_category) }}"
                             alt="{{ $category->name_category }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-300">
                            <i class="fas fa-door-open text-6xl"></i>
                        </div>
                    @endif

                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Model Count Badge -->
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                        <span class="text-sm font-bold text-[#543A14]">
                            {{ $category->complete_models_count }} models
                        </span>
                    </div>
                </div>

                <!-- Category Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#543A14] transition-colors">
                        {{ $category->name_category }}
                    </h3>

                    @if($category->description)
                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ $category->description }}
                    </p>
                    @endif

                    <!-- View Button -->
                    <div class="mt-4 flex items-center text-[#543A14] font-semibold group-hover:translate-x-2 transition-transform">
                        <span>Explore models</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-20">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No Door Categories Available</h3>
                <p class="text-gray-500">Check back later for door collections</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
