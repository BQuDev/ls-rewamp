<?php

class ModuleSupervisorAllocationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /modulesupervisorallocations
	 *
	 * @return Response
	 */
	public function index()
	{
		//return $course;
		$courses_id = DB::table('application_courses')->where('name','=',$course)->first()->id;

		$supervisors = DB::table('modules')->where('course_id','=',$courses_id)
							->join('module_supervisors','module_supervisors.module_id','=','modules.id')
							->select('module_supervisors.name','module_supervisors.id')
							->groupBy('modules.id')
							->get();

		$registered_students = DB::table('student_course_enrolments')
									->where('course_name','=',intval($courses_id))->select('san')
									->groupBy('san')
									->get();

		return View::make('moduleSupervisorAllocations.index')
		->with('students',$registered_students)
		->with('supervisors',$supervisors);

	}

	public function assign_supervisor(){

		$san = Input::get('san');
		$supervisor = Input::get('supervisor');

		$supervisor_id = DB::table('module_supervisors')->where('name','=',$supervisor)->get();
		$supervisor_id = $supervisor_id[0]->id;

		$already_exists = DB::table('student_module_supervisor_allocation')->where('san','=',$san)
		->where('supervisor_id','=',$supervisor_id)->get();//return $already_exists;
		if(!empty($already_exists))return '3';

		$student_module_supervisor_allocation = new StudentModuleSupervisorAllocation();
		$student_module_supervisor_allocation->san = $san;
		$student_module_supervisor_allocation->supervisor_id = $supervisor_id;

		if($student_module_supervisor_allocation->save()){
		return '1';
		}else{
		return '0';
		}

	}
	/**
	 * Show the form for creating a new resource.
	 * GET /modulesupervisorallocations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /modulesupervisorallocations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /modulesupervisorallocations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($course)
	{
		//
		//return $course;
        		$courses_id = DB::table('application_courses')->where('name','=',$course)->first()->id;

        		$supervisors = DB::table('modules')->where('course_id','=',$courses_id)
        							->join('module_supervisors','module_supervisors.module_id','=','modules.id')
        							->select('module_supervisors.name','module_supervisors.id')
        							->groupBy('modules.id')
        							->get();

        		$registered_students = DB::table('student_course_enrolments')
        									->where('course_name','=',intval($courses_id))->select('san')
        									->groupBy('san')
        									->get();

        		return View::make('moduleSupervisorAllocations.index')
        		->with('students',$registered_students)
        		->with('supervisors',$supervisors);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /modulesupervisorallocations/{id}/edit
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
	 * PUT /modulesupervisorallocations/{id}
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
	 * DELETE /modulesupervisorallocations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}