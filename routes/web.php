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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/responses', 'ResponseController@index')->name('responses');
Route::get('/faq', 'FaqController@index')->name('faq');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/search/{key}','HomeController@search');
Route::get('/ad/{id}','AdController@show')->name('ad');
Route::resource('/employee/profile','EmployeeController');
