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

    $app->post('/post','PostsController@addNewPosts');//Add new Posts
    $app->get('/posts/user/{user_id}','PostsController@get_by_user');// Request posts by user
    $app->delete('/post/{post_id}','PostsController@remove_by_user');// Remove post by user

    $app->put('post/update/{post_id}', 'PostsController@update_by_user');//Update post by user

    $app->get('/posts/comments', 'CommentsController@getComments');//Request comments
    $app->get('/comments/{comments_id}', 'CommentsController@get_comments_by_user')//Request comments by user
    $app->post('/post/{post_id}/comment','CommentsController@addComments');// add new comment

    $app->put('/post/comment/update/{comment_id}', 'CommentsController@updateComment'); //Update comment
    $app->delete('post/comment/delete/{comment_id}', 'CommentsController@deleteComment');//delete comment

    $app->post('/logout','AuthController@logout');//logout
    $app->put('/user/{user_id}', 'UsersController@updateUser');//update user
    $app->get('/auth/user','AuthController@me');//authenticate user

});


$app->get('/posts','PostsController@getPosts'); // Request Posts

$app->post('/login', 'AuthController@login'); //login
$app->post('/user', 'UsersController@newUser'); // Register new user



/*

falta:
    -update posts
    -update comments
    -delete comments


*/