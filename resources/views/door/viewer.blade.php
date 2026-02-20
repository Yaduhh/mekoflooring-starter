@extends('layouts.pages')

@section('title', '3D Door Viewer - ' . $product->nama)

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('doors.category', $product->category->slug_category) }}"
                       class="text-[#543A14] hover:text-[#6B4E1A] transition-colors mb-2 inline-block">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to {{ $product->category->name_category }}
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->door_base_name }}</h1>
                    <p class="text-gray-600 mt-1">
                        Current Handle: <span class="font-semibold">{{ $product->handle_name }} ({{ $product->handle_code }})</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6">
            <!-- 3D Viewer -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Canvas Container -->
                <div id="canvas-container" class="relative w-full h-[600px] bg-gradient-to-br from-gray-100 to-gray-200">
                    <canvas id="door-canvas"></canvas>

                    <!-- Loading Overlay -->
                    <div id="loading-overlay" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-90 z-50">
                        <div class="text-center">
                            <div class="inline-block animate-spin rounded-full h-16 w-16 border-b-2 border-[#543A14]"></div>
                            <p class="mt-4 text-gray-600 font-medium">Loading 3D Model...</p>
                            <p class="text-sm text-gray-500 mt-2" id="loading-progress">Initializing...</p>
                        </div>
                    </div>

                    <!-- View Controls Info -->
                    <div class="absolute top-4 right-4 bg-white bg-opacity-90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg">
                        <p class="text-xs text-gray-600">
                            <i class="fas fa-mouse mr-2"></i>
                            <span>Drag to rotate • Scroll to zoom</span>
                        </p>
                    </div>
                </div>

                <!-- Controls -->
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-wrap gap-3">
                        <button id="reset-view" class="px-4 py-2 bg-[#543A14] text-white rounded-lg hover:bg-[#6B4E1A] transition-colors text-sm">
                            <i class="fas fa-sync-alt mr-2"></i>Reset View
                        </button>

                        <button id="toggle-rotation" class="px-4 py-2 bg-white border-2 border-[#543A14] text-[#543A14] rounded-lg hover:bg-[#543A14] hover:text-white transition-colors text-sm">
                            <i class="fas fa-play mr-2"></i>
                            <span id="rotation-text">Auto Rotate</span>
                        </button>

                        <button id="toggle-wireframe" class="px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors text-sm">
                            <i class="fas fa-cube mr-2"></i>Wireframe
                        </button>

                        <button id="take-screenshot" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm">
                            <i class="fas fa-camera mr-2"></i>Screenshot
                        </button>

                        <div class="ml-auto">
                            <a href="https://wa.me/6281112016231?text=Hi,%20I'm%20interested%20in%20{{ urlencode($product->nama) }}"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                                <i class="fab fa-whatsapp mr-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HORIZONTAL Handle Variations Selector -->
            @if($handleVariations->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-grip-horizontal mr-2 text-[#543A14]"></i>
                    Try Different Handles ({{ $handleVariations->count() + 1 }} options)
                </h3>

                <!-- HORIZONTAL Scrollable Container -->
                <div class="relative">
                    <!-- Scroll Buttons -->
                    <button id="scroll-left" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center text-gray-600 hover:text-[#543A14] transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="scroll-right" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 bg-white shadow-lg rounded-full w-10 h-10 flex items-center justify-center text-gray-600 hover:text-[#543A14] transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>

                    <!-- Horizontal Scroll Container -->
                    <div id="handle-scroll-container" class="flex gap-4 overflow-x-auto pb-2 scroll-smooth" style="scrollbar-width: thin;">
                        <!-- Current Handle (Active) -->
                        <div class="handle-card flex-shrink-0 w-40 cursor-pointer border-2 border-[#543A14] bg-[#FFF0DC] rounded-xl p-3 transition-all">
                            <div class="relative">
                                <div class="w-full h-32 bg-gray-100 rounded-lg overflow-hidden mb-2">
                                    <img src="{{ $product->getViewerThumbnailUrl() }}"
                                         alt="{{ $product->handle_name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="absolute top-2 right-2 bg-[#543A14] text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-check mr-1"></i>Current
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-sm text-gray-900 truncate">{{ $product->handle_name }}</p>
                                <p class="text-xs text-gray-600">{{ $product->handle_code }}</p>
                            </div>
                        </div>

                        <!-- Other Handle Variations -->
                        @foreach($handleVariations as $variation)
                        <a href="{{ route('doors.view', [$variation->category->slug_category, $variation->slug_produk]) }}"
                           class="handle-card flex-shrink-0 w-40 border-2 border-gray-200 hover:border-[#543A14] rounded-xl p-3 transition-all hover:shadow-md">
                            <div class="w-full h-32 bg-gray-100 rounded-lg overflow-hidden mb-2">
                                <img src="{{ $variation->getViewerThumbnailUrl() }}"
                                     alt="{{ $variation->handle_name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-sm text-gray-900 truncate">{{ $variation->handle_name }}</p>
                                <p class="text-xs text-gray-600">{{ $variation->handle_code }}</p>
                                <p class="text-xs text-[#543A14] mt-1">
                                    <i class="fas fa-arrow-right mr-1"></i>Switch
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Scroll Indicator -->
                <div class="flex justify-center mt-3 gap-1">
                    <div class="scroll-indicator h-1 w-8 bg-gray-300 rounded-full transition-all"></div>
                    <div class="scroll-indicator h-1 w-8 bg-gray-300 rounded-full transition-all"></div>
                    <div class="scroll-indicator h-1 w-8 bg-gray-300 rounded-full transition-all"></div>
                </div>
            </div>
            @endif

            <!-- Product Info -->
            @if($product->description)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-3">About This Model</h3>
                <p class="text-gray-600">{{ $product->description }}</p>
            </div>
            @endif
        </div>
    </div>
</div>


<!-- Three.js Scripts -->
<!-- IMPORTANT: Override createImageBitmap BEFORE importmap loads -->
<script>
    // createImageBitmap fails on some browsers for GLB embedded textures
    // This override forces Three.js GLTFLoader to use fallback Image loading
    window.createImageBitmap = undefined;
</script>

<script type="importmap">
{
  "imports": {
    "three": "/js/three.js-master/build/three.module.js",
    "three/addons/": "/js/three.js-master/examples/jsm/"
  }
}
</script>

<script type="module">
    import * as THREE from 'three';
    import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
    import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

    // Global variables
    let scene, camera, renderer, controls;
    let doorModel;
    let autoRotate = false;
    let wireframeMode = false;

    function init() {
        const container = document.getElementById('canvas-container');
        const canvas = document.getElementById('door-canvas');

        scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf5f5f5);

        camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
        camera.position.set(0, 1.5, 5);

        renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.outputColorSpace = THREE.SRGBColorSpace;
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.0;

        // Lighting
        scene.add(new THREE.AmbientLight(0xffffff, 2));
        const dir1 = new THREE.DirectionalLight(0xffffff, 2);
        dir1.position.set(5, 10, 7);
        scene.add(dir1);
        const dir2 = new THREE.DirectionalLight(0xffffff, 1);
        dir2.position.set(-5, 5, -5);
        scene.add(dir2);

        scene.add(new THREE.GridHelper(10, 10, 0xcccccc, 0xe0e0e0));

        controls = new OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.minDistance = 2;
        controls.maxDistance = 15;
        controls.maxPolarAngle = Math.PI / 2;
        controls.target.set(0, 1, 0);
        controls.update();

        loadModel();
        animate();
        window.addEventListener('resize', onWindowResize);
    }

    function loadModel() {
        const modelUrl = "{{ $product->getModelUrl() }}";
        if (!modelUrl) { hideLoading(); alert('No 3D model available.'); return; }

        showLoading('Loading 3D model...');

        const loader = new GLTFLoader();
        loader.load(
            modelUrl,
            function(gltf) {
                doorModel = gltf.scene;

                const box = new THREE.Box3().setFromObject(doorModel);
                const center = box.getCenter(new THREE.Vector3());
                const size = box.getSize(new THREE.Vector3());
                doorModel.position.sub(center);
                const scale = 3 / Math.max(size.x, size.y, size.z);
                doorModel.scale.setScalar(scale);

                scene.add(doorModel);
                hideLoading();
            },
            function(xhr) {
                if (xhr.total) updateLoadingProgress(`Loading: ${Math.round(xhr.loaded / xhr.total * 100)}%`);
            },
            function(error) {
                console.error('GLTFLoader error:', error);
                hideLoading();
                alert('Failed to load 3D model.');
            }
        );
    }

    function animate() {
        requestAnimationFrame(animate);
        if (autoRotate && doorModel) doorModel.rotation.y += 0.005;
        controls.update();
        renderer.render(scene, camera);
    }

    function onWindowResize() {
        const container = document.getElementById('canvas-container');
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    }

    function showLoading(msg) { document.getElementById('loading-overlay').style.display = 'flex'; updateLoadingProgress(msg); }
    function hideLoading() { document.getElementById('loading-overlay').style.display = 'none'; }
    function updateLoadingProgress(msg) { document.getElementById('loading-progress').textContent = msg; }

    document.getElementById('reset-view').addEventListener('click', () => {
        camera.position.set(0, 1.5, 5);
        controls.target.set(0, 1, 0);
        controls.update();
    });

    document.getElementById('toggle-rotation').addEventListener('click', () => {
        autoRotate = !autoRotate;
        document.querySelector('#toggle-rotation i').className = autoRotate ? 'fas fa-pause mr-2' : 'fas fa-play mr-2';
        document.getElementById('rotation-text').textContent = autoRotate ? 'Stop Rotate' : 'Auto Rotate';
    });

    document.getElementById('toggle-wireframe').addEventListener('click', () => {
        wireframeMode = !wireframeMode;
        scene.traverse(child => { if (child.isMesh) child.material.wireframe = wireframeMode; });
    });

    document.getElementById('take-screenshot').addEventListener('click', () => {
        renderer.render(scene, camera);
        const link = document.createElement('a');
        link.download = '{{ Str::slug($product->nama) }}.png';
        link.href = renderer.domElement.toDataURL('image/png');
        link.click();
    });

    init();
</script>

<script>
    // Horizontal scroll functionality
    const scrollContainer = document.getElementById('handle-scroll-container');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');

    if (scrollContainer) {
        scrollLeftBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -200, behavior: 'smooth' });
        });

        scrollRightBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 200, behavior: 'smooth' });
        });

        // Update scroll indicators
        scrollContainer.addEventListener('scroll', () => {
            const scrollPercent = scrollContainer.scrollLeft / (scrollContainer.scrollWidth - scrollContainer.clientWidth);
            document.querySelectorAll('.scroll-indicator').forEach((indicator, index) => {
                if (scrollPercent > (index / 2)) {
                    indicator.classList.add('bg-[#543A14]');
                    indicator.classList.remove('bg-gray-300');
                } else {
                    indicator.classList.remove('bg-[#543A14]');
                    indicator.classList.add('bg-gray-300');
                }
            });
        });
    }
</script>

<style>
    /* Custom scrollbar for handle container */
    #handle-scroll-container::-webkit-scrollbar {
        height: 6px;
    }

    #handle-scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #handle-scroll-container::-webkit-scrollbar-thumb {
        background: #543A14;
        border-radius: 10px;
    }

    #handle-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #6B4E1A;
    }
</style>
@endsection
