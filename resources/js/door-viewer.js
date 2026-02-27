import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { HDRLoader } from 'three/addons/loaders/HDRLoader.js';

let scene, camera, renderer, controls;
let doorModel = null;
let autoRotate = false;
let wireframeMode = false;
let initialized = false;

function init() {
    const container = document.getElementById('canvas-wrapper') || document.getElementById('canvas-container');
    const canvas    = document.getElementById('door-canvas');

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xfaf7f2);

    camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.set(0, 1.5, 5);

    renderer = new THREE.WebGLRenderer({ canvas, antialias: true, preserveDrawingBuffer: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1;
    renderer.physicallyCorrectLights = true;

    new HDRLoader().load('/hdr/white_studio_06_1k.hdr', (texture) => {
    texture.mapping = THREE.EquirectangularReflectionMapping;
    scene.environment = texture;
    scene.environmentIntensity = 0.6;
    // scene.background = texture;
    });

    new THREE.TextureLoader().load('/img/Room.png', (bg) => {
    bg.colorSpace = THREE.SRGBColorSpace;
    scene.background = bg;
    });

    const rimLight = new THREE.DirectionalLight(0xffffff, 1.3);
    rimLight.position.set(0, 2, -4);
    scene.add(rimLight);

    const dir1 = new THREE.DirectionalLight(0xffffff, 2);
    dir1.position.set(5, 10, 7);
    scene.add(dir1);

    const dir2 = new THREE.DirectionalLight(0xffffff, 1);
    dir2.position.set(-5, 5, -5);
    scene.add(dir2);

    const backFill = new THREE.DirectionalLight(0xffffff, 0.6);
    backFill.position.set(0, -1, -3);
    scene.add(backFill);

    const hemiLight = new THREE.HemisphereLight(0xffffff, 0x444444, 1.2);
    scene.add(hemiLight);

    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping    = true;
    controls.dampingFactor    = 0.05;
    controls.minDistance      = 2;
    controls.maxDistance      = 15;
    controls.minPolarAngle    = Math.PI / 2;
    controls.maxPolarAngle    = Math.PI / 2;
    controls.target.set(0, 1, 0);
    controls.update();

    animate();
    window.addEventListener('resize', onWindowResize);
    initialized = true;
}

function loadModel(url) {
    if (!url) { hideLoading(); return; }
    showLoading('Loading 3D model...');

    if (doorModel) {
        scene.remove(doorModel);
        doorModel.traverse(child => {
            if (child.isMesh) {
                child.geometry.dispose();
                const mats = Array.isArray(child.material) ? child.material : [child.material];
                mats.forEach(m => m.dispose());
            }
        });
        doorModel = null;
    }

    const loader = new GLTFLoader();
    loader.load(
        url,
        function (gltf) {
            doorModel = gltf.scene;
            doorModel.traverse(child => {
                if (child.isMesh) {
                    console.log('Mesh:', child.name);
                    console.log('Material type:', child.material.type);
                }
            });
            doorModel.traverse(child => {
                if (child.isMesh && child.material) {
                    const mats = Array.isArray(child.material) ? child.material : [child.material];
                    mats.forEach(mat => {
                        if (mat.map)          mat.map.colorSpace          = THREE.SRGBColorSpace;
                        if (mat.emissiveMap)  mat.emissiveMap.colorSpace  = THREE.SRGBColorSpace;
                        if (wireframeMode)    mat.wireframe                = true;
                        mat.needsUpdate = true;
                    });
                }
            });

            const box    = new THREE.Box3().setFromObject(doorModel);
            const center = box.getCenter(new THREE.Vector3());
            const size   = box.getSize(new THREE.Vector3());
            doorModel.position.sub(center);
            const scale = 3 / Math.max(size.x, size.y, size.z);
            doorModel.scale.setScalar(scale);

            doorModel.rotation.y = -Math.PI / 2;

            scene.add(doorModel);

            camera.position.set(0, 1.5, 5);
            controls.target.set(0, 1, 0);
            controls.update();

            hideLoading();
        },
        function (xhr) {
            if (xhr.total) updateLoadingProgress(`Loading: ${Math.round(xhr.loaded / xhr.total * 100)}%`);
        },
        function (error) {
            console.error('GLTFLoader error:', error);
            hideLoading();
        }
    );
}

function animate() {
    requestAnimationFrame(animate);
    if (autoRotate && doorModel) doorModel.rotation.y += 0.01;
    controls.update();
    renderer.render(scene, camera);
}

function onWindowResize() {
    const container = document.getElementById('canvas-wrapper') || document.getElementById('canvas-container');
    if (!container) return;
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
}

function showLoading(msg)         { document.getElementById('loading-overlay').style.display = 'flex'; updateLoadingProgress(msg); }
function hideLoading()            { document.getElementById('loading-overlay').style.display = 'none'; }
function updateLoadingProgress(m) { const el = document.getElementById('loading-progress'); if (el) el.textContent = m; }

document.getElementById('reset-view')?.addEventListener('click', () => {
    camera.position.set(0, 1.5, 5);
    controls.target.set(0, 1, 0);
    controls.update();
});

document.getElementById('toggle-rotation')?.addEventListener('click', () => {
    autoRotate = !autoRotate;
    document.querySelector('#toggle-rotation i').className = autoRotate ? 'fas fa-pause mr-1.5' : 'fas fa-play mr-1.5';
    document.getElementById('rotation-text').textContent   = autoRotate ? 'Stop Rotate' : 'Auto Rotate';
});

document.getElementById('toggle-wireframe')?.addEventListener('click', () => {
    wireframeMode = !wireframeMode;
    scene?.traverse(child => { if (child.isMesh) child.material.wireframe = wireframeMode; });
});

document.getElementById('take-screenshot')?.addEventListener('click', () => {
    renderer.render(scene, camera);
    const link  = document.createElement('a');
    link.download = (window.DOOR_PRODUCT_SLUG || 'door') + '.png';
    link.href     = renderer.domElement.toDataURL('image/png');
    link.click();
});
window.initDoorViewer = function () {
    if (!initialized) init();
    loadModel(window.DOOR_MODEL_URL);
    window._doorViewerReady = true;
};
window._loadNewModel = function (url, slug) {
    window.DOOR_MODEL_URL    = url;
    window.DOOR_PRODUCT_SLUG = slug;
    loadModel(url);
};

if (window.DOOR_MODEL_URL) {
    window.initDoorViewer();
}
