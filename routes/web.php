<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
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
//HOMEPAGE
Route::get('/list',[ProductController::class,'view'])->name('productdetails');
Route::get('/search',[ProductController::class,'search']);

//Product Add
Route::get('/product',[ProductController::class,'addproduct'])->name('product.addproduct');

Route::get('/register',[CustomerController::class,'signup'])->name('signup');
Route::post('/register',[CustomerController::class,'signupValidate'])->name('signup.ok');

Route::get('/login',[CustomerController::class,'login'])->name('loginpage');
Route::post('/login',[CustomerController::class,'loginSubmit'])->name('loginpage.ok');

Route::get('/dashboard',[CustomerController::class,'dashboard'])->name('dashboard')->middleware('logged.user');





Route::get('/add_to_cart',[CustomerController::class,'addtocart'])->name('add_to_cart')->middleware('logged.user');
Route::post('/add_to_cart',[CustomerController::class,'addtocart'])->name('add_to_cart.ok');

Route::get('/cart',[CustomerController::class,'cartitem'])->name('cart')->middleware('logged.user');

Route::get('deletes/{id}',[CustomerController::class,'destroy']);

Route::get('/EditProduct',[CustomerController::class,'confirmorderr'])->name('product.EditProduct')->middleware('logged.user');;
Route::post('/EditProduct',[CustomerController::class,'confirmorderr'])->name('product.EditProduct');
//Route::put('/UpdateProduct/{id}',[CustomerController::class,'update'])->name('product.UpdateProduct');


Route::get('/sellerregister',[SellerController::class,'signup'])->name('sellersignup');
Route::post('/sellerregister',[SellerController::class,'signupValidate'])->name('sellersignup.ok');

Route::get('/sellerlogin',[SellerController::class,'login'])->name('sellerloginpage');
Route::post('/sellerlogin',[SellerController::class,'loginSubmit'])->name('sellerloginpage.ok');

//Route::get('/sellerdashboard',[SellerController::class,'dashboard'])->name('sellerdashboard')->middleware('logged.user');

Route::get('/addproduct',[SellerController::class,'createproduct'])->name('createproduct')->middleware('loggeds.user');;

Route::post('/addproduct',[SellerController::class,'productSubmit'])->name('createproduct.submit');

//Route::get('/EditProduct',[SellerController::class,'confirmorderr'])->name('product.EditProduct');
//Route::post('/EditProduct',[SellerController::class,'confirmorderr'])->name('product.EditProduct');

Route::get('/sellerlist',[SellerController::class,'view'])->name('sellerproductdetails')->middleware('loggeds.user');

Route::get('/allorder',[SellerController::class,'everyorder'])->name('allorder')->middleware('loggeds.user');

Route::get('delete/{id}',[SellerController::class,'delivered']);
Route::get('deleteproduct/{id}',[SellerController::class,'deleteproduct']);




Route::get('/searchbox',[CustomerController::class,'search']);


Route::get('/changepassword',[CustomerController::class,'changepassword'])->name('changepassword')->middleware('logged.user');;

//Route::post('/changepassword',[CustomerController::class,'changepasswordsubmit'])->name('passsubmit');


Route::get('/SellerEditProduct/{id}',[SellerController::class,'editproduct'])->name('product.EditProduct')->middleware('loggeds.user');;

Route::put('/UpdateProduct/{id}',[SellerController::class,'update'])->name('product.UpdateProduct');


Route::get('/contactus',[ProductController::class,'aboutus'])->name('aboutus');



Route::get('/logout',function(){
    session()->forget('logged');
    session()->flash('msg','Sucessfully Logged out');
    return redirect()->route('productdetails');
})->name('logout');

Route::get('/logouts',function(){
    session()->forget('loggeds');
    session()->flash('msg','Sucessfully Logged out');
    return redirect()->route('productdetails');
})->name('logouts');