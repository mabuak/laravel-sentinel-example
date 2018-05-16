<?php

/**
 * Users Login Route
 */
Route::group(['prefix' => '/login', 'namespace' => 'Auth'], function () {

    Route::get('', 'AuthController@login')
        ->name('login.form');

    // For Action
    Route::post('', ['uses' => 'AuthController@processLogin'])
        ->name('login.action')
        ->middleware('prevent.back.history');
});

/**
 * Logout Route
 */
Route::group(['prefix' => '/logout', 'namespace' => 'Auth', 'middleware' => 'sentinel.permission:dashboard'], function () {

    Route::get('', 'AuthController@logout')
        ->name('logout')
        ->middleware('prevent.back.history');
});

/**
 * Users Register Route
 */
Route::group(['prefix' => '/register', 'namespace' => 'Auth'], function () {

    Route::get('', 'AuthController@register')->name('register.form');

    // For Action
    Route::post('', ['uses' => 'AuthController@processRegistration'])->name('register.action');

    Route::get('activate/{userId}/{code}', 'AuthController@activate')->name('register.activate');
});

/**
 * Reset Password Email Route
 */
Route::group(['prefix' => '/forgot-password', 'namespace' => 'Auth'], function () {

    Route::get('', 'AuthController@forgotPassword')->name('forgotPassword.form');

    // For Action
    Route::post('', ['uses' => 'AuthController@processForgotPassword'])->name('forgotPassword.action');

});


/**
 * Reset Password Route
 */
Route::group(['prefix' => '/reset-password', 'namespace' => 'Auth'], function () {

    Route::get('{userId}/{code}', 'AuthController@resetPassword')->name('resetPassword.form');

    // For Action
    Route::post('{userId}/{code}', ['uses' => 'AuthController@processResetPassword'])->name('resetPassword.action');

});

/**
 * Change Password Route
 */
Route::group(['prefix' => '/change-password', 'namespace' => 'Auth', 'middleware' => 'sentinel.permission:dashboard'], function () {

    Route::get('', 'AuthController@changePassword')->name('changePassword.form');

    // For Action
    Route::post('', ['uses' => 'AuthController@processChangePassword'])->name('changePassword.action');

});

Route::get('access-denied', 'Auth\AuthController@accessDenied')->middleware('sentinel.permission:dashboard');
