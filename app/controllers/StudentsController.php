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
                    ->with('intake',ApplicationIntake::where('year','=',1)->lists('name','id'))
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

                $student_data_snapshot->students = $student->id;


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
                $student_data_snapshot->student_sources = $student_source->id;

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
                $student_data_snapshot->student_contact_informations = $contact_details->id;

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
                //To-Do
                //$student_data_snapshot->contact_information_p = $contact_details_1->id;

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
                $student_data_snapshot->student_contact_information_onlines = $contact_details_online->id;

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
                $student_data_snapshot->student_contact_information_kin_detailes = $contact_details_kin->id;

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
                $student_data_snapshot->student_course_enrolments = $course_enrolment->id;

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
                $student_data_snapshot->student_educational_qualifications = $educational_qualifications->id;

                $english_language_level = new StudentEnglishLangLevels();
                //To -Do
                $english_language_level->english_language_level = json_encode(Input::get('english_language_level'));
                $english_language_level->english_language_level_other = Input::get('english_language_level_other');
                $english_language_level->san = Input::get('san');
                $english_language_level->amendment = 0;
             
                $english_language_level->created_by = Sentry::getUser()->id;
                $english_language_level->save();
                $student_data_snapshot->student_english_lang_levels = $english_language_level->id;

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
                $student_data_snapshot->student_work_experiences = $work_experience->id;

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
                $student_data_snapshot->student_payment_info_metadatas = $payment_info_metadata->id;
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
                $student_data_snapshot->student_payment_infos = $payment_info->id;

                $bqu_application_data = new StudentBquData();
                $bqu_application_data->application_received_date =  Input::get('application_received_to_bqu_date').'-'.Input::get('application_received_to_bqu_month').'-'.Input::get('application_received_to_bqu_year');

                $bqu_application_data->supervisor =Input::get('supervisor');

                $bqu_application_data->notes = Input::get('notes');
                $bqu_application_data->san = Input::get('san');
                $bqu_application_data->amendment = 0;
             
                $bqu_application_data->created_by = Sentry::getUser()->id;
                $bqu_application_data->save();
                $student_data_snapshot->student_bqu_data = $bqu_application_data->id;
                $student_data_snapshot->san = Input::get('san');
                $student_data_snapshot->created_by = Sentry::getUser()->id;
                $student_data_snapshot->student_application_status = 1;
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
                     ->with('intake',ApplicationIntake::where('year','=',1)->lists('name','id'))
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





    public function teststudents()
	{
	return Student::all();

	}
    public function more_validate($san)
	{
		// Select agent or lap

		if(StudentSource::where('san','=',$san)->orderBy('id','desc')->first()->source == 2){
                       $agents_laps = ApplicationLap::lists('name','id');
                     }elseif(StudentSource::where('san','=',$san)->orderBy('id','desc')->first()->source == 1){
                       $agents_laps = ApplicationAgent::lists('name','id');
                     }else{
                       $agents_laps = ApplicationLap::lists('name','id');
                     }

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
                     ->with('intake',ApplicationIntake::lists('name','id'))
                     ->with('supervisors',User::lists('first_name','id'))
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

             ->with('information_sources',ApplicationSource::lists('name','id'))
             ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))
             //To-Do
             // ->with('admission_managers',ApplicationAdmissionManager::where('source_id','=',1)->lists('name','id'))

                ->with('agents_laps',$agents_laps)



                    ;


	}


	public function more_verify($san){
	if(StudentSource::where('san','=',$san)->orderBy('id','desc')->first()->source == 2){
                           $agents_laps = ApplicationLap::lists('name','id');
                         }elseif(StudentSource::where('san','=',$san)->orderBy('id','desc')->first()->source == 1){
                           $agents_laps = ApplicationAgent::lists('name','id');
                         }else{
                           $agents_laps = ApplicationLap::lists('name','id');
                         }

    		 return View::make('students.more_verify')
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
                         ->with('intake',ApplicationIntake::lists('name','id'))
                         ->with('supervisors',User::lists('first_name','id'))
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

                 ->with('information_sources',ApplicationSource::lists('name','id'))
                 ->with('admission_managers',ApplicationAdmissionManager::lists('name','id'))
                 //To-Do
                 // ->with('admission_managers',ApplicationAdmissionManager::where('source_id','=',1)->lists('name','id'))

                    ->with('agents_laps',$agents_laps)



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

public function snapshot($san , $table_name , $latest_value, $client_time){
    $tables = ['student_bqu_data','student_contact_information_kin_detailes','student_contact_information_onlines',
    'student_contact_informations','student_course_enrolments','student_educational_qualifications','student_english_lang_levels',
    'student_payment_info_metadatas','student_payment_infos','student_sources','student_work_experiences',
    'students','student_application_status'];
    date_default_timezone_set("Asia/Calcutta");
    $tables = array_except($tables, [$table_name]);

    $snapshot = new StudentDataSnapshot();

    for ($i = 0; $i < count($tables); ++$i) {
        $snapshot->$tables[$i] = DB::table($tables[$i])->where('san','=',$san)->orderBy('id','desc')->first()->id;
        }
        $snapshot->$table_name = $latest_value;
        $snapshot->is_verified = 0;
        $snapshot->san = $san;

        $seconds = $client_time / 1000;
        $snapshot->client_time =  date("Y-m-d H:i:s T", $seconds);
//return date("d-m-Y H:i:s", $seconds);
        if($snapshot->save()){
        DB::table($table_name)->where('id', $latest_value)->update(['amendment' => $snapshot->id]);
        return 'Success';
        }else{
        return 'Snapshot Failed';
        }
}


public function latestRecord($table , $san){
    $latest_record = DB::table($table)->where('san','=',$san)->orderBy('id', 'desc')->first();
    return  json_decode(json_encode($latest_record), true);
}

public function saveAmendmentLog($old_value,$new_value,$old_value,$column,$table,$table_id,$client_time,$san){


}
public function amendment_log_raw($san , $old_array, $new_array ,$client_time){

   /* if ( strcmp ( $old_value, $new_value) != 0  ){



    }*/

}

public function amendments(){
    switch (Input::get('se')) {
        case 'admission_manager_information_form':

            $information_source       = Input::get('information_source');
            $admission_manager        = Input::get('admission_manager');
            $admission_managers_other = Input::get('admission_managers_other');
            $agents_laps              = Input::get('agents_laps');
            $agents_laps_other        = Input::get('agents_laps_other');
            $t = Input::get('t');
            $s = Input::get('s');
            $se = Input::get('se');
            $san = Input::get('san');
            $ls_student_number = Input::get('ls_student_number');


        if(Input::get('s') == 'validate'){

            $this->saveStudentSource(1);
            //$this->snapshot($san ,'student_sources' , $student_sources->id,$t );
            echo '1';
            }else{

            $latestRecord =  $this->latestRecord('student_sources' , $san);

            // Saving amendment as un verified
            $this->saveStudentSource(0);



            // Check with existing records

            //
            $this->amendment_log($san , 'student_sources');
            }
            break;
        case 'personal_data_form':
		
		
			if(Input::get('s') == 'validate'){
				$this->saveStudent(1);
			}else{
				$this->saveStudent(0);
			}
            $title = Input::get('title');
            $initials_1 = Input::get('initials_1');
            $initials_2 = Input::get('initials_2');
            $initials_3 = Input::get('initials_3');
            $forename_1 = Input::get('forename_1');
            $forename_2 = Input::get('forename_2');
            $forename_3 = Input::get('forename_3');
            $surname = Input::get('surname');
            $gender = Input::get('gender');
            $date_of_birth = Input::get('date_of_birth_date').'-'.Input::get('date_of_birth_month').'-'.Input::get('date_of_birth_year');
            $nationality = Input::get('nationality');
            $passport = Input::get('passport');

            $t = Input::get('t');
            $s = Input::get('s');
            $se = Input::get('se');
            $san = Input::get('san');
            $ls_student_number = Input::get('ls_student_number');

            //$this->snapshot($san , 'students' , $this->saveStudent(1),$t );

            echo '1';
            break;
        case 'tt_contact_information_form':
			if(Input::get('s') == 'validate'){
				$this->saveTTStudentContactInformation(1);
			}else{
				$this->saveTTStudentContactInformation(0);
			}
                $tt_address_1 = Input::get('tt_address_1');
                $tt_address_2 = Input::get('tt_address_2');
                $tt_city = Input::get('tt_city');
                $tt_post_code = Input::get('tt_post_code');
                $tt_country = Input::get('tt_country');
                $tt_mobile = Input::get('tt_mobile');
                $tt_landline = Input::get('tt_landline');


                $t = Input::get('t');
                $s = Input::get('s');
                $se = Input::get('se');
                $san = Input::get('san');
                $ls_student_number = Input::get('ls_student_number');

/*
                $studentContactInformation = new StudentContactInformation();
                $studentContactInformation->address_1 = $tt_address_1;
                $studentContactInformation->address_2 = $tt_address_2;
                $studentContactInformation->city = $tt_city;
                $studentContactInformation->post_code = $tt_post_code;
                $studentContactInformation->country = $tt_country;
                $studentContactInformation->mobile = $tt_mobile;
                $studentContactInformation->landline = $tt_landline;
                $studentContactInformation->student_contact_information_type = 1;

                $studentContactInformation->is_verified = 1;
                $studentContactInformation->san =  $san;
                $studentContactInformation->amendment = 0;
                $studentContactInformation->created_by = Sentry::getUser()->id;
                $studentContactInformation->save();
*/
                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'contact_information_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentContactInformation(1);
			}else{
				$this->saveStudentContactInformation(0);
			}
                $address_1 = Input::get('address_1');
                $address_2 = Input::get('address_2');
                $city = Input::get('city');
                $post_code = Input::get('post_code');
                $country = Input::get('country');
                $mobile = Input::get('mobile');
                $landline = Input::get('landline');


                $t = Input::get('t');
                $s = Input::get('s');
                $se = Input::get('se');
                $san = Input::get('san');
                $ls_student_number = Input::get('ls_student_number');

/*
                $studentContactInformation = new StudentContactInformation();
                $studentContactInformation->address_1 = $address_1;
                $studentContactInformation->address_2 = $address_2;
                $studentContactInformation->city = $city;
                $studentContactInformation->post_code = $post_code;
                $studentContactInformation->country = $country;
                $studentContactInformation->mobile = $mobile;
                $studentContactInformation->landline = $landline;
                $studentContactInformation->student_contact_information_type = 2;

                $studentContactInformation->is_verified = 1;
                $studentContactInformation->san =  $san;
               $studentContactInformation->amendment = 0;
               $studentContactInformation->created_by = Sentry::getUser()->id;
                $studentContactInformation->save();*/

                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'online_contact_information_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentContactInformationOnline(1);
			}else{
				$this->saveStudentContactInformationOnline(0);
			}
                $email = Input::get('email');
                $alternative_email = Input::get('alternative_email');
                $facebook = Input::get('facebook');
                $linkedin = Input::get('linkedin');
                $twitter = Input::get('twitter');
                $other_social = Input::get('other_social');

                $t = Input::get('t');
                $s = Input::get('s');
                $se = Input::get('se');
                $san = Input::get('san');
                $ls_student_number = Input::get('ls_student_number');

/*
                $studentContactInformationOnline = new StudentContactInformationOnline();
                $studentContactInformationOnline->email = $email;
                $studentContactInformationOnline->alternative_email = $alternative_email;
                $studentContactInformationOnline->facebook = $facebook;
                $studentContactInformationOnline->linkedin = $linkedin;
                $studentContactInformationOnline->twitter = $twitter;
                $studentContactInformationOnline->other_social = $other_social;

                $studentContactInformationOnline->is_verified = 1;
                $studentContactInformationOnline->san =  $san;
                $studentContactInformationOnline->amendment = 0;
                $studentContactInformationOnline->created_by = Sentry::getUser()->id;
                $studentContactInformationOnline->save();*/

                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'next_of_kin_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentContactInformationKinDetail(1);
			}else{
				$this->saveStudentContactInformationKinDetail(0);
			}
                

                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'course_details_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentCourseEnrolment(1);
			}else{
				$this->saveStudentCourseEnrolment(0);
			}
                $course_name = Input::get('course_name');
                $course_level = Input::get('course_level');
                $awarding_body = Input::get('awarding_body');
                $intake_year = Input::get('intake_year');
                $intake = Input::get('intake');
                $study_mode = Input::get('study_mode');

                $t = Input::get('t');
                $s = Input::get('s');
                $se = Input::get('se');
                $san = Input::get('san');
                $ls_student_number = Input::get('ls_student_number');


                

                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'educational_qualifications_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentEducationalQualification(1);
			}else{
				$this->saveStudentEducationalQualification(0);
			}
                $english_language_level = Input::get('english_language_level');
                $institution_1 = Input::get('institution_1');
                $institution_2 = Input::get('institution_2');
                $institution_3 = Input::get('institution_3');
                $qualification_1 = Input::get('qualification_1');
                $qualification_2 = Input::get('qualification_2');
                $qualification_3 = Input::get('qualification_3');
                $qualification_1_other = Input::get('qualification_1_other');
                $qualification_2_other = Input::get('qualification_2_other');
                $qualification_3_other = Input::get('qualification_3_other');
                $qualification_start_date_1 = Input::get('qualification_start_date_1');
                $qualification_start_date_2 = Input::get('qualification_start_date_2');
                $qualification_start_date_3 = Input::get('qualification_start_date_3');
                $qualification_end_date_1 = Input::get('qualification_end_date_1');
                $qualification_end_date_2 = Input::get('qualification_end_date_2');
                $qualification_end_date_3 = Input::get('qualification_end_date_3');
                $qualification_grade_1 = Input::get('qualification_grade_1');
                $qualification_grade_2 = Input::get('qualification_grade_2');
                $qualification_grade_3 = Input::get('qualification_grade_3');
                $awarding_body = Input::get('awarding_body');
                $intake_year = Input::get('intake_year');
                $intake = Input::get('intake');
                $study_mode = Input::get('study_mode');

                $t = Input::get('t');
                $s = Input::get('s');
                $se = Input::get('se');
                $san = Input::get('san');
                $ls_student_number = Input::get('ls_student_number');


                

                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'work_experience_form':

            
			if(Input::get('s') == 'validate'){
				$this->saveStudentWorkExperience(1);
			}else{
				$this->saveStudentWorkExperience(0);
			}
                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );

                echo '1';
                break;
        case 'payment_information_form':
			if(Input::get('s') == 'validate'){
				$this->saveStudentPaymentInfo(1);
			}else{
				$this->saveStudentPaymentInfo(0);
			}


                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );
            
                echo '1';
                break;
        case 'bqu_only_form':
			if(Input::get('s') == 'validate'){
				$this->saveBQuOnly(1);
			}else{
				$this->saveBQuOnly(0);
			}


                //$this->snapshot($san , 'student_contact_informations' , $studentContactInformation->id,$t );
            //$this->saveBQuOnly(1);
                echo '1';
                break;
    }
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
        else if(intval($source) == 3){
            return array();
        }else{
            return ApplicationLap::lists('name','id');
        }
    }

    public function intakes_dropdown(){
        $year = Input::get('option');
       return ApplicationIntake::where('year','=',$year)->lists('name','id');
      // return DB::table('application_intakes')->select('name','id')->where('year','=',$year)->get();
    }
    public function courses_dropdown(){
        $course_id = Input::get('option');
       return Module::where('course_id','=',$course_id)->lists('name','id');
      // return DB::table('application_intakes')->select('name','id')->where('year','=',$year)->get();
    }


    public function saveStudentSource($is_verified){
        $ams_date       = Input::get('ams_date');
        $information_source       = Input::get('information_source');
        $admission_manager        = Input::get('admission_manager');
        $admission_managers_other = Input::get('admission_managers_other');
        $agents_laps              = Input::get('agents_laps');
        $agents_laps_other        = Input::get('agents_laps_other');
        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $student_sources = new StudentSource();
        $student_sources->ams_date = $ams_date;
        $student_sources->source = $information_source;
        $student_sources->agent_lap = $agents_laps;
        $student_sources->agents_laps_other = $agents_laps_other;
        $student_sources->admission_manager = $admission_manager;
        $student_sources->admission_managers_other = $admission_managers_other;
        //$student_sources->ams_date = DB::table('student_sources')->where('san','=',$san)->orderBy('id','desc')->first()->ams_date;
        $student_sources->is_verified = $is_verified;
        $student_sources->san = $san;
        $student_sources->amendment = 0;
        $student_sources->created_by = Sentry::getUser()->id;
        $student_sources->save();
        return $student_sources->id;
    }
    public function saveStudent($is_verified){
        $title = Input::get('title');
        $initials_1 = Input::get('initials_1');
        $initials_2 = Input::get('initials_2');
        $initials_3 = Input::get('initials_3');
        $forename_1 = Input::get('forename_1');
        $forename_2 = Input::get('forename_2');
        $forename_3 = Input::get('forename_3');
        $surname = Input::get('surname');
        $gender = Input::get('gender');
        $date_of_birth = Input::get('date_of_birth_date').'-'.Input::get('date_of_birth_month').'-'.Input::get('date_of_birth_year');
        $nationality = Input::get('nationality');
        $passport = Input::get('passport');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $student = new Student();
        $student->title = $title;
        $student->initials_1 = $initials_1;
        $student->initials_2 = $initials_2;
        $student->initials_3 = $initials_3;
        $student->forename_1 = $forename_1;
        $student->forename_2 = $forename_2;
        $student->forename_3 = $forename_3;
        $student->surname = $surname;
        $student->gender = $gender;
        $student->date_of_birth = $date_of_birth;
        $student->nationality = $nationality;
        $student->passport = $passport;
        $student->ls_student_number = $ls_student_number;
        $student->is_verified = $is_verified;
        $student->san =  $san;
        $student->amendment = 0;
        $student->created_by = Sentry::getUser()->id;
        $student->save();
        return $student->id;
    }
    public function saveTTStudentContactInformation($is_verified){
        $tt_address_1 = Input::get('tt_address_1');
        $tt_address_2 = Input::get('tt_address_2');
        $tt_city = Input::get('tt_city');
        $tt_post_code = Input::get('tt_post_code');
        $tt_country = Input::get('tt_country');
        $tt_mobile = Input::get('tt_mobile');
        $tt_landline = Input::get('tt_landline');


        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentContactInformation = new StudentContactInformation();
        $studentContactInformation->address_1 = $tt_address_1;
        $studentContactInformation->address_2 = $tt_address_2;
        $studentContactInformation->city = $tt_city;
        $studentContactInformation->post_code = $tt_post_code;
        $studentContactInformation->country = $tt_country;
        $studentContactInformation->mobile = $tt_mobile;
        $studentContactInformation->landline = $tt_landline;
        $studentContactInformation->student_contact_information_type = 1;
		
        $studentContactInformation->is_verified = $is_verified;
        $studentContactInformation->san =  $san;
        $studentContactInformation->amendment = 0;
        $studentContactInformation->created_by = Sentry::getUser()->id;
        $studentContactInformation->save();
        return $studentContactInformation->id;
    }
    public function saveStudentContactInformation($is_verified){
        $address_1 = Input::get('address_1');
        $address_2 = Input::get('address_2');
        $city = Input::get('city');
        $post_code = Input::get('post_code');
        $country = Input::get('country');
        $mobile = Input::get('mobile');
        $landline = Input::get('landline');


        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentContactInformation = new StudentContactInformation();
        $studentContactInformation->address_1 = $address_1;
        $studentContactInformation->address_2 = $address_2;
        $studentContactInformation->city = $city;
        $studentContactInformation->post_code = $post_code;
        $studentContactInformation->country = $country;
        $studentContactInformation->mobile = $mobile;
        $studentContactInformation->landline = $landline;
        $studentContactInformation->student_contact_information_type = 2;

        $studentContactInformation->is_verified = $is_verified;
        $studentContactInformation->san =  $san;
        $studentContactInformation->amendment = 0;
        $studentContactInformation->created_by = Sentry::getUser()->id;
        $studentContactInformation->save();
        return $studentContactInformation->id;
    }
    public function saveStudentContactInformationOnline($is_verified){
        $email = Input::get('email');
        $alternative_email = Input::get('alternative_email');
        $facebook = Input::get('facebook');
        $linkedin = Input::get('linkedin');
        $twitter = Input::get('twitter');
        $other_social = Input::get('other_social');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentContactInformationOnline = new StudentContactInformationOnline();
        $studentContactInformationOnline->email = $email;
        $studentContactInformationOnline->alternative_email = $alternative_email;
        $studentContactInformationOnline->facebook = $facebook;
        $studentContactInformationOnline->linkedin = $linkedin;
        $studentContactInformationOnline->twitter = $twitter;
        $studentContactInformationOnline->other_social = $other_social;

        $studentContactInformationOnline->is_verified = $is_verified;
        $studentContactInformationOnline->san =  $san;
        $studentContactInformationOnline->amendment = 0;
        $studentContactInformationOnline->created_by = Sentry::getUser()->id;
        $studentContactInformationOnline->save();

        return $studentContactInformationOnline->id;
    }
    public function saveStudentContactInformationKinDetail($is_verified){
        $next_of_kin_title = Input::get('next_of_kin_title');
        $next_of_kin_forename = Input::get('next_of_kin_forename');
        $next_of_kin_surname = Input::get('next_of_kin_surname');
        $next_of_kin_telephone = Input::get('next_of_kin_telephone');
        $next_of_kin_email = Input::get('next_of_kin_email');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentContactInformationKinDetail = new StudentContactInformationKinDetail();
        $studentContactInformationKinDetail->next_of_kin_title = $next_of_kin_title;
        $studentContactInformationKinDetail->next_of_kin_forename = $next_of_kin_forename;
        $studentContactInformationKinDetail->next_of_kin_surname = $next_of_kin_surname;
        $studentContactInformationKinDetail->next_of_kin_telephone = $next_of_kin_telephone;
        $studentContactInformationKinDetail->next_of_kin_email = $next_of_kin_email;

        $studentContactInformationKinDetail->is_verified = $is_verified;
        $studentContactInformationKinDetail->san =  $san;
        $studentContactInformationKinDetail->created_by = Sentry::getUser()->id;
        $studentContactInformationKinDetail->amendment = 0;
        $studentContactInformationKinDetail->save();
        return $studentContactInformationKinDetail->id;
    }
    public function saveStudentCourseEnrolment($is_verified){
        $course_name = Input::get('course_name');
        $course_level = Input::get('course_level');
        $awarding_body = Input::get('awarding_body');
        $intake_year = Input::get('intake_year');
        $intake = Input::get('intake');
        $study_mode = Input::get('study_mode');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentCourseEnrolment = new StudentCourseEnrolment();
        $studentCourseEnrolment->course_name = $course_name;
        $studentCourseEnrolment->course_level = $course_level;
        $studentCourseEnrolment->awarding_body = $awarding_body;
        $studentCourseEnrolment->intake = $intake;
        $studentCourseEnrolment->study_mode = $study_mode;

        $studentCourseEnrolment->is_verified = $is_verified;
        $studentCourseEnrolment->san =  $san;
        $studentCourseEnrolment->created_by = Sentry::getUser()->id;
        $studentCourseEnrolment->amendment = 0;
        $studentCourseEnrolment->save();
        return $studentCourseEnrolment->id;
    }
    public function saveStudentEducationalQualification($is_verified){
        $english_language_level = Input::get('english_language_level');
        $english_language_level_other = Input::get('english_language_level_other');
        $institution_1 = Input::get('institution_1');
        $institution_2 = Input::get('institution_2');
        $institution_3 = Input::get('institution_3');
        $qualification_1 = Input::get('qualification_1');
        $qualification_2 = Input::get('qualification_2');
        $qualification_3 = Input::get('qualification_3');
        $qualification_1_other = Input::get('qualification_1_other');
        $qualification_2_other = Input::get('qualification_2_other');
        $qualification_3_other = Input::get('qualification_3_other');
        $qualification_start_date_1 = Input::get('qualification_start_date_1');
        $qualification_start_date_2 = Input::get('qualification_start_date_2');
        $qualification_start_date_3 = Input::get('qualification_start_date_3');
        $qualification_end_date_1 = Input::get('qualification_end_date_1');
        $qualification_end_date_2 = Input::get('qualification_end_date_2');
        $qualification_end_date_3 = Input::get('qualification_end_date_3');
        $qualification_grade_1 = Input::get('qualification_grade_1');
        $qualification_grade_2 = Input::get('qualification_grade_2');
        $qualification_grade_3 = Input::get('qualification_grade_3');
        $awarding_body = Input::get('awarding_body');
        $intake_year = Input::get('intake_year');
        $intake = Input::get('intake');
        $study_mode = Input::get('study_mode');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');

        $studentEnglishLangLevels = new StudentEnglishLangLevels();
        $studentEnglishLangLevels->english_language_level = serialize($english_language_level);
        $studentEnglishLangLevels->english_language_level_other = $english_language_level_other;
       $studentEnglishLangLevels->is_verified = $is_verified;
        $studentEnglishLangLevels->san =$san;
		$studentEnglishLangLevels->created_by = Sentry::getUser()->id;
        $studentEnglishLangLevels->amendment = 0;
       $studentEnglishLangLevels->save();
		
		
        $studentEducationalQualification = new StudentEducationalQualification();
        $studentEducationalQualification->qualification_1 = $qualification_1;
        $studentEducationalQualification->qualification_other_1 = $qualification_1_other;
        $studentEducationalQualification->institution_1 = $institution_1;
        $studentEducationalQualification->qualification_start_date_1 = $qualification_start_date_1;
        $studentEducationalQualification->qualification_end_date_1 = $qualification_end_date_1;
        $studentEducationalQualification->qualification_grade_1 = $qualification_grade_1;

        $studentEducationalQualification->qualification_2 = $qualification_2;
        $studentEducationalQualification->qualification_other_2 = $qualification_2_other;
        $studentEducationalQualification->institution_2 = $institution_2;
        $studentEducationalQualification->qualification_start_date_2 = $qualification_start_date_2;
        $studentEducationalQualification->qualification_end_date_2 = $qualification_end_date_2;
        $studentEducationalQualification->qualification_grade_2 = $qualification_grade_2;

        $studentEducationalQualification->qualification_3 = $qualification_3;
        $studentEducationalQualification->qualification_other_3 = $qualification_3_other;
        $studentEducationalQualification->institution_3 = $institution_3;
        $studentEducationalQualification->qualification_start_date_3 = $qualification_start_date_3;
        $studentEducationalQualification->qualification_end_date_3 = $qualification_end_date_3;
        $studentEducationalQualification->qualification_grade_3 = $qualification_grade_3;

        $studentEducationalQualification->is_verified = $is_verified;
        $studentEducationalQualification->san =  $san;
        $studentEducationalQualification->created_by = Sentry::getUser()->id;
        $studentEducationalQualification->amendment = 0;
        $studentEducationalQualification->save();
        return $studentEducationalQualification->id;
    }
    public function saveStudentWorkExperience($is_verified){
        $occupation_1 = Input::get('occupation_1');
        $occupation_2 = Input::get('occupation_2');
        $occupation_3 = Input::get('occupation_3');

        $company_name_1 = Input::get('company_name_1');
        $company_name_2 = Input::get('company_name_2');
        $company_name_3 = Input::get('company_name_3');

        $main_duties_and_responsibilities_1 = Input::get('main_duties_and_responsibilities_1');
        $main_duties_and_responsibilities_2 = Input::get('main_duties_and_responsibilities_2');
        $main_duties_and_responsibilities_3 = Input::get('main_duties_and_responsibilities_3');

        $occupation_start_date_1 = Input::get('occupation_start_date_1');
        $occupation_start_date_2 = Input::get('occupation_start_date_2');
        $occupation_start_date_3 = Input::get('occupation_start_date_3');

        $occupation_end_date_1 = Input::get('occupation_end_date_1');
        $occupation_end_date_2 = Input::get('occupation_end_date_2');
        $occupation_end_date_3 = Input::get('occupation_end_date_3');

        $currently_working_1 = Input::get('currently_working_1');
        $currently_working_2 = Input::get('currently_working_2');
        $currently_working_3 = Input::get('currently_working_3');


        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');


        $studentWorkExperience = new StudentWorkExperience();

        $studentWorkExperience->occupation_1 = $occupation_1;
        $studentWorkExperience->occupation_2 = $occupation_2;
        $studentWorkExperience->occupation_3 = $occupation_3;

        $studentWorkExperience->company_name_1 = $company_name_1;
        $studentWorkExperience->company_name_2 = $company_name_2;
        $studentWorkExperience->company_name_3 = $company_name_3;

        $studentWorkExperience->main_duties_1 = $main_duties_and_responsibilities_1;
        $studentWorkExperience->main_duties_2 = $main_duties_and_responsibilities_2;
        $studentWorkExperience->main_duties_3 = $main_duties_and_responsibilities_3;

        $studentWorkExperience->occupation_start_date_1 = $occupation_start_date_1;
        $studentWorkExperience->occupation_start_date_2 = $occupation_start_date_2;
        $studentWorkExperience->occupation_start_date_3 = $occupation_start_date_3;

        $studentWorkExperience->occupation_end_date_1 = $occupation_end_date_1;
        $studentWorkExperience->occupation_end_date_2 = $occupation_end_date_2;
        $studentWorkExperience->occupation_end_date_3 = $occupation_end_date_3;


        if($currently_working_1 == 'Yes')
            $studentWorkExperience->currently_working_1 = 'Yes';
        if($currently_working_2 == 'Yes')
            $studentWorkExperience->currently_working_2 = 'Yes';
        if($currently_working_3 == 'Yes')
            $studentWorkExperience->currently_working_3 = 'Yes';



        $studentWorkExperience->is_verified = $is_verified;
        $studentWorkExperience->san =  $san;
        $studentWorkExperience->created_by = Sentry::getUser()->id;
        $studentWorkExperience->amendment = 0;
        $studentWorkExperience->save();
        return $studentWorkExperience->id;
    }
    public function saveStudentPaymentInfo($is_verified){
        $total_fee = Input::get('total_fee');
        $course_fees = Input::get('course_fees');
        $payment_status = Input::get('payment_status');
        $late_admin_fee = Input::get('late_admin_fee');
        $late_fee = Input::get('late_fee');


        $deposit = Input::get('deposit');
        $deposit_date = Input::get('deposit_date');
        $deposit_method = Input::get('deposit_method');

        $installment_1 = Input::get('installment_1');
        $installment_1_date = Input::get('installment_1_date');
        $installment_1_method = Input::get('installment_1_method');

        $installment_2 = Input::get('installment_2');
        $installment_2_date = Input::get('installment_2_date');
        $installment_2_method = Input::get('installment_2_method');

        $installment_3 = Input::get('installment_3');
        $installment_3_date = Input::get('installment_3_date');
        $installment_3_method = Input::get('installment_3_method');

        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');

        $studentPaymentInfoMetadata = new StudentPaymentInfoMetadata();



        $studentPaymentInfoMetadata->course_fees = serialize($course_fees);
        $studentPaymentInfoMetadata->payment_status = serialize($payment_status);
        $studentPaymentInfoMetadata->total_fee = $total_fee;
        $studentPaymentInfoMetadata->late_admin_fee = $late_admin_fee;
        $studentPaymentInfoMetadata->late_fee = $late_fee;

        $studentPaymentInfoMetadata->is_verified = $is_verified;
        $studentPaymentInfoMetadata->san =  $san;
        $studentPaymentInfoMetadata->created_by = Sentry::getUser()->id;
        $studentPaymentInfoMetadata->amendment = 0;
        $studentPaymentInfoMetadata->save();
        
                    $studentPaymentInfo = new StudentPaymentInfo();

                    $studentPaymentInfo->deposit = $deposit;
                    $studentPaymentInfo->deposit_date = $deposit_date;
                    $studentPaymentInfo->deposit_method = $deposit_method;

                    $studentPaymentInfo->installment_1 = $installment_1;
                    $studentPaymentInfo->installment_1_date = $installment_1_date;
                    $studentPaymentInfo->installment_1_method = $installment_1_method;

                    $studentPaymentInfo->installment_2 = $installment_2;
                    $studentPaymentInfo->installment_2_date = $installment_2_date;
                    $studentPaymentInfo->installment_2_method = $installment_2_method;

                    $studentPaymentInfo->installment_3 = $installment_3;
                    $studentPaymentInfo->installment_3_date = $installment_3_date;
                    $studentPaymentInfo->installment_3_method = $installment_3_method;

                    $studentPaymentInfo->is_verified = 1;
                    $studentPaymentInfo->san =  $san;
                    $studentPaymentInfo->created_by = Sentry::getUser()->id;
                    $studentPaymentInfo->amendment = 0;
                    $studentPaymentInfo->save();
        return $studentPaymentInfoMetadata->id;
    }
	public function saveBQuOnly($is_verified){
		
        $application_received_date = Input::get('application_received_date');
        $supervisor = Input::get('supervisor');


        $t = Input::get('t');
        $s = Input::get('s');
        $se = Input::get('se');
        $san = Input::get('san');
        $ls_student_number = Input::get('ls_student_number');

        $studentBquData = new StudentBquData();
        $studentBquData->application_received_date = $application_received_date;
        $studentBquData->supervisor = $supervisor;
        $studentBquData->notes = '';



                    $studentBquData->is_verified = 1;
                    $studentBquData->san =  $san;
                    $studentBquData->created_by = Sentry::getUser()->id;
                    $studentBquData->amendment = 0;
                    $studentBquData->save();
        return $studentBquData->id;
    }

	
