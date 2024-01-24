<?php

use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\CategoryController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return "Cleared!";
});

Route::get('/', function () {
    return view('admin/dashboard');
})->name('admin.dashboard');


Route::resource('admin/category', CategoryController::class);
Route::post('admin/category/updateStatus', [CategoryController::class, 'updateStatus'])->name('category.updateStatus');




Route::prefix('subcategory')->group(function () {
    Route::get('/', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    // Route::get('/status/{id}', [SubCategoryController::class, 'statusupdate'])->name('subcategory.status');
    Route::get('/changeStatus/{id}', [SubcategoryController::class, 'changeStatus'])->name('subcategory.status');
    Route::get('/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
});


Route::prefix('product')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
    Route::post('updateStatus', [ProductController::class, 'updateStatus'])->name('updateStatus');
    Route::get('removeimage/{id}', [ProductController::class, 'removeimage'])->name('removeimage');
});

Route::resource('admin/blog',BlogController::class);

Route::resource('admin/project', ProjectController::class);

Route::get('getSubcategories', [ProductController::class, 'getSubcategories'])->name('getSubcategory');








