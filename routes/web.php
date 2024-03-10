<?php

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

Route::get('/', [\App\Http\Controllers\User\FrontendController::class, 'home'])->name('home');
Route::get('/notFound', [\App\Http\Controllers\User\FrontendController::class, 'notFound'])->name('not-found');
Route::get("/shop", [\App\Http\Controllers\User\FrontendController::class, 'shop'])->name('shop');
Route::get('/about', [\App\Http\Controllers\User\FrontendController::class, 'about'])->name('about');
Route::get('/services', [\App\Http\Controllers\User\FrontendController::class, 'services'])->name('services');
Route::get('/contact', [\App\Http\Controllers\User\FrontendController::class, 'contact'])->name('contact');
Route::get('/products/{product}', [\App\Http\Controllers\User\ProductController::class, 'show'])->name('product.show');
Route::get("/city/{id}",[\App\Http\Controllers\User\CityController::class, 'cities']);

Route::resource('/cart', \App\Http\Controllers\User\CartController::class);
Route::resource('/recensions', \App\Http\Controllers\User\RecensionsController::class);
Route::resource('/order', \App\Http\Controllers\User\OrderController::class);
Route::post('/order/location', [\App\Http\Controllers\User\OrderController::class, 'changeLocation'])->name("order.location");


Route::prefix('admin')->group(function () {
    Route::middleware(["admin"])->group(function() {
        Route::get('/adminpage',[\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('adminpage');

        Route::resource('/categories',\App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('/countries',\App\Http\Controllers\Admin\CountryController::class);
        Route::resource('/cities',\App\Http\Controllers\Admin\CityController::class);
        Route::resource('/roles',\App\Http\Controllers\Admin\RoleController::class);
        Route::resource('/products',\App\Http\Controllers\Admin\ProductController::class);
        Route::resource('/users',\App\Http\Controllers\Admin\UserController::class);
        Route::resource('/specifications',\App\Http\Controllers\Admin\SpecificationController::class);
        Route::resource('/images',\App\Http\Controllers\Admin\ImageController::class);
        Route::resource('/testimonials',\App\Http\Controllers\Admin\TestimonialsController::class);
        Route::resource('/inventories',\App\Http\Controllers\Admin\InventoryController::class);
        Route::resource('/product-inventories',\App\Http\Controllers\Admin\ProductInventoryController::class);
        Route::resource('/materials',\App\Http\Controllers\Admin\MaterialsController::class);
        Route::resource('/product-materials',\App\Http\Controllers\Admin\ProductMaterialController::class);
        Route::delete('/product-specification/{id}',[\App\Http\Controllers\Admin\ProductSpecificationController::class, 'destroy']);
        Route::post('/product-specification',[\App\Http\Controllers\Admin\ProductSpecificationController::class, 'store'])->name('product-specification.store');
    });
});



Route::middleware(['protectedFromUser'])->group(function (){
    Route::get('/login', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\User\AuthController::class, 'loginUser'])->name('login.user');

    Route::get('/registration', [\App\Http\Controllers\User\AuthController::class, 'registration'])->name('registration');
    Route::post('/registration', [\App\Http\Controllers\User\AuthController::class, 'createUser'])->name('user.registration');
});
Route::get('/logout', [\App\Http\Controllers\User\AuthController::class, 'logout'])->name('logout');






