<?php

use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('frontend.index');
// // });
// Route::get('/frontend/product', function () {
//     return view('frontend.product_details');
// });

Auth::routes();

Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');

Route::get('/customer/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
    Route::get('/product-details/{slug}', [IndexController::class, 'product_details'])->name('frontend.product_details');
    Route::get('/product-quick-view/{id}/', [IndexController::class, 'quick_view']);


    //review and wishlist
    Route::get('/store-review', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/store-website-review', [ReviewController::class, 'website_review_store'])->name('store.website.review');
    Route::get('/add-wishlist/{id}/', [ReviewController::class, 'wishlist_add'])->name('add.wishlist');
    Route::get('/wishlist', [CartController::class, 'wishlist_show'])->name('frontend.wishlist');
    Route::get('/wishlist/product-remove/{id}', [CartController::class, 'wishlist_product_remove'])->name('wishlist.product.remove');
    Route::get('/wishlist/remove', [CartController::class, 'wishlist_remove'])->name('wishlist.remove');

    //cart
    Route::get('/all-cart', [IndexController::class, 'all_cart'])->name('all.cart');
    Route::post('/add-to-cart', [CartController::class, 'add_to_cart_qv'])->name('add.to.cart.quickview');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('my.cart');
    Route::get('/delete-cart', [CartController::class, 'DestroyCart'])->name('cart.destroy');
    Route::get('/cartproduct/remove/{rowId}/', [CartController::class, 'RemoveProduct'])->name('cart.product.remove');
    Route::get('/cartproduct/updateqty/{rowId}/{qty}/', [CartController::class, 'UpdateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}/', [CartController::class, 'UpdateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}/', [CartController::class, 'UpdateSize']);

    //checkout
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/coupon-apply', [CheckoutController::class, 'coupon_apply'])->name('coupon.apply');
    Route::get('/coupon-remove', [CheckoutController::class, 'coupon_remove'])->name('coupon.remove');
    Route::post('/order-place', [CheckoutController::class, 'order_place'])->name('order.place');

    //newsletter
    Route::post('/newsletter-subscribe', [IndexController::class, 'subscribe'])->name('newsletter.subscribe');

    //category_wise product show
    Route::get('/category-product/{id}', [IndexController::class, 'category_product'])->name('categorywise_product');
    Route::get('/subcategory-product/{id}', [IndexController::class, 'subcategory_product'])->name('subcategorywise_product');
    Route::get('/childcategory-product/{id}', [IndexController::class, 'childcategory_product'])->name('childcategorywise_product');

    //user 
    Route::get('/user-dashboard', [ProfileController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user-review', [ProfileController::class, 'review'])->name('user.review');
    Route::get('/user-settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::post('/user-password-change', [ProfileController::class, 'user_password_change'])->name('user.password.change');
    Route::get('/user-open-ticket', [ProfileController::class, 'user_open_ticket'])->name('user.open_ticket');
    Route::get('/user-create-ticket', [ProfileController::class, 'user_create_ticket'])->name('user.create_ticket');
    Route::post('/user-store-ticket', [ProfileController::class, 'user_store_ticket'])->name('user.ticket.store');
    Route::get('/user-ticket-show/{id}', [ProfileController::class, 'ticket_show'])->name('user.ticket.show');
    Route::get('/user-ticket-delete/{id}', [ProfileController::class, 'ticket_delete'])->name('user.ticket.delete');
    Route::get('/order-details/{id}', [ProfileController::class, 'order_details'])->name('order.details.show');
});

?>