<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/




$router->get('/posts','PostsController@getPosts');
$router->post('/post','PostsController@addNewPosts');
$router->get('/posts/user/{user_id}','PostsController@get_by_user');
$router->delete('/post/{post_id}','PostsController@remove_by_user');
$router->post('/post/{post_id}/comment','CommentsController@addComments');

$router->post('/user', 'UsersController@newUser');
$router->post('/login', 'AuthController@login');


// $router->get('/', function () use ($router) {
//     echo "<center> Welcome </center>";
// });

// $router->get('/version', function () use ($router) {
//     return $router->app->version();
// });

// Route::group([

//     'prefix' => 'api'

// ], function ($router) {
  
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('user-profile', 'AuthController@me');

// });


