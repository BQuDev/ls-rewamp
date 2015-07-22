<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MastersheetCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'app:export-mastersheet-data';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Exporting all the student data to mastersheet table';



	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

        //$students = Student::groupBy('san')->take(25)->get();
        $students = Student::groupBy('san')->get();
        Mastersheet::truncate();
        foreach($students as $student){

            $mastersheet = new Mastersheet();

            $mastersheet->san               = $student->san;
            $mastersheet->ls_student_number = $student->ls_student_number;

            $student_sources = DB::table('student_sources')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

            if(!is_null( $student_sources)){

                //$mastersheet->ams_date =  $student_sources->ams_date;
                $mastersheet->ams_date =  DateTime::createFromFormat('j-m-Y H:i:s', $student_sources->ams_date.'00:00:00');

                if(!is_null( $student_sources)&($student_sources->source>0)){
                    $mastersheet->source  =   ApplicationSource::getNameByID(intval($student_sources->source));
                }

                if (intval($student_sources->agent_lap) == 10000) {
                    $mastersheet->agents_laps_other = $student_sources->agents_laps_other;
                }elseif ((intval($student_sources->agent_lap) == 2) & (intval($student_sources->agent_lap) > 0)) {
                    $mastersheet->agent_lap         = ApplicationLap::getNameByID($student_sources->agent_lap);
                }elseif (intval($student_sources->agent_lap) > 0){
                    $mastersheet->agent_lap         = ApplicationAgent::getNameByID($student_sources->agent_lap);
                }

                if (intval($student_sources->admission_manager) == 10000) {
                    $mastersheet->admission_managers_other = $student_sources->admission_managers_other;
                } elseif (intval($student_sources->admission_manager) > 0) {
                    $mastersheet->admission_manager = ApplicationAdmissionManager::getExportNameByID($student_sources->admission_manager);
                }
            }

            $student_details = DB::table('students')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

            $mastersheet->title         = $student_details->title;
            $mastersheet->initials_1    = $student_details->initials_1;
            $mastersheet->initials_2    = $student_details->initials_2;
            $mastersheet->initials_3    = $student_details->initials_3;
            $mastersheet->forename_1    = $student_details->forename_1;
            $mastersheet->forename_2    = $student_details->forename_2;
            $mastersheet->forename_3    = $student_details->forename_3;
            $mastersheet->surname       = $student_details->surname;
            $mastersheet->gender        = $student_details->gender;

            //$mastersheet->date_of_birth = $student_details->date_of_birth;
            $mastersheet->date_of_birth = DateTime::createFromFormat('j-m-Y H:i:s', $student_details->date_of_birth.'00:00:00');
            if($student_details->nationality > 0){
                $mastersheet->nationality = StaticNationality::getNameByID($student_details->nationality);
            }
            $mastersheet->passport      = $student_details->passport;

            $tt = StudentContactInformation::lastUKRecordBySAN($student->san);
            $mastersheet->tt_address_1      = $tt->address_1;
            $mastersheet->tt_address_2      = $tt->address_2;
            $mastersheet->tt_city           = $tt->city;
            $mastersheet->tt_post_code      = $tt->post_code;

            if($tt->country >0){
                $mastersheet->tt_country    = StaticCountry::getNameByID($tt->country);
            }

            $mastersheet->tt_mobile        = $tt->mobile ;
            $mastersheet->tt_landline      = $tt->landline;

            $contactInformation = StudentContactInformation::lastRecordBySAN($student->san);
            $mastersheet->p_address_1      = $contactInformation->address_1;
            $mastersheet->p_address_2      = $contactInformation->address_2;
            $mastersheet->p_city           = $contactInformation->city;
            $mastersheet->p_post_code      = $contactInformation->post_code;

            if($tt->country >0){
                $mastersheet->p_country    = StaticCountry::getNameByID($contactInformation->country);
            }

            $mastersheet->p_mobile        = $contactInformation->mobile ;
            $mastersheet->p_landline      = $contactInformation->landline;

            $studentContactInformationOnline = StudentContactInformationOnline::lastRecordBySAN($student->san);

            $mastersheet->email               = $studentContactInformationOnline->email;
            $mastersheet->alternative_email   = $studentContactInformationOnline->alternative_email;
            $mastersheet->facebook            = $studentContactInformationOnline->facebook;
            $mastersheet->linkedin            = $studentContactInformationOnline->linkedin;
            $mastersheet->twitter             = $studentContactInformationOnline->twitter;
            $mastersheet->other_social        = $studentContactInformationOnline->other_social;

            $studentContactInformationKinDetail = StudentContactInformationKinDetail::lastRecordBySAN($student->san);

            $mastersheet->next_of_kin_title         = $studentContactInformationKinDetail->next_of_kin_title;
            $mastersheet->next_of_kin_forename      = $studentContactInformationKinDetail->next_of_kin_forename;
            $mastersheet->next_of_kin_surname       = $studentContactInformationKinDetail->next_of_kin_surname;
            $mastersheet->next_of_kin_telephone     = $studentContactInformationKinDetail->next_of_kin_telephone;
            $mastersheet->next_of_kin_email         = $studentContactInformationKinDetail->next_of_kin_email;

            $studentCourseEnrolment = DB::table('student_course_enrolments')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

            if(!is_null($studentCourseEnrolment)) {
                if ($studentCourseEnrolment->course_name > 0) {
                    $mastersheet->course_name  =  ApplicationCourse::getNameByID($studentCourseEnrolment->course_name);
                }
            }
            if(!is_null($studentCourseEnrolment)) {
                $mastersheet->course_level = $studentCourseEnrolment->course_level;
            }

            if(!is_null($studentCourseEnrolment)) {
                if ($studentCourseEnrolment->awarding_body > 0){
                    $mastersheet->awarding_body = ApplicationAwardingBody::getNameByID($studentCourseEnrolment->awarding_body);
                }
            }

            if((!is_null($studentCourseEnrolment))&&($studentCourseEnrolment->intake >0)){
                $mastersheet->intake    =   ApplicationIntake::getRowByID($studentCourseEnrolment->intake)->name;
            }

            if((!is_null($studentCourseEnrolment))&&($studentCourseEnrolment->intake>0)){
                $mastersheet->intake_year    =   StaticYear::getNameByID(ApplicationIntake::getRowByID($studentCourseEnrolment->intake)->year);
            }

            if(!is_null($studentCourseEnrolment)) {
                $mastersheet->study_mode    =   $studentCourseEnrolment->study_mode;
            }


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
            $mastersheet->english_language_level    =  ltrim ($english_language_level_export, ',');



            $studentEducationalQualification = StudentEducationalQualification::lastRecordBySAN($student->san);

            if(intval($studentEducationalQualification->qualification_1) == 10000) {
                $mastersheet->qualification_1    =   $studentEducationalQualification->qualification_other_1;
            }elseif(intval($studentEducationalQualification->qualification_1) == 0) {
                $mastersheet->qualification_1    =   $studentEducationalQualification->qualification_other_1;
            }elseif(intval($studentEducationalQualification->qualification_1) > 0){
                $mastersheet->qualification_1    =   ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_1);
            }

            $mastersheet->institution_1               = $studentEducationalQualification->institution_1;
            if(intval($studentEducationalQualification->qualification_start_date_1)>0) {
                //$mastersheet->qualification_start_date_1 = $studentEducationalQualification->qualification_start_date_1;
				$mastersheet->qualification_start_date_1 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_start_date_1.'00:00:00');
            }
            if(intval($studentEducationalQualification->qualification_end_date_1)>0) {
                //$mastersheet->qualification_end_date_1 = $studentEducationalQualification->qualification_end_date_1;
				$mastersheet->qualification_end_date_1 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_end_date_1.'00:00:00');
            }
            $mastersheet->qualification_grade_1       = $studentEducationalQualification->qualification_grade_1;


            if(intval($studentEducationalQualification->qualification_2) == 10000) {
                $mastersheet->qualification_2    =   $studentEducationalQualification->qualification_other_2;
            }elseif(intval($studentEducationalQualification->qualification_2) == 0) {
                $mastersheet->qualification_2    =   $studentEducationalQualification->qualification_other_1;
            }elseif(intval($studentEducationalQualification->qualification_2) > 0){
                $mastersheet->qualification_2    =   ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_2);
            }

            $mastersheet->institution_2               = $studentEducationalQualification->institution_2;
            if(intval($studentEducationalQualification->qualification_start_date_2)>0) {
                //$mastersheet->qualification_start_date_2 = $studentEducationalQualification->qualification_start_date_2;
				$mastersheet->qualification_start_date_2 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_start_date_2.'00:00:00');
            }
            if(intval($studentEducationalQualification->qualification_end_date_2)>0) {
                //$mastersheet->qualification_end_date_2 = $studentEducationalQualification->qualification_end_date_2;
				$mastersheet->qualification_end_date_2 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_end_date_2.'00:00:00');
            }
            $mastersheet->qualification_grade_2       = $studentEducationalQualification->qualification_grade_2;


            if(intval($studentEducationalQualification->qualification_3) == 10000) {
                $mastersheet->qualification_3    =   $studentEducationalQualification->qualification_other_3;
            }elseif(intval($studentEducationalQualification->qualification_3) == 0) {
                $mastersheet->qualification_3    =   $studentEducationalQualification->qualification_other_3;
            }elseif(intval($studentEducationalQualification->qualification_2) > 0){
                $mastersheet->qualification_3    =   ApplicationEducationalQualification::getNameByID($studentEducationalQualification->qualification_3);
            }

            $mastersheet->institution_3               = $studentEducationalQualification->institution_3;
            if(intval($studentEducationalQualification->qualification_start_date_3)>0) {
                //$mastersheet->qualification_start_date_3 = $studentEducationalQualification->qualification_start_date_3;
				$mastersheet->qualification_start_date_3 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_start_date_3.'00:00:00');
            }
            if(intval($studentEducationalQualification->qualification_end_date_2)>0) {
                //$mastersheet->qualification_end_date_3 = $studentEducationalQualification->qualification_end_date_3;
				$mastersheet->qualification_end_date_3 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentEducationalQualification->qualification_end_date_3.'00:00:00');
            }
            $mastersheet->qualification_grade_3       = $studentEducationalQualification->qualification_grade_3;


            $studentWorkExperiences = StudentWorkExperience::lastRecordBySAN($student->san);

            $mastersheet->occupation_1             = $studentWorkExperiences->occupation_1;
            $mastersheet->company_name_1           = $studentWorkExperiences->company_name_1;
            $mastersheet->main_duties_1            = $studentWorkExperiences->main_duties_1;
            if(intval($studentWorkExperiences->occupation_start_date_1)>0) {
                //$mastersheet->occupation_start_date_1 = $studentWorkExperiences->occupation_start_date_1;
				$mastersheet->occupation_start_date_1 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_start_date_1.'00:00:00');
            }
            if(intval($studentWorkExperiences->occupation_end_date_1)>0) {
                //$mastersheet->occupation_end_date_1 = $studentWorkExperiences->occupation_end_date_1;
				$mastersheet->occupation_end_date_1 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_end_date_1.'00:00:00');
            }
            if($studentWorkExperiences->currently_working_1 == 'Yes') {
                $mastersheet->currently_working_1 = $studentWorkExperiences->currently_working_1;
            }

            $mastersheet->occupation_2             = $studentWorkExperiences->occupation_2;
            $mastersheet->company_name_2           = $studentWorkExperiences->company_name_2;
            $mastersheet->main_duties_2            = $studentWorkExperiences->main_duties_2;
            if(intval($studentWorkExperiences->occupation_start_date_2)>0) {
                //$mastersheet->occupation_start_date_2 = $studentWorkExperiences->occupation_start_date_2;
				$mastersheet->occupation_start_date_2 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_start_date_2.'00:00:00');
            }
            if(intval($studentWorkExperiences->occupation_end_date_2)>0) {
                //$mastersheet->occupation_end_date_2 = $studentWorkExperiences->occupation_end_date_2;
				$mastersheet->occupation_end_date_2 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_end_date_2.'00:00:00');
            }
            if($studentWorkExperiences->currently_working_2 == 'Yes') {
                $mastersheet->currently_working_2 = $studentWorkExperiences->currently_working_2;
            }

            $mastersheet->occupation_3             = $studentWorkExperiences->occupation_3;
            $mastersheet->company_name_3           = $studentWorkExperiences->company_name_3;
            $mastersheet->main_duties_3            = $studentWorkExperiences->main_duties_3;
            if(intval($studentWorkExperiences->occupation_start_date_3)>0) {
                //$mastersheet->occupation_start_date_3 = $studentWorkExperiences->occupation_start_date_3;
				$mastersheet->occupation_start_date_3 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_start_date_3.'00:00:00');
            }
            if(intval($studentWorkExperiences->occupation_end_date_3)>0) {
                //$mastersheet->occupation_end_date_3 = $studentWorkExperiences->occupation_end_date_3;
				$mastersheet->occupation_end_date_3 =  DateTime::createFromFormat('j-m-Y H:i:s', $studentWorkExperiences->occupation_end_date_3.'00:00:00');
            }
            if($studentWorkExperiences->currently_working_3 == 'Yes') {
                $mastersheet->currently_working_3 = $studentWorkExperiences->currently_working_3;
            }

            $student_payment_info_metadatas = DB::table('student_payment_info_metadatas')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

            if($student_payment_info_metadatas->total_fee > 0) {
                $mastersheet->total_fee = $student_payment_info_metadatas->total_fee;
            }

            if($student_payment_info_metadatas->course_fees != 'null') {
                $payment_status_export = '';
                if (strpos($student_payment_info_metadatas->course_fees, 'Self funded') !== false) {
                    $payment_status_export = $payment_status_export . ', Self funded';
                }
                if (strpos($student_payment_info_metadatas->course_fees, 'Sponsored by the Company') !== false) {
                    $payment_status_export = $payment_status_export . ', Sponsored by the Company';
                }
                if (strpos($student_payment_info_metadatas->course_fees, 'Bank Loan') !== false) {
                    $payment_status_export = $payment_status_export . ', Bank Loan';
                }
                $mastersheet->course_fees = ltrim($payment_status_export, ',');
            }

            if($student_payment_info_metadatas->payment_status != 'null'){

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
                $mastersheet->payment_status = ltrim ($payment_status_export, ',');
            }

            $studentPaymentInfo = StudentPaymentInfo::lastRecordBySAN($student->san);
            $mastersheet->deposit        = $studentPaymentInfo->deposit;
            //$mastersheet->deposit_date   = $studentPaymentInfo->deposit_date;
			$mastersheet->deposit_date =  DateTime::createFromFormat('j-m-Y H:i:s', $studentPaymentInfo->deposit_date.'00:00:00');
            if(intval($studentPaymentInfo->deposit_method)>0){
                $mastersheet->deposit_method =ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->deposit_method);
            }
            $mastersheet->installment_1        = $studentPaymentInfo->installment_1;
            //$mastersheet->installment_1_date   = $studentPaymentInfo->installment_1_date;
			$mastersheet->installment_1_date =  DateTime::createFromFormat('j-m-Y H:i:s', $studentPaymentInfo->installment_1_date.'00:00:00');
            if(intval($studentPaymentInfo->installment_1_method)>0){
                $mastersheet->installment_1_method =ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_1_method);
            }

            $mastersheet->installment_2        = $studentPaymentInfo->installment_2;
            //$mastersheet->installment_2_date   = $studentPaymentInfo->installment_2_date;
			$mastersheet->installment_2_date =  DateTime::createFromFormat('j-m-Y H:i:s', $studentPaymentInfo->installment_2_date.'00:00:00');
            if(intval($studentPaymentInfo->installment_2_method)>0){
                $mastersheet->installment_2_method =ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_2_method);
            }

            $mastersheet->installment_3        = $studentPaymentInfo->installment_3;
            //$mastersheet->installment_3_date   = $studentPaymentInfo->installment_3_date;
			$mastersheet->installment_3_date =  DateTime::createFromFormat('j-m-Y H:i:s', $studentPaymentInfo->installment_3_date.'00:00:00');
            if(intval($studentPaymentInfo->installment_3_method)>0){
                $mastersheet->installment_3_method = ApplicationPaymentInfoMethodsOfPayment::getNameByID($studentPaymentInfo->installment_3_method);
            }

            $ApplicationStatus = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

            if(!is_null($ApplicationStatus)) {
                $mastersheet->status = StaticDataStatus::getNameByID($ApplicationStatus->status);
            }

            $studentBquData = StudentBquData::lastRecordBySAN($student->san);
            $application_received_date = explode('-', $studentBquData->application_received_date);

            if(intval( $studentBquData->application_received_date)>0){
                $mastersheet->application_received_date = $studentBquData->application_received_date;
            }

            $studentApplicationBasicStatus = DB::table('student_application_status')->where('san','=',$student->san)->where('status','=',1)->orderBy('id', 'desc')->first();
            if($studentApplicationBasicStatus != null) {
                $mastersheet->application_created_by = User::getFirstNameByID(intval($studentApplicationBasicStatus->created_by)) . ' ' . User::getLastNameByID(intval($studentApplicationBasicStatus->created_by));

                $mastersheet->application_created_at = $studentApplicationBasicStatus->created_at;
				//$mastersheet->application_created_at =  DateTime::createFromFormat('j-m-Y H:i:s', $studentApplicationBasicStatus->created_at);
            }

            $studentApplicationValidateStatus = DB::table('student_application_status')->where('san','=',$student->san)->where('status','=',2)->orderBy('id', 'desc')->first();
            if($studentApplicationValidateStatus != null) {
                $mastersheet->application_validated_by = User::getFirstNameByID(intval($studentApplicationValidateStatus->created_by)) . ' ' . User::getLastNameByID(intval($studentApplicationValidateStatus->created_by));

                $mastersheet->application_validated_at = $studentApplicationValidateStatus->created_at;
                //$mastersheet->application_validated_at =  DateTime::createFromFormat('j-m-Y H:i:s', $studentApplicationValidateStatus->created_at);
            }

            $studentApplicationVerifiedStatus = DB::table('student_application_status')->where('san','=',$student->san)->where('status','=',3)->orderBy('id', 'desc')->first();
            if($studentApplicationVerifiedStatus != null) {
                $mastersheet->application_verified_by = User::getFirstNameByID(intval($studentApplicationVerifiedStatus->created_by)) . ' ' . User::getLastNameByID(intval($studentApplicationVerifiedStatus->created_by));

                $mastersheet->application_verified_at = $studentApplicationVerifiedStatus->created_at;
				//$mastersheet->application_verified_at =  DateTime::createFromFormat('j-m-Y H:i:s', $studentApplicationVerifiedStatus->created_at);
            }

            $mastersheet->notes = StudentBquData::lastRecordBySAN($student->san)->notes;


            $mastersheet->save();

        }
	}



}
