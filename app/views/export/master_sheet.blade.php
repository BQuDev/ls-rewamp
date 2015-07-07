<html>

<tr>
<th>SAN</th>
 <th>LSM Student number</th>
 <th>AMS Date</th>
 <th>Source</th>
 <th>Agent /LAP</th>
 <th>Admission Manager</th>
 <th>Title</th>
 <th>	Initial 1</th>
 <th>Initial 2</th>
 <th>Initial 3</th>
 <th>Forename 1</th>
 <th>Forename 2	</th>
 <th>Forename 3	</th>
 <th>Surname	</th>
 <th>Gender	</th>
 <th>Date of birth (dd/mm/yyyy)	</th>
 <th>Nationality	</th>
 <th>Passport number</th>
 <th>Term time - Address - street</th>
 <th>Term time - Address - Address 2</th> <!-- To-Do -->
 <th>Term time - Address - Town/City</th>
 <th>Term time - Address - Post code	</th>
 <th>Term time - Address - Country	</th>
 <th>Term time - Mobile</th>
 <th>Term time - Landline</th>
 <th>Permanent - Address line 1	</th>
 <th>Permanent - Address line 2	</th>
 <th>Permanent - Town/City	</th>
 <th>Permanent - Post code	</th>
 <th>Permanent - Country	</th>
 <th>Permanent - Telephone - mobile</th>
 <th>Country of origin - Telephone - Land line</th>
 <th>Email</th>
 <th>Alternative Email	</th>
 <th>Social Accounts - Facebook	</th>
 <th>Social Accounts - LinkedIn	</th>
 <th>Social Accounts - Twitter	</th>
 <th>Social Accounts - Other Social Media	</th>
 <th>Title	</th>
 <th>Forename	</th>
 <th>Surname		</th>
 <th>Telephone	</th>
 <th>Email</th>
 <th>Course Name	</th>
 <th>Top up / Advanced entry	</th>
 <th>Awarding body	</th>
 <th>Intake	Year	</th>
 <th>Intake</th>
 <th>Study mode	</th>
 <th>English language level</th>
 <th>Qualification 1	</th>
 <th>	Institutuion	</th>
 <th>	Start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)</th>
 <th>Grade	</th>
 <th>Qualification 2</th>
 <th>	Institutuion	</th>
 <th>	Start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)	</th>
 <th>	Grade	</th>
 <th>Qualification 3	</th>
 <th>	Institutuion	</th>
 <th>	Start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)	</th>
 <th>	Grade	</th>
 <th>Occupation 1	</th>
 <th>	Company Name - Address	</th>
  <th>	Duties and responsibilities	</th>
 <th>	start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)	</th>
 <th>	Curently working	</th>
 <th>Occupation 2	</th>
 <th>	Company Name - Address	</th> <th>	Duties and responsibilities	</th>
 <th>	start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)	</th>
 <th>	Curently working	</th>
 <th>Occupation 3	</th>
 <th>	Company Name - Address	</th> <th>	Duties and responsibilities	</th>
 <th>	start date (dd/mm/yyyy)	</th>
 <th>	end date (dd/mm/yyyy)	</th>
 <th>	Curently working	</th>
 <th>Total Fee</th>
 <th>Course fees</th>
 <th>Payment status</th>
<th>Deposit</th>
 <th>Date of payment	</th>
 <th>Method of payment	</th>
 <th>Installment 1	</th>
 <th>Date of payment	</th>
 <th>Method of payment	</th>
  <th>Installment 2	</th>
  <th>Date of payment	</th>
  <th>Method of payment	</th>
 <th>Installment 3	</th>
  <th>	Date of payment	</th>
  <th>Method of payment	</th>
 <th>Late admin fee	</th>
 <th>Late Fee	</th>
  <th>Application Status</th>
 <th>App received to Bqu date (dd/mm/yyyy)	</th>
 <th>App input by	</th>
 <th>App input date	</th>
  <th>App Validated by	</th>
  <th>App Validated date	</th>
 <th>App verified by</th>
 <th>App verified date (dd/mm/yyyy)	</th>
 <th>Supervisor	</th>
 <th>Notes</th>
 <th>Received any emails?</th>
 <th>Know about course structure</th>
 <th>How did you hear</th>
 <th>What do you want to achieve</th>
 <th>Student Comments</th>
 <th>BQu Comments</th>
 <th>Call type</th>
