<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/* User Routes */

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/',[HomeController::class,'home']);
Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myOrders',[HomeController::class,'myOrders'])->middleware(['auth', 'verified']);
/* User dashboard Part 19 */
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/* When the user is login. This functionality is working before the part :- 20*/
/* Route::get('/dashboard', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('product_details/{id}',[HomeController::class,'product_details']);
Route::get('add_cart/{id}',[HomeController::class,'add_cart'])->middleware(['auth', 'verified']);
Route::get('mycart',[HomeController::class,'mycart'])->middleware(['auth', 'verified']);
Route::post('confirm_order',[HomeController::class,'confirm_order'])->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';

/* Get the Admin Dashboard */
Route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth', 'admin']); // middleware(['first_check_user_is_logged_in', 'middleware_name']) 
Route::get('view_category',[AdminController::class,'view_category'])->middleware(['auth', 'admin']); // middleware(['first_check_user_is_logged_in', 'middleware_name']) 
Route::post('add_category',[AdminController::class,'add_category'])->middleware(['auth', 'admin']); // Add Category
Route::get('delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth', 'admin']); // Delete Category
Route::get('edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth', 'admin']); // Edit Category
Route::post('update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth', 'admin']); // Update Category

/* Admin Products Routes */

Route::get('add_product',[AdminController::class,'add_product'])->middleware(['auth', 'admin']);
Route::post('upload_product',[AdminController::class,'upload_product'])->middleware(['auth', 'admin']);
Route::get('view_product',[AdminController::class,'view_product'])->middleware(['auth', 'admin']);
Route::get('delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth', 'admin']);
Route::get('update_product/{slug}',[AdminController::class,'update_product'])->middleware(['auth', 'admin']);
Route::post('edit_product/{id}',[AdminController::class,'edit_product'])->middleware(['auth', 'admin']);
Route::get('product_serach',[AdminController::class,'product_serach'])->middleware(['auth', 'admin']);

/* Admin Orders */
Route::get('view_orders',[AdminController::class,'view_orders'])->middleware(['auth', 'admin']);
Route::get('onTheWay/{id}',[AdminController::class,'onTheWay'])->middleware(['auth', 'admin']);
Route::get('delivered/{id}',[AdminController::class,'delivered'])->middleware(['auth', 'admin']);
Route::get('print_pdf/{id}',[AdminController::class,'print_pdf'])->middleware(['auth', 'admin']);


/* Stripe Payment method */

Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

Route::get('shop',[HomeController::class, 'shop']);
Route::get('why',[HomeController::class, 'why']);
Route::get('testimonial',[HomeController::class, 'testimonial']);
Route::get('contact',[HomeController::class, 'contact']);
