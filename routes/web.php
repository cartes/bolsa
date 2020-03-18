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

Route::get('/', 'Controller@index')->name('/');
Route::get('/home', 'Controller@index')->name('home');

Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/store', 'UserController@store')->name('store');
Route::get('/prices', function () {
    return view("prices");
})->name('prices');

Route::group(["prefix" => "profile"], function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::put('profile/update', 'ProfileController@update')->name('profile.update');
    Route::put('profile/salary', 'ProfileController@salary')->name('profile.salary');
    Route::put('profile/contact', 'ProfileController@contact')->name('profile.contact');
    Route::put('profile/experience', 'ProfileController@experience')->name('profile.experience');
    Route::put('profile/education', 'ProfileController@education')->name('profile.education');
    Route::put('profile/objectives', 'ProfileController@objectives')->name('profile.objectives');
    Route::put('profile/languages', 'ProfileController@languages')->name('profile.languages');
    Route::put('profile/references', "ProfileController@references")->name("profile.references");
    Route::put('profile/skills', 'ProfileController@skills')->name('profile.skills');
    Route::put('profile/resume', 'ProfileController@resume')->name('profile.resume');
});

Route::prefix('posts')->group(function () {
    Route::get('create', 'PostController@postCreateForm')->name('post.create');
    Route::put('register', 'PostController@register')->name('post.register');
});

Route::prefix('business')->group(function () {
    Route::get('index', 'BusinessController@index')->name('business.index');
    Route::post('/login', 'BusinessController@login')->name('business.login');
    Route::post('register', 'BusinessController@register')->name('business.register');
    Route::get('profile', 'BusinessController@profileIndex')->name('business.profile');
    Route::put('update', 'BusinessController@updateProfile')->name('business.update');
    Route::get('/{id}/file', 'BusinessController@file')->name("business.file");
});

Route::prefix('offer')->group(function () {
    Route::get('/{offer}/postulate', 'OfferController@postulate')->name('offer.postulate');
    Route::get('/index', 'OfferController@index')->name('offer.admin');
    Route::get('/list', 'OfferController@list')->name('offer.list');
    Route::get('/{offer}/edit', 'OfferController@detail')->name('offer.detail');
    Route::put('/create', 'OfferController@create')->name('offer.create');
    Route::put("/{offer}/store", "OfferController@store")->name("offer.store");
    Route::delete("/{offer}/destroy", "OfferController@destroy")->name("offer.delete");
    Route::get("/show/{slug}/{search?}", "OfferController@show")->name("offer.show");
    Route::get('/{slug}/candidates', 'OfferController@candidates')->name('offer.candidates');
    Route::put('/{slug}/republish', 'OfferController@republish')->name('offer.republish');
    Route::get('/{slug}/getajax', 'OfferController@ajax')->name('offer.ajax');
});

Route::prefix('user')->group(function () {
    Route::get('/offers', "UserController@showoffers")->name('user.offers')->middleware(['redhome']);
    Route::get('/alerts', 'UserController@alerts')->name("user.alerts")->middleware(['redhome']);
    Route::get('{id}/{offer?}/file', "UserController@file")->name('user.file');
});

Route::prefix('message')->group(function () {
    Route::post('/show', "MessageController@show")->name("message.show")->middleware(['redhome']);
    Route::post('/send', "MessageController@send")->name("message.send")->middleware(['redhome']);
});
Route::post('/search', 'SearchController@result')->name('search');
