<?php

class ModuleSupervisorAllocationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /modulesupervisorallocations
	 *
	 * @return Response
	 */
	public function index($course)
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


	public function setSupervisors_allocation(){/*
		    $validator =Validator::make(Input::all(),['student'=>'required','supervisor'=>'required']);

    if($validator->fails()){
        Notify::error('Please select students and supervisors');
        return Redirect::back()->withInput();
    }
    // dd(Input::get('supervisor22'));

        
        $students_array = Input::get('student');
        $supervisor_array = Input::get('supervisor');
		
		$array_to_insert = array();

        $division=count($students_array) / count($supervisor_array);
        //  echo  floor($division);
        $modulus=count($students_array) % count($supervisor_array);
        $id=0;
        foreach ($students_array as $student => $value) {
            //echo "ID : " . $value . "<br />";
            $ids = explode(",",$value);
            if($modulus > 0 and $division <= 1){
				$array_to_insert[] = array('ls_student_number' => $ids[0],
                        'supervisor_id' => $supervisor_array[0] ,
                        'san'=>$ids[1]);
            }else{

                if($id<=(count($supervisor_array)-1)){//check supervisor count

					$array_to_insert[] = array('ls_student_number' => $ids[0],
                        'supervisor_id' => $supervisor_array[0] ,
                        'san'=>$ids[1]);


                    if($id==(count($supervisor_array)-1)){ $id=0; } else{ $id++; }

                }

            }

        }
		
		DB::table('module_supervisor_allocation')->insert( $array_to_insert);
        Notify::success('Supervisor asign successfully');
		
		return $this->getSupervisors_allocation();
		*/
		
		$validator =Validator::make(Input::all(),['student'=>'required','supervisor'=>'required']);

    if($validator->fails()){
        Notify::error('Please select students and supervisors');
        return Redirect::back()->withInput();
    }
    // dd(Input::get('supervisor22'));

         //dd(Input::get('supervisor'));
        $students_array = Input::get('student');
        $supervisor_array = Input::get('supervisor');

        $division=count($students_array) / count($supervisor_array);
        //  echo  floor($division);
        $modulus=count($students_array) % count($supervisor_array);
        $id=0;
        foreach ($students_array as $student => $value) {
            //echo "ID : " . $value . "<br />";
            $ids = explode(",",$value);
            if($modulus > 0 and $division <= 1){

                DB::table('module_supervisor_allocation')->insert(
                    array('ls_student_number' => $ids[0],
                        'supervisor_id' => $supervisor_array[0] ,
                        'san'=>$ids[1])
                );
            }else{

                if($id<=(count($supervisor_array)-1)){//check supervisor count


                    DB::table('module_supervisor_allocation')->insert(
                        array('ls_student_number' => $ids[0],
                            'supervisor_id' => $supervisor_array[$id] ,
                            'san'=>$ids[1])
                    );


                    if($id==(count($supervisor_array)-1)){ $id=0; } else{ $id++; }

                }

            }

        }
          Notify::success('Supervisor assigned successfully');
    return $this->getSupervisors_allocation();
	}
	public function getSupervisors_allocation(){
		
		$supervisorsMA = DB::table('module_supervisors')
        ->select('module_supervisors.name','module_supervisors.id')
        ->get();
		//To-Do [join]
		$all_students = DB::table('students')
		->join('student_course_enrolments','student_course_enrolments.san','=','students.san')
		->where('students.ls_student_number','>',0)
		->where('student_course_enrolments.course_name','=',Input::get('c'))
		->groupBy('students.san')
		->get();
		DB::setFetchMode(PDO::FETCH_ASSOC);
		$students_with_supervisors = DB::table('module_supervisor_allocation')->groupBy('module_supervisor_allocation.ls_student_number')->get();
		DB::setFetchMode(PDO::FETCH_CLASS);
	
		$unassigened_students = array();
		foreach($all_students as $student){
		if(!in_array( $student->ls_student_number ,array_pluck($students_with_supervisors,'ls_student_number') ))
			$unassigened_students[] = $student;
		}
		
		 return View::make('moduleSupervisorAllocations.supervisorassign')
        ->with('students',$unassigened_students)
        ->with('supervisorsMA',$supervisorsMA);
	}
	
	public function assign_supervisor(){

	$validator =Validator::make(Input::all(),['student'=>'required','supervisor'=>'required']);
		if($validator->fails()){
		Notify::error('Please select students and supervisors');
		return Redirect::back()->withInput();
		}
		$san = Input::get('san');
		$supervisor = Input::get('supervisor');

		$supervisor_id = DB::table('module_supervisors')->where('name','=',$supervisor)->get();
		$supervisor_id = $supervisor_id[0]->id;

		$already_exists = DB::table('student_module_supervisor_allocation')->where('san','=',$san)
		->where('supervisor_id','=',$supervisor_id)->get();
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
		$san = Input::get('san');
        		$supervisor = Input::get('supervisor');

        		$supervisor_id = DB::table('module_supervisors')->where('name','=',$supervisor)->get();
        		$supervisor_id = $supervisor_id[0]->id;

        		$already_exists = DB::table('student_module_supervisor_allocation')->where('san','=',$san)
        		->where('supervisor_id','=',$supervisor_id)->get();
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
		//return urldecode($course);
        		$courses_id = DB::table('application_courses')->where('name','=',urldecode($course))->first()->id;
/*
        		$supervisors = DB::table('modules')->where('course_id','=',$courses_id)
        							->join('module_supervisors','module_supervisors.module_id','=','modules.id')
        							->select('module_supervisors.name','module_supervisors.id')
        							->groupBy('modules.id')
        							->get();
									*/
											$supervisors = DB::table('module_supervisors')
        ->select('module_supervisors.name','module_supervisors.id')
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
	
	public function excel_export()
	{//return View::make('export.supervisor_allocation');
		return Excel::create('Supervisor Allocation Sheet', function($excel) {

			$excel->sheet('Supervisor Allocation Sheet', function($sheet) {

				$sheet->loadView('export.supervisor_allocation');

			});
            $excel->setcreator('BQu');
            $excel->setlastModifiedBy('BQu');
            $excel->setcompany('BQuServices(PVT)LTD');
            $excel->setmanager('Damith');

		})->download('xls');
	}

}