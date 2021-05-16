<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => ['admin','verified']],function (){
    Route::get('panel' , 'HomeController@index')->name('admin.panel');

    Route::middleware('can:edit-users')->group(function (){
        Route::get('user/admins','UserController@admins')->name('user.admins');
        Route::patch('user/role/{user}','UserController@setRole')->name('user.setRole');
        Route::resource('user','UserController');
        Route::resource('role','RoleController');
    });

    Route::patch('/filter/add','FilterController@add')->name('filter.add');
    Route::post('/filter/','FilterController@getFilters')->name('get.filter');
    Route::delete('/filter/delete','FilterController@delete')->name('filter.delete');
    Route::get('category/{category}/filter','FilterController@filter')->name('category.filter');

    Route::resource('category' , 'CategoryController');

    Route::resource('blog' , 'BlogController');

    Route::resource('banner' , 'BannerController');

    Route::get('product/{product}/option','ProductController@option')->name('product.option');
    Route::post('product/{product}/add/option','ProductController@addOption')->name('product.addOption');
    Route::get('product/topOffer','ProductController@topOffers')->name('product.topOffer');
    Route::resource('product' , 'ProductController');
    Route::get('product-image/{product:slug}' , 'GalleryController@gallery')->name('product.gallery');
    Route::post('product-image/{product}' , 'GalleryController@addImageToGallery')->name('product.store.gallery');
    Route::delete('product-image/{gallery}' , 'GalleryController@destroy')->name('product.destroy.gallery');

    Route::resource('slider','SliderController');
    Route::resource('service','ServiceController');

    Route::get('comment/approved','CommentController@approved')->name('comment.approved');
    Route::get('comment/unapproved','CommentController@unapproved')->name('comment.unapproved');
    Route::get('comment/{comment}/confirm','CommentController@confirm')->name('comment.confirm');
    Route::get('comment/{comment}/reply','CommentController@reply')->name('comment.reply');
    Route::post('comment/{comment}/answer','CommentController@answer')->name('comment.answer');
    Route::delete('comment/destroy/{comment}','CommentController@destroy')->name('comment.destroy');

    Route::get('orders','OrderController@index')->name('order.index');
    Route::get('orders/delivered','OrderController@delivered')->name('order.delivered');
    Route::get('orders/undelivered','OrderController@undelivered')->name('order.undelivered');
    Route::get('orders/{checkout}','OrderController@single')->name('order.single');
    Route::patch('orders/{checkout}','OrderController@deliver')->name('order.deliver');

    Route::name('admin')->resource('coupon','CouponController');

    Route::post('ckEditor/','AdminController@ckUpload')->name('ckUpload');
});

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home')->middleware(['visit']);

Route::get('/', 'IndexController@index')->middleware('visit');
;
Route::get('/product/{product:slug}', 'ProductController@single')->middleware('visit');

Route::post('/comment/add', 'CommentController@store')->name('add.comment')->middleware('auth');

Route::get('category/','CategoryController@index')->middleware('visit')->name('category.all');
Route::get('category/{category:slug}','CategoryController@single')->middleware('visit')->name('category.single');

Route::get('checkout','CheckoutController@index')->middleware(['verified','cart','visit'])->name('checkout.index');

Route::prefix('cart')->group(function (){
    Route::post('/{product}','CartController@add')->name('add.to.cart');
    Route::get('/get','CartController@get')->name('get.cart');
    Route::delete('/delete','CartController@delete')->name('delete.cart');
    Route::put('/update','CartController@update')->name('update.cart');
    Route::get('/','CartController@index')->name('cart.index');
    Route::patch('/address/{checkout}','CheckoutController@address')->name('cart.address');
});

Route::post('fav/add/','FavouriteController@addAjax')->name('add.to.fav.ajax');
Route::get('fav/add/{product}','FavouriteController@add')->name('add.to.fav')->middleware('verified');
Route::delete('fav/delete/{product}','FavouriteController@destroy')->name('delete.fav')->middleware('verified');

// {payment} == payment class name ex:Zarinpal , Myclass
Route::post('payment/{payment}', 'PaymentController@payment')->middleware('verified')->name('payment');
Route::get('payment/checker/{payment}', 'PaymentController@checker')->name('callback.payment');

Route::get('user/profile', 'UserController@profile')->name('user.profile')->middleware(['verified','visit']);
Route::patch('user/profile', 'UserController@update')->name('user.profile.update')->middleware('verified');

Route::get('blog','BlogController@blog')->name('blog.all')->middleware('visit');
Route::get('blog/{blog:slug}','BlogController@single')->name('blog.single')->middleware('visit');
Route::get('blog/category/{category:slug}','BlogController@category')->name('blog.category')->middleware('visit');

Route::get('blog/tags/{tag}','BlogController@tag')->name('blog.tag');

Route::get('search','IndexController@search')->name('search.index');

//Socialite
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::post('check-coupon','CouponController@checkCoupon')->middleware('verified');

Auth::routes();