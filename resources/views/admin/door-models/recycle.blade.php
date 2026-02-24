<x-layouts.app :title="__('Recycle Bin - Door Models')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.door-models.index') }}" class="text-gray-400 hover:text-[#543A14] transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Recycle Bin — Door Models</h2>
        </div>

        @if(session('success'))
            <div class="bg-emerald-700 text-white p-4 rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle"></i><span>{{ session('success') }}</span>
            </div>
        @endif

        @forelse($doorModels as $model)
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 flex items-center gap-4 border border-neutral-200 dark:border-neutral-700">
                <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                    <img src="{{ $model->getCatalogImageUrl() }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800 dark:text-white">{{ $model->door_base_name }}</p>
                    <p class="text-sm text-gray-500">{{ $model->handle_name }} ({{ $model->handle_code }})</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $model->doorType->name ?? '-' }} · Dihapus {{ $model->updated_at->diffForHumans() }}</p>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('admin.door-models.restore', $model) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm px-3 py-1.5 rounded-lg">
                            <i class="fas fa-undo mr-1"></i>Restore
                        </button>
                    </form>
                    <form action="{{ route('admin.door-models.force-delete', $model) }}" method="POST"
                          onsubmit="return confirm('Hapus permanen? File 3D juga akan dihapus.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded-lg">
                            <i class="fas fa-times mr-1"></i>Hapus Permanen
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                <i class="fas fa-trash text-gray-200 text-6xl mb-4"></i>
                <p class="text-gray-500">Recycle bin kosong</p>
            </div>
        @endforelse
    </div>
</x-layouts.app>
