<?php

class StudentMarksIMA01GlancedsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /studentmarksima01glanceds
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('student_marks_IM_A_01_glanced');
	}


    public function students_for_marks_IM_A_01_glanced(){
        //return Student::all();
        return DB::table('students')
            ->leftJoin('xxx','students.san','=','xxx.san')
            ->select('students.san','students.ls_student_number','c1','c2','c3','c4','c5','c6','m1','m2','ageed_mark')
            ->where('students.ls_student_number','>',0)
            ->groupBy('students.san')
            ->get();
    }

    public function save_marks_for_IM_A_01_glanced(){

    //return Input::all();

        $san               = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');
        $col               = Input::get('col');
        $val               = Input::get('val');
/*
        ;*/

        $has_row = DB::table('xxx')->where('san','=',$san)->get();
        if($has_row){
			
            $mark_update = DB::table('xxx')
                ->where('san', $san)
                ->update(array($col => $val));
				
			$row = DB::table('xxx')->where('san','=',$san)->first();
			
			
			//Calculate marks
			
			 //print_r($row);
			if((($row->c1)>0)&&(($row->c2)>0)&&(($row->c3))&&(($row->c4)>0)&&(($row->c5)>0)&&(($row->c6)>0)){
				
				$mark1 = 0;
				$c1 = intval($row->c1) * .1;
				$c2 = intval($row->c2) * .2;
				$c3 = intval($row->c3) * .2;
				$c4 = intval($row->c4) * .1;
				$c5 = intval($row->c5) * .2;
				$c6 = intval($row->c6) * .2;
				
				$mark1 = $c1+$c2+$c3+$c4+$c5+$c6;
				//.9*Input1+.2*RND(0-1)
				//$mark2 = (.9 * $mark1) + $mark1*(rand( 0,20 )/100);
				
				$mark2 = 0;
				
					$mark2 = (.9 * $mark1) + $mark1*(rand( 0,20 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,20 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,20 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,20 )/100);
				
				$mark_update = DB::table('xxx')
                ->where('san', $san)
                ->update(array('m1' => $mark1,'m2' => $mark2));
				return 1;
			}else{
				$mark_update = DB::table('xxx')
                ->where('san', $san)
                ->update(array('m1' => null,'m2' => null));
			}
			
			
				
        }else{ 
			// If there are no row in 'students_marks_IM_a_01_glanced'
			$mark_update = new StudentMarksIMA01Glanced();
            $mark_update->san = $san;
            $mark_update->ls_student_number = $ls_student_number;
            $mark_update->$col = $val;
            $mark_update->save();
        }
    }
	
	
	public function excel_export(){
		
		return Excel::create('Mark Input Sheet', function($excel) {

			$excel->sheet('Mark Input Sheet', function($sheet) {

				$sheet->loadView('export.marks');

			});
            $excel->setcreator('BQu');
            $excel->setlastModifiedBy('BQu');
            $excel->setcompany('BQuServices(PVT)LTD');
            $excel->setmanager('Damith');

		})->download('xls');
		
	}
	
	
	public function to_word(){
		$san               = Input::get('san');
		$export_type               = Input::get('export_type');
		//return Input::get('export_type');
			$student_data = DB::table('xxx')->where('san','=',$san)->get(); 
		if($student_data){
		if($export_type === 'pdf'){
			
			$pdf = App::make('dompdf');
			
		
			
			
$pdf->loadHTML('<table width="75%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td  colspan="5" ><p style="text-align:center"><img src="https://lsadmin.net/images/top_img.jpg" width="711" height="auto" /></p></td>
  </tr>
  </table>
  <br />
  <table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><h2 style="text-align:center;font-weight:bold;">International Marketing<br />
BA in Marketing<br />
MOD001194 <br />
Assessment 1 – Presentation<br /> 
30% of the Final Mark<br>
</h2></td>
  </tr>
  </table>
  <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td  colspan="3">SID Number :'.$student_data[0]->san.'</td>
   
    <td  colspan="2">LS Number :'.$student_data[0]->ls_student_number.'</td>
  </tr>
  <tr>
    <td  colspan="5">Brand selected :</td>
  </tr>
  <tr>
    <td colspan="3">First Marker:'.Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name.'</td>
    <td>Suggested Mark: '.($student_data[0]->c1+$student_data[0]->c2+$student_data[0]->c3+$student_data[0]->c4+$student_data[0]->c5+$student_data[0]->c6).'%</td>
    <td>Agreed Mark: '.$student_data[0]->ageed_mark.' %</td>
  </tr>
  </table>
  <br />    <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td width="60%" align="center">Criteria</td>
    <td align="center">Comments</td>
    <td align="center">Marks %</td>
    <td align="center">Weight </td>
    <td align="center">Weighted Marks</td>
  </tr>
  <tr>
    <td><b>Range and use of secondary sources</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c1.'</td>
    <td align="center">0.1</td>
    <td>&nbsp;'.($student_data[0]->c1*.1).'</td>
  </tr>
  <tr>
    <td><b>Theoretical context –</b> how well has the candidate applied their analysis to the Keller model?</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c2.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c2*.2).'</td>
  </tr>
  <tr>
    <td><b>Brand context – </b>how well has the candidate applied their work to the selected brand?</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c3.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c3*.2).'</td>
  </tr>
  <tr>
    <td><b>Evaluation – </b> a higher level student will identify limitations of their data, identify where assumptions are subjective, say where data is not available, evaluate their findings, critique the model, etc.</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c4.'</td>
    <td align="center">0.1</td>
    <td>&nbsp;'.($student_data[0]->c4*.1).'</td>
  </tr>
  <tr>
    <td><b>Quality of presentation – </b>use of the slides to analyse the brand, variety / style, evidence of working on analysis (both demonstrate awareness / understanding of contents), structure / organisation</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c5.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c5*.2).'</td>
  </tr>
  <tr>
    <td><b>Communication of ideas – </b>logical storytelling, professionalism, presentation skills, clarity of communication and clear ideas.</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c6.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c6*.2).'</td>
  </tr>
  <tr>
    <td colspan="4">Weighted total</td>
    <td>&nbsp;'.$student_data[0]->m1.'</td>
  </tr>
  </table>
    <table width="100%" border="1" cellspacing="1" cellpadding="2">
    <br />
 
  <h3 style="text-align:left"> Overall Comment </h3>
  <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td height="120px;"></td>
  </tr>
  </table>
  <br /><br />
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">First Marker:'.Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name.'</td>
    <td colspan="2">Date: 30-07-2015</td>
  </tr>
 
