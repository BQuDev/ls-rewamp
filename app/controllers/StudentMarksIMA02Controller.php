<?php

class StudentMarksIMA02Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /studentmarksima01glanceds
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('student_marks_IM_A_02');
	}


    public function students_for_marks_IM_A_02(){
        //return Student::all();
        return DB::table('students')
            ->leftJoin('students_for_marks_im_a_02','students.san','=','students_for_marks_im_a_02.san')
            ->leftJoin('application_scj','students.san','=','application_scj.san')
            ->select('students.san','sample','scj_number','students.ls_student_number','students.forename_1','c1','c2','c3','m1','m2','ageed_mark')
            ->where('students.ls_student_number','>',0)
            ->groupBy('students.san')
            ->get();
    }

    public function save_marks_for_IM_A_02(){

    //return Input::all();

        $san               = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');
        $col               = Input::get('col');
        $val               = Input::get('val');
/*
        ;*/

        $has_row = DB::table('students_for_marks_im_a_02')->where('san','=',$san)->get();
        if($has_row){
			
            $mark_update = DB::table('students_for_marks_im_a_02')
                ->where('san', $san)
                ->update(array($col => $val));
				
			$row = DB::table('students_for_marks_im_a_02')->where('san','=',$san)->first();
			
			
			//Calculate marks
			
			 //print_r($row);
			if((($row->c1)>0)&&(($row->c2)>0)&&(($row->c3))){
				
				$mark1 = 0;
				$c1 = intval($row->c1) * .65;
				$c2 = intval($row->c2) * .3;
				$c3 = intval($row->c3) * .05;
				
				$mark1 = $c1+$c2+$c3;
				
				$mark2 = 0;
				
				$mark2 = (.95 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				
				
				$mark_update = DB::table('students_for_marks_im_a_02')
                ->where('san', $san)
                ->update(array('m1' => $mark1,'m2' => $mark2));
				return 1;
			}else{
				$mark_update = DB::table('students_for_marks_im_a_02')
                ->where('san', $san)
                ->update(array('m1' => null,'m2' => null));
			}
			
			
				
        }else{ 
			// If there are no row in 'students_marks_IM_a_01_glanced'
			$mark_update = new StudentMarksIMA02();
            $mark_update->san = $san;
            $mark_update->ls_student_number = $ls_student_number;
            $mark_update->$col = $val;
            $mark_update->save();
        }
    }
	
	
	public function excel_export(){
		
		return Excel::create('Mark Input Sheet', function($excel) {

			$excel->sheet('Mark Input Sheet', function($sheet) {

				$sheet->loadView('export.marks_ba_im_02');

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
		$date               = Input::get('d');
		//return Input::get('export_type');
			$student_data = DB::table('students_for_marks_im_a_02')
			->leftJoin('application_scj','students_for_marks_im_a_02.san','=','application_scj.san')
			->where('students_for_marks_im_a_02.san','=',$san)->get(); 
		if($student_data){
		if($export_type === 'pdf'){
			
			$pdf = App::make('dompdf');
			
		
			
			
$pdf->loadHTML('<table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
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
    <td  colspan="3">SID Number :'.$student_data[0]->scj_number.'</td>
   
    <td  colspan="2">LS Number :'.$student_data[0]->ls_student_number.'</td>
  </tr>
  <tr>
    <td  colspan="5">Brand selected :</td>
  </tr>
  <tr>
    <td colspan="3">First Marker:</td>
    <td>Suggested Mark: '.($student_data[0]->c1+$student_data[0]->c2+$student_data[0]->c3).'%</td>
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
    <td>critically analyse the extent that the chosen brand’s marketing mix is standardised and/or adapted across international markets using the following elements of the marketing mix - Product,Price,Place, Promotion.Evidence of a range of theories </td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c1.'</td>
    <td align="center">0.1</td>
    <td>&nbsp;'.($student_data[0]->c1*.1).'</td>
  </tr>
  <tr>
    <td>required to discuss which IPT ‘best’ describes the internationalisation process that the chosen global brand has undertaken - Review of main IP theories,Discussion which ‘best’ applies’. This may include Born Global, Uppsala, stages etc.Analysis of advantages and disadvantages of the best IP theory selected</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c2.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c2*.2).'</td>
  </tr>
  <tr>
    <td>Presentation - Well structured, theory applied to the case, good range of references, Harvard Referencing System usage in citing references.</td>
    <td>&nbsp;</td>
    <td>&nbsp;'.$student_data[0]->c3.'</td>
    <td align="center">0.2</td>
    <td>&nbsp;'.($student_data[0]->c3*.2).'</td>
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
    <td colspan="3">First Marker:</td>
    <td colspan="2">Date:</td>
  </tr>
 
</table>
<br />
<br />');
return $pdf->stream();
		}else{
			

			$headers = array(
    "Content-type"=>"application/msword",
    "Content-Disposition"=>"attachment;Filename=IM_".$student_data[0]->scj_number." & ".$student_data[0]->ls_student_number."_".Sentry::getUser()->first_name." ".Sentry::getUser()->last_name.".doc");

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
    <td colspan="5"><h2 style="text-align:center;">International Marketing<br />
BA in Marketing<br />
MOD001194 <br />
Assessment 2 - Report <br /> 
70% of the Final Mark<br>
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
	Candidates are required to critically analyse the extent that the chosen brand’s marketing mix is standardised and/or adapted across international markets using the following elements of the marketing mix. 
<br><br>
•	Product – Student analyses standardisation and adaptation in relation to a number of product related issues e.g. branding, design, usage, and positioning. 
<br><br>
•	Price – Evidence of analysis based on standardisation and adaptation in terms of pricing strategy(s). 
<br><br>
•	Place – Ability to analyse distribution, including channels, POS, and market entry in terms of standardisation and adaptation. 
<br><br>
•	Promotion – Student analyses adaptation and standardisation in relation to advertising; PR and other marketing communications tools. 
<br><br>
In concluding the answer, the candidate should include a 2-3 paragraph summary that discusses whether their chosen brand has adopted an appropriate strategy(s). Evidence of a range of theories and case studies to support answer. 

	</td>
      <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c1.'</td> <td align="center">0.65</td>
    <td>&nbsp;'.($student_data[0]->c1*.65).'</td>
   

  </tr>
  <tr>
    <td height="70">
	Candidates are required to discuss which Internationalisation Process Theory (IPT) ‘best’ describes the internationalisation process that the chosen global brand has undertaken. 
<br><br>
The answer should include: <br>
•	Review of main IP theories.<br>
•	Discussion which ‘best’ applies’. This may include Born Global, Uppsala, stages etc. <br>
•	Analysis of advantages and disadvantages of the best IP theory selected. <br>

</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c2.'</td><td align="center">0.30</td>
    <td>&nbsp;'.($student_data[0]->c2*.3).'</td>
    
  
  </tr>
  <tr>
    <td>Presentation – Well structured, theory applied to the case, good range of references, Harvard Referencing System usage in citing references. </td>
     <td>&nbsp;</td>
	 <td>&nbsp;'.$student_data[0]->c3.'</td><td align="center">0.05</td>
    <td>&nbsp;'.($student_data[0]->c3*.05).'</td>
    
   
  </tr>
  <tr>
    <td colspan="4"><b>Weighted total</b></td>
    <td>&nbsp;'.(($student_data[0]->c3*.65)+($student_data[0]->c2*.3)+($student_data[0]->c1*.05)).'</td>
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
