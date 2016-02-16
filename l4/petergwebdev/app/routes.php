<?php

Route::get('/', function()
{
	return View::make('hello');
});

// Site: guest
Route::group(['namespace' => 'PsgSite'], function()
{
    Route::get('/confirm/contact', ['as'=>'site.pages.contactConfirm', 'uses'=>'PagesController@contactConfirm']);
    Route::get('/portfolio', ['as'=>'site.portfolio.index', 'uses'=>'PortfolioController@index']);

}); // site

// Site: member
Route::group(['before'=>'auth.site', 'namespace' => 'PsgSite'], function()
{
}); // site

Route::group(['before'=>'auth.admin', 'prefix'=>'admin2','namespace' => 'PsgAdmin'], function()
{
    //Route::get('/users/setActive/{pkid}/{isActive}', ['as'=>'admin.users.setActive', 'uses'=>'UsersController@setActive']);
    //Route::get('/users/loginAsUser/{userID}', ['as'=>'admin2.users.loginAsUser', 'uses'=>'UsersController@loginAsUser']);
    //Route::put('/users/addRole/{userID}', ['as'=>'admin2.users.addRole', 'uses'=>'UsersController@addRole']);
    //Route::delete('/users/removeRole/{userID}', ['as'=>'admin2.users.removeRole', 'uses'=>'UsersController@removeRole']);
    //Route::get('/users/roles/{userID}', ['as'=>'admin2.users.indexRoles', 'uses'=>'UsersController@indexRoles']);
    //Route::resource('users', 'UsersController');
    //Route::resource('contactmessages', 'ContactmessagesController');
    //Route::get('/', ['as'=>'admin2.home', 'uses'=>'HomeController@index']);
}); // admin

Route::group(['namespace' => 'PsgSite'], function()
{
    Route::get('/{slug}', ['as'=>'site.pages.show', 'uses'=>'PagesController@show']);
});
