<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Introduction (300 words)-
Describe the scope of the report.(FIT analysis of Coca-Cola, UK) brief introduction,current market position and strategy.Briefly introduce the beverage/ soft drink industry in UK outlining its history, current market position and strategy.Outline the structure of the report.
</th>
<th>TASK A -  Market Environmental Analysis (1000 words)-
evaluate conditions in the market environment that Coca-Cola occupies,  comprising of the micro environment and the wider macro environment in which Coca-Cola operates.Highlight the market environment’s critical success factors. 

</th>
<th>TASK B – Resources and Capability Analysis (1000 words)-
Using appropriate analytical tools, evaluate the internal environment of Coca-Cola, highlighting its threshold and unique resources, and its core capabilities/ competencies.
</th>
<th>TASK C – Strategic FIT Analysis (700 words)-
Using the analysis completed in Tasks A and B, evaluate the strategic FIT of Coca-Cola, highlighting how Coca-Cola’s strengths and weaknesses fit the opportunities and threats in its market environment.
</th>
<th>Presentation Skills (Harvard referencing, style of writing and use of language, word limit)-
should contain a title page, a table of contents an introduction and a main body.Sections and subsections should follow a logical order.Language should be appropriate.Sources should be properly cited and displayed in a reference list according to the Harvard System
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_sma_a_01','students.san','=','students_for_marks_sma_a_01.san')
            ->select('students.san','students.ls_student_number','c1','c2','c3','c4','c5','m1','m2','ageed_mark')
            ->where('students.ls_student_number','>',0)
            ->groupBy('students.san')
            ->get();

 
 ?>
 
 @foreach($students  as $student)
 @if($student->m1)
 <tr>
<td>{{ $student->san }}</td>
<td>{{ $student->ls_student_number }}</td>
<td>BA</td>
<td>SMA</td>
<td>Element 01</td>
<td>{{ $student->c1 }}</td>
<td>{{ $student->c2 }}</td>
<td>{{ $student->c3 }}</td>
<td>{{ $student->c4 }}</td>
<td>{{ $student->c5 }}</td>
<td>{{ $student->m1 }}</td>
<td>{{ $student->m2 }}</td>
<td>{{ $student->ageed_mark }}</td>
 </tr>
 @endif
 @endforeach
</html>