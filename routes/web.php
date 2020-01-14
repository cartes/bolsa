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

Route::get('/', function () {
    return view('home');
});
Route::post('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', function (){
    return view('user.register');
})->name('register');
Route::post('/login','UserController@login')->name('login');
Route::post('/store','UserController@store')->name('store');

Route::group(["prefix" => "profile"], function() {
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