</tr>



@foreach( $students  as $student)
<tr>
<td>{{ $student->san }}</td>
<td>{{ $student->ls_student_number }}</td>
 <td>
 <?php
 $student_sources = DB::table('student_sources')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
 $ams_date = $student_sources->ams_date;
 $source = $student_sources->source;
 $agent_lap = $student_sources->agent_lap;
 $admission_manager = $student_sources->admission_manager;
 $student_details = DB::table('students')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
 ?>
 @if(intval( $ams_date)>0)
<?php
$ams_date = explode('-',$ams_date);
?>
{{ sprintf("%02d", $ams_date[0]).'/'.sprintf("%02d", $ams_date[1]).'/'.$ams_date[2] }}
@endif
</td>
 <td>
 @if(intval($source)>0) {{
ApplicationSource::getNameByID(intval($source)) }}
 @endif
 </td>
 <td>
 @if(intval($agent_lap) == 1000)
{{ $student_sources->agents_laps_other }}
 @elseif((intval($source) ==2)&(intval($agent_lap)>0))
 {{ ApplicationLap::getNameByID($agent_lap)  }}
 @elseif(intval($agent_lap)>0)
 {{ApplicationAgent::getNameByID($agent_lap) }}
 @endif
 </td>
 <td>
     @if(intval($admission_manager) == 1000)
    {{ $student_sources->admission_managers_other }}
    @elseif(intval($admission_manager) >0)
    {{ ApplicationAdmissionManager::getNameByID($admission_manager); }}
    @endif
 </td>
 <td>{{ $student_details->title }}</td>
 <td>{{ $student_details->initials_1 }}</td>
 <td>{{ $student_details->initials_2 }}</td>
 <td>{{ $student_details->initials_3 }}</td>
 <td>{{ $student_details->forename_1 }}</td>
 <td>{{ $student_details->forename_2 }}</td>
 <td>{{ $student_details->forename_3 }}</td>
 <td>{{ $student_details->surname }}</td>
 <td>{{ $student_details->gender }}</td>
 <td>
 @if(intval($student_details->date_of_birth)>0)
<?php
$date_of_birth = explode('-', $student_details->date_of_birth);
?>
{{  sprintf("%02d", $date_of_birth[0]).'/'. sprintf("%02d", $date_of_birth[1]).'/'.$date_of_birth[2] }}
@endif
 </td>
 <td>
 @if($student_details->nationality > 0)
{{ StaticNationality::getNameByID($student_details->nationality); }}
@endif
 </td>
 <td>{{ $student_details->passport; }}</td>
 <?php 
 $tt = StudentContactInformation::lastUKRecordBySAN($student->san);
 ?>
 <td>{{ $tt->address_1 }}</td>
 <td>{{ $tt->address_2 }}</td> <!-- To-Do -->
 <td>{{ $tt->city }}</td>
 <td>{{ $tt->post_code }}</td>
 <td>
 @if($tt->country >0)
{{ StaticCountry::getNameByID($tt->country); }}
@endif
 </td>
 <td>{{ $tt->mobile }}</td>
 <td>{{ $tt->landline }}</td>
  <?php 
 $contactInformation = StudentContactInformation::lastRecordBySAN($student->san);
 ?>
 <td>{{ $contactInformation->address_1 }}</td>
 <td>{{ $contactInformation->address_2 }}</td>
 <td>{{ $contactInformation->city }}</td>
 <td>{{ $contactInformation->post_code }}</td>
 <td> @if($contactInformation->country >0)
{{ StaticCountry::getNameByID($contactInformation->country); }}
@endif
</td>
 <td>{{ $contactInformation->mobile }}</td>
 <td>{{ $contactInformation->landline }}</td>
