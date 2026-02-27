@extends('layouts.pages')

@section('title', $doorType->name . ' - Door Collection')

@section('content')
<div class="bg-gradient-to-br from-[#1a1108] to-[#2d1f0a] min-h-screen">
    <div class="container mx-auto px-4 py-6" style="height: 100vh; display: flex; flex-direction: column;">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between mb-4 flex-shrink-0">
            <div class="flex items-center gap-4">
                <a href="{{ route('doors.index') }}"
                   class="flex items-center gap-2 text-[#c9a06a] hover:text-[#f0c87a] transition-colors text-sm font-medium">
                    <i class="fas fa-arrow-left"></i>
                    <span>Semua Pintu</span>
                </a>
                <div class="w-px h-5 bg-white/20"></div>
                <div>
                    <h1 class="text-white font-bold text-lg leading-tight">{{ $doorType->name }}</h1>
                    <p class="text-[#c9a06a] text-xs" id="active-model-info">Pilih model untuk preview</p>
                </div>
            </div>

            <a id="wa-link" href="https://wa.me/6281112016231" target="_blank"
               class="flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-xl text-sm font-semibold transition-colors shadow-lg">
                <i class="fab fa-whatsapp text-base"></i>
                <span class="hidden sm:inline">Hubungi Kami</span>
            </a>
        </div>

        {{-- MAIN AREA --}}
        <div class="flex gap-4 flex-1 min-h-0">

            {{-- 3D VIEWER (kiri) --}}
            <div class="flex-1 flex flex-col min-w-0 rounded-2xl overflow-hidden shadow-2xl border border-white/10">

                {{-- Empty state --}}
                <div id="empty-state" class="flex-1 flex flex-col items-center justify-center bg-gradient-to-br from-[#2a1f12] to-[#1a130a]">
                    <div class="text-center">
                        <i class="fas fa-door-open text-[#543A14] text-8xl mb-6 opacity-40"></i>
                        <h2 class="text-white/60 text-xl font-semibold mb-2">Pilih Model Pintu</h2>
                        <p class="text-white/30 text-sm">Klik model di panel kanan untuk preview 3D</p>
                        <div class="mt-6 flex items-center gap-2 text-[#c9a06a]/50 text-xs">
                            <i class="fas fa-arrow-right animate-pulse"></i>
                            <span>Pilih handle untuk mulai</span>
                        </div>
                    </div>
                </div>

                {{-- Canvas --}}
                <div id="canvas-wrapper" class="flex-1 relative bg-gradient-to-br from-[#2a1f12] to-[#1a130a] hidden">
                    <canvas id="door-canvas" class="w-full h-full"></canvas>

                    <div id="loading-overlay" class="absolute inset-0 flex items-center justify-center bg-[#1a1108]/90 z-50">
                        <div class="text-center">
                            <div class="inline-block animate-spin rounded-full h-14 w-14 border-b-2 border-[#c9a06a]"></div>
                            <p class="mt-4 text-white font-semibold">Loading 3D Model...</p>
                            <p class="text-sm text-[#c9a06a]/70 mt-1" id="loading-progress">Initializing...</p>
                        </div>
                    </div>

                    <div class="absolute top-3 right-3 bg-black/40 backdrop-blur-sm px-3 py-1.5 rounded-lg">
                        <p class="text-xl text-white/70"><i class="fas fa-mouse mr-1"></i>Drag · Rotate</p>
                        <p class="text-xl text-white/70"><i class="fas fa-mouse mr-1"></i>Zoom · Scroll</p>
                    </div>
                </div>

                {{-- Controls --}}
                <div id="controls-bar" class="bg-[#1a1108]/90 backdrop-blur border-t border-white/10 px-4 py-3 flex gap-2 flex-shrink-0 hidden">
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

            {{-- RIGHT PANEL --}}
            <div class="w-56 lg:w-64 flex-shrink-0 flex flex-col bg-[#1a1108]/80 backdrop-blur border border-white/10 rounded-2xl overflow-hidden shadow-2xl">

                <div class="px-4 py-3 border-b border-white/10 flex-shrink-0">
                    <h3 class="text-white font-bold text-sm">
                        <i class="fas fa-grip-horizontal mr-1.5 text-[#c9a06a]"></i>Pilih Handle
                    </h3>
                    <p class="text-white/40 text-xs mt-0.5">
                        {{ $groupedModels->sum(fn($g) => $g->count()) }} pilihan ·
                        {{ $groupedModels->count() }} desain
                    </p>
                </div>

                <div class="flex-1 overflow-y-auto p-3 space-y-4" style="scrollbar-width: thin; scrollbar-color: #543A14 transparent;">
                    @foreach($groupedModels as $doorBaseName => $models)
                        <div>
                            <p class="text-[#c9a06a]/60 text-[10px] font-bold uppercase tracking-widest mb-2 px-1">
                                {{ $doorBaseName }}
                            </p>
                            <div class="space-y-1.5">
                                @foreach($models as $model)
                                    <button onclick="loadDoorModel(
                                        '{{ $model->getModelUrl() }}',
                                        '{{ $model->slug }}',
                                        this,
                                        '{{ addslashes($model->handle_name) }}',
                                        '{{ $model->handle_code }}',
                                        'https://wa.me/6281112016231?text={{ urlencode('Hi, saya tertarik dengan ' . $model->door_base_name . ' ' . $model->handle_name) }}'
                                    )"
                                        class="handle-card w-full flex items-center gap-2.5 rounded-xl p-2 border-2 border-white/10 hover:border-[#c9a06a]/50 bg-white/5 hover:bg-[#c9a06a]/5 transition-all duration-200 text-left group">
                                        <div class="w-12 h-12 flex-shrink-0 rounded-lg overflow-hidden bg-black/20">
                                            <img src="{{ $model->getViewerThumbnailUrl() }}"
                                                 alt="{{ $model->handle_name }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-white/80 group-hover:text-white text-xs font-semibold truncate transition-colors leading-tight">
                                                {{ $model->handle_name }}
                                            </p>
                                            <p class="text-white/40 text-[10px] truncate">{{ $model->handle_code }}</p>
                                        </div>
                                        <i class="fas fa-chevron-right text-white/20 group-hover:text-[#c9a06a]/60 text-xs transition-colors flex-shrink-0"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .flex-1.overflow-y-auto::-webkit-scrollbar { width: 4px; }
    .flex-1.overflow-y-auto::-webkit-scrollbar-track { background: transparent; }
    .flex-1.overflow-y-auto::-webkit-scrollbar-thumb { background: #543A14; border-radius: 99px; }
    .handle-card.active { border-color: #c9a06a !important; background-color: rgba(201,160,106,0.12) !important; }
    .handle-card.active p:first-child { color: white !important; }
</style>

<script>
    window.DOOR_MODEL_URL    = null;
    window.DOOR_PRODUCT_SLUG = null;
    window._doorViewerReady  = false;

    function loadDoorModel(modelUrl, slug, btn, handleName, handleCode, waUrl) {
        document.querySelectorAll('.handle-card').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');

        document.getElementById('active-model-info').textContent = handleName + ' (' + handleCode + ')';
        document.getElementById('wa-link').href = waUrl;

        document.getElementById('empty-state').classList.add('hidden');
        document.getElementById('canvas-wrapper').classList.remove('hidden');
        document.getElementById('controls-bar').classList.remove('hidden');

        if (window._doorViewerReady && window._loadNewModel) {
            window._loadNewModel(modelUrl, slug);
        } else {
            window.DOOR_MODEL_URL    = modelUrl;
            window.DOOR_PRODUCT_SLUG = slug;
            requestAnimationFrame(() => window.initDoorViewer());
        }
    }
</script>

@vite('resources/js/door-viewer.js')
@endsection
