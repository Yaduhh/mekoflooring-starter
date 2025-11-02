<x-layouts.app :title="__('Newsletter Subscribers')">
    <div class="mx-auto lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ __('Newsletter Subscribers') }}</h2>
        </div>

        <!-- Alert Success or Error -->
        @if(session('success'))
            <div class="mt-4 p-4 bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mt-4 p-4 bg-red-200 dark:bg-red-800 text-red-800 dark:text-red-200 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Total Subscribers') }}</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-2">{{ $totalAll }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Active') }}</p>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalSubscribed }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Unsubscribed') }}</p>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2">{{ $totalUnsubscribed }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-gray-200 dark:border-zinc-700 mb-6">
            <form method="GET" action="{{ route('admin.newsletter.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="{{ __('Search by email...') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Status Filter -->
                <div>
                    <select 
                        name="status" 
                        class="px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>{{ __('All Status') }}</option>
                        <option value="subscribed" {{ request('status') === 'subscribed' ? 'selected' : '' }}>{{ __('Subscribed') }}</option>
                        <option value="unsubscribed" {{ request('status') === 'unsubscribed' ? 'selected' : '' }}>{{ __('Unsubscribed') }}</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div>
                    <select 
                        name="sort_by" 
                        class="px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>{{ __('Date') }}</option>
                        <option value="email" {{ request('sort_by') === 'email' ? 'selected' : '' }}>{{ __('Email') }}</option>
                        <option value="status" {{ request('sort_by') === 'status' ? 'selected' : '' }}>{{ __('Status') }}</option>
                    </select>
                </div>

                <!-- Sort Order -->
                <div>
                    <select 
                        name="sort_order" 
                        class="px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()"
                    >
                        <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>{{ __('Descending') }}</option>
                        <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>{{ __('Ascending') }}</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    {{ __('Filter') }}
                </button>

                <!-- Clear Button -->
                @if(request('search') || request('status') !== 'all' || request('sort_by') !== 'created_at' || request('sort_order') !== 'desc')
                    <a 
                        href="{{ route('admin.newsletter.index') }}"
                        class="px-6 py-2 bg-gray-600 dark:bg-gray-500 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 flex items-center justify-center"
                    >
                        {{ __('Clear') }}
                    </a>
                @endif
            </form>
        </div>

        <!-- Subscribers Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-zinc-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Email') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Subscribed At') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Unsubscribed At') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                        @forelse($subscriptions as $subscription)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $subscription->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($subscription->status === 'subscribed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ __('Subscribed') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            {{ __('Unsubscribed') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $subscription->subscribed_at ? $subscription->subscribed_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $subscription->unsubscribed_at ? $subscription->unsubscribed_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a 
                                        href="{{ route('newsletter.unsubscribe', $subscription->token) }}" 
                                        target="_blank"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-4"
                                        title="{{ __('View Unsubscribe Link') }}"
                                    >
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('No subscribers found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 dark:border-zinc-700">
                {{ $subscriptions->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>

