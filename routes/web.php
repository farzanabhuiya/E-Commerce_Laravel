<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DiscountCuponController;
use App\Http\Controllers\Backend\productC0ntroller;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\TempImageController;
use App\Http\Controllers\Backend\SubcategorieController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ShopController;
use Mockery\Matcher\Subset;

// Route::get('/', function () {
//     return view('Frontend.Homepage');
// });
Route::get('/',[HomePageController::class,'index'])->name('front.homepage');
Route::get('/shop/{categoryslug?}/{subcategorieslug?}',[ShopController::class,'index'])->name('front.shopPage');
Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/addto-cart',[CartController::class,'addtoCart'])->name('front.addtoCart');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart');
Route::delete('/deletecart/{rowId}',[CartController::class,'delete'])->name('front.deleteCart');
Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');
Route::post('/processCheckout',[CartController::class,'processCheckout'])->name('front.processCheckout');
Route::get('/thanks',[CartController::class,'thanks'])->name('front.thanks');
Route::post('/getorderSummery',[CartController::class,'getorderSummery'])->name('front.getorderSummery');
Route::post('/coupon',[CartController::class,'applycoupon'])->name('front.applyCoupon');
Route::post('/remove',[CartController::class,'removeCoupon'])->name('front.removeCoupon');





Auth::routes();




// Route::group(['middleware' => 'auth'], function()

// Route::group(['middleware' => ['role:admin']], function (){
// Route::group(['middleware' =>'auth'], function(){
  
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile',[ProfileController::class,'showfile'])->name('profile');
Route::put('/profile-update',[ProfileController::class,'profileUpdate'])->name('profile.update');
// });
 Route::get('/account',[ProfileController::class,'profileAccount'])->name('profile.account');



//category
// Route::group(['middleware' => ['role:admin']], function (){
Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::get('/category-create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category-store',[CategoryController::class,'store'])->name('category.store');
Route::get('/category-edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
Route::put('/category-update/{id}',[CategoryController::class,'update'])->name('category.update');
Route::delete('/category-delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');

//});




///subcategorie

Route::get('/subcategorie',[SubcategorieController::class,'index'])->name('Subcategorie.index');
Route::post('/subcategorie-create',[SubcategorieController::class,'create'])->name('Subcategorie.create');
Route::get('/subcategorie-story',[SubcategorieController::class,'story'])->name('Subcategorie.story');
Route::get('/subcategorie-edit/{id}',[SubcategorieController::class,'edit'])->name('Subcategorie.edit');
Route::put('/subcategorie-update/{id}',[SubcategorieController::class,'update'])->name('Subcategorie.update');
Route::delete('/subcategorie-delete/{id}',[SubcategorieController::class,'deleted'])->name('Subcategorie.delete');



Route::get('/get-all-subcategories',[SubcategorieController::class,'getSubcategories'])->name('Subcategorie.get');


//brand 

Route::get('/brand',[BrandController::class,'index'])->name('Brand.index');
Route::post('/brand-create',[BrandController::class,'create'])->name('Brand.create');
Route::get('/brand-story',[BrandController::class,'story'])->name('Brand.story');
Route::get('/brand-edit/{id}',[BrandController::class,'edit'])->name('Brand.edit');
Route::put('/brand-update/{id}',[BrandController::class,'update'])->name('Brand.update');
Route::delete('/brand-delete/{id}',[BrandController::class,'delete'])->name('Brand.delete');




//product

Route::get('/product-create',[productC0ntroller::class,'create'])->name('Product.create');
Route::post('/product-story',[productC0ntroller::class,'story'])->name('Product.story');
Route::get('/product-all',[productC0ntroller::class,'allProduct'])->name('Product.all');
Route::get('/product-edit/{id}',[productC0ntroller::class,'edit'])->name('Product.edit');
Route::put('/product-update/{id}',[productC0ntroller::class,'update'])->name('Product.update');
Route::delete('/product-update/{id}',[productC0ntroller::class,'delete'])->name('Product.delete');

Route::get('/relatedproduct',[productC0ntroller::class,'relatedproduct'])->name('Product.related');



Route::get('/shipping',[ShippingController::class,'create'])->name('shipping.create');
Route::post('/shipping',[ShippingController::class,'story'])->name('shipping.story');

Route::get('/DiscountCupon',[DiscountCuponController::class,'index'])->name('discountCupon.index');
Route::get('/DiscountCupon-create',[DiscountCuponController::class,'create'])->name('discountCupon.create');
Route::post('/DiscountCupon-story',[DiscountCuponController::class,'story'])->name('discountCupon.story');
