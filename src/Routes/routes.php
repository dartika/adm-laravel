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

$namespace = 'Dartika\Adm\Http\Controllers';

Route::group(['prefix' => config('dartika-adm.prefix'), 'middleware' => 'web'], function () use ($namespace) {
    Route::get('login', "{$namespace}\Auth\LoginController@showLoginForm")->name('dartika-adm.login');
    Route::post('login', "{$namespace}\Auth\LoginController@login");
    Route::get('logout', "{$namespace}\Auth\LoginController@logout")->name('dartika-adm.logout');

    Route::group(['middleware' => 'auth:adm'], function () use ($namespace) {
        Route::get('/', function () {
            return view('dartika-adm::sections.dashboard.index');
        })->name('dartika-adm.dashboard');

        Route::group(['prefix' => 'adm-users'], function () use ($namespace) {
            Route::get('/', "{$namespace}\AdmUsersController@index")->name('dartika-adm.adm_users.index');
            Route::get('/new', "{$namespace}\AdmUsersController@create")->name('dartika-adm.adm_users.create');
            Route::post('/', "{$namespace}\AdmUsersController@store")->name('dartika-adm.adm_users.store');
            Route::get('/{admUser}', "{$namespace}\AdmUsersController@edit")->name('dartika-adm.adm_users.edit');
            Route::put('/{admUser}', "{$namespace}\AdmUsersController@update")->name('dartika-adm.adm_users.update');
            Route::get('/{admUser}/delete', "{$namespace}\AdmUsersController@delete")->name('dartika-adm.adm_users.deleteget');
            Route::delete('/{admUser}', "{$namespace}\AdmUsersController@delete")->name('dartika-adm.adm_users.delete');
        });
    });
});