<?php
$studentContactInformationOnline = StudentContactInformationOnline::lastRecordBySAN($student->san);
?>
 <td>{{ $studentContactInformationOnline->email }}</td>
 <td>{{ $studentContactInformationOnline->alternative_email }}</td>
 <td>{{ $studentContactInformationOnline->facebook }}</td>
 <td>{{ $studentContactInformationOnline->linkedin }}</td>
 <td>{{ $studentContactInformationOnline->twitter }}</td>
 <td>{{ $studentContactInformationOnline->other_social }}</td>
 <?php
 $studentContactInformationKinDetail = StudentContactInformationKinDetail::lastRecordBySAN($student->san);
 ?>
 
 <td>{{ $studentContactInformationKinDetail->next_of_kin_title }}</td>
 <td>{{ $studentContactInformationKinDetail->next_of_kin_forename }}	</td>
 <td>{{ $studentContactInformationKinDetail->next_of_kin_surname }}		</td>
 <td>{{ $studentContactInformationKinDetail->next_of_kin_telephone }}	</td>
 <td>{{ $studentContactInformationKinDetail->next_of_kin_email }}</td>
  <?php
 $studentCourseEnrolment = StudentCourseEnrolment::lastRecordBySAN($student->san);
 ?>

 <td>@if($studentCourseEnrolment->course_name >0 ){{ ApplicationCourse::getNameByID($studentCourseEnrolment->course_name) }} @endif</td>
 <td>{{ $studentCourseEnrolment->course_level }}</td>
 <td>
 @if($studentCourseEnrolment->awarding_bod > 0)
 {{ ApplicationAwardingBody::getNameByID($studentCourseEnrolment->awarding_body) }}
 @endif
 </td>
 <td>{{ StaticYear::getNameByID(ApplicationIntake::getRowByID($studentCourseEnrolment->intake)->year) }}	</td>
 <td>{{ ApplicationIntake::getRowByID($studentCourseEnrolment->intake)->name }}</td>
 <td>{{ $studentCourseEnrolment->study_mode }}</td>
 <td>
 @if(StudentEnglishLangLevels::lastRecordBySAN($student->san)->english_language_level != 'null')
<?php
$english_language_level =StudentEnglishLangLevels::lastRecordBySAN($student->san)->english_language_level;
$english_language_level_export = '';
if(strpos($english_language_level,'CITY & GUILDS')!==false){
$english_language_level_export = $english_language_level_export.', CITY & GUILDS';
}
if(strpos($english_language_level,'IELTS')!==false){
$english_language_level_export = $english_language_level_export.', IELTS';
}
if(strpos($english_language_level,'ESOL')!==false){
$english_language_level_export = $english_language_level_export.', ESOL';
}
if(strpos($english_language_level,'Other')!==false){
$english_language_level_export = $english_language_level_export.', '.StudentEnglishLangLevels::lastRecordBySAN($student->san)->english_language_level_other;
}
$english_language_level_export= ltrim ($english_language_level_export, ',');

//$english_language_level = str_replace('"]]','"\']',$english_language_level);
?>
{{ $english_language_level_export }}
@endif
 </td>
 <td>
 <?php
 $studentEducationalQualification = StudentEducationalQualification::lastRecordBySAN($student->san);
 ?>
@if(intval($studentEducationalQualification->qualification_1) == 1000)

@elseif(intval($studentEducationalQualification->qualification_1) == 0)
{{ $studentEducationalQualification->qualification_other_1 }}
@elseif(intval($studentEducationalQualification->qualification_1) > 0)
{{ ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_1) }}
@endif	</td>
 <td>{{ $studentEducationalQualification->institution_1 }}</td>
 <td>
 @if(intval($studentEducationalQualification->qualification_start_date_1)>0)
<?php
$qualification_start_date = explode('-', $studentEducationalQualification->qualification_start_date_1);
?>
{{ sprintf("%02d", $qualification_start_date[0]).'/'.sprintf("%02d", $qualification_start_date[1]).'/'.$qualification_start_date[2] }}
@endif
 </td>
 <td>
 @if(intval($studentEducationalQualification->qualification_end_date_1)>0)
