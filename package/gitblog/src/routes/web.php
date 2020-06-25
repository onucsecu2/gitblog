<?php

use Illuminate\Support\Facades\Route;
Route::group([
                'namespace'=>'Onu\Gitblog\Http\Controllers',
                'middleware' => ['web', 'auth'],
             ],function () {
    Route::get('/home','GitblogHomeController@index');
    Route::get('/post/details/{slug}', 'GitblogHomeController@readDetails');
    
    Route::get('/create','GitblogPostsController@create');
    Route::post('/post','GitblogPostsController@post');
    
    Route::get('/pull/{id}','GitblogPostsContributionController@pull');
    Route::post('/pull/request','GitblogPostsContributionController@pullRequest');
    Route::get('/pull/all/{id}','GitblogPostsContributionController@allPullRequest');
    Route::get('/post/pull/details/{id}','GitblogPostsContributionController@PullRequestDetails');
});
    
