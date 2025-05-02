<x-layouts.app :title="__('Google Analytics Data')">
    <div class="container mx-auto text-gray-100">
        <h1 class="text-4xl font-semibold mb-12 text-center text-gray-100">Google Analytics Overview</h1>

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
                    @foreach ($dataOverview['topReferrers'] as $referrer)
                        <li>{{ $referrer }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-xl">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-globe text-gray-300 text-4xl"></i> <!-- pakai globe buat browser -->
                </div>
                <h2 class="text-xl font-semibold mb-4 text-gray-100">Top Browsers</h2>
                <ul class="text-lg text-gray-300">
                    @foreach ($dataOverview['topBrowsers'] as $browser)
                        <li>{{ $browser }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Custom Bar Chart (CSS-based) -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl mb-12">
            <h2 class="text-xl font-semibold mb-6 text-center text-gray-100">Page Views by Page</h2>
            <div class="space-y-4">
                @foreach ($formattedData as $data)
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-300 truncate w-48">{{ $data['pageTitle'] }}</span>
                        <div class="flex-1 bg-gray-700 rounded-full h-6">
                            <div class="bg-blue-500 h-6 rounded-full" style="width: {{ $data['screenPageViews'] / $totalPageViews * 100 }}%"></div>
                        </div>
                        <span class="text-gray-400">{{ $data['screenPageViews'] }} views</span>
                    </div>
                @endforeach
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
                    @foreach ($paginatedData as $data)
                        <tr class="border-t border-gray-600 hover:bg-gray-700">
                            <td class="py-3 px-6">{{ $data['pageTitle'] }}</td>
                            <td class="py-3 px-6">{{ $data['activeUsers'] }}</td>
                            <td class="py-3 px-6">{{ $data['screenPageViews'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 text-center text-gray-300">
            {{ $paginatedData->links() }}
        </div>
    </div>
</x-layouts.app>
