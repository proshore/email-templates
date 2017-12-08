<?php
namespace Proshore\EmailTemplates;

use Illuminate\Support\Facades\Facade;

/**
 * Class EmailTemplatesFacade
 * @package Proshore\EmailTemplates
 */
class EmailTemplatesFacade extends Facade
{

    /**
     * Get registered name of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'proshore-email-templates';
    }

}