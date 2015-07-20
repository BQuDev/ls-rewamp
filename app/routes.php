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

 
  //  Route::get('/modules/marks-input/create','ModulesController@markInputCreate');
    Route::get('/test',function(){
        $x = Student::where('san','=','khpsh001')->first();
        return $x->id;
    });
    Route::get('/teststudents', 'StudentsController@teststudents');
  //  Route::post('/modules/marks-input/create','ModulesController@saveMarkInputs');

Route::group(array('before' => 'members_auth'), function()
{

    Route::post('/modules/supervisor-allocation','ModuleSupervisorAllocationsController@assign_supervisor');
    //Route::post('/modules/supervisor-allocation','ModuleMarkerAllocationsController@assign_marker');

    Route::get('/testpage',function(){
       return View::make('test');
    });

    Route::get('/logout', 'UsersController@logout');
    Route::get('/help', 'UsersController@logout');
    Route::get('students/create/checkSanAvailability','StudentsController@checkSanAvailability');
    Route::get('students/create/information_source/dropdown','StudentsController@information_source_dropdown');
    Route::get('students/create/intakes/dropdown','StudentsController@intakes_dropdown');
    Route::get('students/verify/courses/dropdown','StudentsController@courses_dropdown');
    Route::get('/students/verify','StudentsController@verify');

    Route::post('/students/verify','StudentsController@verify_student');
    Route::get('/students/verify/{san}','StudentsController@more_verify');
    Route::get('/students/validate','StudentsController@validate');
    Route::post('/students/validate','StudentsController@validate_student');
    Route::get('/students/validate/{san}','StudentsController@more_validate');
	
	// Students Amendments
	Route::post('students/amendments','StudentsController@amendments');

/*
    Route::get('modules/marks-input/get_student_marks','ModulesController@getStudentMarks');
    Route::get('modules/marks-input/create/module/dropdown','ModulesController@getModulesByLsStudentNumber');
    Route::get('modules/marks-input/create/elements/dropdown','ModulesController@getElementsByModuleID');
    Route::get('/modules/marks-input','ModulesController@markInputIndex');
    Route::get('/modules/marks-input/{ls_student_number}','ModulesController@markInputShow');
    Route::get('modules/marks-input/create/{ls_student_number}','ModulesController@markInputIndex1');*/
    Route::get('students/applications/export','StudentsController@export');

// To-Do
    Route::get('/settings/user-management/all-users','UsersController@index');
    Route::get('/settings/user-management/create','UsersController@create');
    Route::get('/settings/user-management/user-groups','UsersController@user_groups');
    Route::post('/settings/user-management/user-groups','UsersController@add_user_groups');
    Route::get('/settings/user-management/user-groups/{group}','UsersController@edit_group');
    Route::post('/settings/user-management/user-groups/update_permissions','UsersController@update_permissions');

    Route::resource('students','StudentsController');
    Route::resource('users','UsersController');
    Route::resource('modules','ModulesController');
    Route::resource('settings','SettingsController');
    Route::resource('contact-bqu','ContactBquController');
    Route::resource('migrate','DBMigrationController');
    Route::resource('modules/marker-allocation', 'ModuleMarkerAllocationsController');
    Route::resource('modules/supervisor-allocation', 'ModuleSupervisorAllocationsController');
    Route::resource('modules/marks-input', 'ModuleMarksInputsController');

});