<?php

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

$app->group(['middleware'=>'jwt.verify'],function($app) {
    $app->post('/post','PostsController@addNewPosts');
    $app->get('/posts/user/{user_id}','PostsController@get_by_user');
    $app->delete('/post/{post_id}','PostsController@remove_by_user');

    $app->get('/posts/comments', 'CommentsController@getComments');
    $app->post('/post/{post_id}/comment','CommentsController@addComments');

    $app->post('/logout','AuthController@logout');
    $app->put('/user/{user_id}', 'UsersController@updateUser');
});


$app->get('/posts','PostsController@getPosts');

$app->post('/login', 'AuthController@login');
$app->post('/user', 'UsersController@newUser');


/*Falta update:
    ->Users
    ->Posts
    ->Comments
*/