@extends('layouts.main')
@section('content')
<div class="row" style="min-height: 50px;"></div>
<div class="row">
   <div class="col-sm-12">
      {{ Form::open(array('url' =>URL::to("/").'/students',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley')) }}
      
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">{{ Form::label('san', 'Student Application Number (SAN)', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->san }} </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('ls_student_number', 'LS Student Number', array('class' => 'control-label'));  }}</td>
    <td><span id="ls_student_number_temp">{{ $student->ls_student_number }}</span></td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('app_date', 'App Date', array('class' => 'control-label'));  }}</td>
    <td> {{ $studentSource->app_date }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('ams_date', 'AMS Date', array('class' => ' control-label'));  }}</td>
    <td> {{ $studentSource->ams_date }}</td>
  </tr>
     </table>

     
      <section class="panel panel-default">
        <header class="panel-heading font-bold">AGENT/ ADMISSION MANAGER INFORMATION</header>
         <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right"> {{ Form::label('information_source', 'Information Source', array('class' => 'control-label'));  }}</td>
    <td>

    @if(intval($studentSource->source)>0)
    {{ ApplicationSource::getNameByID(intval($studentSource->source)) }}
     @endif

    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('admission_manager', 'Admission manager', array('class' => 'control-label'));  }}</td>
    <td>
        @if(intval($studentSource->admission_manager) == 1000)
        {{ $studentSource->admission_managers_other }}
        @elseif(intval($studentSource->admission_manager) >0)
        {{ ApplicationAdmissionManager::getNameByID($studentSource->admission_manager); }}
        @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'control-label'));  }}</td>
    <td>
    @if(intval($studentSource->agent_lap) == 1000)
    {{ $studentSource->agents_laps_other }}
     @elseif((intval($studentSource->source) == 2)&(intval($studentSource->agent_lap)>0))
     {{ ApplicationLap::getNameByID($studentSource->agent_lap)  }}
     @elseif(intval($studentSource->agent_lap)>0)
     {{ApplicationAgent::getNameByID($studentSource->agent_lap) }}
     @endif
    </td>
  </tr>
