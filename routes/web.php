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
Route::post('job/respond','ResponseController@store')->name('respond');
Route::post('job/respondfront','ResponseController@storefront')->name('respondfront');
Route::get('register/verify/{token}', 'Auth\RegisterController@verify');
Route::get('register/resendverification', 'Auth\RegisterController@verifysend')->name('verifysend');
Route::post('register/sendverification', 'Auth\RegisterController@sendverification')->name('sendverification');
Route::post('register/emailcheck/','Auth\RegisterController@emailcheck')->name('emailcheck');
Route::post('login/check','Auth\LoginController@logincheck')->name('logincheck');
Route::group(['middleware' => ['auth']], function () {

  Route::get('user/responses','ResponseController@index')->name('responses');
  // Responses json
  Route::get('user/responses/conversations/data','ResponseController@get_conversations')->name('get_conversations');
  Route::post('user/responses/data','ResponseController@get_responses')->name('get_responses');
  Route::post('user/respond/store','ResponseController@store_response')->name('store_response');
  Route::delete('user/respond/delete','ResponseController@delete_response')->name('delete_response');

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
Route::post('/contact', 'GeneralController@postcontact')->name('postcontact');
Route::get('/about', 'GeneralController@creator')->name('about');
Route::get('/creator', 'GeneralController@creator')->name('creator');
Route::get('/suggestions', 'GeneralController@contact')->name('suggestions');
