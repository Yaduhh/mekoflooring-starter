@extends('layouts.pages')

@section('title', $category->name_category . ' - Door Collection')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('door.index') }}" class="text-gray-600 hover:text-[#543A14] transition-colors">
                            <i class="fas fa-home mr-2"></i>Door View
                        </a>
                    </li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li>
                        <a href="{{ route('doors.index') }}" class="text-gray-600 hover:text-[#543A14] transition-colors">
                            All Doors
                        </a>
                    </li>
                    <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                    <li class="text-[#543A14] font-semibold">
                        {{ $category->name_category }}
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Category Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                @if($category->image_category)
                <div class="w-32 h-32 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                    <img src="{{ Storage::url($category->image_category) }}"
                         alt="{{ $category->name_category }}"
                         class="w-full h-full object-cover">
                </div>
                @endif

                <div class="flex-1">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        {{ $category->name_category }}
                    </h1>
                    @if($category->description)
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    @endif
                    <div class="flex items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center">
                            <i class="fas fa-cube mr-2 text-[#543A14]"></i>
                            {{ $groupedModels->sum(fn($group) => $group->count()) }} total models
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-layer-group mr-2 text-[#543A14]"></i>
                            {{ $groupedModels->count() }} door designs
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @forelse($groupedModels as $doorBaseName => $models)
        <div class="mb-12">
            <!-- Door Base Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $doorBaseName }}</h2>
                <p class="text-gray-600">{{ $models->count() }} handle option{{ $models->count() != 1 ? 's' : '' }} available</p>
            </div>

            <!-- Handle Variations Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                @foreach($models as $product)
                <a href="{{ route('doors.view', [$category->slug_category, $product->slug_produk]) }}"
                   class="group bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden hover:-translate-y-1">

                    <!-- Product Image -->
                    <div class="relative aspect-square bg-gray-100 overflow-hidden">
                        <img src="{{ $product->getCatalogImageUrl() }}"
                             alt="{{ $product->handle_name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <!-- 3D Badge -->
                        @if($product->is_3d)
                        <div class="absolute top-2 right-2">
                            <span class="bg-[#543A14] text-white px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                <i class="fas fa-cube"></i>
                                3D
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="p-3">
                        <p class="font-semibold text-sm text-gray-900 truncate group-hover:text-[#543A14] transition-colors">
                            {{ $product->handle_name }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $product->handle_code }}
                        </p>

                        <!-- File Size -->
                        <div class="mt-2 flex items-center text-xs text-gray-400">
                            <i class="fas fa-hdd mr-1"></i>
                            {{ $product->formatted_file_size }}
                        </div>

                        <!-- View Button -->
                        <div class="mt-3">
                            <span class="block w-full text-center bg-[#543A14] text-white py-2 rounded-lg text-xs font-semibold group-hover:bg-[#6B4E1A] transition-colors">
                                View in 3D
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-xl shadow-lg">
            <i class="fas fa-cube text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-600 mb-2">No Models Available Yet</h3>
            <p class="text-gray-500 mb-6">This category doesn't have any door models yet. Check back later!</p>
            <a href="{{ route('doors.index') }}" class="inline-block bg-[#543A14] text-white px-6 py-3 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Browse Other Categories
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
