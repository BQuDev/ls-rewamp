<?php


class StudentsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /students
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return View::make('students.index')
                        ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                            ->groupBy('san')
                            ->get());
	}


    public function validate()
    {
        //
        return View::make('students.validate')
            ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                ->groupBy('san')
                ->get());
    }

    public function verify()
    {
        //
        return View::make('students.verify')
            ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                ->groupBy('san')
                ->get());
    }
	/**
	 * Show the form for creating a new resource.
	 * GET /students/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		try
            {
                $bqu_group = Sentry::findGroupByName('BQu');
            }
            catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
            {
                echo 'Group was not found.';
            }

            $supervisors = DB::table('users')
                ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                ->select('users.id', 'users.first_name', 'users.last_name')
                ->get();

		 return View::make('students.create')
                    ->with('information_sources',ApplicationSource::lists('name','id'))
                    //->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))
                    //To-Do
                    ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))

                    //->with('agents_laps',ApplicationAdmissionManager::lists('name','id'))

                    ->with('agents_laps',array_merge(ApplicationAgent::lists('name','id'), ApplicationLap::lists('name','id')))
                    ->with('nationalities',StaticNationality::lists('name','id'))
                    ->with('countries',StaticCountry::lists('name','id'))
                    ->with('course_names',ApplicationCourse::lists('name','id'))
                    ->with('awarding_bodies',ApplicationAwardingBody::lists('name','id'))

                    ->with('education_qualifications',ApplicationEducationalQualification::lists('name','id'))
                    ->with('method_of_payment',ApplicationPaymentInfoMethodsOfPayment::lists('name','id'))
                    ->with('application_status',ApplicationStatus::lists('name','id'))
                    ->with('intake_year',StaticYear::lists('name','id'))
                    ->with('intake',ApplicationIntake::lists('name','id'))
                    ->with('supervisors',$supervisors);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /students
	 *
	 * @return Response
	 */
	public function store()
	{
		//

		$student_exists = Student::where('san','=',Input::get('san'))->first();
		if(!is_null($student_exists))
		{Notify::error('SAN ('.Input::get('san').') already exists');
		return View::make('students.index')
                                ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                                    ->groupBy('san')
                                    ->get());
		}



		 $student_data_snapshot = new StudentDataSnapshot();
		$student = new Student();
                $student->title = Input::get('title');
                $student->initials_1 = Input::get('initials_1');
                $student->initials_2 = Input::get('initials_2');
                $student->initials_3 = Input::get('initials_3');
                $student->forename_1 = Input::get('forename_1');
                $student->forename_2 = Input::get('forename_2');
                $student->forename_3 = Input::get('forename_3');
                $student->surname = Input::get('surname');
                $student->gender = Input::get('gender');
                $student->date_of_birth = Input::get('date_of_birth_date') . '-' . Input::get('date_of_birth_month') . '-' . Input::get('date_of_birth_year');
                $student->nationality = Input::get('nationality');
                $student->passport = Input::get('passport');
				$student->amendment = 0;
                $student->created_by = Sentry::getUser()->id;
              
                $student->san = Input::get('san');
                $student->ls_student_number = Input::get('ls_student_number');


                $student->save();

                $student_data_snapshot->student = $student->id;


                //Student Source
                $student_source = new StudentSource();
                $student_source->app_date =  Input::get('app_date_date') . '-' . Input::get('app_date_month') . '-' . Input::get('app_date_year');
                $student_source->ams_date =  Input::get('ams_date_date') . '-' . Input::get('ams_date_month') . '-' . Input::get('ams_date_year');
                $student_source->source = Input::get('information_source');

                $student_source->agent_lap = Input::get('agents_laps');
                $student_source->agents_laps_other = Input::get('agents_laps_other');

                $student_source->admission_manager = Input::get('admission_manager');
                $student_source->admission_managers_other = Input::get('admission_managers_other');
                $student_source->san = Input::get('san');
                $student_source->amendment = 0;
            
                $student_source->created_by = Sentry::getUser()->id;
                $student_source->save();
                $student_data_snapshot->source_id = $student_source->id;

                // Saving contact details
                $contact_details = new StudentContactInformation();
                $contact_details_1 = $contact_details->replicate();

                $contact_details->address_1 = Input::get('tt_address_1');
                $contact_details->address_2 = Input::get('tt_address_2');
                $contact_details->city = Input::get('tt_city');
                $contact_details->post_code = Input::get('tt_post_code');
                $contact_details->country = Input::get('tt_country');
                $contact_details->mobile = Input::get('tt_mobile_1').Input::get('tt_mobile_2').Input::get('tt_mobile_3').Input::get('tt_mobile');
                $contact_details->landline = Input::get('tt_landline_1').Input::get('tt_landline_2').Input::get('tt_landline_3').Input::get('tt_landline');
                $contact_details->student_contact_information_type = 1;
                $contact_details->san = Input::get('san');
                $contact_details->amendment = 0;
              
                $contact_details->created_by = Sentry::getUser()->id;
                $contact_details->save();
                $student_data_snapshot->contact_information_tt = $contact_details->id;

                $contact_details_1->address_1 = Input::get('address_1');
                $contact_details_1->address_2 = Input::get('address_2');
                $contact_details_1->city = Input::get('city');
                $contact_details_1->post_code = Input::get('post_code');
                $contact_details_1->country = Input::get('country');
                $contact_details_1->mobile = Input::get('mobile_1').Input::get('mobile_2').Input::get('mobile_3').Input::get('mobile');
                $contact_details_1->landline = Input::get('landline_1').Input::get('landline_2').Input::get('landline_3').Input::get('landline');
                $contact_details_1->student_contact_information_type = 2;
                $contact_details_1->san = Input::get('san');
                $contact_details_1->amendment = 0;
            
                $contact_details_1->created_by = Sentry::getUser()->id;
                $contact_details_1->save();
                $student_data_snapshot->contact_information_p = $contact_details_1->id;

                $contact_details_online = new StudentContactInformationOnline();
                $contact_details_online->email = Input::get('email');
                $contact_details_online->alternative_email = Input::get('alternative_email');
                $contact_details_online->facebook = Input::get('facebook');
                $contact_details_online->linkedin = Input::get('linkedin');
                $contact_details_online->twitter = Input::get('twitter');
                $contact_details_online->other_social = Input::get('other_social');
                $contact_details_online->san = Input::get('san');
                $contact_details_online->amendment = 0;
               
                $contact_details_online->created_by = Sentry::getUser()->id;
                $contact_details_online->save();
                $student_data_snapshot->contact_information_online = $contact_details_online->id;

                $contact_details_kin = new StudentContactInformationKinDetail();
                $contact_details_kin->next_of_kin_title = Input::get('next_of_kin_title');
                $contact_details_kin->next_of_kin_forename = Input::get('next_of_kin_forename');
                $contact_details_kin->next_of_kin_surname = Input::get('next_of_kin_surname');
                $contact_details_kin->next_of_kin_telephone = Input::get('next_of_kin_telephone_1').Input::get('next_of_kin_telephone_2').Input::get('next_of_kin_telephone_3').Input::get('next_of_kin_telephone');
                $contact_details_kin->next_of_kin_email = Input::get('next_of_kin_email');
                $contact_details_kin->san = Input::get('san');
                $contact_details_kin->amendment = 0;
              
                $contact_details_kin->created_by = Sentry::getUser()->id;
                $contact_details_kin->save();
                $student_data_snapshot->contact_information_kin_detail = $contact_details_kin->id;

                $course_enrolment = new StudentCourseEnrolment();
                $course_enrolment->course_name = Input::get('course_name');
                $course_enrolment->course_level = Input::get('course_level');
                $course_enrolment->awarding_body = Input::get('awarding_body');
                $course_enrolment->intake =  Input::get('intake'); //intake_month = intake
                $course_enrolment->study_mode = Input::get('study_mode');
                $course_enrolment->san = Input::get('san');
                $course_enrolment->amendment = 0;
              
                $course_enrolment->created_by = Sentry::getUser()->id;
                $course_enrolment->save();
                $student_data_snapshot->course_enrolment = $course_enrolment->id;

                $educational_qualifications = new StudentEducationalQualification();

                $educational_qualifications->qualification_other_1 = Input::get('qualification_1_other');
                $educational_qualifications->qualification_1 = Input::get('qualification_1');
                $educational_qualifications->qualification_other_2 = Input::get('qualification_2_other');
                $educational_qualifications->qualification_2 = Input::get('qualification_2');
                $educational_qualifications->qualification_other_3 = Input::get('qualification_3_other');
                $educational_qualifications->qualification_3 = Input::get('qualification_3');


                $educational_qualifications->institution_1 = Input::get('institution_1');
                $educational_qualifications->qualification_start_date_1 = Input::get('qualification_start_date_1').'-'.Input::get('qualification_start_month_1').'-'.Input::get('qualification_start_year_1');
                $educational_qualifications->qualification_end_date_1 = Input::get('qualification_end_date_1').'-'.Input::get('qualification_end_month_1').'-'.Input::get('qualification_end_year_1');
                $educational_qualifications->qualification_grade_1 = Input::get('qualification_grade_1');


                $educational_qualifications->institution_2 = Input::get('institution_2');
                $educational_qualifications->qualification_start_date_2 = Input::get('qualification_start_date_2').'-'.Input::get('qualification_start_month_2').'-'.Input::get('qualification_start_year_2');
                $educational_qualifications->qualification_end_date_2 = Input::get('qualification_end_date_2').'-'.Input::get('qualification_end_month_2').'-'.Input::get('qualification_end_year_2');
                $educational_qualifications->qualification_grade_2 = Input::get('qualification_grade_2');


                $educational_qualifications->institution_3 = Input::get('institution_3');
                $educational_qualifications->qualification_start_date_3 = Input::get('qualification_start_date_3').'-'.Input::get('qualification_start_month_3').'-'.Input::get('qualification_start_year_3');
                $educational_qualifications->qualification_end_date_3 = Input::get('qualification_end_date_3').'-'.Input::get('qualification_end_month_3').'-'.Input::get('qualification_end_year_3');
                $educational_qualifications->qualification_grade_3 = Input::get('qualification_grade_3');
                $educational_qualifications->san = Input::get('san');
                $educational_qualifications->amendment = 0;
            
                $educational_qualifications->created_by = Sentry::getUser()->id;
                $educational_qualifications->save();
                $student_data_snapshot->educational_qualification = $educational_qualifications->id;

                $english_language_level = new StudentEnglishLangLevels();
                //To -Do
                $english_language_level->english_language_level = json_encode(Input::get('english_language_level'));
                $english_language_level->english_language_level_other = Input::get('english_language_level_other');
                $english_language_level->san = Input::get('san');
                $english_language_level->amendment = 0;
             
                $english_language_level->created_by = Sentry::getUser()->id;
                $english_language_level->save();
                $student_data_snapshot->english_lang_level = $english_language_level->id;

                $work_experience = new StudentWorkExperience();

                $work_experience->occupation_1 = Input::get('occupation_1');
                $work_experience->company_name_1 = Input::get('company_name_1');
                $work_experience->main_duties_1 = Input::get('main_duties_and_responsibilities_1');
                $work_experience->occupation_start_date_1 = Input::get('occupation_start_date_1').'-'.Input::get('occupation_start_month_1').'-'.Input::get('occupation_start_year_1');
                $work_experience->occupation_end_date_1 = Input::get('occupation_end_date_1').'-'.Input::get('occupation_end_month_1').'-'.Input::get('occupation_end_year_1');
                $work_experience->currently_working_1 = Input::get('currently_working_1', false);

                $work_experience->occupation_2 = Input::get('occupation_2');
                $work_experience->company_name_2 = Input::get('company_name_2');
                $work_experience->main_duties_2 = Input::get('main_duties_and_responsibilities_2');
                $work_experience->occupation_start_date_2 = Input::get('occupation_start_date_2').'-'.Input::get('occupation_start_month_2').'-'.Input::get('occupation_start_year_2');
                $work_experience->occupation_end_date_2 = Input::get('occupation_end_date_2').'-'.Input::get('occupation_end_month_2').'-'.Input::get('occupation_end_year_2');
                $work_experience->currently_working_2 = Input::get('currently_working_2', false);

                $work_experience->occupation_3 = Input::get('occupation_3');
                $work_experience->company_name_3 = Input::get('company_name_3');
                $work_experience->main_duties_3 = Input::get('main_duties_and_responsibilities_3');
                $work_experience->occupation_start_date_3 = Input::get('occupation_start_date_3').'-'.Input::get('occupation_start_month_3').'-'.Input::get('occupation_start_year_3');
                $work_experience->occupation_end_date_3 = Input::get('occupation_end_date_3').'-'.Input::get('occupation_end_month_3').'-'.Input::get('occupation_end_year_3');
                $work_experience->currently_working_3 = Input::get('currently_working_3', false);

                $work_experience->san = Input::get('san');
                $work_experience->amendment = 0;
          
                $work_experience->created_by = Sentry::getUser()->id;
                $work_experience->save();
                $student_data_snapshot->work_experience = $work_experience->id;

                $payment_info_metadata = new StudentPaymentInfoMetadata();
                $payment_info_metadata->course_fees = json_encode(Input::get('course_fees'));
                $payment_info_metadata->payment_status = json_encode(Input::get('payment_status'));
                $payment_info_metadata->total_fee = Input::get('total_fee');
                $payment_info_metadata->late_admin_fee = Input::get('late_admin_fee');
                $payment_info_metadata->late_fee = Input::get('late_fee');
                $payment_info_metadata->san = Input::get('san');
                $payment_info_metadata->amendment = 0;
                $payment_info_metadata->created_by = Sentry::getUser()->id;
                $payment_info_metadata->save();

                $payment_info_metadata_id = $payment_info_metadata->id;
                $student_data_snapshot->payment_info_metadata = $payment_info_metadata->id;
                $payment_info = new StudentPaymentInfo();




                $payment_info->deposit = Input::get('deposit');
                $payment_info->deposit_date = Input::get('deposit_date').'-'.Input::get('deposit_month').'-'.Input::get('deposit_year');
                $payment_info->deposit_method = Input::get('deposit_payment_method_1');

                $payment_info->installment_1 = Input::get('instalment_1');
                $payment_info->installment_1_date = Input::get('instalment_1_date').'-'.Input::get('instalment_1_month').'-'.Input::get('instalment_1_year');
                $payment_info->installment_1_method = Input::get('instalment_payment_method_1');

                $payment_info->installment_2 = Input::get('instalment_2');
                $payment_info->installment_2_date = Input::get('instalment_2_date').'-'.Input::get('instalment_2_month').'-'.Input::get('instalment_2_year');
                $payment_info->installment_2_method = Input::get('instalment_payment_method_2');

                $payment_info->installment_3 = Input::get('instalment_3');
                $payment_info->installment_3_date = Input::get('instalment_3_date').'-'.Input::get('instalment_3_month').'-'.Input::get('instalment_3_year');
                $payment_info->installment_3_method = Input::get('instalment_payment_method_3');
                $payment_info->san = Input::get('san');
                $payment_info->amendment = 0;

                $payment_info->created_by = Sentry::getUser()->id;
                $payment_info->save();
                $student_data_snapshot->payment_info = $payment_info->id;

                $bqu_application_data = new StudentBquData();
                $bqu_application_data->application_received_date =  Input::get('application_received_to_bqu_date').'-'.Input::get('application_received_to_bqu_month').'-'.Input::get('application_received_to_bqu_year');

                $bqu_application_data->supervisor =Input::get('supervisor');

                $bqu_application_data->notes = Input::get('notes');
                $bqu_application_data->san = Input::get('san');
                $bqu_application_data->amendment = 0;
             
                $bqu_application_data->created_by = Sentry::getUser()->id;
                $bqu_application_data->save();
                $student_data_snapshot->bqu_data = $bqu_application_data->id;
                $student_data_snapshot->san = Input::get('san');
                $student_data_snapshot->created_by = Sentry::getUser()->id;
                $student_data_snapshot->application_status = 1;
                $student_data_snapshot->save();

                $studentApplicationStatus = new StudentApplicationStatus();
                $studentApplicationStatus->san = Input::get('san');
                $studentApplicationStatus->created_by = Sentry::getUser()->id;
                $studentApplicationStatus->status = 1;
                $studentApplicationStatus->save();

                Notify::success('Application ( '.Input::get('san').' ) added successfully');


