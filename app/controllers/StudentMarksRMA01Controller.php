<?php

class StudentMarksRMA01Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /studentmarksima01glanceds
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('student_marks_RM_A_01');
	}


    public function students_for_marks_rm_a_01(){
        //return Student::all();
        return DB::table('students')
            ->leftJoin('students_for_marks_rm_a_01','students.san','=','students_for_marks_rm_a_01.san')
            ->leftJoin('application_scj','students.san','=','application_scj.san')
            ->select('students.san','sample','scj_number','students.ls_student_number','students.forename_1','c1','c2','c3','m1','m2','ageed_mark')
            ->where('students.ls_student_number','>',0)
            ->groupBy('students.san')
            ->get();
    }

    public function save_marks_for_rm_A_01(){

    //return Input::all();

        $san               = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');
        $col               = Input::get('col');
        $val               = Input::get('val');
/*
        ;*/

        $has_row = DB::table('students_for_marks_rm_a_01')->where('san','=',$san)->get();
        if($has_row){
			
            $mark_update = DB::table('students_for_marks_rm_a_01')
                ->where('san', $san)
                ->update(array($col => $val));
				
			$row = DB::table('students_for_marks_rm_a_01')->where('san','=',$san)->first();
			
			
			//Calculate marks
			
			 //print_r($row);
			if((($row->c1)>0)&&(($row->c2)>0)&&(($row->c3)>0)){
				
				$mark1 = 0;
				$c1 = intval($row->c1) * .4;
				$c2 = intval($row->c2) * .3;
				$c3 = intval($row->c3) * .3;
				
				$mark1 = $c1+$c2+$c3;
				
				$mark2 = 0;
				
				$mark2 = (.95 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				
				
				$mark_update = DB::table('students_for_marks_rm_a_01')
                ->where('san', $san)
                ->update(array('m1' => $mark1,'m2' => $mark2));
				return 1;
			}else{
				$mark_update = DB::table('students_for_marks_rm_a_01')
                ->where('san', $san)
                ->update(array('m1' => null,'m2' => null));
			}
			
			
				
        }else{ 
			// If there are no row in 'students_marks_IM_a_01_glanced'
			$mark_update = new StudentMarksMCA01();
            $mark_update->san = $san;
            $mark_update->ls_student_number = $ls_student_number;
            $mark_update->$col = $val;
            $mark_update->save();
        }
    }
	
	
	public function excel_export(){
		
		return Excel::create('Mark Input Sheet', function($excel) {

			$excel->sheet('Mark Input Sheet', function($sheet) {

				$sheet->loadView('export.marks_ba_rm_01');

			});
            $excel->setcreator('BQu');
            $excel->setlastModifiedBy('BQu');
            $excel->setcompany('BQuServices(PVT)LTD');
            $excel->setmanager('Damith');

		})->download('xls');
		
	}
	
	
	public function to_word(){
		$san               = Input::get('san');
		$date               = Input::get('d');
		$export_type               = Input::get('export_type');
		//return Input::get('export_type');
			$student_data = DB::table('students_for_marks_rm_a_01')
			->leftJoin('application_scj','students_for_marks_rm_a_01.san','=','application_scj.san')
			->where('students_for_marks_rm_a_01.san','=',$san)->get(); 
		if($student_data){

			

			$headers = array(
    "Content-type"=>"application/msword",
    "Content-Disposition"=>"attachment;Filename=RM_".$student_data[0]->scj_number." & ".$student_data[0]->ls_student_number."_".Sentry::getUser()->first_name." ".Sentry::getUser()->last_name.".doc");

$content = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" bgcolor="#FEFFFf" ><p style="text-align:center"><img src="https://lsadmin.net/images/top_img.jpg" width="100%" height="auto" /></p></td>
  </tr>
  </table>
  <br />
  <table width="100%" align="center" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><h2 style="text-align:center;">Retail Marketing<br />
BA in Marketing<br />
</h2></td>
  </tr>
  </table>
  <br />
  <table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td  colspan="3">SID Number :&nbsp;'.$student_data[0]->scj_number.'</td>
   
    <td  colspan="2">LS Number :&nbsp;'.$student_data[0]->ls_student_number.'</td>
  </tr>
  <tr>
    <td  colspan="5">Brand selected :</td>
  </tr>
  <tr>
    <td colspan="3">First Marker:&nbsp;</td>
    <td>Suggested Mark:&nbsp;'.($student_data[0]->m1).'%</td>
    <td>Agreed Mark:&nbsp;'.$student_data[0]->ageed_mark.'%</td>
  </tr>
  </table>
  <br />    <br />
  <table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td width="35%" align="center">Criteria</td>
    <td width="40%" align="center">Comments</td>
    <td align="center">Marks %</td>
    <td align="center">Weight </td>
    <td align="center">Weighted Marks</td>
  </tr>
  <tr>
    <td height="70">
	1)	For a non-domestic retailer operating in a country of your choice analyse each element of the retail mix. The analysis should include:<br>
•	Merchandise range and assortment<br>
•	Retail communications<br>
•	Store layout, design and visual merchandising<br>
•	Customer service and facilitating services<br>
•	Formats and locations<br>
•	Pricing strategy and tactics<br><br>
Learning outcome 1 and 2

	</td>
      <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c1.'</td> <td align="center">0.40</td>
    <td>&nbsp;'.($student_data[0]->c1*.4).'</td>
  </tr>
  <tr>
    <td height="70">
2) Assess the extent to which the retail mix provides a basis for sustainable competitive advantage<br><br>
Learning outcome 1 and 2

</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c2.'</td><td align="center">0.30</td>
    <td>&nbsp;'.($student_data[0]->c2*.3).'</td>
  </tr>
  <tr>
    <td height="70">
	3) Evaluate the challenges to continued international growth that will be faced by your chosen retailer. Consider, for example, PEST factors, the competitive context, growth objectives, growth strategy, market selection and entry methods, emerging retailing trends.
<br><br>
	Learning outcome 3
</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c3.'</td><td align="center">0.30</td>
    <td>&nbsp;'.($student_data[0]->c3*.3).'</td>
  </tr>
  <tr>
  <tr>
    <td colspan="4"><b>Weighted total</b></td>
    <td>&nbsp;'.(($student_data[0]->c1*.4)+($student_data[0]->c2*.3)+($student_data[0]->c3*.3)).'</td>
  </tr>
  </table>
  <table width="100%" align="center" border="0" cellspacing="1" cellpadding="1">
   <tr>
     <td height="10">  </td>
  </tr>
  <tr>
     <td> <h3> Overall Comment </h3> </td>
  </tr>
  </table>

  <br />
  <table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td height="120"></td>
  </tr>
  </table>
  <br /><br />
    <table width="100%" align="center" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">First Marker:&nbsp;</td>
    <td colspan="2">Date: '.$date .'</td>
  </tr>
 
</table>
<br />
<br />
</body>
</html>';


return Response::make($content,200, $headers);
			
			
		
		
		}else{
			echo '<b>Export Failed. Please select student with marks. If you get this error continuously please contact BQu IT team.</b>';
			
		}


		
		
	
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /studentmarksima01glanceds/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        //return View::make('student_marks_IM_A_01_glanced');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /studentmarksima01glanceds
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /studentmarksima01glanceds/{id}
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
	 * GET /studentmarksima01glanceds/{id}/edit
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
	 * PUT /studentmarksima01glanceds/{id}
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
	 * DELETE /studentmarksima01glanceds/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