<?php
$qualification_end_date = explode('-', $studentEducationalQualification->qualification_end_date_1);
?>
{{ sprintf("%02d", $qualification_end_date[0]).'/'.sprintf("%02d", $qualification_end_date[1]).'/'.$qualification_end_date[2] }}
@endif
 </td>
 <td>{{ $studentEducationalQualification->qualification_grade_1; }}	</td>
 <td>
 
@if(intval($studentEducationalQualification->qualification_2) == 1000)

@elseif(intval($studentEducationalQualification->qualification_2) == 0)
{{ $studentEducationalQualification->qualification_other_2 }}
@elseif(intval($studentEducationalQualification->qualification_2) > 0)
{{ ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_2) }}
@endif	</td>
 <td>{{ $studentEducationalQualification->institution_2 }}</td>
 <td>
 @if(intval($studentEducationalQualification->qualification_start_date_2)>0)
<?php
$qualification_start_date = explode('-', $studentEducationalQualification->qualification_start_date_2);
?>
{{ sprintf("%02d", $qualification_start_date[0]).'/'.sprintf("%02d", $qualification_start_date[1]).'/'.$qualification_start_date[2] }}
@endif
 </td>
 <td>
 @if(intval($studentEducationalQualification->qualification_end_date_2)>0)
<?php
$qualification_end_date = explode('-', $studentEducationalQualification->qualification_end_date_2);
?>
{{ sprintf("%02d", $qualification_end_date[0]).'/'.sprintf("%02d", $qualification_end_date[1]).'/'.$qualification_end_date[2] }}
@endif
 </td>
 <td>{{ $studentEducationalQualification->qualification_grade_2; }}	</td>
  <td>
 
@if(intval($studentEducationalQualification->qualification_3) == 1000)

@elseif(intval($studentEducationalQualification->qualification_3) == 0)
{{ $studentEducationalQualification->qualification_other_3 }}
@elseif(intval($studentEducationalQualification->qualification_3) > 0)
{{ ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_3) }}
@endif	</td>
 <td>{{ $studentEducationalQualification->institution_3 }}</td>
 <td>
 @if(intval($studentEducationalQualification->qualification_start_date_3)>0)
<?php
$qualification_start_date = explode('-', $studentEducationalQualification->qualification_start_date_3);
?>
{{ sprintf("%02d", $qualification_start_date[0]).'/'.sprintf("%02d", $qualification_start_date[1]).'/'.$qualification_start_date[2] }}
@endif
 </td>
 <td>
 @if(intval($studentEducationalQualification->qualification_end_date_3)>0)
<?php
$qualification_end_date = explode('-', $studentEducationalQualification->qualification_end_date_3);
?>
{{ sprintf("%02d", $qualification_end_date[0]).'/'.sprintf("%02d", $qualification_end_date[1]).'/'.$qualification_end_date[2] }}
@endif
 </td>
 <td>{{ $studentEducationalQualification->qualification_grade_3; }}	</td>
 
 
 
 <td>
 <?php
$studentWorkExperiences = StudentWorkExperience::lastRecordBySAN($student->san);
?>
 
 {{ $studentWorkExperiences->occupation_1 }}</td>
 <td>	{{ $studentWorkExperiences->company_name_1 }}</td>
  <td>	{{ $studentWorkExperiences->main_duties_1 }}	</td>
 <td>
@if(intval($studentWorkExperiences->occupation_start_date_1)>0)
<?php
$occupation_start_date = explode('-', $studentWorkExperiences->occupation_start_date_1);
?>
{{ sprintf("%02d", $occupation_start_date[0]).'/'.sprintf("%02d", $occupation_start_date[1]).'/'.$occupation_start_date[2] }}
@endif
</td>
 <td>
 @if(intval($studentWorkExperiences->occupation_end_date_1)>0)
<?php
$occupation_end_date = explode('-', $studentWorkExperiences->occupation_end_date_1);
?>
{{ sprintf("%02d", $occupation_end_date[0]).'/'.sprintf("%02d", $occupation_end_date[1]).'/'.$occupation_end_date[2] }}
@endif
 </td>
 <td>
 @if($studentWorkExperiences->currently_working_1 == 'Yes')
{{ $studentWorkExperiences->currently_working_1; }}
@endif

	</td>
 <td>{{ $studentWorkExperiences->occupation_2 }}</td>
 <td>	{{ $studentWorkExperiences->company_name_2 }}</td>
  <td>	{{ $studentWorkExperiences->main_duties_2 }}	</td>
 <td>
