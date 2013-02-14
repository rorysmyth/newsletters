<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function(){
    $cf = Ioc::resolve('cloudfiles');
    $containers = $cf->list_public_containers();
    dd($containers);
});

Route::get('newsletters', array(
    'as'   => 'newsletters_all',
    'uses' => 'site.newsletters@index'
));

Route::get('newsletters/(:num)', array(
    'as'   => 'newsletters',
    'uses' => 'site.newsletters@edit'
));

Route::get('newsletters/(:num)/duplicate', array(
    'as'   => 'newsletters_duplicate',
    'uses' => 'site.newsletters@duplicate'
));

Route::get('newsletters/new', array(
    'as'   => 'newsletters_new',
    'uses' => 'site.newsletters@new'
));


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::any('/api/newsletters/(:num?)', array(
    'as' => 'api_newsletter',
    'uses' => 'api.newsletters@index'
));

Route::any('/api/newsletters/(:num?)/snippets', array(
    'as' => 'api_get_all_snippets',
    'uses' => 'api.newsletters@snippets'
));

Route::any('/api/newsletters/(:num)/duplicate', array(
    'as' => 'api_newsletter_duplicate',
    'uses' => 'api.newsletters@duplicate'
));

Route::any('/api/newsletters/(:num?)/code', array(
    'as' => 'api_get_template_code',
    'uses' => 'api.newsletters@code'
));

Route::any('/api/newsletters/(:num?)/html', array(
    'as' => 'api_get_template_html',
    'uses' => 'api.newsletters@html'
));

Route::any('/api/snippets/(:num?)', array(
	'as' => 'api_get_single_snippet',
	'uses' => 'api.snippets@index'
));

View::composer(array('global.nav'), function($view){
	/*$sites = Site::all();
	$view->with('sites', $sites);*/
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...

});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});