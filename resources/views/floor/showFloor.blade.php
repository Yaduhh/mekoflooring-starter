@extends('layouts.floorView')

@section('title', 'Floor View')

@section('content')
    <section class="min-h-screen w-full flex flex-col items-start justify-center relative z-0">
        <a href="/" class="p-6 w-46">
            <img src="{{ asset('assets/img/flooringViewLight.png') }}" alt="logo" class="w-full h-full object-cover" />
        </a>
        <div class="grid auto-rows-min md:grid-cols-3">
            @foreach ($categories as $category)
                <a href="{{ route('floor.product.show', ['slug' => $category->slug_category]) }}" class="relative overflow-hidden border border-neutral-200 dark:border-neutral-700 group">
                    <x-placeholder-pattern
                        class="absolute inset-0 size-full bg-black/40 z-0 group-hover:scale-110 duration-150 transition-all" />

                    @if ($category->image_category)
                        <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}"
                            class="w-full h-full group-hover:scale-110 duration-150 transition-all">
                    @else
                        <p>{{ __('Tidak ada gambar kategori') }}</p>
                    @endif

                    <h2 class="absolute bottom-20 text-white text-3xl z-0 text-center w-full font-semibold">
                        {{ $category->name_category }}
                    </h2>

                </a>
            @endforeach
        </div>
            
        <div class="relative h-full flex-1 overflow-hidden border border-neutral-200 dark:border-neutral-700">
            <div class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"></div>
            {{--<x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
        </div>
    </section>
@endsection
