<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Introduction - include an outline of the company,Their current position in the market,Clearly identified client problem, Implications for the business if the problem is not addressed</th>
<th>Situation analysis of the market - include a review of the market using suitable models (e.g. STEEPLE; SWOT McKinsey 7s, etc.) </th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_mc_a_01','students.san','=','students_for_marks_mc_a_01.san')
            ->select('students.san','students.ls_student_number','c1','c2','m1','m2','ageed_mark')
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
<td>MC</td>
<td>Element 01</td>
<td>{{ $student->c1 }}</td>
<td>{{ $student->c2 }}</td>
<td>{{ $student->m1 }}</td>
<td>{{ $student->m2 }}</td>
<td>{{ $student->ageed_mark }}</td>
 </tr>
 @endif
 @endforeach
</html>