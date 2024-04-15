<?php

use App\Http\Controllers\admin\adminAuthController;
use App\Http\Controllers\admin\orderManagement;
use App\Http\Controllers\admin\reviewController;
use App\Http\Controllers\adminManagementController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\couponController;
use App\Http\Controllers\productController;
use App\Http\Controllers\slideManagmentController;
use App\Http\Controllers\subCategoryController;
use App\Http\Controllers\web\authController;
use App\Http\Controllers\web\contactController;
use App\Http\Controllers\web\homeController;
use App\Http\Controllers\web\productController as WebProductController;
use Illuminate\Support\Facades\Route;

//admin routes
Route::get('/admin/login', [adminAuthController::class, 'index'])->name('admin.login'); // admin login
Route::post('/admin/authCheck', [adminAuthController::class, 'authCheck'])->name('admin.admin.authCheck'); // admin authCheck
Route::get('/admin/adsManagement', [adminAuthController::class, 'dashBoard'])->name('admin.adsManagement.index'); // admin adsManagement
Route::get('/admin/logout', [adminAuthController::class, 'logout'])->name('admin.logout'); // admin logout
Route::get('/admin/forgetPassword', [adminAuthController::class, 'forgetPassword'])->name('admin.forgetPassword'); // admin forgetPassword
Route::post('/admin/forgetPasswordMail', [adminAuthController::class, 'forgetPasswordMail'])->name('admin.forgetPassword.mail'); // admin forgetPassword
Route::get('/admin/forget_password_link/{token}', [adminAuthController::class, 'forget_password_link'])->name('forget_password_link.email');
Route::post('/admin/resetPassword', [adminAuthController::class, 'resetPassword'])->name('admin.resetPassword'); // admin resetPassword

Route::get('/admin/adminManagement/index', [adminManagementController::class, 'index'])->name('admin.adminManagement.index'); // admin management view
Route::get('/admin/adminManagement/recieveData', [adminManagementController::class, 'recieveData'])->name('admin.adminManagement.recieveData'); // admin management recieveData
Route::post('/admin/adminManagement/create', [adminManagementController::class, 'create'])->name('admin.adminManagement.create'); // admin management create
Route::get('/admin/adminManagement/{id}/getData', [adminManagementController::class, 'getData'])->name('admin.adsManagement.getData'); // admin adsManagement getData
Route::post('/admin/adminManagement/update', [adminManagementController::class, 'update'])->name('admin.adminManagement.update'); // admin management update

Route::get('/admin/slideManagement/index', [slideManagmentController::class, 'index'])->name('admin.slideManagement'); // admin slide Management view
Route::get('/admin/slideManagement/recieveData', [slideManagmentController::class, 'recieveData'])->name('admin.mainBanner.recieveData'); // admin mainBanner
Route::post('/admin/slideManagement/create', [slideManagmentController::class, 'create'])->name('admin.mainBanner.create'); // admin mainBanner create
Route::get('admin/mainBannerManagement/{id}/delete', [slideManagmentController::class, 'delete'])->name('admin.slideManagement.delete'); // admin slide Management delete

Route::get('/admin/categoryManagement/index', [categoryController::class, 'index'])->name('admin.categoryManagement'); // category Management 
Route::get('/admin/categoryManagement/recieveData', [categoryController::class, 'recieveData'])->name('admin.category.recieveData'); // category Management table
Route::post('/admin/categoryManagement/create', [categoryController::class, 'create'])->name('admin.category.create'); // admin category create
Route::post('/admin/categoryManagement/update', [categoryController::class, 'update'])->name('admin.category.update'); // category Management update
Route::get('admin/category/{id}/edit', [categoryController::class, 'edit'])->name('admin.category.edit'); // category Management edit
Route::get('admin/subCategory/nextPage/{id}', [categoryController::class, 'nextPage'])->name('admin.category.nextPage'); // access sub category page

Route::get('/admin/sub_categoryManagement/index/{id}', [subCategoryController::class, 'index'])->name('admin.sub_category.recieveData'); // sub_category Management 
Route::post('/admin/sub_categoryManagement/create', [subCategoryController::class, 'create'])->name('admin.sub_category.create'); // admin sub category create
Route::get('admin/sub_category/{id}/edit', [subCategoryController::class, 'edit'])->name('admin.sub_category.edit'); // sub_category Management edit
Route::post('/admin/sub_category/update', [subCategoryController::class, 'update'])->name('admin.sub_category.update'); // sub_category Management update

