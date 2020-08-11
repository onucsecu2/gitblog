<?php

use Illuminate\Support\Facades\Route;
Route::group([
                'namespace'=>'Onu\Gitblog\Http\Controllers',
                'middleware' => ['web', 'auth'],
             ],function () {

    Route::get('/test/{postId}', 'GitblogHomeController@test');// for testing several functions...

    Route::get('/home','GitblogHomeController@index'); //show home page
    Route::get('/post/details/{slug}', 'GitblogHomeController@readDetails'); //
    Route::get('/post/details/{slug}/edit', 'GitblogHomeController@editPost'); // show the suggested edits of the post --not completed--
    Route::get('/create','GitblogPostsController@createStory');// creating a new post
    Route::post('/post','GitblogPostsController@post'); // send the post to db


});
/** Contribution Part Start **/
Route::group([
    'namespace'=>'Onu\Gitblog\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix'=>"primary",
],function () {
    Route::get('/pull/all/{id}','GitblogPrimaryContributionController@getAllRequestedContributions'); //show all the primary contributions of that post
    Route::get('/article/pull/details/{id}','GitblogPrimaryContributionController@showContribution'); //show details of the contribution
    Route::get('/pull/{id}','GitblogPrimaryContributionController@setContribution');//get the post content in field to add or remove contents
    Route::post('/pull/request','GitblogPrimaryContributionController@sendContributionRequest'); //send the contributed tet to the db

});
Route::group([
    'namespace'=>'Onu\Gitblog\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix'=>"secondary",
],function () {
    Route::get('/pull/all/{id}','GitblogSecondaryContributionController@getAllRequestedContributions'); //show all the Secondary contributions of that post
    Route::get('/article/pull/details/{id}','GitblogSecondaryContributionController@showContribution'); //show details of the contribution
    Route::get('/pull/{id}','GitblogSecondaryContributionController@setContribution');
    Route::post('/pull/request','GitblogSecondaryContributionController@sendContributionRequest');
});

/** Contribution Part End **/

/** APi Part **/

Route::group([
    'namespace'=> 'Onu\Gitblog\Http\Controllers\Api',
    'middleware' => 'auth:api',
    'prefix'=>"api",
],function () {
    Route::get('/get/info/{postId}', 'GitblogApiResponseController@getInfo');
    Route::post('/post/info/vote', 'GitblogApiResponseController@postVoteResponse');
    Route::post('/post/info/edit', 'GitblogApiResponseController@postEditResponse');
    Route::post('/post/vote', 'GitblogApiResponseController@voteOriginalArticle');
    Route::post('/views/article', 'GitblogApiResponseController@viewsOriginalArticle');
    Route::post('/saved/article', 'GitblogApiResponseController@savedOriginalArticle');
    Route::post('/secure/article', 'GitblogApiResponseController@secureOriginalArticle');
    Route::post('/post/comment', 'GitblogApiResponseController@addCommentArticle');
    Route::post('/comment/reply', 'GitblogApiResponseController@addCommentReply');
});
