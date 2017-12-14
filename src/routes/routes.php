<?php

$routeGroupParams['namespace'] = 'Proshore\EmailTemplates\Http\Controllers';

if(config('proshore.email-templates.prefix')) {
    $routeGroupParams['prefix'] = config('proshore.email-templates.prefix');
}

if(config('proshore.email-templates.middleware')) {
    $routeGroupParams['middleware'] = config('proshore.email-templates.middleware');
}

Route::group($routeGroupParams, function () {

    Route::post('emailtemplates/uploadImage', 'EmailTemplatesController@uploadImage');

    Route::resource('email-templates', 'EmailTemplatesController', ['except' => [
        'show'
    ]]);

    /*
    Route::get('emailtemplates', 'EmailTemplatesController@index')
        ->name('emailtemplates.index');
    Route::get('emailtemplates/create', 'EmailTemplatesController@create')
        ->name('emailtemplates.create');
    Route::post('emailtemplates/store', 'EmailTemplatesController@store')
        ->name('emailtemplates.store');
    Route::get('emailtemplates/edit/{id}', 'EmailTemplatesController@edit')
        ->name('emailtemplates.edit');
    Route::post('emailtemplates/update/{id}', 'EmailTemplatesController@update')
        ->name('emailtemplates.update');
    Route::post('emailtemplates/delete/{id}', 'EmailTemplatesController@destroy')
        ->name('emailtemplates.delete');

    */


});