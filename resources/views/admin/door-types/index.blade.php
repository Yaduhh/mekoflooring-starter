<x-layouts.app :title="__('Door Types')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Door Types</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola jenis-jenis pintu</p>
            </div>
            <a href="{{ route('admin.door-types.create') }}"
               class="bg-[#543A14] text-white px-4 py-2 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                <i class="fas fa-plus mr-2"></i>Tambah Door Type
            </a>
        </div>

        @if (session('success'))
            <div id="successMsg" class="bg-emerald-700 text-white p-4 rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($doorTypes as $doorType)
                <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden shadow hover:shadow-lg transition-all">
                    <div class="aspect-square w-full overflow-hidden bg-gray-100 dark:bg-neutral-700">
                        @if($doorType->image)
                            <img src="{{ Storage::url($doorType->image) }}"
                                 alt="{{ $doorType->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <i class="fas fa-door-open text-5xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-white truncate mb-1">{{ $doorType->name }}</h3>

                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold mb-4
                            {{ $doorType->active_door_models_count > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300' }}">
                            <i class="fas fa-cube mr-1"></i>
                            {{ $doorType->active_door_models_count }} Model
                        </span>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.door-types.edit', $doorType) }}"
                               class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white text-sm py-1.5 rounded-lg transition-colors">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <form action="{{ route('admin.door-types.destroy', $doorType) }}" method="POST"
                                  onsubmit="return confirm('Hapus door type ini?')" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white text-sm py-1.5 rounded-lg transition-colors">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                    <i class="fas fa-door-open text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">Belum ada Door Type</h3>
                    <a href="{{ route('admin.door-types.create') }}"
                       class="inline-block mt-4 bg-[#543A14] text-white px-6 py-2 rounded-lg hover:bg-[#6B4E1A]">
                        <i class="fas fa-plus mr-2"></i>Buat Sekarang
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-2">
            <a href="{{ route('admin.door-types.recycle') }}" class="text-sm text-gray-500 hover:text-red-600 transition-colors">
                <i class="fas fa-trash-alt mr-1"></i>Recycle Bin
            </a>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('successMsg');
            if (el) el.style.display = 'none';
        }, 4000);
    </script>
</x-layouts.app>
