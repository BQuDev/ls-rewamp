<?php

class ModuleMarkerAllocationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /modulemarkerallocations
	 *
	 * @return Response
	 */
	public function index()
	{
		//

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /modulemarkerallocations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /modulemarkerallocations
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$san = Input::get('san');
		$element = Input::get('element');
		$marker_1 = Input::get('marker_1');
		$marker_2 = Input::get('marker_2');


		$already_exists = DB::table('student_module_markers_allocation')
		->where('san','=',$san)
		->where('element_id','=',$element)
		->where('marker_1','=',$marker_1)
		->where('marker_2','=',$marker_2)
		->get();//return $already_exists;
		if(!empty($already_exists))return '3';

		$student_module_marker_allocation = new StudentModuleMarkerAllocation();
		$student_module_marker_allocation->san = $san;
		$student_module_marker_allocation->element_id = $element;
		$student_module_marker_allocation->marker_1 = $marker_1;
		$student_module_marker_allocation->marker_2 = $marker_2;

		if($student_module_marker_allocation->save()){
		return '1';
		}else{
		return '0';
		}
	}

	/**
	 * Display the specified resource.
	 * GET /modulemarkerallocations/{id}
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

        return View::make('moduleMarkerAllocations.index')
        		->with('students',$registered_students)
        		->with('course_id',$courses_id)
        		->with('markers',ModuleMarker::lists('name','id'));
	}

	public function assign_marker(){
            return 'kk';
		$san = Input::get('san');
		$element = Input::get('element');
		$marker_1 = Input::get('marker_1');
		$marker_2 = Input::get('marker_2');


		$already_exists = DB::table('student_module_markers_allocation')
		->where('san','=',$san)
		->where('element_id','=',$element)
		->where('marker_1','=',$marker_1)
		->where('marker_2','=',$marker_2)
		->get();//return $already_exists;
		if(!empty($already_exists))return '3';

		$student_module_marker_allocation = new StudentModuleMarkerAllocation();
		$student_module_marker_allocation->san = $san;
		$student_module_marker_allocation->element_id = $element;
		$student_module_marker_allocation->marker_1 = $marker_1;
		$student_module_marker_allocation->marker_2 = $marker_2;

		if($student_module_marker_allocation->save()){
		return '1';
		}else{
		return '0';
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /modulemarkerallocations/{id}/edit
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
	 * PUT /modulemarkerallocations/{id}
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
	 * DELETE /modulemarkerallocations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}