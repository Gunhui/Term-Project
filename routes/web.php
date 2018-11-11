<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('main');
});

Route::get('google_map', function(){
    return view('form.google_map');
});

Auth::routes();

Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/boards', 'BoardController@store');
Route::post('/modify', 'BoardController@update');
Route::post('/notices_modify', 'NoticesController@update');

Route::get('board/board', ['as' => 'board.board', 'uses' => 'Board_pageController@index']);
Route::get('board/home', ['as' => 'board.home', 'uses' => 'Home_pageController@index']);
Route::get('board/notices', ['as' => 'board.notices', 'uses' => 'Notices_pageController@index']);
Route::get('board/mypage', ['as' => 'board.mypage', 'uses' => 'Mypages_pageController@index']);
Route::get('board/register', ['as' => 'board.register', 'uses' => 'RegisterController@']);
Route::get('board/view', ['as' => 'board.view', 'uses' => 'Board_viewController@index']);

Route::get('board_view/{target}', ['as' => 'board_view', 'uses' => 'Board_pageController@show']);
Route::get('notices_view/{target}', ['as' => 'notices_view', 'uses' => 'Notices_pageController@show']);
Route::get('board_destroy/{target}', ['as' => 'board_destroy', 'uses' => 'BoardController@destroy']);
Route::get('notices_destroy/{target}', ['as' => 'notices_destroy', 'uses' => 'NoticesController@destroy']);
Route::get('modify_form/{id}', ['as' => 'modify.form', 'uses' => 'BoardController@edit']);
Route::get('Notices_modify_form/{id}', ['as' => 'notices.modify.form', 'uses' => 'NoticesController@edit']);
Route::get('Apply/{id}', ['as' => 'apply', 'uses' => 'BoardApplyController@store']);

Route::resource('board', 'Board_pageController');

Route::get('notices_write', 'Notices_pageController@create');
Route::get('board_write', 'Board_pageController@create');

Route::get('/board_page', 'Board_pageController@index');
Route::get('oauth', 'GoogleUserController@index');