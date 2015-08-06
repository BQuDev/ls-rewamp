<html>

<tr>
<th>SAN</th>
<th>LSM Number</th>
<th>Course</th>
<th>Module</th>
<th>Element</th>
<th>Critically analyse the extent that the chosen brand’s marketing mix is standardised and/or adapted across international markets using the following elements of the marketing mix - Product,Price,Place, Promotion.Evidence of a range of theories </th>
<th>Required to discuss which IPT ‘best’ describes the internationalisation process that the chosen global brand has undertaken - Review of main IP theories,Discussion which ‘best’ applies’. This may include Born Global, Uppsala, stages etc.Analysis of advantages and disadvantages of the best IP theory selected</th>
<th>Presentation - Well structured, theory applied to the case, good range of references, Harvard Referencing System usage in citing references. </th>
<th>First Marker's Mark</th>
<th>Second Marker's Mark</th>
<th>Agreed Mark</th>
 </tr>
 
 
 <?php
 $students = DB::table('students')
            ->leftJoin('xxx','students.san','=','xxx.san')
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
<td>IM</td>
<td>Element 02</td>
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