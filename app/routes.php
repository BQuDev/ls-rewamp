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
    Route::get('/students/amendments','StudentsController@amendment');
    Route::get('/students/amendment/{san}','StudentsController@more_amendment');
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

    Route::post('modules/marks','ModulesController@addMarks');

// To-Do
    Route::get('/settings/user-management/all-users','UsersController@index');
    Route::get('/settings/user-management/create','UsersController@create');
    Route::get('/settings/user-management/user-groups','UsersController@user_groups');
    Route::post('/settings/user-management/user-groups','UsersController@add_user_groups');
    Route::get('/settings/user-management/user-groups/{group}','UsersController@edit_group');
    Route::post('/settings/user-management/user-groups/update_permissions','UsersController@update_permissions');
	
			
    Route::get('students_for_marks_IM_A_01_glanced','StudentMarksIMA01GlancedsController@students_for_marks_IM_A_01_glanced');
    Route::post('save_marks_for_IM_A_01_glanced','StudentMarksIMA01GlancedsController@save_marks_for_IM_A_01_glanced');
    Route::get('save_marks_for_IM_A_01_glanced_excel_export','StudentMarksIMA01GlancedsController@excel_export');
    Route::get('save_marks_for_IM_A_01_glanced_word', 'StudentMarksIMA01GlancedsController@to_word');
	Route::resource('student-marks-IM-A-01-glanced', 'StudentMarksIMA01GlancedsController');
	
    Route::get('students_for_marks_IM_A_01','StudentMarksIMA01Controller@students_for_marks_IM_A_01');
    Route::post('save_marks_for_IM_A_01','StudentMarksIMA01Controller@save_marks_for_IM_A_01');
    Route::get('save_marks_for_IM_A_01_excel_export','StudentMarksIMA01Controller@excel_export');
    Route::get('save_marks_for_IM_A_01_word', 'StudentMarksIMA01Controller@to_word');
	Route::resource('student-marks-IM-A-01', 'StudentMarksIMA01Controller');
	
    Route::get('students_for_marks_IM_A_02','StudentMarksIMA02Controller@students_for_marks_IM_A_02');
    Route::post('save_marks_for_IM_A_02','StudentMarksIMA02Controller@save_marks_for_IM_A_02');
    Route::get('save_marks_for_IM_A_02_excel_export','StudentMarksIMA02Controller@excel_export');
    Route::get('save_marks_for_IM_A_02_word', 'StudentMarksIMA02Controller@to_word');
	Route::resource('student-marks-IM-A-02', 'StudentMarksIMA02Controller');	
	
    Route::get('students_for_marks_MC_A_01','StudentMarksMCA01Controller@students_for_marks_MC_A_01');
    Route::post('save_marks_for_MC_A_01','StudentMarksMCA01Controller@save_marks_for_MC_A_01');
    Route::get('save_marks_for_MC_A_01_excel_export','StudentMarksMCA01Controller@excel_export');
    Route::get('save_marks_for_MC_A_01_word', 'StudentMarksMCA01Controller@to_word');
	Route::resource('student-marks-MC-A-01', 'StudentMarksMCA01Controller');
	
    Route::get('students_for_marks_MC_A_02','StudentMarksMCA02Controller@students_for_marks_MC_A_02');
    Route::post('save_marks_for_MC_A_02','StudentMarksMCA02Controller@save_marks_for_MC_A_02');
    Route::get('save_marks_for_MC_A_02_excel_export','StudentMarksMCA02Controller@excel_export');
    Route::get('save_marks_for_MC_A_02_word', 'StudentMarksMCA02Controller@to_word');
	Route::resource('student-marks-MC-A-02', 'StudentMarksMCA02Controller');
	
    Route::get('students_for_marks_OCM_A_01','StudentMarksOCMA01Controller@students_for_marks_OCM_A_01');
    Route::post('save_marks_for_OCM_A_01','StudentMarksOCMA01Controller@save_marks_for_OCM_A_01');
    Route::get('save_marks_for_OCM_A_01_excel_export','StudentMarksOCMA01Controller@excel_export');
    Route::get('save_marks_for_OCM_A_01_word', 'StudentMarksOCMA01Controller@to_word');
	Route::resource('student-marks-OCM-A-01', 'StudentMarksOCMA01Controller');
	
    Route::get('students_for_marks_RM_A_01','StudentMarksRMA01Controller@students_for_marks_RM_A_01');
    Route::post('save_marks_for_RM_A_01','StudentMarksRMA01Controller@save_marks_for_RM_A_01');
    Route::get('save_marks_for_RM_A_01_excel_export','StudentMarksRMA01Controller@excel_export');
    Route::get('save_marks_for_RM_A_01_word', 'StudentMarksRMA01Controller@to_word');
	Route::resource('student-marks-RM-A-01', 'StudentMarksRMA01Controller');
	
    Route::get('students_for_marks_SMA_A_01','StudentMarksSMAA01Controller@students_for_marks_SMA_A_01');
    Route::post('save_marks_for_SMA_A_01','StudentMarksSMAA01Controller@save_marks_for_SMA_A_01');
    Route::get('save_marks_for_SMA_A_01_excel_export','StudentMarksSMAA01Controller@excel_export');
    Route::get('save_marks_for_SMA_A_01_word', 'StudentMarksSMAA01Controller@to_word');
	Route::resource('student-marks-SMA-A-01', 'StudentMarksSMAA01Controller');
	
    Route::get('students_for_marks_SMF_A_01','StudentMarksSMFA01Controller@students_for_marks_SMF_A_01');
    Route::post('save_marks_for_SMF_A_01','StudentMarksSMFA01Controller@save_marks_for_SMF_A_01');
    Route::get('save_marks_for_SMF_A_01_excel_export','StudentMarksSMFA01Controller@excel_export');
    Route::get('save_marks_for_SMF_A_01_word', 'StudentMarksSMFA01Controller@to_word');
	Route::resource('student-marks-SMF-A-01', 'StudentMarksSMFA01Controller');
	
    Route::get('students_for_marks_UGMP_A_01','StudentMarksUGMPA01Controller@students_for_marks_UGMP_A_01');
    Route::post('save_marks_for_UGMP_A_01','StudentMarksUGMPA01Controller@save_marks_for_UGMP_A_01');
    Route::get('save_marks_for_UGMP_A_01_excel_export','StudentMarksUGMPA01Controller@excel_export');
    Route::get('save_marks_for_UGMP_A_01_word', 'StudentMarksUGMPA01Controller@to_word');
	Route::resource('student-marks-UGMP-A-01', 'StudentMarksUGMPA01Controller');
	
    Route::get('students_for_marks_MDI_A_01','StudentMarksMDIA01Controller@students_for_marks_MDI_A_01');
    Route::post('save_marks_for_MDI_A_01','StudentMarksMDIA01Controller@save_marks_for_MDI_A_01');
    Route::get('save_marks_for_MDI_A_01_excel_export','StudentMarksMDIA01Controller@excel_export');
    Route::get('save_marks_for_MDI_A_01_word', 'StudentMarksMDIA01Controller@to_word');
	Route::resource('student-marks-MDI-A-01', 'StudentMarksMDIA01Controller');
	
		
    Route::get('students_for_marks_PMP_MA_A_01','StudentMarksPMPMAA01Controller@students_for_marks_PMP_MA_A_01');
    Route::post('save_marks_for_PMP_MA_A_01','StudentMarksPMPMAA01Controller@save_marks_for_PMP_MA_A_01');
    Route::get('save_marks_for_PMP_MA_A_01_excel_export','StudentMarksPMPMAA01Controller@excel_export');
    Route::get('save_marks_for_PMP_MA_A_01_word', 'StudentMarksPMPMAA01Controller@to_word');
	Route::resource('student-marks-PMP_MA-A-01', 'StudentMarksPMPMAA01Controller');	
		
    Route::get('students_for_marks_PMP_MBA_A_01','StudentMarksPMPMBAA01Controller@students_for_marks_PMP_MBA_A_01');
    Route::post('save_marks_for_PMP_MBA_A_01','StudentMarksPMPMBAA01Controller@save_marks_for_PMP_MBA_A_01');
    Route::get('save_marks_for_PMP_MBA_A_01_excel_export','StudentMarksPMPMBAA01Controller@excel_export');
    Route::get('save_marks_for_PMP_MBA_A_01_word', 'StudentMarksPMPMBAA01Controller@to_word');
	Route::resource('student-marks-PMP_MBA-A-01', 'StudentMarksPMPMBAA01Controller');
		
    Route::get('students_for_marks_MDI_mba_A_01','StudentMarksMDIMBAA01Controller@students_for_marks_MDI_mba_A_01');
    Route::post('save_marks_for_MDI_mba_A_01','StudentMarksMDIMBAA01Controller@save_marks_for_MDI_mba_A_01');
    Route::get('save_marks_for_MDI_mba_A_01_excel_export','StudentMarksMDIMBAA01Controller@excel_export');
    Route::get('save_marks_for_MDI_mba_A_01_word', 'StudentMarksMDIMBAA01Controller@to_word');
	Route::resource('student-marks-MDI_mba-A-01', 'StudentMarksMDIMBAA01Controller');		
	
    Route::get('students_for_marks_RMBM_MA_A_01','StudentMarksRMBMMAA01Controller@students_for_marks_RMBM_MA_A_01');
    Route::post('save_marks_for_RMBM_MA_A_01','StudentMarksRMBMMAA01Controller@save_marks_for_RMBM_MA_A_01');
    Route::get('save_marks_for_RMBM_MA_A_01_excel_export','StudentMarksRMBMMAA01Controller@excel_export');
    Route::get('save_marks_for_RMBM_MA_A_01_word', 'StudentMarksRMBMMAA01Controller@to_word');
	Route::resource('student-marks-RMBM_MA-A-01', 'StudentMarksRMBMMAA01Controller');	
	
		
    Route::get('students_for_marks_RMBM_MA_A_02','StudentMarksRMBMMAA02Controller@students_for_marks_RMBM_MA_A_02');
    Route::post('save_marks_for_RMBM_MA_A_02','StudentMarksRMBMMAA02Controller@save_marks_for_RMBM_MA_A_02');
    Route::get('save_marks_for_RMBM_MA_A_02_excel_export','StudentMarksRMBMMAA02Controller@excel_export');
    Route::get('save_marks_for_RMBM_MA_A_02_word', 'StudentMarksRMBMMAA02Controller@to_word');
	Route::resource('student-marks-RMBM_MA-A-02', 'StudentMarksRMBMMAA02Controller');	
	
		
    Route::get('students_for_marks_RMBM_MBA_A_01','StudentMarksRMBMMBAA01Controller@students_for_marks_RMBM_MBA_A_01');
    Route::post('save_marks_for_RMBM_MBA_A_01','StudentMarksRMBMMBAA01Controller@save_marks_for_RMBM_MBA_A_01');
    Route::get('save_marks_for_RMBM_MBA_A_01_excel_export','StudentMarksRMBMMBAA01Controller@excel_export');
    Route::get('save_marks_for_RMBM_MBA_A_01_word', 'StudentMarksRMBMMBAA01Controller@to_word');
	Route::resource('student-marks-RMBM_MBA-A-01', 'StudentMarksRMBMMBAA01Controller');	
	
		
    Route::get('students_for_marks_RMBM_MBA_A_02','StudentMarksRMBMMBAA02Controller@students_for_marks_RMBM_MBA_A_02');
    Route::post('save_marks_for_RMBM_MBA_A_02','StudentMarksRMBMMBAA02Controller@save_marks_for_RMBM_MBA_A_02');
    Route::get('save_marks_for_RMBM_MBA_A_02_excel_export','StudentMarksRMBMMBAA02Controller@excel_export');
    Route::get('save_marks_for_RMBM_MBA_A_02_word', 'StudentMarksRMBMMBAA02Controller@to_word');
	Route::resource('student-marks-RMBM_MBA-A-02', 'StudentMarksRMBMMBAA02Controller');	
	
	Route::get('/supervisor-allocation','ModuleSupervisorAllocationsController@getSupervisors_allocation');
	Route::post('/supervisor-allocation','ModuleSupervisorAllocationsController@setSupervisors_allocation');

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