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

Route::get('login', "Auth\LoginController@showLoginForm")->name('login');
Route::post('login', "Auth\LoginController@login");
Route::get('logout', "Auth\LoginController@logout")->name('logout');

Route::group(['middleware' => 'auth:adm'], function () {
    Route::get('/', function () {
        return view('dartika-adm::sections.dashboard.index');
    })->name('dashboard');

    Route::group(['prefix' => 'adm-users', 'as' => 'adm_users.'], function () {
        Route::get('/', "AdmUsersController@index")->name('index');
        Route::get('/new', "AdmUsersController@create")->name('create');
        Route::post('/', "AdmUsersController@store")->name('store');
        Route::get('/{admUser}', "AdmUsersController@edit")->name('edit');
        Route::put('/{admUser}', "AdmUsersController@update")->name('update');
        Route::get('/{admUser}/delete', "AdmUsersController@delete")->name('deleteget');
        Route::delete('/{admUser}', "AdmUsersController@delete")->name('delete');
    });
});
