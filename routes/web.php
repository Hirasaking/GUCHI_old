<?php

Route::get('logout', 'ArticleController@index');

    Route::get('/', 'ArticleController@index');
    Route::get('rank', 'ArticleController@rank');

    Route::get('post_history', 'ArticleController@post_history')->middleware('auth');

//BASIC認証
Route::group(['middleware' => 'auth.very_basic'], function() {
});

//投稿フォームページ
Route::group(['middleware' => 'auth'], function() {
    //新規投稿部分
    Route::get ('create'            , 'ArticleController@create')->name('create');
    Route::post('article/confirm'   , 'ArticleController@confirm')->name('confirm');
    Route::post('article/update'    , 'ArticleController@update')->name('update');
    Route::get ('article/complete'  , 'ArticleController@complete')->name('complete');
});

//検索
Route::get('search', 'SearchController@create');


    Route::get('edit/{id}', 'ArticleController@edit');
    Route::post('edit', 'ArticleController@update');

    Route::get('result', 'ArticleController@result');

    Route::get('report/{id}', 'ArticleController@edit_report');
    Route::post('update_report', 'ArticleController@report');

    Route::get('delete/{id}', 'ArticleController@show');
    Route::post('delete', 'ArticleController@delete');

    Route::get('page', 'ArticleController@index2')->middleware('auth');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/goutte', function() {
       $crawler = Goutte::request('GET', 'http://www.uplink.co.jp/movie-show/nowshowing');

       $crawler->filter('article.post h2 a')->each(function ($node) {
         echo $node->text();
         echo '<br/>';
       });
       return view('welcome');
    });
