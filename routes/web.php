<?php

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
//Группа роутов для админки
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth'] ], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    //['as'=>'admin'] - префикс для именнованного маршрута (для исключения пересечения с др ресурсами)
    Route::resource('/category', 'CategoryController', ['as'=>'admin']);
    Route::resource('/article', 'ArticleController', ['as'=>'admin']);
});

Route::get('/', function () {
    return view('welcome');
});

//Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
