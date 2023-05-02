<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Vendor\VendGroupController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Vendor\VendcategoryController;
use App\Http\Controllers\Vendor\VendsubcategoryController;
use App\Http\Controllers\Vendor\VendproductController;
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
/* View Routes Start */
Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('new-arrival',[FrontendController::class,'newarrivals']);
Route::get('popular-products',[FrontendController::class,'popular']);
Route::get('featured-products',[FrontendController::class,'featured']);
Route::get('all-products',[FrontendController::class,'allproducts'])->name('all-products');
Route::get('offer-products',[FrontendController::class,'offer']);
Route::post('review/store/{id}',[FrontendController::class,'review'])->name('review.store');

Route::get('uregister',[FrontendController::class,'register'])->name('uregister');
Route::get('admin',[AdminController::class,'admin'])->name('admin');

// Frontend View
Route::get('/searchajax',[CollectionController::class,'SearchautoComplete'])->name('searchproductajax');
Route::post('/searching',[CollectionController::class,'result']);

Route::get('collection/{group_url}',[CollectionController::class,'groupview']);
Route::get('collection/{group_url}/{cate_url}',[CollectionController::class,'categoryview']);
Route::get('collection/{group_url}/{cate_url}/{subcate_url}',[CollectionController::class,'subcategoryview']);
Route::get('collection/{group_url}/{cate_url}/{subcate_url}/{prod_url}',[CollectionController::class,'productview']);

Route::get('/load-cart-data',[CartController::class,'cartloadbyajax']);
Route::post('add-to-cart',[CartController::class,'addtocart']);
Route::get('/cart',[CartController::class,'index']);
Route::post('update-to-cart',[CartController::class,'updatetocart']);
Route::delete('delete-from-cart',[CartController::class,'deletefromcart']);
Route::get('clear-cart',[CartController::class,'clearcart']);

Route::get('/thank-you',[CartController::class,'thankyou']);

Auth::routes();