public function export(){
	//$students = Student::all();
	

	
        return Excel::create('Mastersheet BQu version', function($excel) {

			$excel->sheet('Mastersheet BQu version', function($sheet) {
			    //$students = Student::all();
			    $students = Student::groupBy('san')->get();
                //$students = DB::table('students')->select('*')->where('id','=',1)->get();
				$sheet->loadView('export.master_sheet')->with('students',$students);

			});
            $excel->setcreator('BQu');
            $excel->setlastModifiedBy('BQu');
            $excel->setcompany('BQuServices(PVT)LTD');
            $excel->setmanager('Rajitha');

		})->download('xls');
    }

    public function validate_student(){

    $studentApplicationStatus = new StudentApplicationStatus();
    $studentApplicationStatus->san = Input::get('san_for_amendments');
    $studentApplicationStatus->status = 2;
    $studentApplicationStatus->created_by =  Sentry::getUser()->id;
    $studentApplicationStatus->save();

      Notify::success('Student data ( '.Input::get('san_for_amendments').' ) Validated successfully');
      return View::make('students.validate')
                ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                    ->groupBy('san')
                    ->get());
     return Input::all();
    }

    public function verify_student(){
 //return Input::all();
    $studentBquVerificationData = new StudentBquVerificationData();
    $studentBquVerificationData->mails_from_lsm = Input::get('received_any_emails_from_lsm');
    $studentBquVerificationData->know_structure_of_the_course = Input::get('know_about_the_structure_of_the_course');
    $studentBquVerificationData->how_did_you_hear = json_encode(Input::get('how_did_you_hear_about_the_course'));
    $studentBquVerificationData->how_did_you_hear_other = Input::get('how_did_you_hear_about_the_course_other');
    $studentBquVerificationData->what_do_you_want_to_achieve = json_encode(Input::get('what_do_you_want_to_achieve'));
    $studentBquVerificationData->what_do_you_want_to_achieve_other = Input::get('what_do_you_want_to_achieve_other');
    $studentBquVerificationData->bqu_comments = Input::get('bqu_comments');
    $studentBquVerificationData->student_comments = Input::get('student_comments');
    $studentBquVerificationData->call_type = Input::get('call_type');
    $studentBquVerificationData->ls_student_number = Input::get('ls_student_number_for_amendments');
    $studentBquVerificationData->san =  Input::get('san_for_amendments');
    $studentBquVerificationData->created_by =  Sentry::getUser()->id;
    $studentBquVerificationData->record_status =  1;
    $studentBquVerificationData->save();


    $studentApplicationStatus = new StudentApplicationStatus();
    $studentApplicationStatus->san = Input::get('san_for_amendments');
    $studentApplicationStatus->status = 3;
    $studentApplicationStatus->created_by =  Sentry::getUser()->id;
    $studentApplicationStatus->save();

      Notify::success('Student data ( '.Input::get('san_for_amendments').' ) Verified successfully');
      return View::make('students.verify')
                ->with('students', DB::table('students')->select(DB::raw('max(id) as id,title,initials_1,initials_2,initials_3,forename_1,forename_2,forename_3,surname,ls_student_number ,san'))
                    ->groupBy('san')
                    ->get());
     return Input::all();
    }

}