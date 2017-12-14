<?php
return [

    /**
     * Upload Directory for WYSIWYG editor
     *
     * Default: public/uploads/images
     */
    'upload_directory'   =>  public_path('uploads/images/email-templates'),

    'template_slugs'    =>  [
        'USER_SIGNUP', 'USER_ACTIVATE', 'FORGOT_PASSWORD'
    ],

    /*
     * prefix for the route. leave empty if not required
     */
    'prefix' => 'admin',

    /*
     * Add additional middleware if required
     */
    'middleware' => ['web'],

    /**
     * Name of layout to be used, such as 'layouts.default'
     */
    'layout-extend-path' => 'layouts.default',

    /*
     * Blade field to put javscript stack. eg stack('scripts')
     */
    'script-stack' => 'scripts',
];