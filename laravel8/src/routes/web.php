<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DetailsProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'home'])->name('Phong Vũ');

Route::get('/', [HomesController::class, 'home']);
Route::get('/test', [HomesController::class, 'test']);
//show product category
Route::get('/collections/{slug}', [HomesController::class, 'product_with_category']);
Route::get('/collections/{slug}', [HomesController::class, 'product_with_category']);
Route::post('/search-keywords', [HomesController::class, 'search_keywords']);

Route::post('/search-item', [HomesController::class, 'search_item']);
Route::post('/load-search-products', [HomesController::class, 'load_search_products']);
//Product Details
Route::get('/collections/{slug}/product/{pro_slug}', [DetailsProductController::class, 'details_product']);
Route::post('/show-related-product', [DetailsProductController::class, 'show_related_product']);


//admin routes
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    //admin category
        Route::get('/add-category', [CategoryController::class, 'add_category']);
        Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category']);

        Route::post('/insert-category', [CategoryController::class, 'insert_category']);
        Route::post('/show-category', [CategoryController::class, 'show_category']);
        Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);
        Route::post('/delete-category', [CategoryController::class, 'delete_category']);
        //subcategory
        Route::post('/insert-subcategory', [SubCategoryController::class, 'insert_subcategory']);
        Route::post('/show-subcategory', [SubCategoryController::class, 'show_subcategory']);
        Route::post('/edit-subcategory', [SubCategoryController::class, 'edit_subcategory']);
        Route::post('/del-subcategory', [SubCategoryController::class, 'del_subcategory']);
        Route::post('/insert-img-subcategory', [SubCategoryController::class, 'insert_img_subcategory']);
    //admin Product
        Route::get('/add-product', [ProductController::class, 'add_product']);
        Route::get('/list-product', [ProductController::class, 'list_product']);
        Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);

        Route::post('/show-subcate-add-product', [ProductController::class, 'show_subcate_add_product']);
        Route::post('/insert-product', [ProductController::class, 'insert_product']);
        Route::post('/select-subcategory', [ProductController::class, 'select_subcategory']);
        Route::post('/show-list-product', [ProductController::class, 'list_show_product']);
        Route::post('/select-subcategory-edit', [ProductController::class, 'select_subcate_edit']);
        Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
        Route::post('/delete-product', [ProductController::class, 'delete_product']);
        //gallery controller
        Route::get('/add-gallery-product/{product_id}', [GalleryController::class, 'add_gallery']);
        
        Route::post('/insert-gallery-product', [GalleryController::class, 'insert_gallery_product']);
        Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);
        Route::post('/delete-all-gallery', [GalleryController::class, 'delete_all_gallery']);

        //CartController
        Route::get('/cart', [CartController::class, 'show_cart']);

        Route::post('/add-my-cart', [CartController::class, 'add_my_cart']);
        Route::post('/load-my-cart', [CartController::class, 'load_my_cart']);
        Route::post('/load-details-my-cart', [CartController::class, 'load_details_my_cart']);
        Route::post('/del-my-cart', [CartController::class, 'del_my_cart']);
        Route::post('/update-my-cart', [CartController::class, 'update_my_cart']);