@if(intval($studentWorkExperiences->occupation_start_date_2)>0)
<?php
$occupation_start_date = explode('-', $studentWorkExperiences->occupation_start_date_2);
?>
{{ sprintf("%02d", $occupation_start_date[0]).'/'.sprintf("%02d", $occupation_start_date[1]).'/'.$occupation_start_date[2] }}
@endif
</td>
 <td>
 @if(intval($studentWorkExperiences->occupation_end_date_2)>0)
<?php
$occupation_end_date = explode('-', $studentWorkExperiences->occupation_end_date_2);
?>
{{ sprintf("%02d", $occupation_end_date[0]).'/'.sprintf("%02d", $occupation_end_date[1]).'/'.$occupation_end_date[2] }}
@endif
 </td>
 <td>
 @if($studentWorkExperiences->currently_working_2 == 'Yes')
{{ $studentWorkExperiences->currently_working_2; }}
@endif

	</td>
 <td>{{ $studentWorkExperiences->occupation_3 }}</td>
 <td>	{{ $studentWorkExperiences->company_name_3 }}</td>
  <td>	{{ $studentWorkExperiences->main_duties_3 }}	</td>
 <td>
@if(intval($studentWorkExperiences->occupation_start_date_3)>0)
<?php
$occupation_start_date = explode('-', $studentWorkExperiences->occupation_start_date_3);
?>
{{ sprintf("%02d", $occupation_start_date[0]).'/'.sprintf("%02d", $occupation_start_date[1]).'/'.$occupation_start_date[2] }}
@endif
</td>
 <td>
 @if(intval($studentWorkExperiences->occupation_end_date_3)>0)
<?php
$occupation_end_date = explode('-', $studentWorkExperiences->occupation_end_date_3);
?>
{{ sprintf("%02d", $occupation_end_date[0]).'/'.sprintf("%02d", $occupation_end_date[1]).'/'.$occupation_end_date[2] }}
@endif
 </td>
 <td>
 @if($studentWorkExperiences->currently_working_3 == 'Yes')
{{ $studentWorkExperiences->currently_working_3; }}
@endif

	</td>
 
 <td>
 <?php
 $student_payment_info_metadatas = DB::table('student_payment_info_metadatas')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
 ?>
 @if($student_payment_info_metadatas->total_fee > 0)
         {{ $student_payment_info_metadatas->total_fee }}
         @endif</td>
 <td>
 @if($student_payment_info_metadatas->course_fees != 'null')
<?php
$payment_status_export = '';
if(strpos($student_payment_info_metadatas->course_fees,'Self funded')!==false){
$payment_status_export = $payment_status_export.', Self funded';
}
if(strpos($student_payment_info_metadatas->course_fees,'Sponsored by the Company')!==false){
$payment_status_export = $payment_status_export.', Sponsored by the Company';
}
if(strpos($student_payment_info_metadatas->course_fees,'Bank Loan')!==false){
$payment_status_export = $payment_status_export.', Bank Loan';
}
$payment_status_export= ltrim ($payment_status_export, ',');


?>
{{ $payment_status_export }}
@endif
 </td>
 <td>
 @if($student_payment_info_metadatas->payment_status != 'null')
<?php
$payment_status_export = '';
if(strpos($student_payment_info_metadatas->payment_status,'Paid in full')!==false){
$payment_status_export = $payment_status_export.', Paid in full';
}
if(strpos($student_payment_info_metadatas->payment_status,'Unpaid')!==false){
$payment_status_export = $payment_status_export.', Unpaid';
}
if(strpos($student_payment_info_metadatas->payment_status,'Deposit paid')!==false){
$payment_status_export = $payment_status_export.', Deposit paid';
}
$payment_status_export= ltrim ($payment_status_export, ',');


?>
{{ $payment_status_export }}
@endif
 </td>
 
<td>
 <?php
