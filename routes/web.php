<?php
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\GoogleAnalyticsController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\EmailSubscriptionController;
use App\Http\Controllers\DoorController;

// Homepage & General
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [HomeController::class, 'show'])->name('product.show');

// Articles
Route::get('artikel/{slug}', [HomeController::class, 'showArticle'])->name('articles.public.show');

// Catalogue
Route::get('catalogue', [HomeController::class, 'showCatalogue'])->name('catalogue.public.show');
Route::get('aksesoris/{slug}', [HomeController::class, 'showAksesoris'])->name('aksesoris.public.show');

// Newsletter
Route::post('newsletter/subscribe', [EmailSubscriptionController::class, 'store'])->name('newsletter.subscribe');
Route::get('newsletter/unsubscribe/{token}', [EmailSubscriptionController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Route::prefix('floor')->name('floor.')->group(function () {
//     Route::get('/', [FloorController::class, 'index'])->name('index');
//     Route::get('/show', [FloorController::class, 'show'])->name('show');
//     Route::get('/show/{slug}', [FloorController::class, 'showByCategory'])->name('product.show');
// });
Route::get('door-view', [DoorController::class, 'landing'])->name('door.index');

Route::prefix('doors')->name('doors.')->group(function () {
    // Landing page - browse door categories
    Route::get('/', [DoorController::class, 'index'])->name('index');

    // Browse specific door category
    Route::get('/{category}', [DoorController::class, 'showCategory'])->name('category');

    // View specific door+handle combination in 3D
    Route::get('/{category}/{slug}', [DoorController::class, 'view'])->name('view');

    // API endpoints
    Route::get('/api/model/{productId}', [DoorController::class, 'getModelData'])->name('api.model');
    Route::get('/api/variations/{productId}', [DoorController::class, 'getHandleVariations'])->name('api.variations');
});

// ========================================
// ADMIN ROUTES - AUTHENTICATED
// ========================================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // ========================================
    // CATEGORIES (Door Types - 2D representations only)
    // ========================================
    Route::resource('categories', CategoryController::class);
    Route::get('dashboard/recycle/categories', [CategoryController::class, 'recycle'])
        ->name('admin.category.recycle');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::put('/categories/{category}/delete', [CategoryController::class, 'delete'])
        ->name('categories.delete');

    // ========================================
    // PRODUCTS
    // ========================================

    // Product Type Routes
    Route::get('admin/products', [ProductController::class, 'index'])
        ->name('products.index'); // Regular products (type 0)

    Route::get('admin/products/aksesoris', [ProductController::class, 'aksesoris'])
        ->name('admin.products.aksesoris'); // 2D Accessories (type 1) - Homepage

    Route::get('admin/products/complete-doors', [ProductController::class, 'completeDoors'])
        ->name('admin.products.complete-doors'); // Complete Models (type 3) - 3D Viewer

    // CRUD Operations
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Recycle Bin
    Route::get('admin/products/recycle', [ProductController::class, 'recycle'])
        ->name('admin.products.recycle'); // ← FIXED: Consistent with view references

    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');

    // ========================================
    // ARTICLES
    // ========================================
    Route::resource('articles', ArticleController::class);
    Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])
        ->name('articles.uploadImage');
    Route::delete('/articles/delete-image', [ArticleController::class, 'deleteImage'])
        ->name('articles.deleteImage');

    // ========================================
    // CATALOGUE & NEWSLETTER
    // ========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('catalogue', CatalogueController::class);
        Route::get('newsletter', [EmailSubscriptionController::class, 'index'])
            ->name('newsletter.index');
    });

    // ========================================
    // SETTINGS
    // ========================================
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // ========================================
    // ANALYTICS
    // ========================================
    Route::get('admin/google/analytics', [GoogleAnalyticsController::class, 'index'])
        ->name('google.analytics');
});

// ========================================
// IMAGE ROUTES (Private Storage Access)
// ========================================

Route::get('product-image/{filename}', function ($filename) {
    $path = storage_path('app/private/images/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($file, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
})->name('product.image');

Route::get('article-image/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($file, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
})->name('article.image');

require __DIR__.'/auth.php';
