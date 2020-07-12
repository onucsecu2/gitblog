<?php

use Illuminate\Support\Facades\Route;
Route::group([
                'namespace'=>'Onu\Gitblog\Http\Controllers',
                'middleware' => ['web', 'auth'],
             ],function () {

    Route::get('/test/{postId}', 'GitblogHomeController@test');

    Route::get('/home','GitblogHomeController@index');
    Route::get('/post/details/{slug}', 'GitblogHomeController@readDetails');
    Route::get('/post/details/{slug}/edit', 'GitblogHomeController@editPost');

    Route::get('/create','GitblogPostsController@createStory');
    Route::post('/post','GitblogPostsController@post');

    Route::get('/pull/{id}','GitblogPostsContributionController@pull');
    Route::post('/pull/request','GitblogPostsContributionController@pullRequest');
    Route::get('/pull/all/{id}','GitblogPostsContributionController@allPullRequest');
    Route::get('/post/pull/details/{id}','GitblogPostsContributionController@PullRequestDetails');
});
Route::group([
    'namespace'=> 'Onu\Gitblog\Http\Controllers\Api',
    'middleware' => 'auth:api',
    'prefix'=>"api",

],function () {
//     Route::get('test', 'GitblogApiResponseController@test');
    Route::get('/get/info/{postId}', 'GitblogApiResponseController@getInfo');
    Route::post('/post/info/vote', 'GitblogApiResponseController@postVoteResponse');
    Route::post('/post/info/edit', 'GitblogApiResponseController@postEditResponse');

});
