<?php

class DBMigrationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        return View::make('static.DBmigration');


	}

    public function migrate()
	{


	}


	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
        $skip = 0;
        $take = 1200;

        $new_student_work_experiences_id              = 0;
        $new_student_sources_id= 0;
        $new_student_payment_infos_id= 0;
        $new_student_payment_info_metadatas_id= 0;
        $new_student_student_english_lang_levels_id= 0;
        $new_student_educational_qualifications_id= 0;
        $new_student_course_enrolments_id= 0;
        $new_student_contact_informations_id= 0;
        $new_student_contact_information_online_id= 0;
        $new_student_contact_information_kin_detail_id= 0;
        $new_student_bqu_data_id= 0;
        $new_student_id= 0;


/*
        if(Input::get('skip') > 0 )
        $skip = Input::get('skip');
        if(Input::get('take') > 0 )
        $take = Input::get('take');
*/
        // Get old students
        $students = DB::connection('mysql_old')->table('students')
            ->join('student_bqu_data', 'student_bqu_data.student_id', '=', 'students.id')
            ->groupBy('students.san')->skip($skip)->take($take)->get();
        //return $students;

        if(!is_null($students)){

            foreach($students as $student) {
                Log::info('Foreach start : ' . $student->san);
                //Get specific SAN inserted

                $inserted_data = DB::connection('mysql_old')->table('student_bqu_data')->orderBy('id', 'desc')->where('san', '=', $student->san)->where('status', '=', 7)->first();
               // $inserted_data = DB::connection('mysql_old')->table('student_bqu_data')->orderBy('id', 'desc')->where('san', '=', $student->san)->first();

                    if (!is_null($inserted_data)) {
                        $inserted_san = $inserted_data->san;
                        $inserted_student_id = $inserted_data->student_id;
                    Log::info('Inserted san : ' . $inserted_san);
                    //return $inserted_san;

                    //Student insert
                    $inserted_student = DB::connection('mysql_old')->table('students')->orderBy('id', 'asc')->where('id', '=', $inserted_student_id)->first();

                    if (!is_null($inserted_student)) {
                        $new_student = new Student();
                        $new_student->title = $inserted_student->title;
                        $new_student->initials_1 = $inserted_student->initials_1;
                        $new_student->initials_2 = $inserted_student->initials_2;
                        $new_student->initials_3 = $inserted_student->initials_3;
                        $new_student->forename_1 = $inserted_student->forename_1;
                        $new_student->forename_2 = $inserted_student->forename_2;
                        $new_student->forename_3 = $inserted_student->forename_3;
                        $new_student->surname = $inserted_student->surname;
                        $new_student->gender = $inserted_student->gender;
                        $new_student->date_of_birth = $inserted_student->date_of_birth;
                        $new_student->nationality = $inserted_student->nationality;
                        $new_student->passport = $inserted_student->passport;
                        $new_student->ls_student_number = $inserted_student->ls_student_number;
                        $new_student->is_verified = 1;
                        $new_student->amendment = 0;
                        $new_student->san = $inserted_san;
                        $new_student->created_by = $inserted_student->created_by;
                        $new_student->deleted_at = $inserted_student->deleted_at;
                        $new_student->created_at = $inserted_student->created_at;
                        $new_student->updated_at = $inserted_student->updated_at;
                        $new_student->save();
                        $new_student_id = $new_student->id;
                        Log::info('Student Saved with ID : ' . $new_student_id);
                    }

                    //student_bqu_data insert
                    $inserted_student_bqu_data = DB::connection('mysql_old')->table('student_bqu_data')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                    if (!is_null($inserted_student_bqu_data)) {

                        $new_student_bqu_data = new StudentBquData();
                        $new_student_bqu_data->application_received_date = $inserted_student_bqu_data->application_received_date;
                        $new_student_bqu_data->supervisor = $inserted_student_bqu_data->supervisor;
                        $new_student_bqu_data->notes = $inserted_student_bqu_data->notes;
                        $new_student_bqu_data->san = $inserted_student_bqu_data->san;
                        $new_student_bqu_data->amendment = 0;
                        $new_student_bqu_data->is_verified = 0;
                        $new_student_bqu_data->created_by = $inserted_student_bqu_data->created_by;
                        $new_student_bqu_data->deleted_at = $inserted_student_bqu_data->deleted_at;
                        $new_student_bqu_data->created_at = $inserted_student_bqu_data->created_at;
                        $new_student_bqu_data->updated_at = $inserted_student_bqu_data->updated_at;
                        $new_student_bqu_data->save();
                        $new_student_bqu_data_id = $new_student_bqu_data->id;
                        Log::info('Student BQu Data saved with ID : ' . $new_student_bqu_data_id);
                    }

                    //contact_information_kin_detailes insert
                    $inserted_contact_information_kin_detailes = DB::connection('mysql_old')->table('student_contact_information_kin_detailes')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                    if (!is_null($inserted_contact_information_kin_detailes)) {

                        $new_student_contact_information_kin_detail = new StudentContactInformationKinDetail();
                        $new_student_contact_information_kin_detail->next_of_kin_title = $inserted_contact_information_kin_detailes->next_of_kin_title;
                        $new_student_contact_information_kin_detail->next_of_kin_forename = $inserted_contact_information_kin_detailes->next_of_kin_forename;
                        $new_student_contact_information_kin_detail->next_of_kin_surname = $inserted_contact_information_kin_detailes->next_of_kin_surname;
                        $new_student_contact_information_kin_detail->next_of_kin_telephone = $inserted_contact_information_kin_detailes->next_of_kin_telephone;
                        $new_student_contact_information_kin_detail->next_of_kin_email = $inserted_contact_information_kin_detailes->next_of_kin_email;
                        $new_student_contact_information_kin_detail->san = $inserted_contact_information_kin_detailes->san;
                        $new_student_contact_information_kin_detail->created_by = $inserted_contact_information_kin_detailes->created_by;
                        $new_student_contact_information_kin_detail->deleted_at = $inserted_contact_information_kin_detailes->deleted_at;
                        $new_student_contact_information_kin_detail->created_at = $inserted_contact_information_kin_detailes->created_at;
                        $new_student_contact_information_kin_detail->updated_at = $inserted_contact_information_kin_detailes->updated_at;
                        $new_student_contact_information_kin_detail->amendment = 0;
                        $new_student_contact_information_kin_detail->is_verified = 0;
                        $new_student_contact_information_kin_detail->save();
                        $new_student_contact_information_kin_detail_id = $new_student_contact_information_kin_detail->id;
                        Log::info('Student Contact information kin detail with ID : ' . $new_student_contact_information_kin_detail_id);
                    }

                    //student_contact_information_onlines insert
                    $inserted_student_contact_information_onlines = DB::connection('mysql_old')->table('student_contact_information_onlines')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                    if (!is_null($inserted_student_contact_information_onlines)) {

                        $new_student_contact_information_onlines = new StudentContactInformationOnline();
                        $new_student_contact_information_onlines->email = $inserted_student_contact_information_onlines->email;
                        $new_student_contact_information_onlines->alternative_email = $inserted_student_contact_information_onlines->alternative_email;
                        $new_student_contact_information_onlines->facebook = $inserted_student_contact_information_onlines->facebook;
                        $new_student_contact_information_onlines->linkedin = $inserted_student_contact_information_onlines->linkedin;
                        $new_student_contact_information_onlines->twitter = $inserted_student_contact_information_onlines->twitter;
                        $new_student_contact_information_onlines->other_social = $inserted_student_contact_information_onlines->other_social;
                        $new_student_contact_information_onlines->san = $inserted_student_contact_information_onlines->san;
                        $new_student_contact_information_onlines->created_by = $inserted_student_contact_information_onlines->created_by;
                        $new_student_contact_information_onlines->deleted_at = $inserted_student_contact_information_onlines->deleted_at;
                        $new_student_contact_information_onlines->created_at = $inserted_student_contact_information_onlines->created_at;
                        $new_student_contact_information_onlines->updated_at = $inserted_student_contact_information_onlines->updated_at;
                        $new_student_contact_information_onlines->amendment = 0;
                        $new_student_contact_information_onlines->is_verified = 0;
                        $new_student_contact_information_onlines->save();
                        $new_student_contact_information_online_id = $new_student_contact_information_onlines->id;
                        Log::info('Student Contact information online with ID : ' . $new_student_contact_information_online_id);
                    }

                    //student_contact_informations insert
                    $inserted_student_contact_informations1 = DB::connection('mysql_old')->table('student_contact_informations')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->where('student_contact_information_type', '=', 1)->first();
                    $inserted_student_contact_informations2 = DB::connection('mysql_old')->table('student_contact_informations')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->where('student_contact_information_type', '=', 2)->first();

                    if (!is_null($inserted_student_contact_informations1)) {

                        $new_student_contact_informations = new StudentContactInformation();
                        $new_student_contact_informations->address_1 = $inserted_student_contact_informations1->address_1;
                        $new_student_contact_informations->address_2 = $inserted_student_contact_informations1->address_2;
                        $new_student_contact_informations->city = $inserted_student_contact_informations1->city;
                        $new_student_contact_informations->post_code = $inserted_student_contact_informations1->post_code;
                        $new_student_contact_informations->country = $inserted_student_contact_informations1->country;
                        $new_student_contact_informations->mobile = $inserted_student_contact_informations1->mobile;
                        $new_student_contact_informations->landline = $inserted_student_contact_informations1->landline;
                        $new_student_contact_informations->student_contact_information_type = 1;
                        $new_student_contact_informations->san = $inserted_student_contact_informations1->san;
                        $new_student_contact_informations->created_by = $inserted_student_contact_informations1->created_by;
                        $new_student_contact_informations->deleted_at = $inserted_student_contact_informations1->deleted_at;
                        $new_student_contact_informations->created_at = $inserted_student_contact_informations1->created_at;
                        $new_student_contact_informations->updated_at = $inserted_student_contact_informations1->updated_at;
                        $new_student_contact_informations->amendment = 0;
                        $new_student_contact_informations->is_verified = 0;
                        $new_student_contact_informations->save();


                        $new_student_contact_informations = new StudentContactInformation();
                        $new_student_contact_informations->address_1 = $inserted_student_contact_informations2->address_1;
                        $new_student_contact_informations->address_2 = $inserted_student_contact_informations2->address_2;
                        $new_student_contact_informations->city = $inserted_student_contact_informations2->city;
                        $new_student_contact_informations->post_code = $inserted_student_contact_informations2->post_code;
                        $new_student_contact_informations->country = $inserted_student_contact_informations2->country;
                        $new_student_contact_informations->mobile = $inserted_student_contact_informations2->mobile;
                        $new_student_contact_informations->landline = $inserted_student_contact_informations2->landline;
                        $new_student_contact_informations->student_contact_information_type = 2;
                        $new_student_contact_informations->san = $inserted_student_contact_informations2->san;
                        $new_student_contact_informations->created_by = $inserted_student_contact_informations2->created_by;
                        $new_student_contact_informations->deleted_at = $inserted_student_contact_informations2->deleted_at;
                        $new_student_contact_informations->created_at = $inserted_student_contact_informations2->created_at;
                        $new_student_contact_informations->updated_at = $inserted_student_contact_informations2->updated_at;
                        $new_student_contact_informations->amendment = 0;
                        $new_student_contact_informations->is_verified = 0;
                        $new_student_contact_informations->save();
                        $new_student_contact_informations_id = $new_student_contact_informations->id;
                        Log::info('Student Contact information with ID : ' . $new_student_contact_informations_id);
                    }

                    //student_course_enrolments insert
                    $inserted_student_course_enrolments = DB::connection('mysql_old')->table('student_course_enrolments')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                    if (!is_null($inserted_student_course_enrolments)) {

                        $new_student_course_enrolments = new StudentCourseEnrolment();
                        $new_student_course_enrolments->course_name = $inserted_student_course_enrolments->course_name;
                        $new_student_course_enrolments->course_level = $inserted_student_course_enrolments->course_level;
                        $new_student_course_enrolments->awarding_body = $inserted_student_course_enrolments->awarding_body;
                        $new_student_course_enrolments->intake = $inserted_student_course_enrolments->intake;
                        $new_student_course_enrolments->study_mode = $inserted_student_course_enrolments->study_mode;
                        $new_student_course_enrolments->san = $inserted_student_course_enrolments->san;
                        $new_student_course_enrolments->created_by = $inserted_student_course_enrolments->created_by;
                        $new_student_course_enrolments->deleted_at = $inserted_student_course_enrolments->deleted_at;
                        $new_student_course_enrolments->created_at = $inserted_student_course_enrolments->created_at;
                        $new_student_course_enrolments->updated_at = $inserted_student_course_enrolments->updated_at;
                        $new_student_course_enrolments->amendment = 0;
                        $new_student_course_enrolments->is_verified = 0;
                        $new_student_course_enrolments->save();
                        $new_student_course_enrolments_id = $inserted_student_course_enrolments->id;
                        Log::info('Student course enrollment with ID : ' . $new_student_course_enrolments_id);
                    }

                    //student_educational_qualifications insert
                    $inserted_student_educational_qualifications = DB::connection('mysql_old')->table('student_educational_qualifications')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->get();
//dd($inserted_student_educational_qualifications);
                    if (!is_null($inserted_student_educational_qualifications)) {
//return $inserted_student_educational_qualifications;

                        //Log::info('xxxc : ');


                            $new_student_educational_qualifications = new StudentEducationalQualification();
                            $new_student_educational_qualifications->qualification_1 = $inserted_student_educational_qualifications[0]->qualification;
                            $new_student_educational_qualifications->qualification_other_1 = $inserted_student_educational_qualifications[0]->qualification_other;
                            $new_student_educational_qualifications->institution_1 = $inserted_student_educational_qualifications[0]->institution;
                            $new_student_educational_qualifications->qualification_start_date_1 = $inserted_student_educational_qualifications[0]->qualification_start_date;
                            $new_student_educational_qualifications->qualification_end_date_1 = $inserted_student_educational_qualifications[0]->qualification_end_date;
                            $new_student_educational_qualifications->qualification_grade_1 = $inserted_student_educational_qualifications[0]->qualification_grade;
                            $new_student_educational_qualifications->institution_1 = $inserted_student_educational_qualifications[0]->institution;
                            $new_student_educational_qualifications->qualification_2 = $inserted_student_educational_qualifications[1]->qualification;
                            $new_student_educational_qualifications->qualification_other_2 = $inserted_student_educational_qualifications[1]->qualification_other;
                            $new_student_educational_qualifications->institution_2 = $inserted_student_educational_qualifications[1]->institution;
                            $new_student_educational_qualifications->qualification_start_date_2 = $inserted_student_educational_qualifications[1]->qualification_start_date;
                            $new_student_educational_qualifications->qualification_end_date_2 = $inserted_student_educational_qualifications[1]->qualification_end_date;
                            $new_student_educational_qualifications->qualification_grade_2 = $inserted_student_educational_qualifications[1]->qualification_grade;
                            $new_student_educational_qualifications->institution_2 = $inserted_student_educational_qualifications[1]->institution;
                            $new_student_educational_qualifications->qualification_3 = $inserted_student_educational_qualifications[2]->qualification;
                            $new_student_educational_qualifications->qualification_other_3 = $inserted_student_educational_qualifications[2]->qualification_other;
                            $new_student_educational_qualifications->institution_3 = $inserted_student_educational_qualifications[2]->institution;
                            $new_student_educational_qualifications->qualification_start_date_3 = $inserted_student_educational_qualifications[2]->qualification_start_date;
                            $new_student_educational_qualifications->qualification_end_date_3 = $inserted_student_educational_qualifications[2]->qualification_end_date;
                            $new_student_educational_qualifications->qualification_grade_3 = $inserted_student_educational_qualifications[2]->qualification_grade;
                            $new_student_educational_qualifications->institution_3 = $inserted_student_educational_qualifications[2]->institution;
                            $new_student_educational_qualifications->san = $inserted_student_educational_qualifications[0]->san;
                            $new_student_educational_qualifications->created_by = $inserted_student_educational_qualifications[0]->created_by;
                            $new_student_educational_qualifications->deleted_at = $inserted_student_educational_qualifications[0]->deleted_at;
                            $new_student_educational_qualifications->created_at = $inserted_student_educational_qualifications[0]->created_at;
                            $new_student_educational_qualifications->updated_at = $inserted_student_educational_qualifications[0]->updated_at;
                            $new_student_educational_qualifications->amendment = 0;
                            $new_student_educational_qualifications->is_verified = 0;
                            $new_student_educational_qualifications->save();
                            $new_student_educational_qualifications_id = $new_student_educational_qualifications->id;
                            Log::info('Student educational_qualifications with ID : ' . $new_student_educational_qualifications_id);
                            //dd($inserted_student_educational_qualifications);

                    }


                        //student_english_lang_levels insert
                        $inserted_student_english_lang_levels = DB::connection('mysql_old')->table('student_english_lang_levels')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                        if (!is_null($inserted_student_english_lang_levels)) {

                            $new_student_student_english_lang_levels = new StudentEnglishLangLevels();
                            $new_student_student_english_lang_levels->english_language_level = $inserted_student_english_lang_levels->english_language_level;
                            $new_student_student_english_lang_levels->english_language_level_other = $inserted_student_english_lang_levels->english_language_level_other;
                            $new_student_student_english_lang_levels->san = $inserted_student_english_lang_levels->san;
                            $new_student_contact_information_onlines->created_by = $inserted_student_english_lang_levels->created_by;
                            $new_student_student_english_lang_levels->deleted_at = $inserted_student_english_lang_levels->deleted_at;
                            $new_student_student_english_lang_levels->created_at = $inserted_student_english_lang_levels->created_at;
                            $new_student_student_english_lang_levels->updated_at = $inserted_student_english_lang_levels->updated_at;
                            $new_student_student_english_lang_levels->amendment = 0;
                            $new_student_student_english_lang_levels->is_verified = 0;
                            $new_student_student_english_lang_levels->save();
                            $new_student_student_english_lang_levels_id = $new_student_student_english_lang_levels->id;
                            Log::info('Student english_lang_levels with ID : ' . $new_student_student_english_lang_levels_id);
                        }


                        //student_payment_info_metadatas
                        $inserted_student_payment_info_metadatas = DB::connection('mysql_old')->table('student_payment_info_metadatas')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                        if (!is_null($inserted_student_payment_info_metadatas)) {

                            $new_student_payment_info_metadatas = new StudentPaymentInfoMetadata();
                            $new_student_payment_info_metadatas->course_fees = $inserted_student_payment_info_metadatas->course_fees;
                            $new_student_payment_info_metadatas->payment_status = $inserted_student_payment_info_metadatas->payment_status;
                            $new_student_payment_info_metadatas->total_fee = $inserted_student_payment_info_metadatas->total_fee;
                            $new_student_payment_info_metadatas->late_admin_fee = $inserted_student_payment_info_metadatas->late_admin_fee;
                            $new_student_payment_info_metadatas->late_fee = $inserted_student_payment_info_metadatas->late_fee;
                            $new_student_payment_info_metadatas->san = $inserted_student_payment_info_metadatas->san;
                            $new_student_payment_info_metadatas->created_by = $inserted_student_payment_info_metadatas->created_by;
                            $new_student_payment_info_metadatas->deleted_at = $inserted_student_payment_info_metadatas->deleted_at;
                            $new_student_payment_info_metadatas->created_at = $inserted_student_payment_info_metadatas->created_at;
                            $new_student_payment_info_metadatas->updated_at = $inserted_student_payment_info_metadatas->updated_at;
                            $new_student_payment_info_metadatas->amendment = 0;
                            $new_student_payment_info_metadatas->is_verified = 0;
                            $new_student_payment_info_metadatas->save();
                            $new_student_payment_info_metadatas_id = $new_student_payment_info_metadatas->id;
                            Log::info('Student english_lang_levels with ID : ' . $new_student_payment_info_metadatas_id);
                        }


                        //student_payment_infos insert
                        $inserted_student_payment_infos = DB::connection('mysql_old')->table('student_payment_infos')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->get();
//dd($inserted_student_payment_infos);
                        if (!is_null($inserted_student_payment_infos)) {

                            $new_student_payment_infos = new StudentPaymentInfo();
                            $new_student_payment_infos->deposit = $inserted_student_payment_infos[0]->payment_amount;
                            $new_student_payment_infos->deposit_date = $inserted_student_payment_infos[0]->date;
                            $new_student_payment_infos->deposit_method = $inserted_student_payment_infos[0]->method;
                            $new_student_payment_infos->installment_1 = $inserted_student_payment_infos[1]->payment_amount;
                            $new_student_payment_infos->installment_1_date = $inserted_student_payment_infos[1]->date;
                            $new_student_payment_infos->installment_1_method = $inserted_student_payment_infos[1]->method;
                            $new_student_payment_infos->installment_2 = $inserted_student_payment_infos[2]->payment_amount;
                            $new_student_payment_infos->installment_2_date = $inserted_student_payment_infos[2]->date;
                            $new_student_payment_infos->installment_2_method = $inserted_student_payment_infos[2]->method;
                            $new_student_payment_infos->installment_3 = $inserted_student_payment_infos[3]->payment_amount;
                            $new_student_payment_infos->installment_3_date = $inserted_student_payment_infos[3]->date;
                            $new_student_payment_infos->installment_3_method = $inserted_student_payment_infos[3]->method;
                            $new_student_payment_infos->san = $inserted_student_payment_infos[0]->san;
                            $new_student_payment_infos->created_by = $inserted_student_payment_infos[0]->created_by;
                            $new_student_payment_infos->deleted_at = $inserted_student_payment_infos[0]->deleted_at;
                            $new_student_payment_infos->created_at = $inserted_student_payment_infos[0]->created_at;
                            $new_student_payment_infos->updated_at = $inserted_student_payment_infos[0]->updated_at;
                            $new_student_payment_infos->amendment = 0;
                            $new_student_payment_infos->is_verified = 0;
                            $new_student_payment_infos->save();
                            $new_student_payment_infos_id = $new_student_payment_infos->id;
                            Log::info('Student student_payment_infos with ID : ' . $new_student_payment_infos_id);
                        }


                        //student_sources
                        $inserted_student_sources = DB::connection('mysql_old')->table('student_sources')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->first();

                        if (!is_null($inserted_student_sources)) {

                            $new_student_sources = new StudentSource();
                            $new_student_sources->app_date = $inserted_student_sources->app_date;
                            $new_student_sources->ams_date = $inserted_student_sources->ams_date;
                            $new_student_sources->source = $inserted_student_sources->source;
                            $new_student_sources->agent_lap = $inserted_student_sources->agent_lap;
                            $new_student_sources->agents_laps_other = $inserted_student_sources->agents_laps_other;
                            $new_student_sources->admission_manager = $inserted_student_sources->admission_manager;
                            $new_student_sources->admission_managers_other = $inserted_student_sources->admission_managers_other;
                            $new_student_sources->san = $inserted_student_sources->san;
                            $new_student_sources->created_by = $inserted_student_sources->created_by;
                            $new_student_sources->deleted_at = $inserted_student_sources->deleted_at;
                            $new_student_sources->created_at = $inserted_student_sources->created_at;
                            $new_student_sources->updated_at = $inserted_student_sources->updated_at;
                            $new_student_sources->is_verified = 0;
                            $new_student_sources->save();
                            $new_student_sources_id = $new_student_payment_info_metadatas->id;
                            Log::info('Student student_sources with ID : ' . $new_student_sources_id);
                        }

                        //student_payment_infos insert
                        $inserted_student_work_experiences = DB::connection('mysql_old')->table('student_work_experiences')->orderBy('id', 'asc')->where('student_id', '=', $inserted_student_id)->get();
                       // dd($inserted_student_work_experiences);
                        if (!is_null($inserted_student_work_experiences)) {

                            $new_student_work_experiences = new StudentWorkExperience();
                            $new_student_work_experiences->occupation_1 = $inserted_student_work_experiences[0]->occupation;
                            $new_student_work_experiences->company_name_1 = $inserted_student_work_experiences[0]->company_name;
                            $new_student_work_experiences->main_duties_1 = $inserted_student_work_experiences[0]->main_duties;
                            $new_student_work_experiences->occupation_start_date_1 = $inserted_student_work_experiences[0]->occupation_start_date;
                            $new_student_work_experiences->occupation_end_date_1 = $inserted_student_work_experiences[0]->occupation_end_date;
                            $new_student_work_experiences->currently_working_1 = $inserted_student_work_experiences[0]->currently_working;
                            $new_student_work_experiences->occupation_2 = $inserted_student_work_experiences[1]->occupation;
                            $new_student_work_experiences->company_name_2 = $inserted_student_work_experiences[1]->company_name;
                            $new_student_work_experiences->main_duties_2 = $inserted_student_work_experiences[1]->main_duties;
                            $new_student_work_experiences->occupation_start_date_2 = $inserted_student_work_experiences[1]->occupation_start_date;
                            $new_student_work_experiences->occupation_end_date_2 = $inserted_student_work_experiences[1]->occupation_end_date;
                            $new_student_work_experiences->currently_working_2 = $inserted_student_work_experiences[1]->currently_working;
                            $new_student_work_experiences->occupation_3 = $inserted_student_work_experiences[2]->occupation;
                            $new_student_work_experiences->company_name_3 = $inserted_student_work_experiences[2]->company_name;
                            $new_student_work_experiences->main_duties_3 = $inserted_student_work_experiences[2]->main_duties;
                            $new_student_work_experiences->occupation_start_date_3 = $inserted_student_work_experiences[2]->occupation_start_date;
                            $new_student_work_experiences->occupation_end_date_3 = $inserted_student_work_experiences[2]->occupation_end_date;
                            $new_student_work_experiences->currently_working_3 = $inserted_student_work_experiences[2]->currently_working;
                            $new_student_work_experiences->san = $inserted_student_work_experiences[0]->san;
                            $new_student_work_experiences->created_by = $inserted_student_work_experiences[0]->created_by;
                            $new_student_work_experiences->deleted_at = $inserted_student_work_experiences[0]->deleted_at;
                            $new_student_work_experiences->created_at = $inserted_student_work_experiences[0]->created_at;
                            $new_student_work_experiences->updated_at = $inserted_student_work_experiences[0]->updated_at;
                            $new_student_work_experiences->amendment = 0;
                            $new_student_work_experiences->is_verified = 0;
                            $new_student_work_experiences->save();
                            $new_student_work_experiences_id = $new_student_work_experiences->id;
                            Log::info('Student student_payment_infos with ID : ' . $new_student_work_experiences_id);
                        }

                        $student_application_status = new StudentApplicationStatus();
                        $student_application_status->status = $inserted_data->status;
                        $student_application_status->san = $inserted_student_bqu_data->san;
                        $student_application_status->created_by = $inserted_student_bqu_data->created_by;
                        $student_application_status->save();
                        $student_application_status_id = $student_application_status->id;


                        $snapshot = new StudentDataSnapshot();
                        $snapshot->student_course_enrolments = $new_student_course_enrolments_id;
                        $snapshot->student_english_lang_levels = $new_student_student_english_lang_levels_id;
                        $snapshot->student_payment_info_metadatas = $new_student_payment_info_metadatas_id;
                        $snapshot->student_payment_infos = $new_student_payment_infos_id;
                        $snapshot->student_contact_information_kin_detailes = $new_student_contact_information_kin_detail_id;
                        $snapshot->student_contact_information_onlines = $new_student_contact_information_online_id;
                        $snapshot->student_contact_informations = $new_student_contact_informations_id;
                        $snapshot->students = $new_student_id;
                        $snapshot->student_bqu_data = $new_student_bqu_data_id;
                        $snapshot->student_educational_qualifications = $new_student_educational_qualifications_id;
                        $snapshot->student_work_experiences = $new_student_work_experiences_id;
                        $snapshot->student_application_status = $student_application_status_id;
                        $snapshot->student_sources = $new_student_sources_id;
                        $snapshot->is_verified = 0;
                        $snapshot->san = $inserted_student_bqu_data->san;
                        $snapshot->save();




                }
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
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
	 * PUT /user/{id}
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
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



}