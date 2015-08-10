<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>analyse each element of the retail mix - Merchandise range and assortment,Retail communications, Store layout, design and visual merchandising, Customer service and facilitating services, Formats and locations, Pricing strategy and tactics
</th>
<th>Assess the extent to which the retail mix provides a basis for sustainable competitive advantage
</th>
<th>Evaluate the challenges to continued international growth that will be faced by chosen retailer.for example, PEST factors, the competitive context, growth objectives, growth strategy, market selection and entry methods, emerging retailing trends.
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_rm_a_01','students.san','=','students_for_marks_rm_a_01.san')
            ->select('students.san','students.ls_student_number','c1','c2','c3','m1','m2','ageed_mark')
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
<td>{{ $student->m1 }}</td>
<td>{{ $student->m2 }}</td>
<td>{{ $student->ageed_mark }}</td>
 </tr>
 @endif
 @endforeach
</html>