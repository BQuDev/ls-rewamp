@extends('layouts.main')


@section('content')


<div class="row" style="min-height: 50px;"></div>
<div class="row">
   <div class="col-sm-12">
      {{ Form::open(array('url' =>URL::to("/").'/students',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create')) }}
<div class="form-group">
         {{ Form::label('san', 'Student Application Number (SAN)', array('class' => 'col-sm-3 control-label'));  }}
         <div class="col-sm-9">{{ Form::text('san', '',['placeholder'=>'Student Application Number (SAN)','class'=>'form-control','data-required'=>'true','minlength'=>"5",'onBlur'=>'checkSanAvailability()']); }}<span id="san_available"></span><span style="color: red;visibility: hidden" id="san_not_available"> SAN is already in the database </span> </div>
      </div>

      <div class="form-group">
         {{ Form::label('ls_student_number', 'LS Student Number', array('class' => 'col-sm-3 control-label'));  }}
         <div class="col-sm-9">{{ Form::text('ls_student_number', '',['placeholder'=>'LS Student Number','class'=>'form-control']); }}</div>
      </div>
<div class="form-group">
         <div class="form-inline">
            {{ Form::label('app_date', 'App Date', array('class' => 'col-sm-3 control-label'));  }}
            <div class="col-sm-3">
               {{ Form::text('app_date_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
               {{ Form::text('app_date_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
               {{ Form::text('app_date_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>"4",'data-parsley-type'=>'digits']); }}
            </div>
            {{ Form::label('ams_date', 'AMS Date', array('class' => 'col-sm-2 control-label'));  }}
            <div class="col-sm-3">
               {{ Form::text('ams_date_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
               {{ Form::text('ams_date_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
               {{ Form::text('ams_date_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>"4",'data-parsley-type'=>'digits']); }}
            </div>
         </div>
      </div>

            <section class="panel panel-default">
               <header class="panel-heading font-bold" id="AGENT_INFORMATION">AGENT/ ADMISSION MANAGER INFORMATION</header>
               <div class="panel-body">
                  <div class="form-group">
                     {{ Form::label('information_source', 'Information Source', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">
                     {{ Form::select('information_source', $information_sources,'',['class'=>'chosen-select col-sm-4']);  }}

                     </div>
                  </div>


<div class="form-group">
             {{ Form::label('admission_manager', 'Admission manager', array('class' => 'col-sm-3 control-label'));  }}
             <div class="col-sm-4">{{ Form::select('admission_manager',  $admission_managers,'',['class'=>'chosen-select','style'=>'width:259px !important']);  }}</div>
                              <div class="col-sm-4">{{ Form::text('admission_managers_other', '',['placeholder'=>'Please Specify','class'=>'form-control']); }}</div>
                           </div>


<div class="form-group">
             {{ Form::label('agents_laps', 'Agent/LAP', array('class' => 'col-sm-3 control-label'));  }}
             <div class="col-sm-4">{{ Form::select('agents_laps', $agents_laps,'',['class'=>'chosen-select','style'=>'width:259px !important']);  }}</div>
                              <div class="col-sm-4">{{ Form::text('agents_laps_other', '',['placeholder'=>'Please Specify','class'=>'form-control']); }}</div>
                           </div>

               </div>
            </section>

               <section class="panel panel-default">
                     <header class="panel-heading font-bold" id="PERSONAL_DATA">PERSONAL DATA</header>
                     <div class="panel-body">
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Title</label>
                           <div class="col-sm-9">
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Mr.',true); }}
                                 <i></i>
                                 Mr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Mrs.'); }}
                                 <i></i>
                                 Mrs
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Miss.'); }}
                                 <i></i>
                                 Miss
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Ms.'); }}
                                 <i></i>
                                 Ms
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Dr.'); }}
                                 <i></i>
                                 Dr
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('title', 'Other.'); }}
                                 <i></i>
                                 Other
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('initials', 'Initials', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="form-inline">
                              <div class="col-sm-1">{{ Form::text('initials_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                              <div class="col-sm-1">{{ Form::text('initials_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                              <div class="col-sm-1">{{ Form::text('initials_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:60px !important']); }}</div>

                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_1', 'Forename 1', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ Form::text('forename_1', '',['placeholder'=>'Forename 1','class'=>'form-control']); }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_2', 'Forename 2', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ Form::text('forename_2', '',['placeholder'=>'Forename 2','class'=>'form-control']); }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('forename_3', 'Forename 3', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ Form::text('forename_3', '',['placeholder'=>'Forename 3','class'=>'form-control']); }}</div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">{{ Form::text('surname', '',['placeholder'=>'Surname','class'=>'form-control']); }}</div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-3 control-label">Gender</label>
                           <div class="col-sm-9">
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('gender', 'Male',true); }}
                                 <i></i>
                                 Male
                                 </label>
                              </div>
                              <div class="radio-inline i-checks">
                                 <label>
                                 {{ Form::radio('gender', 'Female'); }}
                                 <i></i>
                                 Female
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('date_of_birth', 'Date of birth', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-3"><div class="form-inline">
                                          {{ Form::text('date_of_birth_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
                                          {{ Form::text('date_of_birth_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>"2",'data-parsley-type'=>'digits']); }}
                                          {{ Form::text('date_of_birth_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>"4",'data-parsley-type'=>'digits']); }}
                                       </div>
                                       </div>
                           </div>
                        <div class="form-group">
                           {{ Form::label('nationality', 'Nationality', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">

                              {{ Form::select('nationality', $nationalities,'',['class'=>'chosen-select col-sm-4']);  }}
                           </div>
                        </div>
                        <div class="form-group">
                           {{ Form::label('passport', 'Passport number', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9"> {{ Form::text('passport', '',['placeholder'=>'Passport number','class'=>'form-control']); }}</div>
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
                             {{ Form::text('tt_address_1', '',['placeholder'=>'Address line 1','class'=>'form-control']); }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Address line 2</label>
                          <div class="col-sm-9">
                             {{ Form::text('tt_address_2', '',['placeholder'=>'Address line 2','class'=>'form-control']); }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Town/City</label>
                          <div class="col-sm-9">
                             {{ Form::text('tt_city', '',['placeholder'=>'Town/City','class'=>'form-control']); }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Post code</label>
                          <div class="col-sm-9">
                             {{ Form::text('tt_post_code', '',['placeholder'=>'Post code','class'=>'form-control']); }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Country</label>
                          <div class="col-sm-9">
                             {{ Form::select('tt_country', $countries,'',['class'=>'chosen-select col-sm-4']);  }}
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label">Telephone</label>
                          <label class="col-sm-2 control-label">Mobile</label>
                          <div class="col-sm-9">
                             <div class="form-inline">
                               +&nbsp;&nbsp;
                               {{ Form::text('tt_mobile_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                               {{ Form::text('tt_mobile_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                               {{ Form::text('tt_mobile_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                               {{ Form::text('tt_mobile', '',['placeholder'=>'','class'=>'form-control','style'=>'width:350px !important','data-parsley-type'=>'digits']); }}
                             </div>
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-1 control-label"></label>
                          <label class="col-sm-2 control-label">Landline</label>
                          <div class="col-sm-9">
                             <div class="form-inline">
                                                 +&nbsp;&nbsp;
                                                 {{ Form::text('tt_landline_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits','data-parsley-type'=>'digits']); }}
                                                 {{ Form::text('tt_landline_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits','data-parsley-type'=>'digits']); }}
                                                 {{ Form::text('tt_landline_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits','data-parsley-type'=>'digits']); }}
                                                 {{ Form::text('tt_landline', '',['placeholder'=>'','class'=>'form-control','style'=>'width:350px !important','data-parsley-type'=>'digits','data-parsley-type'=>'digits']); }}
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
                  {{ Form::text('address_1', '',['placeholder'=>'Address line 1','class'=>'form-control']); }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Address line 2</label>
               <div class="col-sm-9">
                  {{ Form::text('address_2', '',['placeholder'=>'Address line 2','class'=>'form-control']); }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Town/City</label>
               <div class="col-sm-9">
                  {{ Form::text('city', '',['placeholder'=>'Town/City','class'=>'form-control']); }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Post code</label>
               <div class="col-sm-9">
                  {{ Form::text('post_code', '',['placeholder'=>'Post code','class'=>'form-control']); }}
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Country</label>
               <div class="col-sm-9">

                     {{ Form::select('country', $countries,'',['class'=>'chosen-select col-sm-4']);  }}

               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label">Telephone</label>
               <label class="col-sm-2 control-label">Mobile</label>
               <div class="col-sm-9">
                  <div class="form-inline">
                    +&nbsp;&nbsp;
                    {{ Form::text('mobile_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                    {{ Form::text('mobile_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                    {{ Form::text('mobile_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                    {{ Form::text('mobile', '',['placeholder'=>'','class'=>'form-control','style'=>'width:350px !important','data-parsley-type'=>'digits']); }}
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label class="col-sm-1 control-label"></label>
               <label class="col-sm-2 control-label">Landline</label>
               <div class="col-sm-9">
                  <div class="form-inline">
                                      +&nbsp;&nbsp;
                                      {{ Form::text('landline_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                      {{ Form::text('landline_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                      {{ Form::text('landline_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                      {{ Form::text('landline', '',['placeholder'=>'','class'=>'form-control','style'=>'width:350px !important','data-parsley-type'=>'digits']); }}
                                    </div>
               </div>
            </div>
            <div class="form-group">
               {{ Form::label('email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('email', '',['placeholder'=>'Email','class'=>'form-control','data-parsley-type'=>'email']); }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('alternative_email', 'Alternative Email', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('alternative_email', '',['placeholder'=>'Alternative Email','class'=>'form-control','data-parsley-type'=>'email']); }}</div>
            </div>
            <div class="form-group">
               <div class="line line-dashed b-b line-lg pull-in"></div>
               {{ Form::label('forename_3', 'Social Accounts', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('facebook', '',['placeholder'=>'Facebook','class'=>'form-control']); }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('linkedin', '',['placeholder'=>'LinkedIn','class'=>'form-control']); }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('twitter', '',['placeholder'=>'Twitter','class'=>'form-control']); }}</div>
            </div>
            <div class="form-group">
               {{ Form::label('forename_3', ' ', array('class' => 'col-sm-3 control-label'));  }}
               <div class="col-sm-9">{{ Form::text('other_social', '',['placeholder'=>'Other','class'=>'form-control']); }}</div>
            </div>
         </div>
         <div class="line line-dashed b-b line-lg pull-in"></div>
      </section>

      <section class="panel panel-default">
               <header class="panel-heading font-bold" id="NEXT_OF_KIN_DETAILS">Next of Kin Details</header>
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Title</label>
                     <div class="col-sm-9">
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Mr.',true); }}
                           <i></i>
                           Mr
                           </label>
                        </div>
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Mrs.'); }}
                           <i></i>
                           Mrs
                           </label>
                        </div>
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Miss.'); }}
                           <i></i>
                           Miss
                           </label>
                        </div>
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Ms.'); }}
                           <i></i>
                           Ms
                           </label>
                        </div>
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Dr.'); }}
                           <i></i>
                           Dr
                           </label>
                        </div>
                        <div class="radio-inline i-checks">
                           <label>
                           {{ Form::radio('next_of_kin_title', 'Other.'); }}
                           <i></i>
                           Other
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_forename', 'Forename', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ Form::text('next_of_kin_forename', '',['placeholder'=>'Forename','class'=>'form-control']); }}</div>
                  </div>
                  <div class="form-group">
                     {{ Form::label('next_of_kin_surname', 'Surname', array('class' => 'col-sm-3 control-label'));  }}
                     <div class="col-sm-9">{{ Form::text('next_of_kin_surname', '',['placeholder'=>'Surname','class'=>'form-control']); }}</div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 control-label">Telephone</label>
                       <div class="col-sm-9">
                                      <div class="form-inline">
                                                          +&nbsp;&nbsp;
                                                          {{ Form::text('next_of_kin_telephone_1', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                                          {{ Form::text('next_of_kin_telephone_2', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                                          {{ Form::text('next_of_kin_telephone_3', '',['placeholder'=>'','class'=>'form-control','style'=>'width:40px !important','maxlength'=>'1','data-parsley-type'=>'digits']); }}
                                                          {{ Form::text('next_of_kin_telephone', '',['placeholder'=>'','class'=>'form-control','style'=>'width:350px !important','data-parsley-type'=>'digits']); }}
                                                        </div>
                                   </div>
                  </div>
               </div>
               <div class="form-group">
                  {{ Form::label('next_of_kin_email', 'Email ', array('class' => 'col-sm-3 control-label'));  }}
                  <div class="col-sm-9">{{ Form::text('next_of_kin_email', '',['placeholder'=>'Email','class'=>'form-control','data-parsley-type'=>'email']); }}</div>
               </div>
            </section>

            <section class="panel panel-default">
                     <header class="panel-heading font-bold" id="COURSE_DETAILS">COURSE DETAILS</header>
                     <div class="panel-body">
                        <div class="form-group">
                           {{ Form::label('course_name', 'Course Name', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">
                                <div class="form-inline">
                                {{ Form::select('course_name', $course_names,'',['class'=>'chosen-select col-sm-4']);  }}




                           </div>
                           </div>
                        </div>

                        <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                    <div class="radio-inline i-checks">
                                            <label>
                                            {{ Form::radio('course_level', 'Top - Up',true); }}
                                            <i></i>
                                            Top - Up
                                            </label>
                                         </div>
                                       <div class="radio-inline i-checks">
                                          <label>
                                          {{ Form::radio('course_level', 'Advanced Entry'); }}
                                          <i></i>
                                          Advanced Entry
                                          </label>
                                       </div>

                                    </div>
                                 </div>
                        <div class="form-inline">

                        </div>
                        <div class="form-group">
                           {{ Form::label('awarding_body', 'Awarding Body', array('class' => 'col-sm-3 control-label'));  }}
                           <div class="col-sm-9">

                              {{ Form::select('awarding_body', $awarding_bodies,'',['class'=>'chosen-select col-sm-4']);  }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        {{ Form::label('intake1', 'Intake', array('class' => 'col-sm-3 control-label'));  }}
                        <div class="col-sm-9">
                           <div class="form-group">
                             <div class="form-inline">
                             <div class="col-sm-3">
                                              {{ Form::label('intake_year', 'Year', array('class' => 'col-sm-3 control-label'));  }}
                                                <div class="col-sm-2">

                                                   {{ Form::select('intake_year', $intake_year,'',['class'=>'chosen-select','style'=>'width:150px !important']);  }}
                                                </div>
                             </div>
                             <div class="col-sm-4">
                                              {{ Form::label('intake', 'Intake', array('class' => 'col-sm-3 control-label'));  }}
                                                <div class="col-sm-9">

                                                   {{ Form::select('intake', $intake,'',['class'=>'chosen-select','style'=>'width:150px !important']);  }}
                                                </div>
                             </div>
                             </div>
                           </div>

                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label">Study mode</label>
                        <div class="col-sm-9">
                        <div class="radio-inline i-checks">
                                <label>
                                {{ Form::radio('study_mode', 'Blended',true); }}
                                <i></i>
                                Blended
                                </label>
                             </div>
                           <!--<div class="radio-inline i-checks">
                              <label>
                              {{ Form::radio('study_mode', 'Online'); }}
                              <i></i>
                              Online
                              </label>
                           </div>
                           <div class="radio-inline i-checks">
                              <label>
                              {{ Form::radio('study_mode', 'Face to Face'); }}
                              <i></i>
                              Face to Face
                              </label>
                           </div>-->

                        </div>
                     </div>
                  </section>
                  <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="EDUCATIONAL_QUALIFICATIONS">EDUCATIONAL QUALIFICATIONS</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('english_language_level1', 'English language level', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
                                    <div class="form-inline">
                                       <div class="col-sm-3 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('english_language_level[]', 'CITY & GUILDS',false); }}
                                             <i></i>
                                             CITY & GUILDS
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('english_language_level[]', 'IELTS',false); }}
                                             <i></i>
                                             IELTS
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('english_language_level[]', 'ESOL',false); }}
                                             <i></i>
                                             ESOL
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-5">
                                       <div class="form-inline">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('english_language_level[]', 'Other',false); }}
                                             <i></i>
                                             Other
                                             </label>
                                          </div>
                                          {{ Form::text('english_language_level_other', '',['placeholder'=>'','class'=>'form-control']); }}
                                       </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>



                              <div class="form-group">
                                 {{ Form::label('qualification_1', 'Qualification 1', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-4">{{ Form::select('qualification_1', $education_qualifications,'',['class'=>'chosen-select','style'=>'width:350px !important']);  }}</div>
                                                  <div class="col-sm-4">{{ Form::text('qualification_1_other', '',['placeholder'=>'Please Specify','class'=>'form-control']); }}</div>
                                               </div>
                              <div class="form-group">
                                 {{ Form::label('institution_1', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('institution_1', '',['placeholder'=>'Institution','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                                {{ Form::text('qualification_start_date_1', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_month_1', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_year_1', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('qualification_end_date_1', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_month_1', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_year_1', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('qualification_grade_1', '',['placeholder'=>'Pass','class'=>'form-control']); }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>


                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <p>
                                       <a href="#" id="add_more_qualifications" class="btn btn-default btn-sm">Add More Qualifications</a>
                                    </p>
                                 </div>
                              </div>



                  <div id="qualification_container_2">
                              <div class="form-group">
                                 {{ Form::label('qualification_2', 'Qualification 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-4">{{ Form::select('qualification_2', $education_qualifications,'',['style'=>'width:350px !important','class'=>'chosen-select']);  }}</div>
                                   <div class="col-sm-4">{{ Form::text('qualification_2_other', '',['placeholder'=>'Please Specify','class'=>'form-control']); }}</div>
                                </div>
                              <div class="form-group">
                                 {{ Form::label('institution_2', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('institution_2', '',['placeholder'=>'Institution','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                                {{ Form::text('qualification_start_date_2', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_month_2', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_year_2', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('qualification_end_date_2', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_month_2', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_year_2', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('qualification_grade_2', '',['placeholder'=>'Pass','class'=>'form-control']); }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>


                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <p>
                                       <a href="#" id="add_more_qualifications_2" class="btn btn-default btn-sm">Add More Qualifications</a>
                                    </p>
                                 </div>
                              </div>
                           </div>

                  <div id="qualification_container_3">
                              <div class="form-group">
                                 {{ Form::label('qualification_3', 'Qualification 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-4">{{ Form::select('qualification_3', $education_qualifications,'',['class'=>'chosen-select','style'=>'width:350px !important']);  }}</div>
                                 <div class="col-sm-4">{{ Form::text('qualification_3_other', '',['placeholder'=>'Please Specify','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('institution_3', 'Institution', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('institution_3', '',['placeholder'=>'Institution','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_start_date', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3">
                                  <div class="form-inline">
                                                {{ Form::text('qualification_start_date_3', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_month_3', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_start_year_3', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('qualification_end_date_3', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_month_3', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('qualification_end_year_3', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('qualification_grade', 'Grade', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('qualification_grade_3', '',['placeholder'=>'Pass','class'=>'form-control']); }}</div>
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
                                 <div class="col-sm-9">{{ Form::text('occupation_1', '',['placeholder'=>'Occupation','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_1', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('company_name_1', '',['placeholder'=>'Company Name - Address','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_1', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::textarea('main_duties_and_responsibilities_1', '',['placeholder'=>'','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_start_date_1', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_month_1', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_year_1', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_end_date_1', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_month_1', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_year_1', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <div class="checkbox i-checks">
                                       <label>
                                      {{ Form::checkbox('currently_working_1', 'Yes',false); }}
                                       <i></i>
                                       Currently working
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <p>
                                       <a href="#" class="btn btn-default btn-sm" id="add_more_occupations_1">Add More Occupations</a>
                                    </p>
                                 </div>
                              </div>
                              </div>

                           <div id="occupation_container_2">
                           <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('forename_2', 'Occupation 2', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('occupation_2', '',['placeholder'=>'Occupation','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_2', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('company_name_2', '',['placeholder'=>'Company Name - Address','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_2', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::textarea('main_duties_and_responsibilities_2', '',['placeholder'=>'','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_start_date_2', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_month_2', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_year_2', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_end_date_2', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_month_2', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_year_2', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <div class="checkbox i-checks">
                                       <label>
                                      {{ Form::checkbox('currently_working_2', 'Yes',false); }}
                                       <i></i>
                                       Currently working
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <p>
                                       <a href="#" class="btn btn-default btn-sm" id="add_more_occupations_2">Add More Occupations</a>
                                    </p>
                                 </div>
                              </div>
                              </div>


                           <div id="occupation_container_3">
                           <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('forename_2', 'Occupation 3', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('occupation_3', '',['placeholder'=>'Occupation','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('company_name_3', 'Company Name - Address', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('company_name_3', '',['placeholder'=>'Company Name - Address','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('main_duties_and_responsibilities_3', 'Main duties and responsibilities', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::textarea('main_duties_and_responsibilities_3', '',['placeholder'=>'','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Start date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_start_date_3', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_month_3', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_start_year_3', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'End date', array('class' => 'col-sm-3 control-label'));  }}
                                  <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('occupation_end_date_3', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_month_3', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('occupation_end_year_3', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>
                              <div class="form-group">
                                 <div class="col-sm-3"></div>
                                 <div class="col-sm-9">
                                    <div class="checkbox i-checks">
                                       <label>
                                      {{ Form::checkbox('currently_working_3', 'Yes',false); }}
                                       <i></i>
                                       Currently working
                                       </label>
                                    </div>
                                 </div>
                              </div>
                              </div>





                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="PAYMENT_INFORMATION">PAYMENT INFORMATION</header>
                           <div class="panel-body">
                           <div class="form-group">
                              <label class="col-sm-3 control-label">Course fees</label>
                              <div class="col-sm-9">
                              <div class="col-sm-2">
                                 <div class="radio-inline i-checks">
                                    <label>
                                    {{ Form::radio('course_fees', 'Self funded',true); }}
                                    <i></i>
                                    Self funded
                                    </label>
                                 </div>
                                 </div><div class="col-sm-4">
                                 <div class="radio-inline i-checks">
                                    <label>
                                    {{ Form::radio('course_fees', 'Sponsored by the Company'); }}
                                    <i></i>
                                    Sponsored by the Company
                                    </label>
                                 </div>
                                 </div><div class="col-sm-3">
                                 <div class="radio-inline i-checks">
                                    <label>
                                    {{ Form::radio('course_fees', 'Bank Loan'); }}
                                    <i></i>
                                    Bank Loan
                                    </label>
                                 </div>
                                 </div>
                              </div>
                           </div>
                                                   <!--
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Course fees', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
                                    <div class="form-inline">
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('course_fees[]', 'Self funded',false); }}
                                             <i></i>
                                             Self funded
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-4 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('course_fees[]', 'Sponsored by the Company',false); }}
                                             <i></i>
                                             Sponsored by the Company
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('course_fees[]', 'Bank Loan',false); }}
                                             <i></i>
                                             Bank Loan
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div> -->

                              <div class="form-group">
                                <label class="col-sm-3 control-label">Payment Status</label>
                                <div class="col-sm-9">
                                <div class="col-sm-2">
                                   <div class="radio-inline i-checks">
                                      <label>
                                      {{ Form::radio('payment_status', 'Paid in full'); }}
                                      <i></i>
                                      Paid in full
                                      </label>
                                   </div>
                                   </div><div class="col-sm-4">
                                   <div class="radio-inline i-checks">
                                      <label>
                                      {{ Form::radio('payment_status', 'Unpaid'); }}
                                      <i></i>
                                      Unpaid
                                      </label>
                                   </div>
                                   </div><div class="col-sm-3">
                                   <div class="radio-inline i-checks">
                                      <label>
                                      {{ Form::radio('payment_status', 'Deposit paid',true); }}
                                      <i></i>
                                      Deposit paid
                                      </label>
                                   </div>
                                   </div>
                                </div>
                             </div>
                                <!--
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Payment Status', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9 ">
                                    <div class="form-inline">
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('payment_status[]', 'Paid in full',false); }}
                                             <i></i>
                                             Paid in full
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-4 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('payment_status[]', 'Unpaid',false); }}
                                             <i></i>
                                             Unpaid
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-sm-2 ">
                                          <div class="checkbox i-checks">
                                             <label>
                                             {{ Form::checkbox('payment_status[]', 'Deposit paid',false); }}
                                             <i></i>
                                             Deposit paid
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>-->
                              <div class="form-group">
                                 {{ Form::label('total_fee', 'Total fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('total_fee', '',['placeholder'=>'Total fee','class'=>'form-control']); }}</div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('deposit', 'Deposit', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ Form::text('deposit', '',['placeholder'=>'Deposit','class'=>'form-control']); }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  {{ Form::text('deposit_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('deposit_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('deposit_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                                               </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">

                                       {{ Form::select('deposit_payment_method_1', $method_of_payment,'',['class'=>'chosen-select col-sm-12']);  }}
                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 1', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ Form::text('instalment_1', '',['placeholder'=>'Instalment 1','class'=>'form-control']); }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  {{ Form::text('instalment_1_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_1_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_1_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                                               </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                       {{ Form::select('instalment_payment_method_1', $method_of_payment,'',['class'=>'chosen-select col-sm-12']);  }}

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 2', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ Form::text('instalment_2', '',['placeholder'=>'Instalment 2','class'=>'form-control']); }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  {{ Form::text('instalment_2_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_2_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_2_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                                               </div>
                                                               </div>{{ Form::label('nationality', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                       {{ Form::select('instalment_payment_method_2', $method_of_payment,'',['class'=>'chosen-select col-sm-12']);  }}

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="form-inline">
                                    {{ Form::label('forename_3', 'Instalment 3', array('class' => 'col-sm-3 control-label'));  }}
                                    <div class="col-sm-2">{{ Form::text('instalment_3', '',['placeholder'=>'Instalment 3','class'=>'form-control']); }}</div>
                                    {{ Form::label('date_of_birth', 'Date', array('class' => 'col-sm-1 control-label'));  }}
                                    <div class="col-sm-2"><div class="form-inline">
                                                                  {{ Form::text('instalment_3_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_3_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                                  {{ Form::text('instalment_3_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                                               </div>
                                                               </div>{{ Form::label('instalment_payment_method_3', 'Method of payment', array('class' => 'col-sm-2 control-label'));  }}
                                    <div class="col-sm-2">
                                       {{ Form::select('instalment_payment_method_3', $method_of_payment,'',['class'=>'chosen-select col-sm-12']);  }}

                                    </div>
                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                 </div>
                              </div>
                              <div class="line line-dashed b-b line-lg pull-in"></div>
                              <div class="form-group">
                                 {{ Form::label('late_admin_fee', 'Late admin fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('late_admin_fee', '',['placeholder'=>'Late admin fee','class'=>'form-control']); }}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('late_fee', 'Late fee', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::text('late_fee', '',['placeholder'=>'Late fee','class'=>'form-control']); }}</div>
                              </div>
                           </div>
                        </section>
                        <section class="panel panel-default">
                           <header class="panel-heading font-bold" id="BQu_ONLY">BQu only</header>
                           <div class="panel-body">
                              <div class="form-group">
                                 {{ Form::label('date_of_birth', 'Application received to BQu date', array('class' => 'col-sm-3 control-label'));  }}
                                <div class="col-sm-3"><div class="form-inline">
                                               {{ Form::text('application_received_to_bqu_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                               {{ Form::text('application_received_to_bqu_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                               {{ Form::text('application_received_to_bqu_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                            </div>
                                            </div>
                                            </div>
                              <div class="form-group">
                                 {{ Form::label('application_input_by', 'Application input by', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-9">{{ Form::hidden('application_input_by', Sentry::getUser()->id) }} {{Sentry::getUser()->first_name.' '.Sentry::getUser()->last_name}}</div>
                              </div>
                              <div class="form-group">
                                 {{ Form::label('supervisor', 'Supervisor ', array('class' => 'col-sm-3 control-label'));  }}

                                 <div class="col-sm-9">


                                 <select data-placeholder="Choose a Supervisors" class="chosen-select col-sm-12" id="supervisor" name="supervisor">
                                @foreach($supervisors as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->first_name.' '.$supervisor->last_name }}</option>
                                @endforeach
                                </select>
                                 </div>
                              </div>
                              <!--<div class="form-group">
                                 {{ Form::label('date_of_birth', 'Applicant verified by BQu date', array('class' => 'col-sm-3 control-label'));  }}
                                 <div class="col-sm-3"><div class="form-inline">
                                                {{ Form::text('applicant_verified_by_bqu_date', '',['placeholder'=>'DD','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('applicant_verified_by_bqu_month', '',['placeholder'=>'MM','class'=>'form-control','style'=>'width:50px !important','data-type'=>'number','maxlength'=>'2','data-parsley-type'=>'digits']); }}
                                                {{ Form::text('applicant_verified_by_bqu_year', '',['placeholder'=>'YYYY','class'=>'form-control','style'=>'width:60px !important','data-type'=>'number','maxlength'=>'4','data-parsley-type'=>'digits']); }}
                                             </div>
                                             </div>
                                             </div>-->
                              <div class="form-group">
                                 <label class="col-sm-1 control-label"></label>
                                 <label class="col-sm-2 control-label">Status </label>
                                 <div class="col-sm-9">
{{ Form::hidden('admission_status','1') }}
{{ Form::hidden('notes','') }}
Added ( Pending for validation )

                                 </div>
                              </div>
                           </div>
                           <div class="line line-dashed b-b line-lg pull-in"></div>
                                       <div class="form-group">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-9">
                                             <div class="checkbox i-checks">
                                                <label>
                                               {{ Form::checkbox('confirm_save', '1',false,array('data-required'=>'true')); }}
                                                <i></i>
                                                Confirm Save
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="line line-dashed b-b line-lg pull-in"></div>
                           <div class="form-group">
                              <label class="col-sm-3 control-label"> </label>
                              <div class="col-sm-9">
                              {{ Form::submit('Save', array('class' => 'btn btn-s-md btn-primary')) }}
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
{{ HTML::style('js/chosen/chosen.css'); }}
@stop

@section('post_js')
<script type="text/javascript">

    $('li').click(function () {
        $('li.selected').removeClass('selected');
        $(this).addClass('selected');
    });




    $('#information_source').change(function(){
        if($('#information_source').val()==3){
            //$('[name="agents_laps"]').prop('disabled', true);
            //$('[name="agents_laps"]').val(0);
        }
        $.ajax({
            url: "{{ url('students/create/information_source/dropdown')}}",
            data: {token: $('[name="_token"]').val(),option: $('#information_source').val()},
            success: function (data) {console.log('success');
                $('[name="agent_names"]').empty();
                var model = $('[name="agents_laps"]');
                model.empty();
                model.append("<option value='0'>Please Select an Option</option>");
                $.each(data, function(index, element) {
                    model.append("<option value='"+ index +"'>" + element + "</option>");
                });
                model.append("<option value='10000'>Other</option>");
                $('[name="agents_laps"]').trigger("chosen:updated");
            },
            type: "GET"
        });
    });



    $('#intake_year').change(function(){
        $.ajax({
            url: "{{ url('students/create/intakes/dropdown')}}",
            data: {token: $('[name="_token"]').val(),option: $('#intake_year').val()},
            success: function (data) {
                $('[name="intake_month"]').empty();
                var model = $('[name="intake"]');
                model.empty();
                $.each(data, function(index, element) {
                    model.append("<option value='"+ index +"'>" + element + "</option>");
                });
                $('[name="intake"]').trigger("chosen:updated");
            },
            type: "GET"
        });
    });

    function checkSanAvailability(){
        if(!isEmpty($('#san').val())){
            $.ajax({
                url: "{{ url('students/create/checkSanAvailability')}}",
                data: {token: $('[name="_token"]').val(),option: $('#san').val()},
                success: function (data) {
                    console.log(data);
                    if(data =='Available'){
                        $('#san').removeClass("parsley-error").addClass( "parsley-success" );
                        $('#san_not_available').hide();
                    }else{
                        $('#san').removeClass("parsley-success").addClass( "parsley-error" );
                        $('#san_not_available').show();
                    }
                },
                type: "GET"

            });}
    }

</script>

 {{ HTML::script('js/student_create.js'); }}

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

.breadcrumb > li + li::before {
    color: #ccc;
    content: "| "!important;
    padding: 0 5px;
}

.selected { font-weight: bold }
</style>
@stop

@section('main_menu')

 @stop

 @section('san')
 <div align="center">
 </div>
  @stop