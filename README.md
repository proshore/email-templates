# Email Template Management for Laravel 5.5
[![Latest Stable Version](https://poser.pugx.org/proshore/email-templates/v/stable)](https://packagist.org/packages/proshore/email-templates)
[![Total Downloads](https://poser.pugx.org/proshore/email-templates/downloads)](https://packagist.org/packages/proshore/email-templates)
[![Latest Unstable Version](https://poser.pugx.org/proshore/email-templates/v/unstable)](https://packagist.org/packages/proshore/email-templates)
[![License](https://poser.pugx.org/proshore/email-templates/license)](https://packagist.org/packages/proshore/email-templates)[![StyleCI](https://styleci.io/repos/113530969/shield?branch=master)](https://styleci.io/repos/113530969)

Email Template Management with Bootstrap & TinyMCE Editor

Can be used managing email templates from backend.

## Installation
1. Require this package with composer.

```shell
composer require proshore/email-templates
```

Laravel 5.5 uses Package Auto-Discovery, so you don't have to manually add the package to the ServiceProvider.


If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Proshore\EmailTemplates\EmailTemplatesServiceProvider::class,
```

2. Publish file. 

## Publishing
#### Publishing the config file

````shell
php artisan vendor:publish --tag=config
````

#### Publishing views
````shell
php artisan vendor:publish --tag=views
````

#### Publishing migrations
````shell
php artisan vendor:publish --tag=migrations
````

#### Publishing assets
````shell
php artisan vendor:publish --tag=public
````


## Usage
TinyMCE script should be included in your appropriate layout. Multiple slugs can be added to config based on which the template identifiers are displayed in CRUD section, please change the config file located at 'config/proshore-email-templates.php'. Initially, there are some slugs to get you started with.



## Contributor
Sudhir Bastakoti
