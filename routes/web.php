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
Route::get('/', 'Auth\LoginController@login')->name('login');

Auth::routes();


Route::group(['middleware' => [
    'auth',
]], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/code-generator/create', function () {
        return view('code-generator.create');
    });
    Route::post('/code-generator/add', 'CodeGeneratorController@add');
    Route::get('/code-generator/show', 'CodeGeneratorController@showData')->name('code-generator.show');

    Route::post('/export', 'ExportController@index');
});
