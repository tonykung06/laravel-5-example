<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// // http://localhost:8000/api/products
// Route::get('products', ['as' => 'products', function() {
//     return App\Product::all();
// }]);

// // http://localhost:8000/api/api/products
// Route::group(['prefix' => 'api'], function() {
//     Route::get('products', ['as' => 'products2', function() {
//         return App\Product::all();
//     }]);
// });


Route::resource('products', 'ProductController', [
    'only' => ['index', 'store', 'update']
]);

Route::resource('products.descriptions', 'ProductDescriptionController', [
    'only' => ['index', 'store', 'update']
]);
