<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'UsersController@login');
Route::get('/login', 'UsersController@login');
Route::post('/login', 'UsersController@authenticate');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::group(array('before' => 'members_auth'), function()
{
    Route::get('/logout', 'UsersController@logout');
    Route::get('students/create/checkSanAvailability','StudentsController@checkSanAvailability');
    Route::get('students/create/information_source/dropdown','StudentsController@information_source_dropdown');
    Route::get('students/create/intakes/dropdown','StudentsController@intakes_dropdown');

    Route::resource('students','StudentsController');
    Route::resource('users','UsersController');
});