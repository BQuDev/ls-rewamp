<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Introduction-
aims or purpose of the report,very brief overview of the chosen corporation, final paragraph that outlines the next section of the report
</th>
<th>Theoretical/Conceptual Approach and Analysis-
Clear explanation of the theoretical or conceptual approach that is to be used, its relevance for the purpose.Include any debates about, or criticisms and weaknesses of, the approach.the materials are going to analyse, its source, and why it is relevant for this analysis.(Maximum 10 marks for each approach)

</th>
<th>Analysis-
specify the material to be analysed, its source, and why it is relevant for this particular analytical approach.For each analysis, systematically apply the approach and explanation of the candidate’s findings.(Maximum 20 marks for each analysis)
</th>
<th>Discussion and conclusion 
Discuss and compare and contrast the findings from the two analyses, including contradictory findings and what could account for them.
Relate the findings and discussion to the aims and purpose of the report, and specify any conclusions the candidate has reached.
</th>
<th>PPresentation and references
Meaningful title Use the Harvard referencing system for citing sources Followed guidance on report structure Appearance and written expression
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_smf_a_01','students.san','=','students_for_marks_smf_a_01.san')
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
<td>SMF</td>
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