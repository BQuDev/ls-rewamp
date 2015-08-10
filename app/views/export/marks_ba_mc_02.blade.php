<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Presentation structure and overall affect</th>
<th>Presentation clarity and style</th>
<th>Suitable set of objectives,Production of appropriate strategy for the company which will enable the company to achieve the objectives. The strategy must use suitable models, Budget (forecast cash flow and profit and loss budgets to be provided for the project) </th>
<th>Understanding and explanation of content demonstrated</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_mc_a_02','students.san','=','students_for_marks_mc_a_02.san')
            ->select('students.san','students.ls_student_number','c1','c2','c3','c4','m1','m2','ageed_mark')
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
<td>Element 02</td>
<td>{{ $student->c1 }}</td>
<td>{{ $student->c2 }}</td>
<td>{{ $student->c3 }}</td>
<td>{{ $student->c4 }}</td>
<td>{{ $student->m1 }}</td>
<td>{{ $student->m2 }}</td>
<td>{{ $student->ageed_mark }}</td>
 </tr>
 @endif
 @endforeach
</html>