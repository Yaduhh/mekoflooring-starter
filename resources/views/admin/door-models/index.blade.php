<x-layouts.app :title="__('Door Models 3D')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">

        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Door Models 3D</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola model 3D pintu (door + handle)</p>
            </div>
            <a href="{{ route('admin.door-models.create') }}"
               class="bg-[#543A14] text-white px-4 py-2 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                <i class="fas fa-plus mr-2"></i>Tambah Model 3D
            </a>
        </div>

        @if(session('success'))
            <div id="successMsg" class="bg-emerald-700 text-white p-4 rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i><span>{{ session('success') }}</span>
            </div>
        @endif

        @if($doorModels->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                <i class="fas fa-cube text-gray-200 text-6xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-500 mb-2">Belum ada Door Model</h3>
                <a href="{{ route('admin.door-models.create') }}"
                   class="inline-block mt-4 bg-[#543A14] text-white px-6 py-2 rounded-lg hover:bg-[#6B4E1A]">
                    <i class="fas fa-plus mr-2"></i>Buat Sekarang
                </a>
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Preview</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Door Base</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Handle</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Door Type</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">File Info</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($doorModels as $model)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ $model->getCatalogImageUrl() }}"
                                                 alt="{{ $model->door_base_name }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $model->door_base_name }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-gray-800 dark:text-white">{{ $model->handle_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $model->handle_code }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 bg-[#543A14]/10 text-[#543A14] dark:text-amber-400 rounded-lg text-xs font-medium">
                                            {{ $model->doorType->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-gray-700 dark:text-gray-300">{{ $model->formatted_file_size }}</p>
                                        <p class="text-xs text-gray-500">{{ ucfirst($model->model_complexity) }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($model->status)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full text-xs font-semibold">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-full text-xs font-semibold">Non-aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('doors.view', [$model->doorType->slug, $model->slug]) }}"
                                               target="_blank"
                                               class="text-[#543A14] hover:text-[#6B4E1A]" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.door-models.edit', $model) }}"
                                               class="text-amber-500 hover:text-amber-700" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.door-models.destroy', $model) }}" method="POST"
                                                  onsubmit="return confirm('Hapus model ini?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $doorModels->links() }}</div>
        @endif

        <div>
            <a href="{{ route('admin.door-models.recycle') }}" class="text-sm text-gray-500 hover:text-red-600 transition-colors">
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
