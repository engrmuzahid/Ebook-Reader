<?php

Route::middleware('auth')->group(function () {
    Route::get('account', 'AccountDashboardController@index')->name('account.dashboard.index');
    Route::get('account/profile', 'AccountProfileController@edit')->name('account.profile.edit');
    Route::put('account/profile', 'AccountProfileController@update')->name('account.profile.update');

    Route::get('account/favorite', 'AccountFavoriteController@index')->name('account.favorite.index');
    Route::delete('account/favorite/{ebookId}', 'AccountFavoriteController@destroy')->name('account.favorite.destroy');

    Route::get('account/reviews', 'AccountReviewController@index')->name('account.reviews.index');
    
    Route::get('account/my-authors', 'AccountAuthorsController@index')->name('account.authors.index');
    
    Route::get('account/my-authors/create', 'AccountAuthorsController@create')->name('account.authors.create');
    Route::post('account/my-authors/', 'AccountAuthorsController@store')->name('account.authors.store');
    
    Route::get('account/my-authors/{id}/edit', 'AccountAuthorsController@edit')->name('account.authors.edit');
    Route::put('account/my-authors/{id}', 'AccountAuthorsController@update')->name('account.authors.update');
    
});
Route::get('users/{slug}', 'AccountProfileController@show')->name('user.profile.show');
Route::get('users', 'AccountProfileController@index')->name('users.index');
