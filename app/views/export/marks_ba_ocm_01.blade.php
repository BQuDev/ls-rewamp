<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>How and Why do middle managers support and resist strategic change?
Introduce strategic change and discuss ways of middle managers to support strategic change, Reasons for middle managers to support strategic change, ways of middle managers resist strategic change and reasons for middle managers to resist strategic change.
</th>
<th>Why do model of planned change not bring about cultural change?
Define and explain different change models used for change management. Discuss the reasons for the referred models are not addressing culture changes in organisations based on relevant literature sources.
</th>
<th>How do leadership behaviours positively and negatively impact upon employee commitment to organisational change?
Explain different types of leadership behaviours and its impact on organization change in terms of increasing or decreasing employee commitment resulting in negative or positive impacts
</th>
<th>Structure and format
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_ocm_a_01','students.san','=','students_for_marks_ocm_a_01.san')
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
<td>OCM</td>
<td>Element 01</td>
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