</table>
<br />
<br />');
return $pdf->stream();
		}else{
			
			
			$headers = array(
    "Content-type"=>"text/html",
    "Content-Disposition"=>"attachment;Filename=myfile.doc"
);

$content = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table width="75%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td  colspan="5" ><p style="text-align:center"><img src="https://lsadmin.net/images/top_img.jpg" width="711" height="auto" /></p></td>
  </tr>
  </table>
  <br />
  <table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><h2 style="text-align:center;font-weight:bold;">International Marketing<br />
BA in Marketing<br />
MOD001194 <br />
Assessment 1 – Presentation<br /> 
30% of the Final Mark<br>
</h2></td>
  </tr>
  </table>
  <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td  colspan="3">SID Number :'.$student_data[0]->san.'</td>
   
    <td  colspan="2">LS Number :'.$student_data[0]->ls_student_number.'</td>
  </tr>
  <tr>
    <td  colspan="5">Brand selected :</td>
  </tr>
  <tr>
    <td colspan="3">First Marker:'.Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name.'</td>
    <td>Suggested Mark:</td>
    <td>Agreed Mark: '.$student_data[0]->ageed_mark.' %</td>
  </tr>
  </table>
  <br />    <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td width="60%" align="center">Criteria</td>
    <td align="center">Comments</td>
    <td align="center">Marks %</td>
    <td align="center">Weight </td>
    <td align="center">Weighted Marks</td>
  </tr>
  <tr>
    <td><b>Range and use of secondary sources</b></td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c1.'</td>
    <td align="center">0.1</td>
    <td>&nbsp;'.($student_data[0]->c1*.1).'</td>
  </tr>
  <tr>
    <td><b>Theoretical context –</b> how well has the candidate applied their analysis to the Keller model?</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c2.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c2*.2).'</td>
  </tr>
  <tr>
    <td><b>Brand context – </b>how well has the candidate applied their work to the selected brand?</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c3.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c3*.2).'</td>
  </tr>
  <tr>
    <td><b>Evaluation – </b> a higher level student will identify limitations of their data, identify where assumptions are subjective, say where data is not available, evaluate their findings, critique the model, etc.</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c4.'</td>
    <td align="center">0.1</td>
    <td>&nbsp;'.($student_data[0]->c4*.1).'</td>
  </tr>
  <tr>
    <td><b>Quality of presentation – </b>use of the slides to analyse the brand, variety / style, evidence of working on analysis (both demonstrate awareness / understanding of contents), structure / organisation</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c5.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c5*.2).'</td>
  </tr>
  <tr>
    <td><b>Communication of ideas – </b>logical storytelling, professionalism, presentation skills, clarity of communication and clear ideas.</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c6.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c6*.2).'</td>
  </tr>
  <tr>
    <td colspan="4">Weighted total</td>
    <td>&nbsp;'.(($student_data[0]->c1*.1)+($student_data[0]->c2*.2)+($student_data[0]->c3*.2)+($student_data[0]->c4*.1)+($student_data[0]->c5*.2)+($student_data[0]->c6*.2)).'</td>
  </tr>
  </table>
    <table width="100%" border="1" cellspacing="1" cellpadding="2">
    <br />
 
  <h3 style="text-align:left"> Overall Comment </h3>
  <br />
  <table width="100%" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td height="120px;"></td>
  </tr>
  </table>
  <br /><br />
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">First Marker:'.Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name.'</td>
    <td colspan="2">Date: 30-07-2015</td>
  </tr>
 
</table>
<br />
<br />
</body>
</html>';


return Response::make($content,200, $headers);
			
			
		}
		
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
