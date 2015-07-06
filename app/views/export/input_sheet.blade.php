<html>

<tr>
<th>SAN</th>
<th>LSM Student number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Test</th>
<th>Test Remark</th>
<th>Course</th>
<th>Course Remark</th>
<th>Retake</th>
<th>Retake Remark</th>
<th>Comments</th>
<th>Created By</th>
<th>Created / Updated at</th>
</tr>

<?php
$main_array = array();$sub_array = array();
?>

@foreach($student_module_marks_input as $data)
<?php
$tt = $data->san.'.'.($data->element -1);
?>
@if(array_get($main_array, $tt) != 'element')
<?php

$sub_array[($data->element -1)] = 'element';
$main_array[$data->san] = $sub_array;
?>
Log::info('SAN In: '.$data->san);
<tr>
<td>{{ $data->san }}</td>
<td>{{ $data->ls_student_number }}</td>
<td>{{ $courses[($modules[($module_element[($data->element -1)]->module_id -1)]->course_id - 1)]->name }}</td>
<td>{{ $modules[($module_element[($data->element -1)]->module_id -1)]->name }}</td>
<td>{{ $module_element[($data->element -1)]->name }}</td>
<td>{{ $data->test }}</td>
<td>{{ $data->test_remark }}</td>
<td>{{ $data->course }}</td>
<td>{{ $data->course_remark }}</td>
<td>{{ $data->retake }}</td>
<td>{{ $data->retake_remark }}</td>
<td>{{ $data->comments }}</td>
<td>{{ $users[($data->created_by-1)]->first_name.' '.$users[($data->created_by-1)]->last_name }}</td>
<td>{{ $data->created_at }}</td>
</tr>
@endif
@endforeach



</html>