$studentPaymentInfo = StudentPaymentInfo::lastRecordBySAN($student->san);
?>
{{ $studentPaymentInfo->deposit }}</td>
 <td>
 @if(intval($studentPaymentInfo->deposit_date)>0)
<?php
$studentPaymentInfoDate = explode('-', $studentPaymentInfo->deposit_date);
?>
{{ sprintf("%02d", $studentPaymentInfoDate[0]).'/'.sprintf("%02d", $studentPaymentInfoDate[1]).'/'.$studentPaymentInfoDate[2] }}
@endif
 </td>
 <td>
 @if(intval($studentPaymentInfo->deposit_method)==1000)

@elseif(intval($studentPaymentInfo->deposit_method)>0)
{{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->deposit_method); }}
@endif
</td>
 <td>{{ $studentPaymentInfo->installment_1 }}</td>
 <td>
 @if(intval($studentPaymentInfo->installment_1_date)>0)
<?php
$studentPaymentInfoDate = explode('-', $studentPaymentInfo->installment_1_date);
?>
{{ sprintf("%02d", $studentPaymentInfoDate[0]).'/'.sprintf("%02d", $studentPaymentInfoDate[1]).'/'.$studentPaymentInfoDate[2] }}
@endif
 </td>
 <td>
  @if(intval($studentPaymentInfo->installment_1_method)==1000)

@elseif(intval($studentPaymentInfo->installment_1_method)>0)
{{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_1_method); }}
@endif
 </td>
 <td>{{ $studentPaymentInfo->installment_2 }}</td>
 <td>
 @if(intval($studentPaymentInfo->installment_2_date)>0)
<?php
$studentPaymentInfoDate = explode('-', $studentPaymentInfo->installment_2_date);
?>
{{ sprintf("%02d", $studentPaymentInfoDate[0]).'/'.sprintf("%02d", $studentPaymentInfoDate[1]).'/'.$studentPaymentInfoDate[2] }}
@endif
 </td>
 <td>
  @if(intval($studentPaymentInfo->installment_2_method)==1000)

@elseif(intval($studentPaymentInfo->installment_2_method)>0)
{{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_2_method); }}
@endif
 </td>
  <td>{{ $studentPaymentInfo->installment_3 }}</td>
 <td>
 @if(intval($studentPaymentInfo->installment_3_date)>0)
<?php
$studentPaymentInfoDate = explode('-', $studentPaymentInfo->installment_3_date);
?>
{{ sprintf("%02d", $studentPaymentInfoDate[0]).'/'.sprintf("%02d", $studentPaymentInfoDate[1]).'/'.$studentPaymentInfoDate[2] }}
@endif
 </td>
 <td>
  @if(intval($studentPaymentInfo->installment_3_method)==1000)

@elseif(intval($studentPaymentInfo->installment_3_method)>0)
{{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_3_method); }}
@endif
 </td>
 <td> @if($student_payment_info_metadatas->late_admin_fee > 0)
         {{ $student_payment_info_metadatas->late_admin_fee }}
         @endif	</td>
 <td> @if($student_payment_info_metadatas->late_fee > 0)
         {{ $student_payment_info_metadatas->late_fee }}
         @endif	</td>


  <td>
  <?php
  $ApplicationStatus = StudentApplicationStatus::lastRecordBySAN($student->san);
  //$ApplicationStatus = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->firstOrFail();
  ?>
  @if($ApplicationStatus != null)
 {{ StaticDataStatus::getNameById($ApplicationStatus->status)  }}
 @endif
 </td>
 <td>
 
  <?php
 $studentBquData = StudentBquData::lastRecordBySAN($student->san);
$application_received_date = explode('-', $studentBquData->application_received_date);
?>
 
 @if(intval( $studentBquData->application_received_date)>0)

{{ sprintf("%02d", $application_received_date[0]).'/'.sprintf("%02d", $application_received_date[1]).'/'.$application_received_date[2] }}
@endif
 
 </td>

 <td>
 <?php
 //$studentApplicationBasicStatus = StudentApplicationStatus::insertRecordBySAN($student->san);
 $studentApplicationBasicStatus = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
 if($studentApplicationBasicStatus != null)
 $created_at = explode('-', $studentApplicationBasicStatus->created_at);
 ?>

 {{ User::getFirstNameByID(intval($studentApplicationBasicStatus->created_by)) }}

	</td>
 <td>
 @if(($studentApplicationBasicStatus != null)&(intval( $created_at)>0))

