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
         <div class="col-sm-9">{{ $student->ls_student_number }}</div>
      </div>
<div class="form-group">
         <div class="form-inline">
            {{ Form::label('app_date', 'App Date', array('class' => 'col-sm-3 control-label'));  }}
            <div class="col-sm-3">
               {{ $studentSource->app_date }}</div>
            {{ Form::label('ams_date', 'AMS Date', array('class' => 'col-sm-2 control-label'));  }}
            <div class="col-sm-3">
                {{ $studentSource->ams_date }}</div>
         </div>
      </div>

            <section class="panel panel-default">
             <header class="panel-heading font-bold">AGENT/ ADMISSION MANAGER INFORMATION</header>
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
  <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'ADMISSION MANAGER INFORMATION',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#admission_manager_information_form">Amend Data</a>
                                                                     </div> </div></div>
               </div>

            </section>

               <section class="panel panel-default">
                     <header class="panel-heading font-bold">PERSONAL DATA</header>
                     <div class="panel-body">
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Title</label>
                           <div class="col-sm-9">

                             {{ $student->title }}
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('initials', 'Initials', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="form-inline">
                              <div class="col-sm-9">
                              {{ $student->initials_1 }}&nbsp;{{ $student->initials_2 }}&nbsp;{{ $student->initials_3 }}
                              </div>



                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_1', 'Forename 1', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ $student->forename_1 }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_2', 'Forename 2', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ $student->forename_2 }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_3', 'Forename 3', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ $student->forename_3 }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ $student->surname }}</div>
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
                           <div class="col-sm-9"> {{ $student->passport }}</div>
                        </div>

                          <div class="line line-dashed b-b line-lg pull-in"></div>

                             <div class="form-inline">
                             <div class="form-group">

                 <div class="col-sm-12" >
                    <div class="checkbox i-checks" style="padding-bottom: 10px">
                       <label>
                       {{ Form::checkbox('admission_manager_information[]', 'ADMISSION MANAGER INFORMATION',false); }}
                       <i></i>
                                                                                    Checked
                       </label>
                    </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#personal_data_form">Amend Data</a>
                 </div> </div></div>


                     </div>

                  </section>


      <section class="panel panel-default">
         <header class="panel-heading font-bold">CONTACT INFORMATION</header>
         <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Term time</div>
         <div class="line line-dashed b-b line-lg pull-in"></div>

           <div class="panel-body">
                       <div class="form-group">
                          <label class="col-sm-1 control-label">Address</label>
                          <label class="col-sm-2 control-label">Address line 1</label>
                          <div class="col-sm-9">
                            {{ $ttStudentContactInformation->address_1 }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Address line 2</label>
                          <div class="col-sm-9">
                             {{ $ttStudentContactInformation->address_2 }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Town/City</label>
                          <div class="col-sm-9">
                             {{ $ttStudentContactInformation->city }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Post code</label>
                          <div class="col-sm-9">
                             {{ $ttStudentContactInformation->post_code }}
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
                               {{ $ttStudentContactInformation->mobile }}</div>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Landline</label>
                          <div class="col-sm-9">
                             <div class="form-inline">
                                                 +&nbsp;&nbsp;
                                                  {{ $ttStudentContactInformation->landline }}  </div>
                          </div>

                       </div>
					     <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('tt_contact_info[]', 'TT CONTACT INFORMATION',false); }}
                                                                           <i></i>
																			Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#tt_contact_information_form">Amend Data</a>
                                                                     </div> </div></div>
																	 <div class="line line-dashed b-b line-lg pull-in"></div>
         </div>
         <!-- Country of origin -->
         <div class="font-bold" style="padding: 10px 15px 0px 15px !important;" href="#">Permanent</div>
         <div class="line line-dashed b-b line-lg pull-in"></div>
         <div class="panel-body">
            <div class="form-group">
               <label class="col-sm-1 control-label">Address</label>
               <label class="col-sm-2 control-label">Address line 1</label>
               <div class="col-sm-9">
                 {{ $studentContactInformation->address_1 }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Address line 2</label>
               <div class="col-sm-9">
                  {{ $studentContactInformation->address_2 }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Town/City</label>
               <div class="col-sm-9">
                  {{ $studentContactInformation->city }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Post code</label>
               <div class="col-sm-9">
                  {{ $studentContactInformation->post_code }}
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
                    {{ $studentContactInformation->mobile }}</div>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Landline</label>
               <div class="col-sm-9">
                  <div class="form-inline">
                                      +&nbsp;&nbsp;
                                      {{ $studentContactInformation->landline }}   </div>
               </div>
            </div>
										     <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

				 <div class="col-sm-12" >
					<div class="checkbox i-checks" style="padding-bottom: 10px">
					   <label>
					   {{ Form::checkbox('contact_info[]', 'CONTACT INFORMATION',false); }}
					   <i></i>
						Checked
					   </label>
					</div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#contact_information_form">Amend Data</a>
				 </div> </div></div>
				 <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
               {{ Form::label('email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->email }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9"> {{ $studentContactInformationOnline->alternative_email }}</div>
            </div>
	
            <div class="form-group">
               
               {{ Form::label('forename_3', 'Social Accounts', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->facebook }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->linkedin }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->twitter}}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ $studentContactInformationOnline->other_social }}</div>
            </div>
			
			<div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('contact_info[]', 'ONLINE CONTACT INFORMATION',false); }}
                                                                           <i></i>
																			Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#online_contact_information_form">Amend Data</a>
                                                                     </div> </div>
																	 </div>	
         </div>
																
      </section>

      <section class="panel panel-default">
               <header class="panel-heading font-bold">NEXT OF KIN DETAILS</header>
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Title</label>
                     <div class="col-sm-9">
                        {{ $student_contact_information_kin_detailes->next_of_kin_title }}
                     </div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_forename }}</div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_surname }}</div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Telephone</label>
                       <div class="col-sm-9">
                                      <div class="form-inline">
                                                          +&nbsp;&nbsp;
                                                          {{ $student_contact_information_kin_detailes->next_of_kin_telephone }} </div>
                                   </div>
                  </div>
				    <div class="form-group">
                  {{ Form::label('next_of_kin_email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
                  <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_email }}</div>
               </div>
				   <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'NEXT OF KIN DETAILS',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#next_of_kin_form">Amend Data</a>
                                                                     </div> </div></div>
               </div>
             
            </section>

            <section class="panel panel-default">
                     <header class="panel-heading font-bold">COURSE DETAILS</header>
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
							
                     <div class="form-group">
                        {{ Form::label('intake1', 'Intake', array('class' => 'col-sm-3 control-label'));  }}
                        <div class="col-sm-9">
                          {{ StaticYear::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->year).'-'.StaticMonth::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->month); }}

                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Study mode</label>
                        <div class="col-sm-9">
                       {{ $student_course_enrolments->study_mode }}

                        </div>
                     </div>
					  <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'COURSE DETAILS',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#course_details_form">Amend Data</a>
                                                                     </div> </div></div>
																	 </div>
                  </section>
                  <section class="panel panel-default">
                           <header class="panel-heading font-bold">EDUCATIONAL QUALIFICATIONS</header>
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
                                                                                          @elseif(intval($student_educational_qualifications->qualification_1) == 0)
                                                                                          {{ $student_educational_qualifications->qualification_other_1 }}
                                                                                          @elseif(intval($student_educational_qualifications->qualification_1) > 0)
                                                                                          {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_1) }}
                                                                                          @endif</div>
                                               </div>
                              <div class="form-group">
                                 {{ Form::label('institution_1', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->institution_1; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                               {{ $student_educational_qualifications->qualification_start_date_1; }} </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                               {{ $student_educational_qualifications->qualification_end_date_1; }} </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->qualification_grade_1; }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>






                  <div id="qualification_container_2">
                              <div class="form-group">
                                 {{ Form::label('qualification_2', 'Qualification 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-8">@if(intval($student_educational_qualifications->qualification_2) == 10000)
                                                     @elseif(intval($student_educational_qualifications->qualification_2) == 0)
                                                     {{ $student_educational_qualifications->qualification_other_2 }}
                                                     @elseif(intval($student_educational_qualifications->qualification_2) > 0)
                                                     {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_2) }}
                                                     @endif</div>

                                </div>
                              <div class="form-group">
                                 {{ Form::label('institution_2', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->institution_2; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                               {{ $student_educational_qualifications->qualification_start_date_2; }}  </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                         {{ $student_educational_qualifications->qualification_end_date_2; }}   </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->qualification_grade_2; }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>



                           </div>

                  <div id="qualification_container_3">
                              <div class="form-group">
                                 {{ Form::label('qualification_3', 'Qualification 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-8">@if(intval($student_educational_qualifications->qualification_3) == 10000)
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
                                               {{ $student_educational_qualifications->qualification_start_date_3; }}</div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ $student_educational_qualifications->qualification_end_date_3; }} </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_educational_qualifications->qualification_grade_3; }}</div>
                              </div>



                           </div>
						     <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'EDUCATIONAL QUALIFICATIONS',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#educational_qualifications_form">Amend Data</a>
                                                                     </div> </div></div>

                  </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold">WORK EXPERIENCE</header>
                           <div class="panel-body">

                           <div id="occupation_container_1">

                              <div class="form-group">
                                 {{ Form::label('occupation_1', 'Occupation 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->occupation_1; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_1', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->company_name_1; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_1', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->main_duties_1; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ $studentWorkExperience->occupation_start_date_1; }}  </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                              {{ $studentWorkExperience->occupation_end_date_1; }} </div>
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
                                 <div class="col-sm-9">{{ $studentWorkExperience->occupation_2; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_2', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->company_name_2; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_2', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->main_duties_3; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                               {{ $studentWorkExperience->occupation_start_date_2; }}</div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                               {{ $studentWorkExperience->occupation_end_date_2; }}</div>
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
                                 <div class="col-sm-9">{{ $studentWorkExperience->occupation_3; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_3', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->company_name_3; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_3', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $studentWorkExperience->main_duties_3; }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                             {{ $studentWorkExperience->occupation_start_date_3; }} </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                              {{ $studentWorkExperience->occupation_end_date_3; }} </div>
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


<div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'WORK EXPERIENCE',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#work_experience_form">Amend Data</a>
                                                                     </div> </div></div>


                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold">PAYMENT INFORMATION</header>
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
                                 <div class="col-sm-9">{{ $student_payment_info_metadata->total_fee }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('deposit', 'Deposit', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ $studentPaymentInfo->deposit; }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                 {{ $studentPaymentInfo->deposit_date; }}  </div>
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
                                    <div class="col-sm-2">{{ $studentPaymentInfo->installment_1; }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                   {{ $studentPaymentInfo->installment_1_date; }}   </div>
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
                                    <div class="col-sm-2">{{ $studentPaymentInfo->installment_2; }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  {{ $studentPaymentInfo->installment_2_date; }}     </div>
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
                                    <div class="col-sm-2">{{ $studentPaymentInfo->installment_3; }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                 {{ $studentPaymentInfo->installment_3_date; }}    </div>
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
                                 <div class="col-sm-9">{{ $student_payment_info_metadata->late_admin_fee }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('late_fee', 'Late fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ $student_payment_info_metadata->late_fee }}</div>
                              </div>
							  <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'WORK EXPERIENCE',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#work_experience_form">Amend Data</a>
                                                                     </div> </div></div>
                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold">BQu ONLY</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Application received to BQu date', array('class' => 'col-sm-3 control-label'));  }}
                                <div class="col-sm-3"><div class="form-inline">
                                              {{ $student_bqu_data->application_received_date }} </div>
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

Added ( Pending for validation )

                                 </div>
                              </div>
							  
							   <div class="line line-dashed b-b line-lg pull-in"></div>

                 <div class="form-inline">
                 <div class="form-group">

                                                                     <div class="col-sm-12" >
                                                                        <div class="checkbox i-checks" style="padding-bottom: 10px">
                                                                           <label>
                                                                           {{ Form::checkbox('admission_manager_information[]', 'BQu ONLY',false); }}
                                                                           <i></i>
Checked
                                                                           </label>
                                                                        </div>&nbsp;&nbsp; OR&nbsp;&nbsp; <a data-toggle="modal" class="btn btn-warning" href="#bqu_only_form">Amend Data</a>
                                                                     </div> </div></div>
                           </div>
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








<div class="modal fade" id="admission_manager_information_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">AGENT/ ADMISSION MANAGER INFORMATION</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                  @if(intval($studentSource->source)>0)
                                      {{ ApplicationSource::getNameByID(intval($studentSource->source)) }}
                                       @endif

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          @if(intval($studentSource->admission_manager) == 10000)
                            {{ $studentSource->admission_managers_other }}
                            @elseif(intval($studentSource->admission_manager) >0)
                            {{ ApplicationAdmissionManager::getNameByID($studentSource->admission_manager); }}
                            @endif
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9"> @if(intval($studentSource->agent_lap) == 10000)
                                                    {{ $studentSource->agents_laps_other }}
                                                     @elseif((intval($studentSource->source) == 2)&(intval($studentSource->agent_lap)>0))
                                                     {{ ApplicationLap::getNameByID($studentSource->agent_lap)  }}
                                                     @elseif(intval($studentSource->agent_lap)>0)
                                                     {{ApplicationAgent::getNameByID($studentSource->agent_lap) }}
                                                     @endif</div>

                                        </div>
                                        </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                               {{ Form::select('information_source', $information_sources,$data_studentSource->source,['class'=>'chosen-select col-sm-12']);  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                           {{ Form::select('admission_manager',  $admission_managers,$data_studentSource->admission_manager,['class'=>'chosen-select col-sm-12']);  }}
                         {{ Form::text('admission_managers_other', $data_studentSource->admission_managers_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          {{ Form::select('agents_laps', $agents_laps,$data_studentSource->agent_lap,['class'=>'chosen-select col-sm-12','style'=>'width:165px']);  }}
{{ Form::text('agents_laps_other', $data_studentSource->agents_laps_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                        </div>
                                        </div>
            </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>

<div class="modal fade" id="personal_data_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">PERSONAL DATA</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
                <div class="row" style="font-size: 16px" >
                     <div class="form-group">
                          {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          {{ $student->title }}
                          </div>
                       </div>
                </div>
                       <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                 {{ Form::label('initials', 'Initials', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                 {{ $student->initials_1 }}&nbsp;{{ $student->initials_2 }}&nbsp;{{ $student->initials_3 }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                 {{ Form::label('forename_1', 'Forename 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                 {{ $student->forename_1 }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                {{ Form::label('forename_2', 'Forename 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                 {{ $student->forename_2 }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                               {{ Form::label('forename_3', 'Forename 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                {{ $student->forename_3 }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                              {{ Form::label('surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                               {{ $student->surname }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                              {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                              {{ $student->gender }}
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('date_of_birth', 'Date of birth', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                            {{ $student->date_of_birth }}
                                 </div>
                              </div>
                    </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('nationality', 'Nationality', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                @if($student->nationality > 0)
								{{ StaticNationality::getNameByID($student->nationality); }}
								@endif
                                 </div>
                              </div>
                    </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('passport', 'Passport number', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                {{ $student->passport }}
                                 </div>
                              </div>
                    </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>

<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                          {{ Form::label('title', 'Title', array('class' => 'col-sm-2 control-label'));  }}
                          <div class="col-sm-10">
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Mr.',strpos($student->title,'Mr.')!==false); }}
                                 <i></i>
                                 Mr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Mrs.',strpos($student->title,'Mrs.')!==false); }}
                                 <i></i>
                                 Mrs
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Miss.',strpos($student->title,'Miss.')!==false); }}
                                 <i></i>
                                 Miss
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                {{ Form::radio('title', 'Ms.',strpos($student->title,'Ms.')!==false); }}
                                 <i></i>
                                 Ms
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                  {{ Form::radio('title', 'Dr.',strpos($student->title,'Dr.')!==false); }}
                                 <i></i>
                                 Dr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Other.',strpos($student->title,'Other.')!==false); }}
                                 <i></i>
                                 Other
                                 </label>
                              </div>
                           </div>
                       </div>
                </div>
                       <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                 {{ Form::label('initials', 'Initials', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                 <div class="form-inline">
                              <div class="col-sm-3"> {{ Form::text('initials_1',  $student->initials_1 ,['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                              <div class="col-sm-3">{{ Form::text('initials_2', $student->initials_2,['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                              <div class="col-sm-3">{{ Form::text('initials_3', $student->initials_3,['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                           </div>
						   </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                 {{ Form::label('forename_1', 'Forename 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('forename_1', $student->forename_1,['placeholder'=>'Forename 1','class'=>'form-control']); }}</div>
                        
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                                {{ Form::label('forename_2', 'Forename 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('forename_2', $student->forename_2,['placeholder'=>'Forename 2','class'=>'form-control']); }}</div>
                        
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                               {{ Form::label('forename_3', 'Forename 3', array('class' => 'col-sm-3 control-label'));  }}
                                <div class="col-sm-9">{{ Form::text('forename_3', $student->forename_3,['placeholder'=>'Forename 3','class'=>'form-control']); }}</div>
                        
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                              {{ Form::label('surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                                <div class="col-sm-9">{{ Form::text('surname', $student->surname,['placeholder'=>'Surname','class'=>'form-control']); }}</div>
                       
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                              {{ Form::label('gender', 'Gender', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                             <div class="radio-inline i-checks">
                                       <label>
                                       {{ Form::radio('gender', 'Male',strpos($student->gender,'Male')!==false); }}
                                       <i></i>
                                       Male
                                       </label>
                                    </div>
                                    <div class="radio-inline i-checks">
                                       <label>
                                       {{ Form::radio('gender', 'Female',strpos($student->gender,'Female')!==false); }}
                                       <i></i>
                                       Female
                                       </label>
            </div>
                                 </div>
                              </div>
                     </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('date_of_birth', 'Date of birth', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
								 <?php
									$date_of_birth = explode('-',$student->date_of_birth);
								?>
                           <div class="form-inline">
                                          {{ Form::text('date_of_birth_date',  $date_of_birth[0],['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
                                          {{ Form::text('date_of_birth_month',  $date_of_birth[1],['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
                                          {{ Form::text('date_of_birth_year',  $date_of_birth[2],['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>"4",'data-parsley-type'=>'digits']); }}
                                       </div>
                                 </div>
                              </div>
                    </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('nationality', 'Nationality', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                {{ Form::select('nationality', $nationalities,$student->nationality,['class'=>'chosen-select col-sm-12']);  }}
                                 </div>
                              </div>
                    </div>
                    <div class="row" style="font-size: 16px" >
                    <div class="form-group">
                            {{ Form::label('passport', 'Passport number', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">
                                {{ Form::text('passport', $student->passport,['placeholder'=>'Passport number','class'=>'form-control']); }}
                                 </div>
                              </div>
                    </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>

<div class="modal fade" id="tt_contact_information_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">CONTACT INFORMATION - Term time</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('address_line_1', 'Address line 1', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                {{ $ttStudentContactInformation->address_1  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                           {{ Form::label('address_line_2', 'Address line 2', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
                        {{ $ttStudentContactInformation->address_2  }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_city', 'Town/City', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $ttStudentContactInformation->city  }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('post_code', 'Post code', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $ttStudentContactInformation->post_code  }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('country', 'Country', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						  @if($ttStudentContactInformation->country >0)
                                {{ StaticCountry::getNameByID($ttStudentContactInformation->country); }}
                                @endif
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_mobile', 'Mobile', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> +&nbsp;&nbsp;
                               {{ $ttStudentContactInformation->mobile }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_landline', 'Landline', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> +&nbsp;&nbsp;
                                                  {{ $ttStudentContactInformation->landline }}</div>

                                        </div>
                                        </div>
            </div>
			

            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('address_line_1', 'Address line 1', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
								{{ Form::text('tt_address_1', $ttStudentContactInformation->address_1,['placeholder'=>'Address line 1','class'=>'form-control']); }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                           {{ Form::label('address_line_2', 'Address line 2', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
						 {{ Form::text('tt_address_2', $ttStudentContactInformation->address_2,['placeholder'=>'Address line 2','class'=>'form-control']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_city', 'Town/City', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ Form::text('tt_city', $ttStudentContactInformation->city,['placeholder'=>'Town/City','class'=>'form-control']); }}
						 </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_post_code', 'Post code', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">{{ Form::text('tt_post_code', $ttStudentContactInformation->post_code ,['placeholder'=>'Post code','class'=>'form-control']); }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_country', 'Country', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						 
								  {{ Form::select('tt_country', $countries,$ttStudentContactInformation->country,['class'=>'chosen-select col-sm-4']);  }}
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_mobile', 'Mobile', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> <div class="form-inline">+&nbsp;&nbsp;
							   {{ Form::text('tt_mobile',$ttStudentContactInformation->mobile ,['placeholder'=>'Mobile','class'=>'form-control']); }}
							   </div>
							   </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_landline', 'Landline', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"><div class="form-inline"> +&nbsp;&nbsp;
												  {{ Form::text('tt_landline',$ttStudentContactInformation->landline ,['placeholder'=>'Landline','class'=>'form-control']); }}
												  </div>
												  </div>

                                        </div>
                                        </div>

<br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>  
  
<div class="modal fade" id="contact_information_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">CONTACT INFORMATION - Permanent</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('address_line_1', 'Address line 1', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                {{ $studentContactInformation->address_1  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                           {{ Form::label('address_line_2', 'Address line 2', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
                        {{ $studentContactInformation->address_2  }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_city', 'Town/City', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $studentContactInformation->city  }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('post_code', 'Post code', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $studentContactInformation->post_code  }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('country', 'Country', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						  @if($ttStudentContactInformation->country >0)
                                {{ StaticCountry::getNameByID($studentContactInformation->country); }}
                                @endif
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_mobile', 'Mobile', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> +&nbsp;&nbsp;
                               {{ $studentContactInformation->mobile }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_landline', 'Landline', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> +&nbsp;&nbsp;
                                                  {{ $studentContactInformation->landline }}</div>

                                        </div>
                                        </div>
            </div>
			

            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('address_line_1', 'Address line 1', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
								{{ Form::text('address_1', $studentContactInformation->address_1,['placeholder'=>'Address line 1','class'=>'form-control']); }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                           {{ Form::label('address_line_2', 'Address line 2', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
						 {{ Form::text('address_2', $studentContactInformation->address_2,['placeholder'=>'Address line 2','class'=>'form-control']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_city', 'Town/City', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ Form::text('city', $studentContactInformation->city,['placeholder'=>'Town/City','class'=>'form-control']); }}
						 </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('post_code', 'Post code', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">{{ Form::text('post_code', $studentContactInformation->post_code ,['placeholder'=>'Post code','class'=>'form-control']); }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_country', 'Country', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						 
								  {{ Form::select('country', $countries,$ttStudentContactInformation->country,['class'=>'chosen-select col-sm-4']);  }}
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_mobile', 'Mobile', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> <div class="form-inline">+&nbsp;&nbsp;
							   {{ Form::text('mobile',$ttStudentContactInformation->mobile ,['placeholder'=>'Mobile','class'=>'form-control']); }}
							   </div>
							   </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('tt_landline', 'Landline', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"><div class="form-inline"> +&nbsp;&nbsp;
												  {{ Form::text('landline',$ttStudentContactInformation->landline ,['placeholder'=>'Landline','class'=>'form-control']); }}
												  </div>
												  </div>

                                        </div>
                                        </div>

<br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>  
  
<div class="modal fade" id="online_contact_information_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">CONTACT INFORMATION</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('email', 'Email ', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                  {{ $studentContactInformationOnline->email }}

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
                           {{ $studentContactInformationOnline->alternative_email }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('facebook', 'Facebook', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $studentContactInformationOnline->facebook }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('linkedin', 'LinkedIn', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $studentContactInformationOnline->linkedin }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('twitter', 'Twitter', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">{{ $studentContactInformationOnline->twitter}}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('other_social', 'Other Social Accounts', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ $studentContactInformationOnline->other_social }}</div>

                                        </div>
                                        </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('email', 'Email ', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                  
								  {{ Form::text('email', $studentContactInformationOnline->email,['placeholder'=>'Email','class'=>'form-control','data-parsley-type'=>'email']); }}

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
						   {{ Form::text('alternative_email', $studentContactInformationOnline->alternative_email,['placeholder'=>'Alternative Email','class'=>'form-control','data-parsley-type'=>'email']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('facebook', 'Facebook', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						  {{ Form::text('facebook', $studentContactInformationOnline->facebook,['placeholder'=>'Facebook','class'=>'form-control']); }}
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('linkedin', 'LinkedIn', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						  {{ Form::text('linkedin', $studentContactInformationOnline->linkedin,['placeholder'=>'LinkedIn','class'=>'form-control']); }}
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('twitter', 'Twitter', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
						  {{ Form::text('twitter', $studentContactInformationOnline->twitter,['placeholder'=>'Twitter','class'=>'form-control']); }}
						  </div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('other_social', 'Other Social Accounts', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> 
						  {{ Form::text('other_social', $studentContactInformationOnline->other_social,['placeholder'=>'Other','class'=>'form-control']); }}
						  </div>

                                        </div>
                                        </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
    
<div class="modal fade" id="next_of_kin_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">Next Of Kin Details</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                 {{ Form::label('next_of_kin_title', 'Title', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                 {{ $student_contact_information_kin_detailes->next_of_kin_title }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_forename }}</div>
                  </div>
                                        </div>

<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_surname }}</div>
                  </div>
                                        </div>
<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_telephone', 'Telephone', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9"><div class="form-inline">
                                                          +&nbsp;&nbsp;
                                                          {{ $student_contact_information_kin_detailes->next_of_kin_telephone }} </div>
                                   </div></div>
                  </div>
                                       
<div class="row" style="font-size: 16px">
            <div class="form-group">
                  {{ Form::label('next_of_kin_email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
                  <div class="col-sm-9">{{ $student_contact_information_kin_detailes->next_of_kin_email }}</div>
               </div>
                                        </div> </div>
     
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                 {{ Form::label('next_of_kin_title', 'Title', array('class' => 'col-sm-2 control-label'));  }}
                                  <div class="col-sm-10">
								 <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('next_of_kin_title', 'Mr.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Mr.')!==false); }}
                                 <i></i>
                                 Mr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('next_of_kin_title', 'Mrs.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Mrs.')!==false); }}
                                 <i></i>
                                 Mrs
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('next_of_kin_title', 'Miss.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Miss.')!==false); }}
                                 <i></i>
                                 Miss
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                {{ Form::radio('next_of_kin_title', 'Ms.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Ms.')!==false); }}
                                 <i></i>
                                 Ms
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                  {{ Form::radio('next_of_kin_title', 'Dr.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Dr.')!==false); }}
                                 <i></i>
                                 Dr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('next_of_kin_title', 'Other.',strpos( $student_contact_information_kin_detailes->next_of_kin_title,'Other.')!==false); }}
                                 <i></i>
                                 Other
                                 </label>
                              </div>
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'col-sm-2 control-label'));  }}
                     <div class="col-sm-10">{{ Form::text('next_of_kin_forename', $student_contact_information_kin_detailes->next_of_kin_forename,['placeholder'=>'Forename','class'=>'form-control']); }}
					 </div>
                  </div>
                                        </div>

<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'col-sm-2 control-label'));  }}
                     <div class="col-sm-10">
					 {{ Form::text('next_of_kin_surname', $student_contact_information_kin_detailes->next_of_kin_surname,['placeholder'=>'Surname','class'=>'form-control']); }}
					 </div>
                  </div>
                                        </div>
<div class="row" style="font-size: 16px">
            <div class="form-group">
                     {{ Form::label('next_of_kin_telephone', 'Telephone', array('class' => 'col-sm-2 control-label'));  }}
                     <div class="col-sm-10"><div class="form-inline">
                                                          +&nbsp;&nbsp;
{{ Form::text('next_of_kin_telephone', $student_contact_information_kin_detailes->next_of_kin_telephone,['placeholder'=>'','class'=>'form-control','style'=>'width:375px !important','data-parsley-type'=>'digits']); }}
														  </div>
                                   </div></div>
                  </div>
                                       
<div class="row" style="font-size: 16px">
            <div class="form-group">
                  {{ Form::label('next_of_kin_email', 'Email ', array('class' => 'col-sm-2 control-label'));  }}
                  <div class="col-sm-10">
				  {{ Form::text('next_of_kin_email', $student_contact_information_kin_detailes->next_of_kin_email,['placeholder'=>'Email','class'=>'form-control','data-parsley-type'=>'email']); }}
				  </div>
               </div>
                                        </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
    
<div class="modal fade" id="course_details_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">COURSE DETAILS</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                {{ Form::label('course_name', 'Course Name', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                    @if(intval($student_course_enrolments->course_name)>0)
                                   {{ ApplicationCourse::getNameByID($student_course_enrolments->course_name); }} ( {{ $student_course_enrolments->course_level }} )
                                   @endif

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('awarding_body', 'Awarding Body', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
                          
                             @if(intval($student_course_enrolments->awarding_body)>0)
                                {{ ApplicationAwardingBody::getNameByID($student_course_enrolments->awarding_body); }}
                                @endif
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('intake1', 'Intake', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">   {{ StaticYear::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->year).'-'.StaticMonth::getNameByID(ApplicationIntake::getRowByID($student_course_enrolments->intake)->month); }}
</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('study_mode', 'Study mode', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">   {{ $student_course_enrolments->study_mode }}
</div>

                                        </div>
                                        </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>

<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                {{ Form::label('course_name', 'Course Name', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                    @if(intval($student_course_enrolments->course_name)>0)
                           
 {{ Form::select('course_name', $course_names,$student_course_enrolments->course_name,['class'=>'chosen-select col-sm-4']);  }}   

 
								  @endif

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         <div class="col-sm-4">  </div>
                          <div class="col-sm-8">
                          
                               <div class="radio-inline i-checks">
                                                                  <label>
                                                                  {{ Form::radio('course_level', 'Top - Up',strpos($student_course_enrolments->course_level,'Top - Up')!==false); }}
                                                                  <i></i>
                                                                  Top - Up
                                                                  </label>
              </div>
                                                             <div class="radio-inline i-checks">
                                                                <label>
                                                                {{ Form::radio('course_level', 'Advanced Entry',strpos($student_course_enrolments->course_level,'Advanced Entry')!==false); }}
                                                                <i></i>
                                                                Advanced Entry
                                                                </label>
                                                             </div>
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('awarding_body', 'Awarding Body', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">
                          
                             @if(intval($student_course_enrolments->awarding_body)>0)
                                {{ Form::select('awarding_body', $awarding_bodies,$student_course_enrolments->awarding_body,['class'=>'chosen-select col-sm-4']);  }}
                                @else
								{{ Form::select('awarding_body', $awarding_bodies,'',['class'=>'chosen-select col-sm-4']);  }}
								@endif
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('intake1', 'Intake', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8"> {{ Form::select('intake_year', $intake_year,ApplicationIntake::getRowByID($student_course_enrolments->intake)->year,['class'=>'chosen-select col-sm-4','style'=>'max-width:100px !important']);  }}
</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         <div class="col-sm-4"> </div>
                          <div class="col-sm-8">
{{ Form::select('intake_month', $intake_month,$student_course_enrolments->intake,['class'=>'chosen-select']);  }}</div>

                                        </div>
                                        </div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                         {{ Form::label('study_mode', 'Study mode', array('class' => 'col-sm-4 control-label'));  }}
                          <div class="col-sm-8">  <div class="radio-inline i-checks">
                                                                              <label>
                                                                              {{ Form::radio('study_mode', 'Blended',true); }}
                                                                              <i></i>
                                                                              Blended
                                                                              </label>
              </div>
</div>

                                        </div>
                                        </div>

			  <br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
    
<div class="modal fade" id="educational_qualifications_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">EDUCATIONAL QUALIFICATIONS</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('english_language_level1', 'English language level', array('class' => 'col-sm-5 control-label'));  }}
                                  <div class="col-sm-7">
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
                               </div>d
							   <div class="line line-dashed b-b line-lg pull-in"></div>
                               </div>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                   {{ Form::label('qualification_1', 'Qualification 1', array('class' => 'col-sm-4 control-label'));  }}
                                  <div class="col-sm-8">
                                  @if(intval($student_educational_qualifications->qualification_1) == 10000)
                                                                                          @elseif(intval($student_educational_qualifications->qualification_1) == 0)
                                                                                          {{ $student_educational_qualifications->qualification_other_1 }}
                                                                                          @elseif(intval($student_educational_qualifications->qualification_1) > 0)
                                                                                          {{ ApplicationEducationalQualification::getNameByID($student_educational_qualifications->qualification_1) }}
                                                                                          @endif
                                  </div>
                               </div>
                               </div>


<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                    {{ Form::label('institution_1', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                  {{ $student_educational_qualifications->institution_1; }}
                                  </div>
                               </div>
                               </div>



<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                   {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                  {{ $student_educational_qualifications->qualification_start_date_1; }} 
                                  </div>
                               </div>
                               </div>
							   
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                   {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                 {{ $student_educational_qualifications->qualification_end_date_1; }}
                                  </div>
                               </div>
                               </div>



            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                               {{ Form::select('information_source', $information_sources,$data_studentSource->source,['class'=>'chosen-select col-sm-12']);  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                           {{ Form::select('admission_manager',  $admission_managers,$data_studentSource->admission_manager,['class'=>'chosen-select col-sm-12']);  }}
                         {{ Form::text('admission_managers_other', $data_studentSource->admission_managers_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          {{ Form::select('agents_laps', $agents_laps,$data_studentSource->agent_lap,['class'=>'chosen-select col-sm-12','style'=>'width:165px']);  }}
{{ Form::text('agents_laps_other', $data_studentSource->agents_laps_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                        </div>
                                        </div>
            </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
    
<div class="modal fade" id="work_experience_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">AGENT/ ADMISSION MANAGER INFORMATION</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                  @if(intval($studentSource->source)>0)
                                      {{ ApplicationSource::getNameByID(intval($studentSource->source)) }}
                                       @endif

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          @if(intval($studentSource->admission_manager) == 10000)
                            {{ $studentSource->admission_managers_other }}
                            @elseif(intval($studentSource->admission_manager) >0)
                            {{ ApplicationAdmissionManager::getNameByID($studentSource->admission_manager); }}
                            @endif
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9"> @if(intval($studentSource->agent_lap) == 10000)
                                                    {{ $studentSource->agents_laps_other }}
                                                     @elseif((intval($studentSource->source) == 2)&(intval($studentSource->agent_lap)>0))
                                                     {{ ApplicationLap::getNameByID($studentSource->agent_lap)  }}
                                                     @elseif(intval($studentSource->agent_lap)>0)
                                                     {{ApplicationAgent::getNameByID($studentSource->agent_lap) }}
                                                     @endif</div>

                                        </div>
                                        </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                               {{ Form::select('information_source', $information_sources,$data_studentSource->source,['class'=>'chosen-select col-sm-12']);  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                           {{ Form::select('admission_manager',  $admission_managers,$data_studentSource->admission_manager,['class'=>'chosen-select col-sm-12']);  }}
                         {{ Form::text('admission_managers_other', $data_studentSource->admission_managers_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          {{ Form::select('agents_laps', $agents_laps,$data_studentSource->agent_lap,['class'=>'chosen-select col-sm-12','style'=>'width:165px']);  }}
{{ Form::text('agents_laps_other', $data_studentSource->agents_laps_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                        </div>
                                        </div>
            </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
    
<div class="modal fade" id="bqu_only_form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row"> <h3 class="m-t-none m-b">AGENT/ ADMISSION MANAGER INFORMATION</h3>
          <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">


              <h4 class="m-t-none m-b">Existing Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                                  @if(intval($studentSource->source)>0)
                                      {{ ApplicationSource::getNameByID(intval($studentSource->source)) }}
                                       @endif

                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          @if(intval($studentSource->admission_manager) == 10000)
                            {{ $studentSource->admission_managers_other }}
                            @elseif(intval($studentSource->admission_manager) >0)
                            {{ ApplicationAdmissionManager::getNameByID($studentSource->admission_manager); }}
                            @endif
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9"> @if(intval($studentSource->agent_lap) == 10000)
                                                    {{ $studentSource->agents_laps_other }}
                                                     @elseif((intval($studentSource->source) == 2)&(intval($studentSource->agent_lap)>0))
                                                     {{ ApplicationLap::getNameByID($studentSource->agent_lap)  }}
                                                     @elseif(intval($studentSource->agent_lap)>0)
                                                     {{ApplicationAgent::getNameByID($studentSource->agent_lap) }}
                                                     @endif</div>

                                        </div>
                                        </div>
            </div>
            <div class="col-sm-6">


              <h4 class="m-t-none m-b">New Data</h4>
<div class="row" style="font-size: 16px" >
                     <div class="form-group">
                                  {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-9">
                               {{ Form::select('information_source', $information_sources,$data_studentSource->source,['class'=>'chosen-select col-sm-12']);  }}
                                  </div>
                               </div>
                               </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                           {{ Form::select('admission_manager',  $admission_managers,$data_studentSource->admission_manager,['class'=>'chosen-select col-sm-12']);  }}
                         {{ Form::text('admission_managers_other', $data_studentSource->admission_managers_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                                        </div>
                                           <div class="col-sm-4"></div>
                                        </div>
                                        </div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
                          <div class="col-sm-9">
                          {{ Form::select('agents_laps', $agents_laps,$data_studentSource->agent_lap,['class'=>'chosen-select col-sm-12','style'=>'width:165px']);  }}
{{ Form::text('agents_laps_other', $data_studentSource->agents_laps_other,['placeholder'=>'Please specify if other','class'=>'form-control','style'=>'width:250px']); }}
                                        </div>
                                        </div>
            </div><br><br>

            <div class="doc-buttons">
            		                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
            		                <a href="#" class="btn btn-s-md btn-primary">Save</a>
            		              </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  </div>
  
  @stop


 @section('breadcrumb')
   <li><a href="{{ URL::to('/students') }}">Application</a></li>
   <li class="active"><a href="{{ URL::to('#') }}">{{ $student->san }}</a></li>
 @stop


@section('post_css')
{{ HTML::style('js/chosen/chosen.css'); }}
<style>
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
    padding-top: 6px;
}
.modal-dialog{
width: 80%;
}

.chosen-container .chosen-drop {
width: 250px !important;
}
.chosen-container-single .chosen-single {
width: 250px !important;
}
</style>
@stop

@section('post_js')
 {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}
   <!-- parsley -->
 {{ HTML::script('js/parsley/parsley.min.js'); }}
 {{ HTML::script('js/parsley/parsley.extend.js'); }}
 {{ HTML::script('js/student_amend.js'); }}
@stop

@section('main_menu')

 @stop

 @section('san')
 <div align="center">
 <span id="top_san_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">SAN : {{ $student->san }}</span>
 <span id="top_lssn_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">LS SN : {{ $student->ls_student_number }}</span>
 </div>
  @stop