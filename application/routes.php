<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('newsletters', array(
    'as'   => 'newsletters_all',
    'uses' => 'site.newsletters@index'
));

Route::get('newsletters/(:num)/(:any?)', array(
    'as'   => 'newsletters',
    'uses' => 'site.newsletters@edit'
));

Route::get('newsletters/(:num)/duplicate', array(
    'as'   => 'newsletters_duplicate',
    'uses' => 'site.newsletters@duplicate'
));

Route::get('newsletters/action/(:num)/variation', array(
    'as'   => 'newsletters_variation',
    'uses' => 'site.newsletters@variation'
));

Route::get('newsletters/new', array(
    'as'   => 'newsletters_new',
    'uses' => 'site.newsletters@new'
));

Route::get('templates/new', array(
    'as' => 'templates_new',
    'uses' => 'site.templates@new'
));

Route::get('templates', array(
    'as' => 'templates_all',
    'uses' => 'site.templates@index'
));

Route::get('templates/(:num)', array(
    'as'   => 'templates',
    'uses' => 'site.templates@edit'
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

Route::get('/api/newsletters/search', array(
    'as' => 'api_newsletter_search',
    'uses' => 'api.newsletters@search'
));

Route::any('/api/newsletters/(:num?)/snippets/(:any?)', array(
    'as' => 'api_get_all_snippets',
    'uses' => 'api.newsletters@snippets'
));

Route::any('/api/newsletters/(:num)/duplicate', array(
    'as' => 'api_newsletter_duplicate',
    'uses' => 'api.newsletters@duplicate'
));

Route::any('/api/newsletters/(:num)/variation', array(
    'as' => 'api_newsletter_variation',
    'uses' => 'api.newsletters@variation'
));

// preview tab
Route::any('/api/newsletters/(:num?)/html/(:any?)', array(
    'as' => 'api_get_template_html',
    'uses' => 'api.newsletters@html'
));

// code tab
Route::any('/api/newsletters/(:num?)/code/(:any?)', array(
    'as' => 'api_get_template_code',
    'uses' => 'api.newsletters@code'
));

Route::any('/api/snippets/(:num?)', array(
	'as' => 'api_get_single_snippet',
	'uses' => 'api.snippets@index'
));

Route::any('/api/templates/(:num?)', array(
    'as' => 'api_template',
    'uses' => 'api.templates@index'
));

View::composer(array('site.partials.nav'), function($view){
    // $newsletters = Newsletter::get('title');
    // $results = array();
    // foreach ($newsletters as $newsletter) {
    //     array_push($results, $newsletter->title);
    // }
    // $view->with('newsletters', json_encode($results));
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

Event::listen('test', function()
{
    return Redirect::to_route('newsletters');
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