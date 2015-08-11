<?php

class StudentMarksRMBMMBAA02Controller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /studentmarksima01glanceds
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('student_marks_RMBM_MBA_A_02');
	}


    public function students_for_marks_rmbm_mba_a_02(){
        //return Student::all();
        return DB::table('students')
            ->leftJoin('students_for_marks_rmbm_mba_a_02','students.san','=','students_for_marks_rmbm_mba_a_02.san')
            ->leftJoin('application_scj','students.san','=','application_scj.san')
            ->select('students.san','sample','scj_number','students.ls_student_number','students.forename_1','c1','c2','c3','c4','m1','m2','ageed_mark')
            ->where('students.ls_student_number','>',0)
            ->groupBy('students.san')
            ->get();
    }

    public function save_marks_for_RMBM_MBA_A_02(){

    //return Input::all();

        $san               = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');
        $col               = Input::get('col');
        $val               = Input::get('val');
/*
        ;*/

        $has_row = DB::table('students_for_marks_rmbm_mba_a_02')->where('san','=',$san)->get();
        if($has_row){
			
            $mark_update = DB::table('students_for_marks_rmbm_mba_a_02')
                ->where('san', $san)
                ->update(array($col => $val));
				
			$row = DB::table('students_for_marks_rmbm_mba_a_02')->where('san','=',$san)->first();
			
			
			//Calculate marks
			
			 //print_r($row);
			if((($row->c1)>0)&&(($row->c2)>0)&&(($row->c3)>0)){
				
				$mark1 = 0;
				$c1 = intval($row->c1) * .2;
				$c2 = intval($row->c2) * .2;
				$c3 = intval($row->c3) * .6;
				$c4 = intval($row->c4) * .6;
				
				$mark1 = $c1+$c2+$c3+$c4;
				
				$mark2 = 0;
				
				$mark2 = (.95 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				if($mark2 > 100)$mark2 = (.9 * $mark1) + $mark1*(rand( 0,6 )/100);
				
				
				$mark_update = DB::table('students_for_marks_rmbm_mba_a_02')
                ->where('san', $san)
                ->update(array('m1' => $mark1,'m2' => $mark2));
				return 1;
			}else{
				$mark_update = DB::table('students_for_marks_rmbm_mba_a_02')
                ->where('san', $san)
                ->update(array('m1' => null,'m2' => null));
			}
			
			
				
        }else{ 
			// If there are no row in 'students_marks_IM_a_02_glanced'
			$mark_update = new StudentMarksRMBMMBAA02();
            $mark_update->san = $san;
            $mark_update->ls_student_number = $ls_student_number;
            $mark_update->$col = $val;
            $mark_update->save();
        }
    }
	
	
	public function excel_export(){
		
		return Excel::create('Mark Input Sheet', function($excel) {

			$excel->sheet('Mark Input Sheet', function($sheet) {

				$sheet->loadView('export.marks_mba_rmbm_02');

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
			$student_data = DB::table('students_for_marks_rmbm_mba_a_02')
			->leftJoin('application_scj','students_for_marks_rmbm_mba_a_02.san','=','application_scj.san')
			->where('students_for_marks_rmbm_mba_a_02.san','=',$san)->get(); 
		if($student_data){

			

			$headers = array(
    "Content-type"=>"application/msword",
    "Content-Disposition"=>"attachment;Filename=rmbm_".$student_data[0]->scj_number." & ".$student_data[0]->ls_student_number."_".Sentry::getUser()->first_name." ".Sentry::getUser()->last_name.".doc");

$content = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<table width="100%" align="center" border="1" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" bgcolor="#FEFFFf" ><p style="text-align:center"><img src="http://lsadmin.net/images/top_img.jpg" width="100%" height="auto" /></p></td>
  </tr>
  </table>
  <br />
  <table width="100%" align="center" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><h2 style="text-align:center;">Research Methods for Business and Management <br />
MA/MBA<br />
MOD001105<br />
RMBM<br />
Introduction to the Research Proposal<br /> 
Part ‘B’<br /> 
80% of the Overall Module Grade<br>
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
	<strong>Introduction:
<br>
The introduction needs to inform reader about the research aims, objectives and research questions.
  </strong><br>You have to introduce the topic and clarify the significance of what you are trying to present. In addition, in this section you have to present the: 
- Research aims <br>
- Research objectives <br>
- Research questions <br>

Please, provide references. Give academic information.

	</td>
      <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c1.'</td> <td align="center">0.125</td>
    <td>&nbsp;'.($student_data[0]->c1*.125).'</td>
  </tr>
  <tr>
    <td height="70">
	<strong>Literature Review :

Synthesis and analysis of initial literature on the topic 
</strong>
 <br>
This section will demonstrate your knowledge of the literature and make a critical link with the research question to be investigated. Students are expected to critically review at least 6 sources to underpin the study. The literature should mostly rely on published academic journal articles in the research area. This critical activity should produce a conceptual framework.
 
 <br>

</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c2.'</td><td align="center">0.25</td>
    <td>&nbsp;'.($student_data[0]->c2*.25).'</td>
  </tr>
  <tr>
    <td height="70">
	<strong>Research Design and Methodology: 
<br>
Appropriateness and rigour of research methods 
</strong>
This section should provide a detailed rationale of how he/she intends to achieve research objectives and framework. You are expected to address the following areas: 
<br>
-Type of investigation: Explain clearly whether your research can be classified as an exploratory, descriptive or hypothesis testing study. Refer to the lecture notes and textbook for details on each type. 
<br>
-Data collection method: Explain how you are going to collect the data (e.g. postal questionnaire, telephone interview, focus group, etc) and why this fits the purpose of your research. 
<br>
-Sampling method: Explain whether you plan to use a probability or non-probability sampling design and the specific sampling technique. The study participants should be able to offer the right type of information to enable you address the research problem. 
<br>
-Accessibility issues: what accessibility issues are you likely to encounter when you collect the data? How are you going to manage the accessibility issues? 
<br>
-Ethical issues: You must discuss any ethical issues that are relevant to your research topic, participants, and method. Discuss how you are going to deal with the ethical issues. 
<br>
-Data analysis plan: how you intend to analyse the data you will collect? This section must be consistent with the previous section on data collection method and must be mindful of the nature of the data collected, whether this is quantitative or qualitative. 
<br>
-Research limitations: Define the limitations of the study that you believe you may encounter and could be affect the quality, scope, or value of the research. 
<br>
</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c3.'</td><td align="center">0.4</td>
    <td>&nbsp;'.($student_data[0]->c3*.5).'</td>
  </tr>
  <tr>
    <td height="70">
	<strong>Time Table 
</strong>

<br>
Does the student provides a rationale time table?

<br>
You may use a Gantt chart or any other method to show how you will use your available time to complete your proposed research. This will provide an indication of the viability of the proposal. You will need to justify your plan.

<br>
<strong>References</strong>

<br>
Do references correctly applied?

<br>
The reference list at this stage need not be lengthy, only sufficient to inform your proposal. The list must include all the sources that were cited and consulted in writing the research proposal. You must use the Harvard Style of referencing.
<br>
</td>
    <td>&nbsp;</td>  <td>&nbsp;'.$student_data[0]->c3.'</td><td align="center">0.125</td>
    <td>&nbsp;'.($student_data[0]->c3*.125).'</td>
  </tr>
  <tr>
    <td colspan="4"><b>References</b>You are required to identify previously conducted research in the area that you are focusing on. These sources need to be referred within your rationale section. Make it clear that you know what has been done in your area in the past and where your research will fit in. 
	 <br>
	 <b>Format and Presentation </b><br>
	 -	You have to make your introduction appealing. Simplify and include only relevant information. Be attentive to the structure and placement of your content. Write clearly. Make sure your introduction includes complete sentences and accurate spelling and punctuation.
	</td>
    <td>&nbsp;'.(($student_data[0]->c1*.125)+($student_data[0]->c2*.25)+($student_data[0]->c3*.5)+($student_data[0]->c4*.125)).'</td>
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
        //return View::make('student_marks_IM_A_02_glanced');
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
