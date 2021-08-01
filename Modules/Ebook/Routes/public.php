<?php

Route::get('ebooks', 'EbookController@index')->name('ebooks.index');
Route::get('ebooks/{slug}', 'EbookController@show')->name('ebooks.show');
Route::post('ebooks/{slug}/unlock', 'EbookController@unlock')->name('ebooks.unlock');
Route::post('ebooks/{ebookId}/report', 'ReportEbookController@store')->name('ebooks.report.store');
Route::get('ebooks/{slug}/download/{fileId?}', 'EbookController@download')->name('ebooks.download');
Route::get('ebook/upload', 'EbookController@create')->name('ebooks.upload');
Route::post('ebook', 'EbookController@store')->name('ebooks.create');
Route::get('ebook/{slug}/delete', 'EbookController@destroy')->name('ebooks.delete');
Route::get('ebook/{slug}/edit', 'EbookController@edit')->name('ebooks.edit');
Route::put('ebook/{id}', 'EbookController@update')->name('ebooks.update');
Route::get('epub/{slug}', 'EbookController@epubReader')->name('ebooks.epubReader');
Route::post('ebooks/{slug}/pdfviewer', 'EbookController@pdfviewer')->name('ebooks.pdfviewer');