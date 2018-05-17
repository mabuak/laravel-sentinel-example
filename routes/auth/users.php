<?php

/**
 * Users Route
 */

Route::group([
    'middleware' => [
        'prevent.back.history'
    ],
    'prefix'     => 'users',
    'namespace'  => 'Auth',
], function () {
    //Resource Route
    Route::get('', 'UsersController@index')
        ->name('users.index')->middleware('sentinel.permission:users.show');

    Route::get('/create', 'UsersController@create')
        ->name('users.create')->middleware('sentinel.permission:users.create');

    Route::post('', 'UsersController@store')
        ->name('users.store')->middleware('sentinel.permission:users.create');

    Route::get('/{user}', 'UsersController@show')
        ->name('users.show')->middleware('sentinel.permission:users.show');

    Route::get('/{user}/edit', 'UsersController@edit')
        ->name('users.edit')->middleware('sentinel.permission:users.edit');

    Route::put('/{user}', 'UsersController@update')
        ->name('users.update')->middleware('sentinel.permission:users.edit');

    Route::delete('/{user}', 'UsersController@destroy')
        ->name('users.destroy')->middleware('sentinel.permission:users.destroy');

    // For Datatables
    Route::get('/ajax/data', 'UsersController@anyData')
        ->name('users.ajax.data')->middleware('sentinel.permission:users.show');

    // For Change User Status
    Route::put('users/status/{id}', 'UsersController@status')
        ->name('users.status')
        ->where('id', '[0-9]+')->middleware('sentinel.permission:users.status');

});