</table>

        </div>
     </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">PERSONAL DATA</header>
         <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">  <label class="control-label">Title</label></td>
    <td> {{ $student->title }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('initials', 'Initials', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->initials_1 }}&nbsp;{{ $student->initials_2 }}&nbsp;{{ $student->initials_3 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('forename_1', 'Forename 1', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->forename_1 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('forename_2', 'Forename 2', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->forename_2 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('forename_3', 'Forename 3', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->forename_3 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('surname', 'Surname', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->surname }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Gender</label></td>
    <td> {{ $student->gender }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('date_of_birth', 'Date of birth', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->date_of_birth }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('nationality', 'Nationality', array('class' => 'control-label'));  }}</td>
    <td>
    @if($student->nationality > 0)
    {{ StaticNationality::getNameByID($student->nationality); }}
    @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('passport', 'Passport number', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->passport }}</td>
  </tr>
</table>

         
          
              
           
           
        </div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">CONTACT INFORMATION</header>
         <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Term time</div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
         <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">  <label class="control-label">Address line 1</label></td>
    <td> {{ $ttStudentContactInformation->address_1 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Address line 2</label></td>
    <td>{{ $ttStudentContactInformation->address_2 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">  <label class="control-label">Town/City</label></td>
    <td>{{ $ttStudentContactInformation->city }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Post code</label></td>
    <td>{{ $ttStudentContactInformation->post_code }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Country</label></td>
    <td>
    @if($ttStudentContactInformation->country >0)
    {{ StaticCountry::getNameByID($ttStudentContactInformation->country); }}
    @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Mobile</label></td>
    <td>{{ $ttStudentContactInformation->mobile }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Landline</label></td>
    <td> {{ $ttStudentContactInformation->landline }}</td>
  </tr>

</table>

 
        <!-- Country of origin -->
        <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Permanent</div>
         <div class="line line-dashed b-b line-lg pull-in"></div>
         <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">  <label class="control-label">Address line 1</label></td>
    <td> {{ $studentContactInformation->address_1 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Address line 2</label></td>
    <td>{{ $studentContactInformation->address_2 }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Town/City</label></td>
    <td>{{ $studentContactInformation->city }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Post code</label></td>
    <td>{{ $studentContactInformation->post_code }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Country</label></td>
    <td>
        @if($studentContactInformation->country >0)
        {{ StaticCountry::getNameByID($studentContactInformation->country); }}
        @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Mobile</label></td>
    <td> {{ $studentContactInformation->mobile }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Landline</label></td>
    <td> {{ $studentContactInformation->landline }}</td>
  </tr>
  <tr>
    <td align="right"> {{ Form::label('email', 'Email ', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentContactInformationOnline->email }}</td>
  </tr>
  <tr>
    <td align="right"> {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'control-label'));  }}</td>
    <td>  {{ $studentContactInformationOnline->alternative_email }}</td>
  </tr>
  <tr>
    <td align="right">  {{ Form::label('forename_3', 'Facebook', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentContactInformationOnline->facebook }}</td>
  </tr>
  <tr>
    <td align="right">{{ Form::label('forename_3', 'LinkedIn', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentContactInformationOnline->linkedin }}</td>
  </tr>
  <tr>
    <td align="right">{{ Form::label('forename_3', 'Twitter', array('class' => 'control-label'));  }}</td>
    <td> {{ $studentContactInformationOnline->twitter}}</td>
  </tr>
  <tr>
    <td align="right"> {{ Form::label('forename_3', 'Other Social', array('class' => 'control-label'));  }}</td>
    <td>  {{ $studentContactInformationOnline->other_social }}</td>
  </tr>
         </table>

          
        </div>
         <div class="line line-dashed b-b line-lg pull-in"></div></div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">Next of Kin Details</header>
         <div class="panel-body">
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right"> <label class="control-label">Title</label></td>
    <td>{{ $student_contact_information_kin_detailes->next_of_kin_title }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'control-label'));  }}</td>
    <td> {{ $student_contact_information_kin_detailes->next_of_kin_forename }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'control-label'));  }}</td>
    <td> {{ $student_contact_information_kin_detailes->next_of_kin_surname }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Telephone</label></td>
    <td> {{ $student_contact_information_kin_detailes->next_of_kin_telephone }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('next_of_kin_email', 'Email ', array('class' => 'control-label'));  }}</td>
    <td>{{ $student_contact_information_kin_detailes->next_of_kin_email }}</td>
  </tr>
</table>
</div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">COURSE DETAILS</header>
         <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">{{ Form::label('course_name', 'Course Name', array('class' => 'control-label'));  }}</td>
    <td>
    @if(intval($student_course_enrolments->course_name)>0)
    {{ ApplicationCourse::getNameByID($student_course_enrolments->course_name); }} ( {{ $student_course_enrolments->course_level }} )
    @endif
    </td>
  </tr>

  <tr>
    <td width="50%" align="right"> {{ Form::label('awarding_body', 'Awarding Body', array('class' => 'control-label'));  }}</td>
    <td>
    @if(intval($student_course_enrolments->awarding_body)>0)
    {{ ApplicationAwardingBody::getNameByID($student_course_enrolments->awarding_body); }}
    @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('intake1', 'Intake', array('class' => 'control-label'));  }}</td>
    <td>
    {{ StaticYear::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->year).'-'.StaticMonth::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->month); }}
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"><label class="control-label">Study mode</label></td>
    <td> {{ $student_course_enrolments->study_mode }}</td>
  </tr>
</table>

         
           
        </div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">EDUCATIONAL QUALIFICATIONS</header>
        <div class="panel-body">
         
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">{{ Form::label('english_language_level1', 'English language level', array('class' => 'control-label'));  }}</td>
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
  </tr>
  
</table>
 @foreach($student_educational_qualifications as $student)
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right"> {{ Form::label('qualification_1', 'Qualification', array('class' => 'control-label'));  }}</td>
    <td> @if(intval($student->qualification) == 1000)
                  @elseif(intval($student->qualification) == 0)
                  {{ $student->qualification_other }}
                  @elseif(intval($student->qualification) > 0)
                  {{ ApplicationEducationalQualification::getNameByID($student->qualification) }}
                  @endif</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('institution_1', 'Institution', array('class' => 'control-label'));  }}</td>
    <td> {{ $student->institution; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('qualification_start_date', 'Start date', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->qualification_start_date; }} </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('date_of_birth', 'End date', array('class' => 'control-label'));  }}</td>
    <td> {{ $student->qualification_end_date; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('qualification_grade', 'Grade', array('class' => 'control-label'));  }}</td>
    <td>{{ $student->qualification_grade; }}</td>
  </tr>
</table>
  @endforeach
        
           
         </div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">WORK EXPERIENCE</header>
         <div class="panel-body">
         @foreach($student_work_experiences as $studentWorkExperience)
        
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right"> {{ Form::label('occupation_1', 'Occupation', array('class' => 'control-label'));  }}</td>
    <td> {{ $studentWorkExperience->occupation; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('company_name_1', 'Company Name - Address', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentWorkExperience->company_name; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('main_duties_and_responsibilities_1', 'Main duties and responsibilities', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentWorkExperience->main_duties; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('date_of_birth', 'Start date', array('class' => 'control-label'));  }}</td>
    <td> {{ $studentWorkExperience->occupation_start_date; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('date_of_birth', 'End date', array('class' => 'control-label'));  }}</td>
    <td> {{ $studentWorkExperience->occupation_end_date; }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('date_of_birth', 'Currently working', array('class' => 'control-label'));  }}&nbsp;</td>
    <td> @if($studentWorkExperience->currently_working == 'Yes')
                     {{ $studentWorkExperience->currently_working; }}
                     @endif</td>
  </tr>
         </table>

         @endforeach
        
             
  </div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">PAYMENT INFORMATION</header>
         <div class="panel-body">
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right"> {{ Form::label('date_of_birth', 'Course fees', array('class' => 'control-label'));  }}</td>
    <td>
      @if($student_payment_info_metadata->course_fees != 'null')
        <?php
        $course_fees =$student_payment_info_metadata->course_fees;
        $course_fees_export = '';
        if(strpos($course_fees,'Self funded')!==false){
        $course_fees_export = $course_fees_export.', Self funded';
        }
        if(strpos($course_fees,'Sponsored by the Company')!==false){
        $course_fees_export = $course_fees_export.', Sponsored by the Company';
        }
        if(strpos($course_fees,'Bank Loan')!==false){
        $course_fees_export = $course_fees_export.', Bank Loan';
        }

        $course_fees_export= ltrim ($course_fees_export, ',');

        //$english_language_level = str_replace('"]]','"\']',$english_language_level);
        ?>
        {{ $course_fees_export }}
        @endif
   </td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('date_of_birth', 'Payment Status', array('class' => 'control-label'));  }}</td>
    <td>
           @if($student_payment_info_metadata->payment_status  != 'null')
             <?php
             $payment_status =$student_payment_info_metadata->payment_status ;
             $payment_status_export = '';
             if(strpos($payment_status,'Paid in full')!==false){
             $payment_status_export = $payment_status_export.', Paid in full';
             }
             if(strpos($payment_status,'Unpaid')!==false){
             $payment_status_export = $payment_status_export.', Unpaid';
             }
             if(strpos($payment_status,'Deposit paid')!==false){
             $payment_status_export = $payment_status_export.', Deposit paid';
             }

             $payment_status_export= ltrim ($payment_status_export, ',');

             //$english_language_level = str_replace('"]]','"\']',$english_language_level);
             ?>
             {{ $payment_status_export }}
             @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('total_fee', 'Total fee', array('class' => 'control-label'));  }}</td>
    <td>  {{ $student_payment_info_metadata->total_fee }}</td>
  </tr>
