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

Route::get('/', 'Controller@index');
Route::get('/home', 'Controller@index')->name('home');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/store', 'UserController@store')->name('store');

Route::group(["prefix" => "profile"], function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::put('profile/update', 'ProfileController@update')->name('profile.update');
    Route::put('profile/salary', 'ProfileController@salary')->name('profile.salary');
    Route::put('profile/contact', 'ProfileController@contact')->name('profile.contact');
    Route::put('profile/experience', 'ProfileController@experience')->name('profile.experience');
    Route::put('profile/education', 'ProfileController@education')->name('profile.education');
    Route::put('profile/objectives', 'ProfileController@objectives')->name('profile.objectives');
    Route::put('profile/languages', 'ProfileController@languages')->name('profile.languages');
    Route::put('profile/skills', 'ProfileController@skills')->name('profile.skills');
});

Route::prefix('posts')->group(function () {
    Route::get('create', 'PostController@postCreateForm')->name('post.create');
    Route::put('register', 'PostController@register')->name('post.register');
});

Route::prefix('business')->group(function () {
    Route::get('index', 'BusinessController@index')->name('business.index');
    Route::post('login', 'BusinessController@login')->name('business.login');
    Route::get('profile', 'BusinessController@profileIndex')->name('business.profile');
    Route::put('update', 'BusinessController@updateProfile')->name('business.update');
});

Route::prefix('offer')->group(function () {
    Route::put('create', 'OfferController@create')->name('offer.create');
});

Route::post('/search', 'SearchController@result')->name('search');