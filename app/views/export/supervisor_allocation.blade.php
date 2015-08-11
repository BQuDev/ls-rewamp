<html>

<tr>
<th>SAN</th>
 <th>LSM Student number</th>
 <th>Student Name</th>
 <th>Supervisor Name</th>
</tr>



<?php 
	$students = DB::table('module_supervisor_allocation')->get();
 ?>
 @foreach($students as $student)
 <?php 
	
	$student1 = DB::table('students')->where('ls_student_number','=',$student->ls_student_number)->first();
	$supervisor = DB::table('module_supervisors')->where('id','=',$student->supervisor_id)->first();
 ?>
<tr>
<td>
@if($student1)
{{ $student1->san }}
@endif
</td>
<td>
@if($student1)
{{ $student1->ls_student_number }}
@endif
</td>
<td>
@if($student1)
{{ $student1->forename_1.' '.$student1->surname }}
@endif
</td>
<td>
@if($supervisor)
{{ $supervisor->name }}
@endif
</td>
</tr>
@endforeach
</html>