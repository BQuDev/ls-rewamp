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

 
    Route::get('/modules/marks-input/create','ModulesController@markInputCreate');

    Route::post('/modules/marks-input/create','ModulesController@saveMarkInputs');

Route::group(array('before' => 'members_auth'), function()
{
    Route::get('/logout', 'UsersController@logout');
    Route::get('students/create/checkSanAvailability','StudentsController@checkSanAvailability');
    Route::get('students/create/information_source/dropdown','StudentsController@information_source_dropdown');
    Route::get('students/create/intakes/dropdown','StudentsController@intakes_dropdown');
    Route::get('/students/verify','StudentsController@verify');
    Route::get('/students/validate','StudentsController@validate');
    Route::get('/students/validate/{san}','StudentsController@more_validate');

    Route::get('modules/marks-input/create/module/dropdown','ModulesController@getModulesByLsStudentNumber');
    Route::get('modules/marks-input/create/elements/dropdown','ModulesController@getElementsByModuleID');
    Route::get('/modules/marks-input','ModulesController@markInputIndex');
Route::get('/modules/marks-input/{ls_student_number}','ModulesController@markInputShow');


    Route::resource('students','StudentsController');
    Route::resource('users','UsersController');
    Route::resource('modules','ModulesController');
});