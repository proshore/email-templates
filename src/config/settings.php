<?php

return [

    /*
     * Upload Directory for WYSIWYG editor
     *
     * Default: public/uploads/images
     */
    'upload_directory'   => public_path('uploads/images/email-templates'),

    'template_slugs'    => [
        'ACTIVATION_EMAIL', 'TRAINING_CONFIRMATION_EMAIL',
        'TRAINING_REMINDER_EMAIL', 'TRAINING_CERTIFICATION_CONFIRMATION_EMAIL',
    ],

    /*
     * Available tokens for each template slugs
     */
    'template_tokens' => [
        'ACTIVATION_EMAIL'  => [
            'USER_NAME', 'EMAIL_ADDRESS',
        ],
        'TRAINING_CONFIRMATION_EMAIL'  => [
            'USER_NAME', 'EMAIL_ADDRESS',
        ],
        'TRAINING_REMINDER_EMAIL'  => [
            'USER_NAME', 'EMAIL_ADDRESS',
        ],
        'TRAINING_CERTIFICATION_CONFIRMATION_EMAIL'  => [
            'USER_NAME', 'EMAIL_ADDRESS',
        ],
    ],

    /*
     * prefix for the route. leave empty if not required
     */
    'prefix' => config('admin.route.prefix'),

    /*
     * Add additional middleware if required
     */
    'middleware' => ['web', 'auth'],

    /*
     * Name of layout to be used, such as 'layouts.default'
     */
    'layout-extend-path' => 'admin.layouts.layout',

    /*
     * Blade field to put javscript stack. eg stack('scripts')
     */
    'script-stack' => 'scripts',
];
