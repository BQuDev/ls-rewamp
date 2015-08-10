<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Range and use of secondary sources
</th>
<th>Theoretical context
how well has applied the analysis to the Keller model?
</th>
<th>Brand context 
how well has applied work to the selected brand?
 </th>
<th>Evaluation
limitations of their data, identify where assumptions are subjective, say where data is not available, evaluate their findings, critique the model, etc.
</th>
<th>Quality of presentation
use of the slides to analyse the brand, variety / style, evidence of working on analysis (both demonstrate awareness / understanding of contents), structure / organisation
</th>
<th>Communication of ideas 
logical storytelling, professionalism, presentation skills, clarity of communication and clear ideas
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_im_a_01','students.san','=','students_for_marks_im_a_01.san')
            ->select('students.san','students.ls_student_number','c1','c2','c3','c4','c5','c6','m1','m2','ageed_mark')
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
<td>IM</td>
<td>Element 01</td>
<td>{{ $student->c1 }}</td>
<td>{{ $student->c2 }}</td>
<td>{{ $student->c3 }}</td>
<td>{{ $student->c4 }}</td>
<td>{{ $student->c5 }}</td>
<td>{{ $student->c6 }}</td>
<td>{{ $student->m1 }}</td>
<td>{{ $student->m2 }}</td>
<td>{{ $student->ageed_mark }}</td>
 </tr>
 @endif
 @endforeach
</html>