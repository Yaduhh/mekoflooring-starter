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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{slug}', [HomeController::class, 'show'])->name('product.show');
Route::get('floor/view-simulation', [FloorController::class, 'index'])->name('floor.index');
Route::get('floor/view-simulation/show', [FloorController::class, 'show'])->name('floor.show');
Route::get('floor/view-simulation/show/category/{slug}', [FloorController::class, 'showByCategory'])->name('floor.product.show');
// Rute untuk melihat artikel secara publik (tanpa login)
Route::get('artikel/{slug}', [HomeController::class, 'showArticle'])->name('articles.public.show');
Route::post('/articles/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.uploadImage');
Route::delete('/articles/delete-image', [ArticleController::class, 'deleteImage'])->name('articles.deleteImage');

Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('articles', ArticleController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

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