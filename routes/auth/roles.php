<?php

/**
 * Users Role Route
 */

Route::group([
    'middleware' => [
        'prevent.back.history'
    ],
    'prefix'     => 'roles',
    'namespace'  => 'Auth'
], function () {
    //Resource Route
    Route::get('', 'RolesController@index')
        ->name('roles.index')
        ->middleware('sentinel.permission:roles.show');

    Route::get('/create', 'RolesController@create')
        ->name('roles.create')
        ->middleware('sentinel.permission:roles.create');

    Route::post('', 'RolesController@store')
        ->name('roles.store')
        ->middleware('sentinel.permission:roles.create');

    Route::get('/{role}', 'RolesController@show')
        ->name('roles.show')
        ->middleware('sentinel.permission:roles.show');

    Route::get('/{role}/edit', 'RolesController@edit')
        ->name('roles.edit')
        ->middleware('sentinel.permission:roles.edit');

    Route::put('/{role}', 'RolesController@update')
        ->name('roles.update')
        ->middleware('sentinel.permission:roles.edit');

    Route::get('/{role}/duplicate', 'RolesController@duplicate')
        ->name('roles.duplicate')
        ->middleware('sentinel.permission:roles.create');

    Route::delete('/{role}', 'RolesController@destroy')
        ->name('roles.destroy')
        ->middleware('sentinel.permission:roles.destroy');

    // For Datatables
    Route::get('/ajax/data', 'RolesController@anyData')
        ->name('roles.ajax.data')
        ->middleware('sentinel.permission:roles.show');

});