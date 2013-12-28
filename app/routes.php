<?php

Route::get('/', 'FeedController@home');

Route::get('refresh', function ()
{
	return View::make('ajax-refresh');
});

Route::get('add', 'FeedController@add');
Route::post('add', 'FeedController@save');

Route::get('feeds', 'FeedController@showFeeds');

Route::get('feed/{id}.json', 'FeedController@getFeed');
Route::get('feed/{id}', 'FeedController@showFeed');
Route::get('feed/{id}/refresh', 'FeedController@refreshFeed');

Route::get('articles/refresh', 'ArticleController@refreshArticlePoints');
Route::get('article/{id}/vote/{value}', 'ArticleController@vote');
Route::get('article/{id}.json', 'ArticleController@getArticle');

Route::get('article/{id}/content', 'ArticleController@getKeywords');

Route::get('search', 'ArticleController@search');

Route::get('new', 'ArticleController@checkNew');