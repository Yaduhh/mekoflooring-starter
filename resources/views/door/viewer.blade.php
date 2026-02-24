@extends('layouts.pages')

@section('title', '3D Viewer - ' . $doorModel->door_base_name . ' ' . $doorModel->handle_name)

@section('content')
<div class="bg-gradient-to-br from-[#1a1108] to-[#2d1f0a] min-h-screen">
    <div class="container mx-auto px-4 py-6 h-screen flex flex-col" style="max-height: 100vh;">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between mb-4 flex-shrink-0">
            <div class="flex items-center gap-4">
                <a href="{{ route('doors.type', $doorType->slug) }}"
                   class="flex items-center gap-2 text-[#c9a06a] hover:text-[#f0c87a] transition-colors text-sm font-medium">
                    <i class="fas fa-arrow-left"></i>
                    <span>{{ $doorType->name }}</span>
                </a>
                <div class="w-px h-5 bg-white/20"></div>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">{{ $doorModel->door_base_name }}</h1>
                    <p class="text-[#c9a06a] text-xs">
                        {{ $doorModel->handle_name }}
                        <span class="opacity-60">({{ $doorModel->handle_code }})</span>
                    </p>
                </div>
            </div>

            <a href="https://wa.me/6281112016231?text={{ urlencode('Hi, saya tertarik dengan ' . $doorModel->door_base_name . ' ' . $doorModel->handle_name) }}"
               target="_blank"
               class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg">
                <i class="fab fa-whatsapp text-base"></i>
                <span class="hidden sm:inline">Hubungi Kami</span>
            </a>
        </div>

        {{-- MAIN AREA --}}
        <div class="flex gap-4 flex-1 min-h-0">

            {{-- 3D VIEWER --}}
            <div class="flex-1 flex flex-col min-w-0 rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                <div id="canvas-container" class="relative flex-1 bg-gradient-to-br from-[#2a1f12] to-[#1a130a]">
                    <canvas id="door-canvas" class="w-full h-full"></canvas>

                    <div id="loading-overlay" class="absolute inset-0 flex items-center justify-center bg-[#1a1108]/90 z-50">
                        <div class="text-center">
                            <div class="inline-block animate-spin rounded-full h-14 w-14 border-b-2 border-[#c9a06a]"></div>
                            <p class="mt-4 text-white font-semibold">Loading 3D Model...</p>
                            <p class="text-sm text-[#c9a06a]/70 mt-1" id="loading-progress">Initializing...</p>
                        </div>
                    </div>

                    <div class="absolute top-3 right-3 bg-black/40 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                        <p class="text-xs text-white/70"><i class="fas fa-mouse mr-1"></i>Drag · Scroll</p>
                    </div>
                </div>

                <div class="bg-[#1a1108]/90 backdrop-blur border-t border-white/10 px-4 py-3 flex gap-2 flex-shrink-0">
                    <button id="reset-view" class="px-3 py-1.5 bg-[#543A14] hover:bg-[#6B4E1A] text-white rounded-lg text-xs font-semibold transition-colors">
                        <i class="fas fa-sync-alt mr-1.5"></i>Reset
                    </button>
                    <button id="toggle-rotation" class="px-3 py-1.5 border border-[#543A14] text-[#c9a06a] hover:bg-[#543A14] hover:text-white rounded-lg text-xs font-semibold transition-colors">
                        <i class="fas fa-play mr-1.5"></i><span id="rotation-text">Auto Rotate</span>
                    </button>
                    <button id="take-screenshot" class="px-3 py-1.5 bg-emerald-700 hover:bg-emerald-600 text-white rounded-lg text-xs font-semibold transition-colors">
                        <i class="fas fa-camera mr-1.5"></i>Screenshot
                    </button>
                </div>
            </div>

            {{-- HANDLE PANEL --}}
            @if($handleVariations->isNotEmpty())
            <div class="w-48 lg:w-56 flex-shrink-0 flex flex-col bg-[#1a1108]/80 backdrop-blur border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                <div class="px-4 py-3 border-b border-white/10 flex-shrink-0">
                    <h3 class="text-white font-bold text-sm">
                        <i class="fas fa-grip-horizontal mr-1.5 text-[#c9a06a]"></i>Pilih Handle
                    </h3>
                    <p class="text-white/40 text-xs mt-0.5">{{ $handleVariations->count() + 1 }} pilihan</p>
                </div>

                <div class="flex-1 overflow-y-auto p-3 space-y-2" style="scrollbar-width: thin; scrollbar-color: #543A14 transparent;">

                    {{-- Current (Active) --}}
                    <div class="relative rounded-xl overflow-hidden border-2 border-[#c9a06a] bg-[#c9a06a]/10 cursor-default">
                        <div class="aspect-square w-full overflow-hidden bg-black/20">
                            <img src="{{ $doorModel->getViewerThumbnailUrl() }}"
                                 alt="{{ $doorModel->handle_name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="absolute top-1.5 right-1.5 bg-[#c9a06a] text-[#1a1108] text-[10px] font-bold px-1.5 py-0.5 rounded-full flex items-center gap-1">
                            <i class="fas fa-check text-[8px]"></i>Aktif
                        </div>
                        <div class="px-2 py-2">
                            <p class="text-white text-xs font-semibold truncate leading-tight">{{ $doorModel->handle_name }}</p>
                            <p class="text-white/50 text-[10px]">{{ $doorModel->handle_code }}</p>
                        </div>
                    </div>

                    {{-- Other Variations --}}
                    @foreach($handleVariations as $variation)
                        <a href="{{ route('doors.view', [$doorType->slug, $variation->slug]) }}"
                           class="group relative block rounded-xl overflow-hidden border-2 border-white/10 hover:border-[#c9a06a]/60 bg-white/5 hover:bg-[#c9a06a]/5 transition-all duration-200">
                            <div class="aspect-square w-full overflow-hidden bg-black/20">
                                <img src="{{ $variation->getViewerThumbnailUrl() }}"
                                     alt="{{ $variation->handle_name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="absolute inset-0 bg-[#c9a06a]/0 group-hover:bg-[#c9a06a]/10 transition-colors pointer-events-none"></div>
                            <div class="px-2 py-2">
                                <p class="text-white/80 group-hover:text-white text-xs font-semibold truncate leading-tight transition-colors">{{ $variation->handle_name }}</p>
                                <p class="text-white/40 text-[10px]">{{ $variation->handle_code }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($doorModel->description)
                    <div class="border-t border-white/10 px-4 py-3 flex-shrink-0">
                        <p class="text-white/40 text-[11px] line-clamp-3">{{ $doorModel->description }}</p>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .flex-1.overflow-y-auto::-webkit-scrollbar { width: 4px; }
    .flex-1.overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
    .flex-1.overflow-y-auto::-webkit-scrollbar-thumb { background: #543A14; border-radius: 99px; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<script>
    window.DOOR_MODEL_URL    = "{{ $doorModel->getModelUrl() }}";
    window.DOOR_PRODUCT_SLUG = "{{ $doorModel->slug }}";
</script>

@vite('resources/js/door-viewer.js')
@endsection
