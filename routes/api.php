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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/demandes', 'API\DemandeApiController');
Route::resource('/offres', 'API\OffreApiController');

Route::post('/register', 'API\AuthController@register');
Route::post('/users', 'API\AuthController@users');
Route::post('/login', 'API\AuthController@login');
Route::get('/user', 'API\AuthController@getCurrentUser');
Route::get('/logout', 'API\AuthController@logout');