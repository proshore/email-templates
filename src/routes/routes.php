<?php

$routeGroupParams['namespace'] = 'Proshore\EmailTemplates\Http\Controllers';

if (config('proshore.email-templates.prefix')) {
    $routeGroupParams['prefix'] = config('proshore.email-templates.prefix');
}

if (config('proshore.email-templates.middleware')) {
    $routeGroupParams['middleware'] = config('proshore.email-templates.middleware');
}

Route::group($routeGroupParams, function () {
    Route::post('email-templates/uploadImage', 'EmailTemplatesController@uploadImage');

    Route::resource('email-templates', 'EmailTemplatesController', ['except' => [
        'show',
    ]]);

});