Route::get('admin/product/nextPage/{id}/{category_id}', [subCategoryController::class, 'nextPage'])->name('admin.sub_category.nextPage'); // sub_category Management nextPage
Route::post('admin/product/create/', [productController::class, 'create'])->name('admin.product.create'); // product Management nextPage
Route::get('/admin/product/recieveData', [productController::class, 'getData'])->name('admin.product.getData'); // product get data
Route::get('admin/product/{id}/info', [productController::class, 'info'])->name('admin.product.info'); // product get info
Route::post('admin/product/update', [productController::class, 'update'])->name('admin.product.update'); // product update

Route::get('/admin/couponManagement/index', [couponController::class, 'index'])->name('admin.couponManagement'); // coupon code Management 
Route::post('/admin/couponManagement/create', [couponController::class, 'create'])->name('admin.coupon.create'); // coupon code create 
Route::get('/admin/couponManagement/recieveData', [couponController::class, 'recieveData'])->name('admin.coupon.recieveData'); // coupon code recieveData 
Route::get('admin/coupon/{id}/edit', [couponController::class, 'edit'])->name('admin.coupon.edit'); // product Management edit
Route::post('/admin/couponManagement/update', [couponController::class, 'update'])->name('admin.coupon.update'); // coupon code update 

Route::get('/admin/reviewManagement/index', [reviewController::class, 'index'])->name('admin.reviewManagement'); // review Management display
Route::get('/admin/reviewManagement/recieveData', [reviewController::class, 'recieveData'])->name('admin.review.recieveData'); // review Management recieveData
Route::get('admin/review/{id}/edit', [reviewController::class, 'edit'])->name('admin.review.edit'); // review get info
Route::post('/admin/review/update', [reviewController::class, 'update'])->name('admin.review.update'); // review update 

Route::get('/admin/orderManagement/index', [orderManagement::class, 'index'])->name('admin.orderManagement'); // order management view
Route::get('/admin/orderManagement/recieveData', [orderManagement::class, 'recieveData'])->name('admin.order.recieveData'); // order management data
Route::get('admin/order/{id}/info', [orderManagement::class, 'info'])->name('admin.order.info'); // order info
Route::get('admin/order/{id}/edit', [orderManagement::class, 'edit'])->name('admin.order.edit'); // order edit
Route::post('/admin/order/update', [orderManagement::class, 'update'])->name('admin.order.statusChange'); // status Change

// admin.order.statusChange
//admin routes

// web routes
Route::get('/', [homeController::class, 'index'])->name('web.home'); // home management
Route::get('/register', [authController::class, 'register'])->name('web.register'); // home register
Route::get('/login', [authController::class, 'login'])->name('web.login'); // home login
Route::post('/customer/create', [authController::class, 'create'])->name('web.customer.create'); // customer create
Route::get('/dashboard', [authController::class, 'dashboard'])->name('web.dashboard'); // home login
Route::post('/customer/authCheck', [authController::class, 'authCheck'])->name('web.authCheck'); // customer authCheck

Route::get('/detailed/{id}', [WebProductController::class, 'detailed'])->name('web.product.detailed'); // product detailed

Route::get('/wishlist', [homeController::class, 'viewWishlist'])->name('web.wishlist.view'); // view wishlist
Route::get('/detailedCart', [homeController::class, 'detailedCart'])->name('web.detailedCart'); // view detailed wishlist

Route::get('/displayCheckout', [WebProductController::class, 'displayCheckout'])->name('web.displayCheckout'); // view displayCheckout

Route::post('/displayCheckout', [WebProductController::class, 'Checkout'])->name('web.payment'); // Checkout post
Route::get('/paypal', [WebProductController::class, 'paypal'])->name('web.paypal'); // view paypal

Route::get('/success', [WebProductController::class, 'success'])->name('web.success'); // success
Route::get('/error', [WebProductController::class, 'error'])->name('web.error'); // error

Route::post('/voiceSearch', [WebProductController::class, 'voiceSearch'])->name('web.voiceSearch'); // voiceSearch post
Route::post('/imageSearch', [WebProductController::class, 'imageSearch'])->name('web.imageSearch'); // imageSearch post
Route::post('/voice_command', [WebProductController::class, 'voice_command'])->name('web.voice_command'); // voice_command post

Route::get('/contact', [contactController::class, 'contact'])->name('web.contact'); // contact
Route::get('/imageSearchResults/{title}', [WebProductController::class, 'imageSearchResults'])->name('web.imageSearchResults'); // imageSearch post

Route::get('/all/product', [WebProductController::class, 'allProducts'])->name('web.product.all'); // web all product
Route::get('/all/category{id}', [WebProductController::class, 'categorySpecified'])->name('web.category'); // web  category
Route::get('/dashboard/order/more{id}', [WebProductController::class, 'order_moreDetails'])->name('web.dashboard.more'); // web  dashboard more details

// web routes


