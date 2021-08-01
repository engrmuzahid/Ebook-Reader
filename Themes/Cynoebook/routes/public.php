<?php
use Illuminate\Support\Facades\Route;

Route::delete('cynoebook/cookie-bar', 'CookieBarController@destroy')->name('cynoebook.cookie_bar.destroy');

Route::post('cynoebook/newsletter', 'NewsletterPopup@store')->name('cynoebook.newsletter_popup.store');
Route::delete('cynoebook/newsletter', 'NewsletterPopup@destroy')->name('cynoebook.newsletter_popup.destroy');