return View::make('students.index')
                        ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                            ->groupBy('san')
                            ->get());
	}

	/**
	 * Display the specified resource.
	 * GET /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($san)
	{
		//
		 return View::make('students.more')
                    ->with('information_sources',ApplicationSource::lists('name','id'))
                    ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))

                    ->with('application_agents',ApplicationAgent::lists('name','id'))
                    ->with('application_laps',ApplicationLap::lists('name','id'))

                    ->with('nationalities',StaticNationality::lists('name','id'))
                    ->with('countries',StaticCountry::lists('name','id'))
                    ->with('course_names',ApplicationCourse::lists('name','id'))
                    ->with('awarding_bodies',ApplicationAwardingBody::lists('name','id'))

                    ->with('education_qualifications',ApplicationEducationalQualification::lists('name','id'))
                    ->with('method_of_payment',ApplicationPaymentInfoMethodsOfPayment::lists('name','id'))
                    ->with('application_status',ApplicationStatus::lists('name','id'))
                    ->with('intake_year',StaticYear::lists('name','id'))
                    ->with('intake_month',StaticMonth::lists('name','id'))
                    // Getting Saved DATA
                    ->with('student',Student::where('san','=',$san)->orderBy('id','desc')->first())
                    ->with('studentSource',StudentSource::where('san','=',$san)->orderBy('id','desc')->first())
                    ->with('ttStudentContactInformation',DB::table('student_contact_informations')
                        ->where('student_contact_information_type','=',1)
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentContactInformation',DB::table('student_contact_informations')
                        ->where('student_contact_information_type','=',2)
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentContactInformationOnline',DB::table('student_contact_information_onlines')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_contact_information_kin_detailes',DB::table('student_contact_information_kin_detailes')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_course_enrolments',DB::table('student_course_enrolments')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_educational_qualifications',DB::table('student_educational_qualifications')
                                                                                        ->where('san','=',$san)->orderBy('id','desc')
                                                                                        ->first())
                    ->with('student_english_lang_levels',DB::table('student_english_lang_levels')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentWorkExperience',DB::table('student_work_experiences')
                                                                              ->where('san','=',$san)->orderBy('id','desc')
                                                                              ->first())
                    ->with('student_payment_info_metadata',DB::table('student_payment_info_metadatas')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentPaymentInfo',DB::table('student_payment_infos')
                           ->where('san','=',$san)->orderBy('id','desc')
                           ->first())
                    ->with('student_bqu_data',DB::table('student_bqu_data')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ;
	}





    public function more_validate($san)
	{
		//
		 return View::make('students.more_validate')
                    ->with('information_sources',ApplicationSource::lists('name','id'))
                    ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))

                    ->with('application_agents',ApplicationAgent::lists('name','id'))
                    ->with('application_laps',ApplicationLap::lists('name','id'))

                    ->with('nationalities',StaticNationality::lists('name','id'))
                    ->with('countries',StaticCountry::lists('name','id'))
                    ->with('course_names',ApplicationCourse::lists('name','id'))
                    ->with('awarding_bodies',ApplicationAwardingBody::lists('name','id'))

                    ->with('education_qualifications',ApplicationEducationalQualification::lists('name','id'))
                    ->with('method_of_payment',ApplicationPaymentInfoMethodsOfPayment::lists('name','id'))
                    ->with('application_status',ApplicationStatus::lists('name','id'))
                    ->with('intake_year',StaticYear::lists('name','id'))
                    ->with('intake_month',StaticMonth::lists('name','id'))
                    // Getting Saved DATA
                    ->with('student',Student::where('san','=',$san)->orderBy('id','desc')->first())
                    ->with('studentSource',StudentSource::where('san','=',$san)->orderBy('id','desc')->first())
                    ->with('ttStudentContactInformation',DB::table('student_contact_informations')
                        ->where('student_contact_information_type','=',1)
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentContactInformation',DB::table('student_contact_informations')
                        ->where('student_contact_information_type','=',2)
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentContactInformationOnline',DB::table('student_contact_information_onlines')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_contact_information_kin_detailes',DB::table('student_contact_information_kin_detailes')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_course_enrolments',DB::table('student_course_enrolments')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('student_educational_qualifications',DB::table('student_educational_qualifications')
                                                                                        ->where('san','=',$san)->orderBy('id','desc')
                                                                                        ->first())
                    ->with('student_english_lang_levels',DB::table('student_english_lang_levels')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentWorkExperience',DB::table('student_work_experiences')
                                                                              ->where('san','=',$san)->orderBy('id','desc')
                                                                              ->first())
                    ->with('student_payment_info_metadata',DB::table('student_payment_info_metadatas')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())
                    ->with('studentPaymentInfo',DB::table('student_payment_infos')
                           ->where('san','=',$san)->orderBy('id','desc')
                           ->first())
                    ->with('student_bqu_data',DB::table('student_bqu_data')
                        ->where('san','=',$san)->orderBy('id','desc')
                        ->first())

             // Getting Saved DATA
             ->with('data_studentSource',StudentSource::where('san','=',$san)->orderBy('id','desc')->first())
             ->with('information_sources',ApplicationSource::lists('name','id'))
             ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))
             //To-Do
             // ->with('admission_managers',ApplicationAdmissionManager::where('source_id','=',1)->lists('name','id'))

             ->with('agents_laps',ApplicationAdmissionManager::lists('name','id'))
                    ;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /students/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /students/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    public function checkSanAvailability()
    {

       $clanCount = Student::where('san', '=', Input::get('option'))->count();
        if ($clanCount == 0) {
            return 'Available';
        } else {
            return 'Not Available';
        }
    }

    public function information_source_dropdown(){
        $source = Input::get('option');
        if(intval($source) == 1)
            return ApplicationAgent::lists('name','id');
        else{
            return ApplicationLap::lists('name','id');
        }
    }

    public function intakes_dropdown(){
        $year = Input::get('option');
       return ApplicationIntake::where('year','=',$year)->lists('name','id');
      // return DB::table('application_intakes')->select('name','id')->where('year','=',$year)->get();
    }

}