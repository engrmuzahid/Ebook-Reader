<?php

Route::post('ebooks/{ebookId}/reviews', 'EbookReviewController@store')->name('ebooks.reviews.store');
