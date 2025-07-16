<x-layouts.app :title="__('Google Analytics Data')">
    <div class="container mx-auto text-gray-100">
        <h1 class="text-4xl font-semibold mb-12 text-center text-gray-100">Google Analytics Overview</h1>

        @if($totalActiveUsers == 0 && $totalPageViews == 0)
            <!-- Pesan Error -->
            <div class="bg-red-900 border border-red-700 text-red-100 px-6 py-4 rounded-lg mb-8">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-300 mr-3 text-xl"></i>
                    <div>
                        <h3 class="font-semibold text-lg">Google Analytics Tidak Dapat Diakses</h3>
                        <p class="mt-1">Mohon periksa konfigurasi berikut:</p>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            <li>Pastikan <code class="bg-red-800 px-1 rounded">ANALYTICS_PROPERTY_ID</code> sudah diset di file <code class="bg-red-800 px-1 rounded">.env</code></li>
                            <li>Pastikan Service Account memiliki akses ke Google Analytics Property</li>
                            <li>Periksa file credentials di <code class="bg-red-800 px-1 rounded">storage/app/analytics/service-account-credentials.json</code></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistik Umum (Card Style) dengan Ikon -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <div class="bg-gradient-to-r from-indigo-700 to-blue-800 p-6 rounded-lg shadow-xl text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-users text-white text-4xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-white mb-4">Total Active Users</h2>
                <p class="text-4xl font-bold text-white">{{ number_format($totalActiveUsers) }}</p>
            </div>
            <div class="bg-gradient-to-r from-green-600 to-teal-700 p-6 rounded-lg shadow-xl text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-eye text-white text-4xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-white mb-4">Total Page Views</h2>
                <p class="text-4xl font-bold text-white">{{ number_format($totalPageViews) }}</p>
            </div>
        </div>

        <!-- Statistik Tambahan (Top Referrers dan Top Browsers) dengan Ikon -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-12">
            <div class="bg-gray-800 p-6 rounded-lg shadow-xl">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-link text-gray-300 text-4xl"></i>
                </div>
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Top Referrers</h2>
                <ul class="text-lg text-gray-300">
                    @if(count($dataOverview['topReferrers']) > 0)
                        @foreach ($dataOverview['topReferrers'] as $referrer)
                            <li>{{ $referrer }}</li>
                        @endforeach
                    @else
                        <li class="text-gray-500">No referrer data available</li>
                    @endif
                </ul>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-xl">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-globe text-gray-300 text-4xl"></i>
                </div>
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Top Browsers</h2>
                <ul class="text-lg text-gray-300">
                    @if(count($dataOverview['topBrowsers']) > 0)
                        @foreach ($dataOverview['topBrowsers'] as $browser)
                            <li>{{ $browser }}</li>
                        @endforeach
                    @else
                        <li class="text-gray-500">No browser data available</li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Custom Bar Chart (CSS-based) -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl mb-12">
            <h2 class="text-xl font-semibold mb-6 text-center text-gray-100">Page Views by Page</h2>
            <div class="space-y-4">
                @if($formattedData->count() > 0)
                    @foreach ($formattedData as $data)
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-300 truncate w-48">{{ $data['pageTitle'] ?? 'Unknown Page' }}</span>
                            <div class="flex-1 bg-gray-700 rounded-full h-6">
                                <div class="bg-blue-500 h-6 rounded-full" style="width: {{ $totalPageViews > 0 ? ($data['screenPageViews'] / $totalPageViews * 100) : 0 }}%"></div>
                            </div>
                            <span class="text-gray-400">{{ $data['screenPageViews'] ?? 0 }} views</span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-gray-400 py-8">
                        <i class="fas fa-chart-bar text-4xl mb-4"></i>
                        <p>No page view data available</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-xl mb-12">
            <table class="min-w-full table-auto text-sm text-gray-300">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="py-4 px-6 text-left">Page Title</th>
                        <th class="py-4 px-6 text-left">Active Users</th>
                        <th class="py-4 px-6 text-left">Screen Page Views</th>
                    </tr>
                </thead>
                <tbody>
                    @if($paginatedData->count() > 0)
                        @foreach ($paginatedData as $data)
                            <tr class="border-t border-gray-600 hover:bg-gray-700">
                                <td class="py-3 px-6">{{ $data['pageTitle'] ?? 'Unknown Page' }}</td>
                                <td class="py-3 px-6">{{ $data['activeUsers'] ?? 0 }}</td>
                                <td class="py-3 px-6">{{ $data['screenPageViews'] ?? 0 }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-t border-gray-600">
                            <td colspan="3" class="py-8 px-6 text-center text-gray-400">
                                <i class="fas fa-table text-2xl mb-2"></i>
                                <p>No data available</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 text-center text-gray-300">
            {{ $paginatedData->links() }}
        </div>
    </div>
</x-layouts.app>
