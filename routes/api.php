<?php

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
Route::post('/books', 'BookController@store');
Route::post('/books/{bookId}', 'BookController@update');
Route::get('/books', 'BookController@index');
Route::get('/books/{bookId}', 'BookController@show');
Route::middleware('auth:api', 'checkAuth')->delete('/books/{bookId}', 'BookController@destroy');

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password',
], function () {
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('/send/email', 'AuthController@mail');
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}', 'AuthController@signupActivate');

    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});