Route::post('/user_login', [AuthLoginController::class,'login'])->name('user_login');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('my-profile',[FrontendController::class, 'myprofile'])->name('my-profile');
    Route::get('profile-edit',[FrontendController::class, 'editprofile']);
    Route::post('my-profile-update',[FrontendController::class, 'profileupdate']);

    Route::get('user/wishlist',[WishlistController::class, 'index']);
    Route::post('add-wishlist',[WishlistController::class, 'storewishlist']);
    Route::post('remove-from-wishlist',[WishlistController::class, 'removewishlistitem']);

    Route::get('checkout', [CheckoutController::class,'index']);
    Route::post('place-order',[CheckoutController::class,'storeorder']);

    // Coupon Code
    Route::post('check-coupon-code',[CheckoutController::class,'checkingcoupon']);


    // Razorpay
    Route::post('confirm-razorpay-payment',[CheckoutController::class,'checkamount']);

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    Route::get('groups',[GroupController::class,'index'])->name('brand.index');
    Route::get('group/create',[GroupController::class,'create'])->name('create');
    Route::post('group/store',[GroupController::class,'store'])->name('store');
    Route::get('group/edit/{id}',[GroupController::class,'edit'])->name('edit');
    Route::post('group/update/{id}',[GroupController::class,'update'])->name('admin-group.update');
    Route::get('group/delete/{id}',[GroupController::class,'state']);
    Route::get('deleted-groups',[GroupController::class,'deletedrecords']);
    Route::get('group/re-store/{id}',[GroupController::class,'deletedrestore']);
    Route::get('group-pr/delete/{id}',[GroupController::class,'destroy'] );

    Route::get('category',[CategoryController::class,'index'])->name('category.index');
    Route::post('/category/{id}/sub',[CategoryController::class,'ajax_cat']);
    Route::get('category/create',[CategoryController::class,'create'])->name('create');
    Route::post('category/store',[CategoryController::class,'store'])->name('store');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('category/update/{id}',[CategoryController::class, 'update'])->name('category.update');
    Route::get('category/delete/{id}',[CategoryController::class,'state']);
    Route::get('deleted-categories',[CategoryController::class,'deletedrecords']);
    Route::get('categorie/re-store/{id}',[CategoryController::class,'deletedrestore']);
    Route::get('categorie-pr/delete/{id}',[CategoryController::class,'destroy'] );


    Route::get('subcategory',[SubcategoryController::class,'index'])->name('sub_category.index');
    Route::get('subcategory/create',[SubcategoryController::class,'create'])->name('create');
    Route::post('subcategory/store',[SubcategoryController::class,'store'])->name('store');
    Route::get('subcategory/edit/{id}',[SubcategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('subcategory/update/{id}',[SubcategoryController::class,'update'])->name('subcategory.update');
    Route::get('sub_category/delete/{id}',[SubcategoryController::class,'state']);
    Route::get('deleted-sub-cat',[SubcategoryController::class,'deletedrecords']);
    Route::get('sub_category/re-store/{id}',[SubcategoryController::class,'deletedrestore']);
    Route::get('sub_category1-pr/delete/{id}',[SubcategoryController::class,'destroy'] );


    Route::get('products',[ProductController::class,'index'])->name('products.index');
    Route::get('product/create',[ProductController::class, 'create'])->name('create');
    Route::post('product/store',[ProductController::class,'store'])->name('store');
    Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('product/update/{id}',[ProductController::class,'update'])->name('product.update');
    Route::get('products/delete/{id}',[ProductController::class,'state']);
    Route::get('deleted-product',[ProductController::class,'deletedrecords']);
    Route::get('product/re-store/{id}',[ProductController::class,'deletedrestore']);
    Route::get('products-pr/delete/{id}',[ProductController::class,'destroy'] );

    Route::get('orders',[OrderController::class,'index']);
    Route::get('order-view/{order_id}',[OrderController::class,'vieworder']);
    Route::get('order-proceed/{order_id}',[OrderController::class,'proceedorder']);
    Route::post('order/update-tracking-status/{order_id}',[OrderController::class,'trackingstatus']);
    Route::post('order/cancel-order/{order_id}',[OrderController::class,'cancelorder']);
    Route::put('order/complete-order/{order_id}',[OrderController::class,'completeorder']);
    Route::get('generate-invoice/{order_id}',[OrderController::class,'invoice']);

    Route::get('banners',[BannerController::class,'index'])->name('banners.index');
    Route::get('banner/create',[BannerController::class, 'create'])->name('banner.create');
    Route::post('banner/store',[BannerController::class,'store'])->name('banner.store');
    Route::get('banner/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
    Route::post('banner/update/{id}',[BannerController::class,'update'])->name('banner.update');
    Route::get('banners/delete/{id}',[BannerController::class,'state'])->name('banner.delete.{id}');
    Route::get('deleted-banner',[BannerController::class,'deletedrecords']);
    Route::get('banner/re-store/{id}',[BannerController::class,'deletedrestore']);
    Route::get('banners-pr/delete/{id}',[BannerController::class,'destroy'] );

    Route::get('options',[OptionController::class,'index'])->name('options.index');
    Route::post('options',[OptionController::class,'store'])->name('options.store');
    Route::post('update/{id}',[OptionController::class, 'update'])->name('options.update');

    Route::get('users',[UserController::class,'index'])->name('user');
    Route::get('user/create',[UserController::class,'create'])->name('user.create');
    Route::post('user/store',[UserController::class,'store'])->name('user.store');
    Route::get('user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{id}',[UserController::class, 'update'])->name('user.update');
    Route::get('user/show/{id}',[UserController::class,'show'])->name('user.show');
    Route::get('user/{id}',[UserController::class,'state'])->name('user.{id}');
    Route::get('deleted-user',[UserController::class,'deletedrecords']);
    Route::get('user/re-store/{id}',[UserController::class,'deletedrestore']);
    Route::get('user-pr/delete/{id}',[UserController::class,'destroy'] );

    Route::get('admin/coupon-view',[CouponController::class,'index']);
    Route::post('coupon-store',[CouponController::class,'store']);
    Route::get('admin/coupon-edit/{id}',[CouponController::class,'edit']);
    Route::post('coupon-update/{id}',[CouponController::class,'update']);
});

Route::middleware(['auth', 'vendor'])->group(function () {
    Route::get('vendor-dashboard',[VendorController::class,'dashboard']);

    Route::get('vendor-groups',[VendGroupController::class,'index'])->name('index');
    Route::get('vendor-group/create',[VendGroupController::class,'create'])->name('create');
    Route::post('vendor-group/store',[VendGroupController::class,'store'])->name('store');
    Route::get('vendor-group/edit/{id}',[VendGroupController::class,'edit'])->name('edit');
    Route::post('vendor-group/update/{id}',[VendGroupController::class,'update'])->name('group.update');
    Route::get('vendor-group/delete/{id}',[VendGroupController::class,'state']);
    Route::get('deleted-vendor-group',[VendGroupController::class,'deletedrecords']);
    Route::get('vendor-group/re-store/{id}',[VendGroupController::class,'deletedrestore']);
    Route::get('vendor-group-pr/delete/{id}',[VendGroupController::class,'destroy'] );

    Route::get('vendor-categories',[VendcategoryController::class,'index'])->name('index');
    Route::get('vendor-categorie/create',[VendcategoryController::class,'create'])->name('create');
    Route::post('vendor-categorie/store',[VendcategoryController::class,'store'])->name('store');
    Route::get('vendor-categorie/edit/{id}',[VendcategoryController::class,'edit'])->name('edit');
    Route::post('vendor-categorie/update/{id}',[VendcategoryController::class, 'update'])->name('vendor-categorie.update');
    Route::get('vendor-categorie/delete/{id}',[VendcategoryController::class,'state']);
    Route::get('deleted-vendor-categorie',[VendcategoryController::class,'deletedrecords']);
    Route::get('vendor-categorie/re-store/{id}',[VendcategoryController::class,'deletedrestore']);
    Route::get('vendor-categorie-pr/delete/{id}',[VendcategoryController::class,'destroy'] );

    Route::get('vendor-sub-categories',[VendsubcategoryController::class,'index'])->name('index');
    Route::get('vendor-sub-categorie/create',[VendsubcategoryController::class,'create'])->name('create');
    Route::post('vendor-sub-categorie/store',[VendsubcategoryController::class,'store'])->name('store');
    Route::get('vendor-sub-categorie/edit/{id}',[VendsubcategoryController::class,'edit'])->name('edit');
    Route::post('vendor-sub-categorie/update/{id}',[VendsubcategoryController::class,'update'])->name('vendor-sub-categorie.update');
    Route::get('vendor-sub-categorie/delete/{id}',[VendsubcategoryController::class,'state']);
    Route::get('vendor-deleted-sub-categorie',[VendsubcategoryController::class,'deletedrecords']);
    Route::get('vendor-sub-categorie/re-store/{id}',[VendsubcategoryController::class,'deletedrestore']);
    Route::get('vendor-sub-categorie-pr/delete/{id}',[VendsubcategoryController::class,'destroy'] );

    Route::get('vendor-products',[VendproductController::class,'index'])->name('index');
    Route::get('vendor-product/create',[VendproductController::class, 'create'])->name('create');
    Route::post('vendor-product/store',[VendproductController::class,'store'])->name('store');
    Route::get('vendor-product/edit/{id}',[VendproductController::class,'edit'])->name('edit');
    Route::post('vendor-product/update/{id}',[VendproductController::class,'update'])->name('vendor-product.update');
    Route::get('vendor-product/delete/{id}',[VendproductController::class,'state']);
    Route::get('vendor-deleted-product',[VendproductController::class,'deletedrecords']);
    Route::get('vendor-product/re-store/{id}',[VendproductController::class,'deletedrestore']);
    Route::get('vendor-product-pr/delete/{id}',[VendproductController::class,'destroy'] );
});