</table>

           <table width="100%" border="0" cellspacing="0" cellpadding="5">
           <?php $i = 0; ?>
   @foreach($studentPaymentInfos as $studentPaymentInfo)
  <tr>
    <td>
    @if($i == 0)
    {{ Form::label('forename_3', 'Deposit', array('class' => 'control-label'));  }}
    @else
    {{ Form::label('forename_3', 'Instalment '.$i, array('class' => 'control-label'));  }}
    @endif</td>
    <td>{{ $studentPaymentInfo->payment_amount; }}</td>
    <td>{{ Form::label('date_of_birth', 'Date', array('class' => 'control-label'));  }}</td>
    <td>{{ $studentPaymentInfo->date; }}</td>
    <td>{{ Form::label('nationality', 'Method of payment', array('class' => 'control-label'));  }}</td>
    <td> @if(intval($studentPaymentInfo->method)==1000)
                     @elseif(intval($studentPaymentInfo->method)>0)
                     {{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->method); }}

                     @endif</td>
  </tr> <?php $i++; ?>
 @endforeach
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">{{ Form::label('late_admin_fee', 'Late admin fee', array('class' => 'control-label'));  }}</td>
    <td>{{ $student_payment_info_metadata->late_admin_fee }}</td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('late_fee', 'Late fee', array('class' => 'control-label'));  }}</td>
    <td>{{ $student_payment_info_metadata->late_fee }}</td>
  </tr>
