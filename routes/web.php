<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mesDemandes','DemandeController@user_demandes')->name('profile.demande');
Route::get('/mesOffres','OffreController@user_offres')->name('profile.offre');

Route::resource('/demande', 'DemandeController');
Route::resource('/offre', 'OffreController');



