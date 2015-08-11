<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Introduction-
abstract adequate?a clear purpose and rationale for the study?Clear set of objectives / research questions?
</th>
<th>Research Design & Methodology

Was research design and methodology discussed? Was the approach appropriate?

</th>
<th>Use of Literature / Sources 
Was the range suitable and adequate? Has a critical review of the literature been adopted?
</th>
<th>Results, analysis and interpretation of data 
Has the data been accurately presented and analysed or are the findings merely a description? Appropriate theory applied? Has attempted to interpret their findings?
</th>
<th>Conclusion & recommendations
Are conclusions reasoned? Do they correspond with the objective(s) of the dissertation?
</th>
<th>Presentation
structure & language, Harvard Referencing correctly applied, appropriate use of tables/diagrams
</th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('students_for_marks_pmp_ma_a_01','students.san','=','students_for_marks_pmp_ma_a_01.san')
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
<td>SMF</td>
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