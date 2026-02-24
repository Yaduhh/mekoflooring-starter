<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

// Controllers - General
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\GoogleAnalyticsController;
use App\Http\Controllers\EmailSubscriptionController;

// Controllers - Admin
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\DoorTypeController;
use App\Http\Controllers\Admin\DoorModelController;

// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [HomeController::class, 'show'])->name('product.show');

// Floor simulation (tetap ada)
Route::get('floor/view-simulation', [FloorController::class, 'index'])->name('floor.index');
Route::get('floor/view-simulation/show', [FloorController::class, 'show'])->name('floor.show');
Route::get('floor/view-simulation/show/category/{slug}', [FloorController::class, 'showByCategory'])->name('floor.product.show');

// Articles
Route::get('artikel/{slug}', [HomeController::class, 'showArticle'])->name('articles.public.show');

// Catalogue
Route::get('catalogue', [HomeController::class, 'showCatalogue'])->name('catalogue.public.show');
Route::get('aksesoris/{slug}', [HomeController::class, 'showAksesoris'])->name('aksesoris.public.show');

// Newsletter
Route::post('newsletter/subscribe', [EmailSubscriptionController::class, 'store'])->name('newsletter.subscribe');
Route::get('newsletter/unsubscribe/{token}', [EmailSubscriptionController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// ── Door 3D Viewer ───────────────────────────────────────────
Route::get('door-view', [DoorController::class, 'landing'])->name('door.landing');

Route::prefix('doors')->name('doors.')->group(function () {
    Route::get('/', [DoorController::class, 'index'])->name('index');
    Route::get('/{typeSlug}', [DoorController::class, 'showType'])->name('type');
    Route::get('/{typeSlug}/{modelSlug}', [DoorController::class, 'view'])->name('view');
});

// ============================================================
// ADMIN ROUTES
// ============================================================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // ── Settings ─────────────────────────────────────────────
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // ── Categories (untuk produk biasa, tidak diubah) ─────────
    Route::resource('categories', CategoryController::class);
    Route::get('dashboard/recycle/categories', [CategoryController::class, 'recycle'])
        ->name('admin.category.recycle');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::put('/categories/{category}/delete', [CategoryController::class, 'delete'])
        ->name('categories.delete');

    // ── Products (untuk produk biasa, tidak diubah) ───────────
    Route::get('admin/products', [ProductController::class, 'index'])
        ->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])
        ->name('products.create');
    Route::post('products', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])
        ->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');
    Route::get('dashboard/recycle/product', [ProductController::class, 'recycle'])
        ->name('admin.product.recycle');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');

    // ── Articles ─────────────────────────────────────────────
    Route::resource('articles', ArticleController::class);
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('articles.uploadImage');
    Route::delete('/articles/delete-image', [ArticleController::class, 'deleteImage'])
        ->name('articles.deleteImage');

    // ── Catalogue & Newsletter ────────────────────────────────
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('catalogue', CatalogueController::class);
        Route::get('newsletter', [EmailSubscriptionController::class, 'index'])
            ->name('newsletter.index');
    });

    // ── Analytics ────────────────────────────────────────────
    Route::get('admin/google/analytics', [GoogleAnalyticsController::class, 'index'])
        ->name('google.analytics');

    // ── Door Types (baru, terpisah) ───────────────────────────
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('door-types', [DoorTypeController::class, 'index'])
            ->name('door-types.index');
        Route::get('door-types/recycle', [DoorTypeController::class, 'recycle'])
            ->name('door-types.recycle');
        Route::get('door-types/create', [DoorTypeController::class, 'create'])
            ->name('door-types.create');
        Route::post('door-types', [DoorTypeController::class, 'store'])
            ->name('door-types.store');
        Route::get('door-types/{doorType}/edit', [DoorTypeController::class, 'edit'])
            ->name('door-types.edit');
        Route::put('door-types/{doorType}', [DoorTypeController::class, 'update'])
            ->name('door-types.update');
        Route::delete('door-types/{doorType}', [DoorTypeController::class, 'destroy'])
            ->name('door-types.destroy');
        Route::put('door-types/{doorType}/restore', [DoorTypeController::class, 'restore'])
            ->name('door-types.restore');
        Route::delete('door-types/{doorType}/force-delete', [DoorTypeController::class, 'forceDelete'])
            ->name('door-types.force-delete');

        // ── Door Models (baru, terpisah) ──────────────────────
        Route::get('door-models', [DoorModelController::class, 'index'])
            ->name('door-models.index');
        Route::get('door-models/recycle', [DoorModelController::class, 'recycle'])
            ->name('door-models.recycle');
        Route::get('door-models/create', [DoorModelController::class, 'create'])
            ->name('door-models.create');
        Route::post('door-models', [DoorModelController::class, 'store'])
            ->name('door-models.store');
        Route::get('door-models/{doorModel}/edit', [DoorModelController::class, 'edit'])
            ->name('door-models.edit');
        Route::put('door-models/{doorModel}', [DoorModelController::class, 'update'])
            ->name('door-models.update');
        Route::delete('door-models/{doorModel}', [DoorModelController::class, 'destroy'])
            ->name('door-models.destroy');
        Route::put('door-models/{doorModel}/restore', [DoorModelController::class, 'restore'])
            ->name('door-models.restore');
        Route::delete('door-models/{doorModel}/force-delete', [DoorModelController::class, 'forceDelete'])
            ->name('door-models.force-delete');
    });
});

// ============================================================
// IMAGE ROUTES (Private Storage Access)
// ============================================================

Route::get('product-image/{filename}', function ($filename) {
    $path = storage_path('app/private/images/' . $filename);
    if (!file_exists($path)) abort(404);
    $file     = file_get_contents($path);
    $mimeType = mime_content_type($path);
    return Response::make($file, 200, [
        'Content-Type'        => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
})->name('product.image');

Route::get('article-image/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!file_exists($path)) abort(404);
    $file     = file_get_contents($path);
    $mimeType = mime_content_type($path);
    return Response::make($file, 200, [
        'Content-Type'        => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
    ]);
})->name('article.image');

require __DIR__ . '/auth.php';
