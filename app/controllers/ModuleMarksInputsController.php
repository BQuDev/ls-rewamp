<?php

class ModuleMarksInputsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /studentmodulemarksinputs
	 *
	 * @return Response
	 */
	public function index()
	{
		//

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /studentmodulemarksinputs/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /studentmodulemarksinputs
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /studentmodulemarksinputs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($course)
	{
		//
		$courses_id = DB::table('application_courses')->where('name','=',$course)->first()->id;

		$registered_students = DB::table('student_course_enrolments')
											->where('course_name','=',intval($courses_id))->select('san')
											->groupBy('san')
											->get();
		return View::make('studentModuleMarksInputs.index')
				->with('modules',DB::table('modules')->where('course_id','=',$courses_id)->get())
				->with('elements',ModuleElement::lists('name','id'))
				->with('students',$registered_students)
				->with('course_id',$courses_id)
				->with('markers',ModuleMarker::lists('name','name'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /studentmodulemarksinputs/{id}/edit
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
	 * PUT /studentmodulemarksinputs/{id}
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
	 * DELETE /studentmodulemarksinputs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}