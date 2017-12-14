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

// Middleware
Auth::routes();

// test
Route::get('test',function(){
  return view('sandbox.test');
});

// Home
Route::get('/', 'HomeController@index')->name('home');

// Jobs requests
Route::group(['middleware' => ['auth']], function () {
Route::get('/job/request','JobController@jobrequest')->name('jobrequest');
});
Route::get('/job/requests','JobController@jobrequests')->name('jobrequests');
Route::post('/jobs/requests/data','JobController@jobrequests_data');

// Job openings
Route::group(['middleware' => ['auth']], function () {
Route::get('/job/opening','JobController@jobopening')->name('jobopening');
});
Route::get('/job/openings','JobController@jobopenings')->name('jobopenings');
Route::post('/jobs/openings','JobController@jobopenings')->name('searchopenings');
Route::get('/job/{id}','JobController@show')->name('job');

// Jobs
Route::post('/jobs/data','JobController@jobs_data');

// Skills
Route::get('skills/data','SkillController@index');

// Categories
Route::get('categories/data','CategoryController@index');

// AdController
Route::resource('/user/ad','AdController');

// users
Route::group(['middleware' => ['auth']], function () {
  Route::post('job/respond','ResponseController@store')->name('respond');
  Route::get('user/responses','ResponseController@index')->name('responses');
  Route::resource('/user/profile','ProfileController');
  Route::post('/user/profile/photo','ProfileController@photo')->name('profilephoto');
  Route::get('/logout', 'ProfileController@logout')->name('logout');
});



// Related data
Route::get('/skillsdata','SkillDefinitionController@list');
Route::get('/categoriesdata','CategoryDefinitionController@list');

// Menu items
Route::get('/faq', 'GeneralController@faq')->name('faq');
Route::get('/contact', 'GeneralController@contact')->name('contact');
Route::get('/about', 'GeneralController@about')->name('about');
Route::get('/creator', 'GeneralController@creator')->name('creator');
Route::get('/suggestions', 'GeneralController@suggestions')->name('suggestions');
