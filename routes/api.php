<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('Buyer', 'Buyer\BuyerController')->only([
  'index',
  'show'
]);
Route::resource('Seller','Seller\SellerController')->only([
  'index',
  'show'
]);
Route::resource('Product','Product\ProductController')->only([
  'index',
  'show'
]);
Route::resource('Category','Category\CategoryController')->except([
  'create',
  'edit'
]);
Route::resource('Transaction','Transaction\TransactionController')->only([
  'index',
  'show'
]);
Route::resource('user','User\UserController')->except([
  'create',
  'edit'
]);
