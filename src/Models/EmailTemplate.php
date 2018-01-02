<?php

namespace Proshore\EmailTemplates\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplateRequest.
 */
class EmailTemplate extends Model
{
    /**
     * Database table to be used by the model.
     *
     * @var string
     */
    protected $table = 'email_templates';

    /**
     * Fields for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'subject',
        'content',
    ];
}
