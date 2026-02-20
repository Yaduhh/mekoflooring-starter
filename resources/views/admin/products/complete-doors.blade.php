{{-- resources/views/admin/products/complete-doors.blade.php --}}
<x-layouts.app :title="__('Complete Door Models')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Complete Door Models</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    3D models with door and handle already combined (product_type = 3)
                </p>
            </div>
            <a href="{{ route('products.create') }}?product_type=3"
                class="bg-[#543A14] text-white px-4 py-2 rounded-lg hover:bg-[#6B4E1A] transition-colors">
                <i class="fas fa-plus mr-2"></i>Create Complete Model
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div id="successNotification" class="bg-emerald-700 text-white p-4 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-check-circle text-2xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div id="errorNotification" class="bg-red-600 text-white p-4 rounded-xl shadow-md flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-2xl"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Info Box -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl mt-0.5"></i>
                <div>
                    <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-1">About Complete Door Models</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        These are complete 3D models (door + handle combined) for the 3D viewer.
                        Different from 2D Accessories which are used on the homepage.
                    </p>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        @if($products->isEmpty())
            <div class="text-center py-20 bg-white dark:bg-zinc-800 rounded-xl">
                <i class="fas fa-cube text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-2">No Complete Models Yet</h3>
                <p class="text-gray-500 dark:text-gray-500 mb-6">Create your first complete door + handle model</p>
                <a href="{{ route('products.create') }}?product_type=3"
                    class="inline-block bg-[#543A14] text-white px-6 py-3 rounded-lg hover:bg-[#6B4E1A]">
                    <i class="fas fa-plus mr-2"></i>Create Complete Model
                </a>
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Preview
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Door Base
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Handle
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Model Info
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <!-- Preview -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                        <img src="{{ $product->getCatalogImageUrl() }}"
                                            alt="{{ $product->nama }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                </td>

                                <!-- Door Base -->
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $product->door_base_name }}
                                    </div>
                                </td>

                                <!-- Handle -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $product->handle_name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Code: {{ $product->handle_code }}
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->category)
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $product->category->name_category }}
                                    </div>
                                    @else
                                    <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                <!-- Model Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $product->formatted_file_size }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ ucfirst($product->model_complexity) }}
                                    </div>
                                    @if($product->complete_model_3d)
                                    <div class="text-xs text-gray-400 mt-1 font-mono">
                                        {{ basename($product->complete_model_3d) }}
                                    </div>
                                    @endif
                                    @if($product->is_3d)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#543A14] text-white mt-1">
                                        <i class="fas fa-cube mr-1"></i>3D
                                    </span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->status)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2 items-center">
                                        @if($product->is_3d && $product->complete_model_3d && $product->category)
                                        <a href="{{ route('doors.view', [$product->category->slug_category, $product->slug_produk]) }}"
                                            target="_blank"
                                            class="text-[#543A14] hover:text-[#6B4E1A]" title="Preview 3D">
                                            <i class="fas fa-cube"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-amber-600 hover:text-amber-900 dark:hover:text-amber-400" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this complete model?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400" title="Delete">
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

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <script>
        // Auto-hide notifications
        setTimeout(() => {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
            if (errorNotification) {
                errorNotification.style.display = 'none';
            }
        }, 5000);
    </script>
</x-layouts.app>
