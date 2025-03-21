<x-layouts.app :title="__('Kategori')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori Baru</a>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($categories as $category)
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                    
                    @if ($category->image_category)
                        <img src="{{ Storage::url($category->image_category) }}" alt="{{ $category->name_category }}" class="w-full h-auto rounded-lg">
                    @else
                        <p>{{ __('Tidak ada gambar kategori') }}</p>
                    @endif

                    <h2 class="absolute inset-0 flex items-center justify-center text-white text-xl">{{ $category->name_category }}</h2>
                </div>
            @endforeach
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
