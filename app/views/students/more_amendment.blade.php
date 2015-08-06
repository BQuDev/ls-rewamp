@extends('layouts.main')


@section('content')


<div class="row" style="min-height: 50px;"></div>
<div class="row">
   <div class="col-sm-12">
      {{ Form::open(array('url' =>URL::to("/").'/students',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create','style'=>'font-size: 16px;')) }}
<div class="form-group">
         {{ Form::label('san', 'Student Application Number (SAN)', array('class' => 'col-sm-3 control-label'));  }}
         <div class="col-sm-9">{{ $student->san }} </div>
      </div>

      <div class="form-group">
         {{ Form::label('ls_student_number', 'LS Student Number', array('class' => 'col-sm-3 control-label'));  }}
         <div class="col-sm-9">
		 <a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username" class="editable editable-click">{{ $student->ls_student_number }}</a>
		 </div>
      </div>
<div class="form-group">
         <div class="form-inline">
            <!--{{ Form::label('app_date', 'App Date', array('class' => 'col-sm-3 control-label'));  }}
            <div class="col-sm-3">
               {{ $studentSource->app_date }}</div>-->
            {{ Form::label('ams_date', 'AMS Date', array('class' => 'col-sm-3 control-label'));  }}
            <div class="col-sm-9">
			
				<a href="#" id="ams_date" data-type="combodate" data-pk="2" data-title="Select date" data-url="/post">{{ $studentSource->ams_date }}</a>
				</div>
         </div>
      </div>

            <section class="panel panel-default">
               <header class="panel-heading font-bold" id="AGENT_INFORMATION">AGENT/ ADMISSION MANAGER INFORMATION</header>
               <div class="panel-body">
                  <div class="form-group">
                     {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">
                     @if(intval($studentSource->source)>0)
                         {{ ApplicationSource::getNameByID(intval($studentSource->source)) }}
                          @endif

                     </div>
                  </div>


<div class="form-group">
             {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
             <div class="col-sm-4">
             @if(intval($studentSource->admission_manager) == 10000)
               {{ $studentSource->admission_managers_other }}
               @elseif(intval($studentSource->admission_manager) >0)
               {{ ApplicationAdmissionManager::getNameByID($studentSource->admission_manager); }}
               @endif
                                           </div>
                              <div class="col-sm-4"></div>
                           </div>


<div class="form-group">
             {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
             <div class="col-sm-4"> @if(intval($studentSource->agent_lap) == 10000)
                                       {{ $studentSource->agents_laps_other }}
                                        @elseif((intval($studentSource->source) == 2)&(intval($studentSource->agent_lap)>0))
                                        {{ ApplicationLap::getNameByID($studentSource->agent_lap)  }}
                                        @elseif(intval($studentSource->agent_lap)>0)
                                        {{ApplicationAgent::getNameByID($studentSource->agent_lap) }}
                                        @endif</div>
                              <div class="col-sm-4"></div>
                           </div>

               </div>
            </section>

               <section class="panel panel-default">
                     <header class="panel-heading font-bold" id="PERSONAL_DATA">PERSONAL DATA</header>
                     <div class="panel-body">
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Title</label>
                           <div class="col-sm-9">

                             
							 <a href="#" id="username" data-type="text" data-pk="6" data-title="Enter Title" class="editable editable-click">{{ $student->title }}</a>
						
							 
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('initials', 'Initials', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="form-inline">
                              <div class="col-sm-9">
                              <a href="#" id="initials_1" data-type="text" data-pk="7">{{ $student->initials_1 }}</a>&nbsp;&nbsp; <a href="#" id="initials_2" data-type="text" data-pk="8">{{ $student->initials_2 }}</a>&nbsp;&nbsp; <a href="#" id="initials_3" data-type="text" data-pk="9">{{ $student->initials_3 }}</a>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_1', 'Forename 1', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
								<a href="#" id="forename_1" data-type="text" data-pk="9" data-title="Forename 1" class="editable editable-click">{{ $student->forename_1 }}</a>
						   </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_2', 'Forename 2', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
								<a href="#" id="forename_2" data-type="text" data-pk="10" data-title="Forename 2" class="editable editable-click">{{ $student->forename_2 }}</a>
						   </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_3', 'Forename 3', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
								<a href="#" id="forename_3" data-type="text" data-pk="11" data-title="Forename 3" class="editable editable-click">{{ $student->forename_3 }}</a>
						   </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
									<a href="#" id="surname" data-type="text" data-pk="12" data-title="Surname" class="editable editable-click">{{ $student->surname }}</a>
						   </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Gender</label>
                           <div class="col-sm-9">
                              {{ $student->gender }}
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('date_of_birth', 'Date of birth', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-3">{{ $student->date_of_birth }}
						   <a href="#" id="date_of_birth" data-type="text" data-pk="14" data-title="Date of birth" class="editable editable-click">{{ $student->date_of_birth }}</a>
                                       </div>
                           </div>
                        <div class="form-group">
                           {{ Form::label('nationality', 'Nationality', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">

                            @if($student->nationality > 0)
                                {{ StaticNationality::getNameByID($student->nationality); }}
                                @endif
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('passport', 'Passport number', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
								<a href="#" id="date_of_birth" data-type="text" data-pk="16" data-title="Passport number" class="editable editable-click">{{ $student->passport }}</a>
						   </div>
                        </div>
                     </div>
                  </section>


      <section class="panel panel-default">
         <header class="panel-heading font-bold" id="CONTACT_INFORMATION">CONTACT INFORMATION</header>
         <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Term time</div>
         <div class="line line-dashed b-b line-lg pull-in"></div>

           <div class="panel-body">
                       <div class="form-group">
                          <label class="col-sm-1 control-label">Address</label>
                          <label class="col-sm-2 control-label">Address line 1</label>
                          <div class="col-sm-9">
                            
							<a href="#" id="tt_address_1" data-type="text" data-pk="17" data-title="Address line 1" class="editable editable-click">{{ $ttStudentContactInformation->address_1 }}</a>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Address line 2</label>
                          <div class="col-sm-9">
							 <a href="#" id="tt_address_2" data-type="text" data-pk="18" data-title="Address line 2" class="editable editable-click">{{ $ttStudentContactInformation->address_2 }}</a>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Town/City</label>
                          <div class="col-sm-9">
							 <a href="#" id="tt_city" data-type="text" data-pk="19" data-title="Town/City" class="editable editable-click">{{ $ttStudentContactInformation->city }}</a>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Post code</label>
                          <div class="col-sm-9">
							  <a href="#" id="tt_post_code" data-type="text" data-pk="20" data-title="Post code" class="editable editable-click">{{ $ttStudentContactInformation->post_code }}</a>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Country</label>
                          <div class="col-sm-9">
                            @if($ttStudentContactInformation->country >0)
                                {{ StaticCountry::getNameByID($ttStudentContactInformation->country); }}
                                @endif
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label">Telephone</label>
                          <label class="col-sm-2 control-label">Mobile</label>
                          <div class="col-sm-9">
                             <div class="form-inline">
                               +&nbsp;&nbsp;
							   <a href="#" id="tt_mobile" data-type="text" data-pk="22" data-title="Mobile" class="editable editable-click">{{ $ttStudentContactInformation->mobile }}</a>
							   </div>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Landline</label>
                          <div class="col-sm-9">
                             <div class="form-inline">
                                                 +&nbsp;&nbsp;
                                                 
								<a href="#" id="tt_landline" data-type="text" data-pk="23" data-title="Landline" class="editable editable-click"> {{ $ttStudentContactInformation->landline }}</a>
												  </div>
                          </div>

                       </div>
         </div>
         <!-- Country of origin -->
         <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Permanent</div>
         <div class="line line-dashed b-b line-lg pull-in"></div>
         <div class="panel-body">
            <div class="form-group">
               <label class="col-sm-1 control-label">Address</label>
               <label class="col-sm-2 control-label">Address line 1</label>
               <div class="col-sm-9">
				 <a href="#" id="address_1" data-type="text" data-pk="24" data-title="Address line 1" class="editable editable-click">{{ $studentContactInformation->address_1 }}</a>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Address line 2</label>
               <div class="col-sm-9">
				   <a href="#" id="address_2" data-type="text" data-pk="25" data-title="Address line 2" class="editable editable-click">{{ $studentContactInformation->address_2 }}</a>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Town/City</label>
               <div class="col-sm-9">
				   <a href="#" id="city" data-type="text" data-pk="25" data-title="Town/City" class="editable editable-click">{{ $studentContactInformation->city }}</a>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Post code</label>
               <div class="col-sm-9">
				  <a href="#" id="post_code" data-type="text" data-pk="26" data-title="Post code" class="editable editable-click">{{ $studentContactInformation->post_code }}</a>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Country</label>
               <div class="col-sm-9">

                     @if($studentContactInformation->country >0)
                             {{ StaticCountry::getNameByID($studentContactInformation->country); }}
                             @endif

               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label">Telephone</label>
               <label class="col-sm-2 control-label">Mobile</label>
               <div class="col-sm-9">
                  <div class="form-inline">
                    +&nbsp;&nbsp;
					  <a href="#" id="mobile" data-type="text" data-pk="28" data-title="Mobile" class="editable editable-click">{{ $studentContactInformation->mobile }}</a>
					</div>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Landline</label>
               <div class="col-sm-9">
                  <div class="form-inline">
                                      +&nbsp;&nbsp;
					<a href="#" id="landline" data-type="text" data-pk="28" data-title="Landline" class="editable editable-click">{{ $studentContactInformation->landline }}</a>
									  </div>
               </div>
            </div>
            <div class="form-group">
               {{ Form::label('email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">
			   <a href="#" id="email" data-type="text" data-pk="29" data-title="Landline" class="editable editable-click">{{ $studentContactInformationOnline->email }}</a>
			   </div>
            </div>
            <div class="form-group">
               {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">
			   <a href="#" id="alternative_email" data-type="text" data-pk="30" data-title="Alternative Email" class="editable editable-click">{{ $studentContactInformationOnline->alternative_email }}</a>
			   </div>
            </div>
            <div class="form-group">
               <div class="line line-dashed b-b line-lg pull-in"></div>
               {{ Form::label('forename_3', 'Social Accounts', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">
			   <a href="#" id="facebook" data-type="text" data-pk="31" data-title="Facebook" class="editable editable-click">{{ $studentContactInformationOnline->facebook }}</a>
			   
			   </div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">
			   <a href="#" id="linkedin" data-type="text" data-pk="32" data-title="Linkedin" class="editable editable-click">{{ $studentContactInformationOnline->linkedin }}</a>
			   </div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->twitter}}
			   <a href="#" id="twitter" data-type="text" data-pk="33" data-title="Twitter" class="editable editable-click">{{ $studentContactInformationOnline->twitter }}</a>
			   </div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->other_social }}
				<a href="#" id="other_social" data-type="text" data-pk="34" data-title="Other social" class="editable editable-click">{{ $studentContactInformationOnline->other_social }}</a>
			   </div>
            </div>
         </div>
         <div class="line line-dashed b-b line-lg pull-in"></div>
      </section>

      <section class="panel panel-default">
               <header class="panel-heading font-bold" id="NEXT_OF_KIN_DETAILS">NEXT OF KIN DETAILS</header>
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Title</label>
                     <div class="col-sm-9">
						<a href="#" id="next_of_kin_title" data-type="text" data-pk="35" data-title="Title" class="editable editable-click">{{ $student_contact_information_kin_detailes->next_of_kin_title }}</a>
                     </div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">
					 <a href="#" id="next_of_kin_forename" data-type="text" data-pk="36" data-title="Forename" class="editable editable-click">{{ $student_contact_information_kin_detailes->next_of_kin_forename }}</a>
					 </div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">
						<a href="#" id="next_of_kin_surname" data-type="text" data-pk="37" data-title="Surname" class="editable editable-click">{{ $student_contact_information_kin_detailes->next_of_kin_surname }}</a>
					 </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Telephone</label>
                       <div class="col-sm-9">
                                      <div class="form-inline">
                                                          +&nbsp;&nbsp;
                                                         
										<a href="#" id="next_of_kin_telephone" data-type="text" data-pk="38" data-title="Telephone" class="editable editable-click"> {{ $student_contact_information_kin_detailes->next_of_kin_telephone }}</a>				  
														  </div>
                                   </div>
                  </div>
               </div>
               <div class="form-group">
                  {{ Form::label('next_of_kin_email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
                  <div class="col-sm-9">
				  <a href="#" id="next_of_kin_email" data-type="text" data-pk="39" data-title="Email" class="editable editable-click">{{ $student_contact_information_kin_detailes->next_of_kin_email }}</a>				  
				  </div>
               </div>
            </section>

            <section class="panel panel-default">
                     <header class="panel-heading font-bold" id="COURSE_DETAILS">COURSE DETAILS</header>
                     <div class="panel-body">
                        <div class="form-group">
                           {{ Form::label('course_name', 'Course Name', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
                                <div class="form-inline">
                                 @if(intval($student_course_enrolments->course_name)>0)
                                   {{ ApplicationCourse::getNameByID($student_course_enrolments->course_name); }} ( {{ $student_course_enrolments->course_level }} )
                                   @endif




                           </div>
                           </div>
                        </div>

                        <div class="form-inline">

                        </div>
                        <div class="form-group">
                           {{ Form::label('awarding_body', 'Awarding Body', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">

                             @if(intval($student_course_enrolments->awarding_body)>0)
                                {{ ApplicationAwardingBody::getNameByID($student_course_enrolments->awarding_body); }}
                                @endif
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
					 <label class="col-sm-3 control-label">Intake</label>
                        <div class="col-sm-9">
                           <div class="form-group">
                             <div class="form-inline">
                           @if($student_course_enrolments->intake >0)
                            {{ StaticYear::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->year).'-'.ApplicationIntake::getRowByID($student_course_enrolments->intake)->name; }}
                            @endif
                             </div>
                           </div>

                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Study mode</label>
                        <div class="col-sm-9">
                       {{ $student_course_enrolments->study_mode }}

                        </div>
                     </div>
                  </section>
                  <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="EDUCATIONAL_QUALIFICATIONS">EDUCATIONAL QUALIFICATIONS</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('english_language_level1', 'English language level', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
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
                                 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>



                              <div class="form-group">
                                 {{ Form::label('qualification_1', 'Qualification 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-4"></div>
                                                  <div class="col-sm-8"> @if(intval($student_educational_qualifications->qualification_1) == 10000)
                                                                                                           {{ $student_educational_qualifications->qualification_other_1 }}
                                                                                                                                   @elseif(intval($student_educational_qualifications->qualification_1) == 0)
                                                                                                                                   {{ $student_educational_qualifications->qualification_other_1 }}
                                                                                                                                   @elseif(intval($student_educational_qualifications->qualification_1) > 0)
                                                                                                                                   {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_1) }}
                                                                                                                                   @endif</div>
                                               </div>
                              <div class="form-group">
                                 {{ Form::label('institution_1', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="institution_1" data-type="text" data-pk="46" data-title="Institution" class="editable editable-click">{{ $student_educational_qualifications->institution_1; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
												<a href="#" id="qualification_start_date_1" data-type="text" data-pk="47" data-title="Start date" class="editable editable-click">{{ $student_educational_qualifications->qualification_start_date_1; }}</a>
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
									<a href="#" id="qualification_end_date_1" data-type="text" data-pk="48" data-title="End date" class="editable editable-click">{{ $student_educational_qualifications->qualification_end_date_1 }}</a>
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="qualification_grade_1" data-type="text" data-pk="49" data-title="Grade" class="editable editable-click">{{ $student_educational_qualifications->qualification_grade_1; }}</a>
								 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>






                  <div id="qualification_container_2">
                              <div class="form-group">
                                 {{ Form::label('qualification_2', 'Qualification 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-8">  @if(intval($student_educational_qualifications->qualification_2) == 10000)
                                                                                         {{ $student_educational_qualifications->qualification_other_2 }}
                                                       											  @elseif(intval($student_educational_qualifications->qualification_2) == 0)
                                                       											  {{ $student_educational_qualifications->qualification_other_2 }}
                                                       											  @elseif(intval($student_educational_qualifications->qualification_2) > 0)
                                                       											  {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_2) }}
                                                       											  @endif</div>

                                </div>
                              <div class="form-group">
                                 {{ Form::label('institution_2', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								<a href="#" id="institution_2" data-type="text" data-pk="50" data-title="Institution" class="editable editable-click">{{ $student_educational_qualifications->institution_2; }}</a> 
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                               
											<a href="#" id="qualification_start_date_2" data-type="text" data-pk="51" data-title="Start date" class="editable editable-click">{{ $student_educational_qualifications->qualification_start_date_2; }}</a> 
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">  
										<a href="#" id="qualification_end_date_2" data-type="text" data-pk="52" data-title="End date" class="editable editable-click">{{ $student_educational_qualifications->qualification_end_date_2; }}</a> 
										 </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
									<a href="#" id="qualification_grade_2" data-type="text" data-pk="53" data-title="Grade" class="editable editable-click">{{ $student_educational_qualifications->qualification_grade_2; }}</a>  
								 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>



                           </div>

                  <div id="qualification_container_3">
                              <div class="form-group">
                                 {{ Form::label('qualification_3', 'Qualification 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-8">@if(intval($student_educational_qualifications->qualification_3) == 10000)
                                                                                         {{ $student_educational_qualifications->qualification_other_3 }}
                                                       									  @elseif(intval($student_educational_qualifications->qualification_3) == 0)
                                                       									  {{ $student_educational_qualifications->qualification_other_3 }}
                                                       									  @elseif(intval($student_educational_qualifications->qualification_3) > 0)
                                                       									  {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_3) }}
                                                       									  @endif</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('institution_3', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->institution_3; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
								<a href="#" id="qualification_start_date" data-type="text" data-pk="55" data-title="Start date" class="editable editable-click">{{ $student_educational_qualifications->qualification_start_date_3; }}</a>			   
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                
<a href="#" id="qualification_end_date_3" data-type="text" data-pk="56" data-title="End date" class="editable editable-click">{{ $student_educational_qualifications->qualification_end_date_3; }}</a>
												</div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
			<a href="#" id="qualification_grade_3" data-type="text" data-pk="57" data-title="Grade" class="editable editable-click">{{ $student_educational_qualifications->qualification_grade_3; }}</a>					 
								 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>



                           </div>

                  </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="WORK_EXPERIENCE">WORK EXPERIENCE</header>
                           <div class="panel-body">

                           <div id="occupation_container_1">

                              <div class="form-group">
                                 {{ Form::label('occupation_1', 'Occupation 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->occupation_1; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_1', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="company_name_1" data-type="text" data-pk="57" data-title="Company Name - Address" class="editable editable-click">{{ $studentWorkExperience->company_name_1; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_1', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
									<a href="#" id="main_duties_and_responsibilities_1" data-type="text" data-pk="57" data-title="Main duties and responsibilities" class="editable editable-click">{{ $studentWorkExperience->main_duties_1; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                
								<a href="#" id="occupation_start_date_1" data-type="text" data-pk="57" data-title="Start date" class="editable editable-click">{{ $studentWorkExperience->occupation_start_date_1; }}</a>
												</div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                          
<a href="#" id="occupation_end_date_1" data-type="text" data-pk="57" data-title="End date" class="editable editable-click">{{ $studentWorkExperience->occupation_end_date_1; }}</a>
											  </div>
                                             </div>
                                             </div>
                              <div class="form-group">{{ Form::label('date_of_birth', 'Currently working', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    @if($studentWorkExperience->currently_working_1 == 'Yes')
                                                         {{ $studentWorkExperience->currently_working_1; }}
                                                         @endif
                                 </div>
                              </div>

                              </div>

                           <div id="occupation_container_2">
                           <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('forename_2', 'Occupation 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->occupation_2; }}
				<a href="#" id="occupation_end_date_1" data-type="text" data-pk="57" data-title="End date" class="editable editable-click">{{ $studentWorkExperience->occupation_end_date_1; }}</a>				 
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_2', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
				<a href="#" id="company_name_2" data-type="text" data-pk="57" data-title="Company Name - Address" class="editable editable-click">{{ $studentWorkExperience->company_name_2; }}</a>				 
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_2', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
									<a href="#" id="main_duties_and_responsibilities_2" data-type="text" data-pk="57" data-title="Main duties and responsibilities" class="editable editable-click">{{ $studentWorkExperience->main_duties_2; }}</a>	
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                             
									<a href="#" id="occupation_start_date_2" data-type="text" data-pk="57" data-title="Start date" class="editable editable-click">{{ $studentWorkExperience->occupation_start_date_2; }}</a>		   
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                               
								<a href="#" id="occupation_end_date_2" data-type="text" data-pk="57" data-title="End date" class="editable editable-click">{{ $studentWorkExperience->occupation_end_date_2; }}</a>			   
											   </div>
                                             </div>
                                             </div>
                              <div class="form-group">{{ Form::label('date_of_birth', 'Currently working', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                  @if($studentWorkExperience->currently_working_2 == 'Yes')
                                                       {{ $studentWorkExperience->currently_working_2; }}
                                                       @endif
                                 </div>
                              </div>

                              </div>


                           <div id="occupation_container_3">
                           <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('forename_2', 'Occupation 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
						<a href="#" id="occupation_3" data-type="text" data-pk="57" data-title="Occupation 3" class="editable editable-click">{{ $studentWorkExperience->occupation_3; }}</a>		 
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_3', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="company_name_3" data-type="text" data-pk="57" data-title="Company Name - Address" class="editable editable-click">{{ $studentWorkExperience->company_name_3; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_3', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								<a href="#" id="main_duties_3" data-type="text" data-pk="57" data-title="Main duties and responsibilities" class="editable editable-click">{{ $studentWorkExperience->main_duties_3; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                             
<a href="#" id="main_duties_3" data-type="text" data-pk="57" data-title="Main duties and responsibilities" class="editable editable-click">{{ $studentWorkExperience->occupation_start_date_3; }}</a>
											 </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                             
							<a href="#" id="occupation_end_date_3" data-type="text" data-pk="57" data-title="End date" class="editable editable-click"> {{ $studentWorkExperience->occupation_end_date_3; }} </a>				  
											  </div>
                                             </div>
                                             </div>
                              <div class="form-group">{{ Form::label('date_of_birth', 'Currently working', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    @if($studentWorkExperience->currently_working_3 == 'Yes')
                                                         {{ $studentWorkExperience->currently_working_3; }}
                                                         @endif
                                 </div>
                              </div>
                              </div>





                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="PAYMENT_INFORMATION">PAYMENT INFORMATION</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Course fees', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
                                    <div class="form-inline">
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
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Payment Status', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
                                    <div class="form-inline">
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
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('total_fee', 'Total fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="total_fee" data-type="text" data-pk="57" data-title="Total fee" class="editable editable-click">{{ $student_payment_info_metadata->total_fee }}</a>
								 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('deposit', 'Deposit', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ $studentPaymentInfo->deposit; }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                               
										<a href="#" id="deposit_date" data-type="text" data-pk="57" data-title="Deposit date" class="editable editable-click">  {{ $studentPaymentInfo->deposit_date; }}</a>
																 </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">

                                      @if(intval($studentPaymentInfo->deposit_method)==10000)
                                                           @elseif(intval($studentPaymentInfo->deposit_method)>0)
                                                           {{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->deposit_method); }}

                                                           @endif
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 1', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">
									<a href="#" id="installment_1" data-type="text" data-pk="57" data-title="Instalment 1" class="editable editable-click"> {{ $studentPaymentInfo->installment_1; }}</a>
									</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  
<a href="#" id="installment_1_date" data-type="text" data-pk="57" data-title="Date" class="editable editable-click"> {{ $studentPaymentInfo->installment_1_date; }}</a>
																   </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                       @if(intval($studentPaymentInfo->installment_1_method)==10000)
                                                   @elseif(intval($studentPaymentInfo->installment_1_method)>0)
                                                   {{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_1_method); }}

                                                   @endif

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 2', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2"><a href="#" id="installment_2" data-type="text" data-pk="57" data-title="Instalment 2" class="editable editable-click"> {{ $studentPaymentInfo->installment_2; }}</a></div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                           <a href="#" id="installment_2_date" data-type="text" data-pk="57" data-title="Date" class="editable editable-click"> {{ $studentPaymentInfo->installment_2_date; }}</a>    </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                        @if(intval($studentPaymentInfo->installment_2_method)==10000)
                                      @elseif(intval($studentPaymentInfo->installment_2_method)>0)
                                      {{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_2_method); }}

                                      @endif

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 3', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2"><a href="#" id="installment_3" data-type="text" data-pk="57" data-title="Instalment 3" class="editable editable-click"> {{ $studentPaymentInfo->installment_3; }}</a></div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                        <a href="#" id="installment_3_date" data-type="text" data-pk="57" data-title="Date" class="editable editable-click"> {{ $studentPaymentInfo->installment_3_date; }}</a></div>
                                                               </div>{{ Form::label('instalment_payment_method_3', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                       @if(intval($studentPaymentInfo->installment_3_method)==10000)
                                         @elseif(intval($studentPaymentInfo->installment_3_method)>0)
                                         {{ ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_3_method); }}

                                         @endif
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('late_admin_fee', 'Late admin fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <a href="#" id="late_admin_fee" data-type="text" data-pk="57" data-title="Late admin fee" class="editable editable-click"> {{ $student_payment_info_metadata->late_admin_fee; }}</a>
								 </div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('late_fee', 'Late fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_payment_info_metadata->late_fee }}
							 <a href="#" id="late_fee" data-type="text" data-pk="57" data-title="Late fee" class="editable editable-click">{{ $student_payment_info_metadata->late_fee }}</a>	 
								 </div>
                              </div>
                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="BQu_ONLY">BQu ONLY</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Application received to BQu date', array('class' => 'col-sm-3 control-label'));  }}
                                <div class="col-sm-3"><div class="form-inline">
                                              
								<a href="#" id="application_received_date" data-type="text" data-pk="57" data-title="Application received to BQu date" class="editable editable-click">{{ $student_bqu_data->application_received_date }}</a>	 
											  </div>
                                            </div>
                                            </div>
                              <div class="form-group">
                                 {{ Form::label('application_input_by', 'Application input by', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ User::getFirstNameByID( $student_bqu_data->created_by); }}&nbsp;&nbsp;{{ User::getLastNameByID( $student_bqu_data->created_by); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('supervisor', 'Supervisor ', array('class' => 'col-sm-3 control-label'));  }}

                                 <div class="col-sm-9">

@if($student_bqu_data->supervisor ==1000)
    @elseif($student_bqu_data->supervisor >0)
    {{ User::getFirstNameByID($student_bqu_data->supervisor); }}&nbsp;&nbsp;{{ User::getLastNameByID( $student_bqu_data->supervisor); }}
    @endif

                                 </div>
                              </div>
                              <!--<div class="form-group">
                                 {{ Form::label('date_of_birth', 'Applicant verified by BQu date', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-3"><div class="form-inline">
                                               </div>
                                             </div>
                                             </div>-->
                              <div class="form-group">
                                 <label class="col-sm-1 control-label"></label>
                                 <label class="col-sm-2 control-label">Status </label>
                                 <div class="col-sm-9">

 <?php
  //$ApplicationStatus = StudentApplicationStatus::lastRecordBySAN($student->san);
  $ApplicationStatus = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
  ?>
  @if(!is_null($ApplicationStatus))
 {{ StaticDataStatus::getNameByID($ApplicationStatus->status)  }}
 @endif

                                 </div>
                              </div>
                           </div>
                           <div class="line line-dashed b-b line-lg pull-in"></div>

                                       <div class="line line-dashed b-b line-lg pull-in"></div>
                           <div class="form-group">
                              <label class="col-sm-3 control-label"> </label>
                              <div class="col-sm-9">

                              </div>
                           </div>
                        </section>
						
{{ Form::close() }}
   </div>
</div>
@stop


 @section('breadcrumb')
     <li><a href="#AGENT_INFORMATION">AGENT INFORMATION</a></li>
     <li class="active"><a href="#PERSONAL_DATA">PERSONAL DATA</a></li>
     <li class="active"><a href="#CONTACT_INFORMATION">CONTACT INFORMATION</a></li>
     <li class="active"><a href="#NEXT_OF_KIN_DETAILS">NEXT OF KIN DETAILS</a></li>
     <li class="active"><a href="#COURSE_DETAILS">COURSE DETAILS</a></li>
     <li class="active"><a href="#EDUCATIONAL_QUALIFICATIONS">EDUCATIONAL QUALIFICATIONS</a></li>
     <li class="active"><a href="#WORK_EXPERIENCE">WORK EXPERIENCE</a></li>
     <li class="active"><a href="#PAYMENT_INFORMATION">PAYMENT INFORMATION</a></li>
     <li class="active"><a href="#BQu_ONLY">BQu ONLY</a></li>
 @stop


@section('post_css')
{{ HTML::style('bootstrap3-editable/css/bootstrap-editable.css'); }}
{{ HTML::style('bootstrap3-editable/css/datetimepicker.css'); }}
<style>
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    padding-top: 6px;
}
</style>
@stop

@section('post_js')

  {{ HTML::script('bootstrap3-editable/js/bootstrap-editable.js'); }}
  
  {{ HTML::script('bootstrap3-editable/js/bootstrap-datetimepicker.js'); }}
  {{ HTML::script('bootstrap3-editable/js/moment.min.js'); }}
  {{ HTML::script('js/amendment-x-edit-config.js'); }}
  <script>
  
 
  </script>
@stop

@section('main_menu')

 @stop

 @section('san')
 <div align="center">
 <span id="top_san_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">SAN : {{ $student->san }}</span>
 <span id="top_lssn_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">LS SN : {{ $student->ls_student_number }}</span>
 </div>
  @stop