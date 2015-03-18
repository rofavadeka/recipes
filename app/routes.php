<?php

//Extended overview of application routes?
//ssh to the project root directory and type "php artisan routes"

/*
|--------------------------------------------------------------------------
| User Only Application Routes ( Require Authentication )
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'auth'), function()
{

    //Logout and redirect
    Route::get('/logout', 'UserController@logout');

    //Only if user has certain permissions ( = current "manager" userrole )
    Route::group(array('before' => 'recipes.create|recipes.edit|recipes.delete'), function()
    {
        //Creates routes to create and manage recipes
        Route::resource('recipe', 'RecipeController',
                    array('except' => array('index')));
    });

    //Only if user has certain permissions ( = current "creator" userrole )
    Route::group(array('before' => 'recipes.create'), function()
    {
        //Creates routes to manage recipes
        Route::resource('recipe', 'RecipeController',
                    array('only' => array('create', 'store')));
    });        

});

/*
|--------------------------------------------------------------------------
| Public Application Routes
|--------------------------------------------------------------------------
*/

//Displays the welcome page
Route::get('/', 'PageController@show');

//Creates routes for /recipe and /recipe/{recipeUrl}
Route::resource('recipe', 'RecipeController',
                array('only' => array('index')));

/*
|--------------------------------------------------------------------------
| Guest Only Application Routes ( Forbidden when logged in )
|--------------------------------------------------------------------------
*/

Route::group(array('before' => 'guest'), function()
{

    //Display user login form
    Route::get('/login', 'UserController@login');

    //Handle's user login form
    Route::post('/login', array('before' => 'csrf', 'uses' => 'UserController@authenticate'));

});