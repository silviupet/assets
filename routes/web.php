<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
//    return view('layouts.user_page');
    if(auth::user()) {
        return redirect()->route('assets.index');
    } else return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('assets', 'AssetsController');

Route::get('assets/indexbycategory/{category}', 'AssetsController@indexbycategory')->name('assets.indexbycategory');


Route::resource('categories', 'CategoriesController');

Route::resource('tags', 'TagsController');
Route::resource('atributes', 'AtributesController');


//Route::get('/currentTeamName' , function(){
//
//return (Auth::user()->currentTeam->name);
//});
Route::get('/test', function () {
    return view('test.admin_layout');
});
//Route::get('/tema ', function () {
//    return view('layouts.master_theme');
//});
