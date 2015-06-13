<?php

class ModulesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /modules
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /modules/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /modules
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /modules/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /modules/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /modules/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /modules/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function markInputIndex(){
        return View::make('modules.index_mark_input')->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
            ->groupBy('san')
            ->get());
    }

    public function markInputShow($ls_student_number){
        return View::make('modules.show_mark_input');
    }

    public function markInputCreate(){
		

try
{
    // Login credentials
    $credentials = array(
       'email'    => 'admin@bqu.com',
    'password' => '123',
    );

    // Authenticate the user
    $user = Sentry::authenticate($credentials, false);
}
catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
{
    echo 'Login field is required.';
}
catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
{
    echo 'Password field is required.';
}
catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
{
    echo 'Wrong password, try again.';
}
catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
{
    echo 'User was not found.';
}
catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
{
    echo 'User is not activated.';
}

// The following is only required if the throttling is enabled
catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
{
    echo 'User is suspended.';
}
catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
{
    echo 'User is banned.';
}


        return View::make('modules.create_mark_input')
            ->with('ls_student_numbers',Student::lists('ls_student_number','ls_student_number'))
            ->with('modules',Module::lists('name','id'))
            ->with('elements',ModuleElement::lists('name','id'));
    }

    public function getModulesByLsStudentNumber(){
        $ls_student_number = Input::get('option');
        $san = Student::where('ls_student_number','=',$ls_student_number)->first()->san;
        $course_id =  StudentCourseEnrolment::where('san','=',$san)->first()->course_name;
        $course_name = ApplicationCourse::where('id','=',$course_id)->first()->name;
        return array(Module::where('course_id','=',$course_id)->lists('name','id'),$course_name);
    }

    public function getElementsByModuleID(){
        $module_id = Input::get('option');
        return ModuleElement::where('module_id','=',$module_id)->lists('name','id');
    }

    public function saveMarkInputs(){
        $student_module_marks_input = new StudentModuleMarksInput();
        $student_module_marks_input->ls_student_number = Input::get('ls_student_number');
        //$student_module_marks_input->san = Input::get('san');
        $student_module_marks_input->test = Input::get('test');
        $student_module_marks_input->course = Input::get('course');
        $student_module_marks_input->course_remarks = Input::get('course_remark');
        $student_module_marks_input->resit = Input::get('resit');
        $student_module_marks_input->resit_remark = Input::get('resit_remark');
        $student_module_marks_input->element = Input::get('element');

        if($student_module_marks_input->save()){
            return 'Added';
        }else{
            return 'error';
        }
    }

}