{{ sprintf("%02d", $created_at[0]).'/'.sprintf("%02d", $created_at[1]).'/'.$created_at[2] }}
@endif
	</td>

 <td>

<?php
$studentApplicationValidateStatus = StudentApplicationStatus::validatedRecordBySAN($student->san);
?>

 	</td>

 <td>

 	</td>

 <td>

 	</td>
 <td>


 </td>
 <td>
 @if(StudentBquData::lastRecordBySAN($student->san)->supervisor ==1000)
     @elseif(StudentBquData::lastRecordBySAN($student->san)->supervisor >0)
     {{ User::getFirstNameByID(StudentBquData::lastRecordBySAN($student->san)->supervisor); }}
     @endif
     	</td>
 <td>{{ StudentBquData::lastRecordBySAN($student->san)->notes; }}</td>
 <td>
 <?php
 $student_verification_data = DB::table('student_bqu_verification_data')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
 ?>
@if( $student_verification_data != null)
 {{ $student_verification_data->mails_from_lsm }}
 @endif
 </td>

 <td>@if( $student_verification_data != null){{ $student_verification_data->know_structure_of_the_course }}
 @endif
 </td>
 <td>
 @if( $student_verification_data != null)
  @if($student_verification_data->how_did_you_hear != 'null')
 <?php
 $how_did_you_hear = '';
 if(strpos($student_verification_data->how_did_you_hear,'Agent')!==false){
 $how_did_you_hear = $how_did_you_hear.', Agent';
 }
 if(strpos($student_verification_data->how_did_you_hear,'LAP centre')!==false){
 $how_did_you_hear = $how_did_you_hear.', LAP centre';
 }
 if(strpos($student_verification_data->how_did_you_hear,'A friend / colleague or relative')!==false){
 $how_did_you_hear = $how_did_you_hear.', A friend / colleague or relative';
 }
 if(strpos($student_verification_data->how_did_you_hear,'Internet')!==false){
 $how_did_you_hear = $how_did_you_hear.', Internet';
 }
 if(strlen($student_verification_data->how_did_you_hear_other)>0){
 $how_did_you_hear = $how_did_you_hear.', '.$student_verification_data->how_did_you_hear_other;
 }
 $how_did_you_hear= ltrim ($how_did_you_hear, ',');
 ?>
 {{ $how_did_you_hear }}
 @endif
 @endif
 </td>
 <td>@if( $student_verification_data != null)

   @if($student_verification_data->what_do_you_want_to_achieve != 'null')
  <?php
  $what_do_you_want_to_achieve = '';
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To obtain knowledge / enhance skills')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To obtain knowledge / enhance skills';
  }
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To qualify for a promotion')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To qualify for a promotion';
  }
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To apply for a new job')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To apply for a new job';
  }
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To switch professions')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To switch professions';
  }
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To start up a company')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To start up a company';
  }
  if(strpos($student_verification_data->what_do_you_want_to_achieve,'To join the family business')!==false){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', To join the family business';
  }
  if(strlen($student_verification_data->what_do_you_want_to_achieve_other)>0){
  $what_do_you_want_to_achieve = $what_do_you_want_to_achieve.', '.$student_verification_data->what_do_you_want_to_achieve_other;
  }
  $what_do_you_want_to_achieve= ltrim ($what_do_you_want_to_achieve, ',');
  ?>
  {{ $what_do_you_want_to_achieve }}

  @endif

 @endif
 </td>
 <td>@if( $student_verification_data != null){{ $student_verification_data->student_comments }}
 @endif
 </td>
 <td>@if( $student_verification_data != null){{ $student_verification_data->bqu_comments }}
 @endif
 </td>
 <td>@if( $student_verification_data != null){{ $student_verification_data->call_type }}
 @endif
 </td>
</tr>
@endforeach
</html>