</table>

           
            
            
        </div>
      </section>
      <section class="panel panel-default">
         <header class="panel-heading font-bold">BQu only</header>
         <div class="panel-body">
         <table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%" align="right">{{ Form::label('date_of_birth', 'Application received to BQu date', array('class' => 'control-label'));  }}</td>
    <td>{{ $student_bqu_data->application_received_date }}</td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('application_input_by', 'Application input by', array('class' => 'control-label'));  }}</td>
    <td>
    {{ User::getFirstNameByID( $student_bqu_data->application_input_by); }}
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('application_input_by', 'Application verified by', array('class' => 'control-label'));  }}</td>
    <td>
    @if(intval($student_bqu_data->verified_by)>0)
    {{ User::getFirstNameByID( $student_bqu_data->verified_by); }}
    @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right">{{ Form::label('application_input_by', 'Application verified date', array('class' => 'control-label'));  }}</td>
    <td>
    {{  $student_bqu_data->verified_date }}
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"> {{ Form::label('supervisor', 'Supervisor ', array('class' => 'control-label'));  }}</td>
    <td>
    @if($student_bqu_data->supervisor ==1000)
    @elseif($student_bqu_data->supervisor >0)
    {{ User::getFirstNameByID($student_bqu_data->supervisor); }}
    @endif
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Status </label></td>
    <td>
    {{ StaticDataStatus::getNameByID($student_bqu_data->status); }}
    </td>
  </tr>
  <tr>
    <td width="50%" align="right"> <label class="control-label">Notes </label></td>
    <td>
    {{ $student_bqu_data->notes }}
    </td>
  </tr>
</table>

         
           
        </div>

     </section>
      {{ Form::close() }}
   </div>
</div>
@stop
@section('post_css')
{{ HTML::style('js/chosen/chosen.css'); }}
@stop
@section('post_js')
<script type="text/javascript">
   $(function() {

   

       $('#top_san_display').html('{{ "SAN : ".$student->san }}');

       $('#top_lssn_display').html('LS SN : '+$('#ls_student_number_temp').html());


   
   });
   
   
   



   

   
</script>
{{ HTML::script('js/chosen/chosen.jquery.min.js'); }}
<!-- parsley -->
{{ HTML::script('js/parsley/parsley.min.js'); }}
{{ HTML::script('js/parsley/parsley.extend.js'); }}
<style>
   #san.parsley-success{
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
   }
   #san.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
   }
</style>
@stop
@section('main_menu')
@stop
@section('san')
<span id="top_san_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">SAN : </span>
<span id="top_lssn_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">LS SN : </span>
@stop


  @section('breadcrumb')
     <li><a href="{{ URL::to('/students') }}">Applications</a></li>
     <li class="active">{{ $student->san }}</li>
   @stop

