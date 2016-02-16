<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
require app_path().'/validators.php';
require app_path().'/config/exceptioncodes.php';
require app_path().'/config/seo.php';

// View "composers" aka "widgets"
View::composer('widgets.editlanguage', '\Ll\EditlanguageComposer');
View::composer('widgets.help', '\Ll\HelpComposer');

if (App::environment('local')) {
    require app_path().'/config/local/constants.php';
} else {
    require app_path().'/config/constants.php';
}

// View "hints" (hint paths)
//View::addLocation(app('path').'/modules/admin/views');
View::addNamespace('admin', app('path').'/modules/admin/views');
View::addNamespace('site', app('path').'/modules/site/views');


// for checkboxes & radio
Form::macro('checkedVal', function($obj,$field,$trueVal=null)
{
    if ( empty($obj->{$field}) ) {
        return false;
    } else {
        if ( empty($trueVal) ) {
            return true; // that the field is not empty is enough
        } else {
            return ($obj->{$field}=== $trueVal);
        }
    }

});
Form::macro('isTrue', function($obj,$field,$trueVal=null)
{
    if ( empty($obj->{$field}) ) {
        return false;
    } else {
        if ( empty($trueVal) ) {
            return true; // that the field is not empty is enough
        } else {
            return ($obj->{$field}=== $trueVal);
        }
    }

});
Form::macro('getVal', function($obj,$field)
{
    if ( empty($obj->{$field}) ) {
        return NULL;
    } else {
        return $obj->{$field};
    }

});
Form::macro('myRadio', function($name,$val,$isChecked,$classes=[])
{
    $id = $name.'-'.$val;

    $html = '';
    $html .= '<input';
    $html .= ' type="radio"';
    $html .= ' name="'.$name.'"';
    $html .= ' value="'.$val.'"';
    $html .= ' id="'.$id.'"';
    if ($isChecked) {
        $html .= ' checked="checked"';
    }
    if (!empty($classes)) {
        $html .= ' class="'.implode(' ',$classes).'"';
    }
    $html .= '>';
    return $html;
    //return '<input type="awesome">';
});

