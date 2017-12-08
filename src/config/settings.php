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

    /**
     * Name of layout to be used, such as 'layouts.default'
     */
    'layout_name' => 'layouts.default'
];