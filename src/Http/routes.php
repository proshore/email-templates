<?php
//Route::get('emailtemplates', function () {
//    return EmailTemplates::hello();
//});

Route::group(['middleware' => 'web', 'prefix' => 'emailtemplates'], function () {

    Route::get('/', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@index')->name('emailtemplates.index');
    Route::get('/create', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@create')->name('emailtemplates.create');
    Route::post('/store', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@store')->name('emailtemplates.store');
    Route::get('/edit/{id}', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@edit')->name('emailtemplates.edit');
    Route::post('/update/{id}', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@update')->name('emailtemplates.update');
    Route::post('/delete/{id}', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@destroy')->name('emailtemplates.delete');
    Route::post('/uploadImage', '\Proshore\EmailTemplates\Http\Controllers\EmailTemplatesController@uploadImage');

});