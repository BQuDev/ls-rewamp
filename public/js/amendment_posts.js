var base_url = '../../';
var stack_bottomright = {"dir1": "down", "dir2": "left"};

function pnotify_success(text){
    new PNotify({
        title: 'Succesfuly updated',
        text: text,
        notice:'success',
        type : 'success',
        buttons: {
            closer: true,
            sticker: true
        },
        animate_speed: 100,
        opacity: .9,
        hide: true,
        stack: stack_bottomright
    })

}

function pnotify_error(text){

    new PNotify({
        title: 'Error!',
        text: text,
        notice:'error',
        type : 'error',
        buttons: {
            closer: true,
            sticker: true
        },
        animate_speed: 100,
        opacity: .9,
        hide: true,
        stack: stack_bottomright
    });

}


$('#save_admission_manager_information_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {
        token: $('[name="_token"]').val(),
        ams_date: $('[name="ams_date"]').val(),
        information_source: $('[name="information_source"]').val(),
        admission_manager: $('[name="admission_manager"]').val(),
        admission_managers_other: $('[name="admission_managers_other"]').val(),
        agents_laps: $('[name="agents_laps"]').val(),
        agents_laps_other: $('[name="agents_laps_other"]').val(),
        t: $.now(),
        s:'validate',
        se:'admission_manager_information_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Agent / Admission manager information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#admission_manager_information_form').modal('toggle');

});


$('#save_personal_data_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        title: $('[name="title"]:checked').val(),
        initials_1: $('[name="initials_1"]').val(),
        initials_2: $('[name="initials_2"]').val(),
        initials_3: $('[name="initials_3"]').val(),
        forename_1: $('[name="forename_1"]').val(),
        forename_2: $('[name="forename_2"]').val(),
        forename_3: $('[name="forename_3"]').val(),
        surname: $('[name="surname"]').val(),
        gender: $('[name="gender"]:checked').val(),
        date_of_birth_date: $('[name="date_of_birth_date"]').val(),
        date_of_birth_month: $('[name="date_of_birth_month"]').val(),
        date_of_birth_year: $('[name="date_of_birth_year"]').val(),
        nationality: $('[name="nationality"]').val(),
        passport: $('[name="passport"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'personal_data_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Personal information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#personal_data_form').modal('toggle');

});



$('#save_tt_contact_information_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        tt_address_1: $('[name="tt_address_1"]').val(),
        tt_address_2: $('[name="tt_address_2"]').val(),
        tt_city: $('[name="tt_city"]').val(),
        tt_post_code: $('[name="tt_post_code"]').val(),
        tt_country: $('[name="tt_country"]').val(),
        tt_mobile: $('[name="tt_mobile"]').val(),
        tt_landline: $('[name="tt_landline"]').val(),


        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'tt_contact_information_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Contact information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#tt_contact_information_form').modal('toggle');

});


$('#save_contact_information_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        address_1: $('[name="address_1"]').val(),
        address_2: $('[name="address_2"]').val(),
        city: $('[name="city"]').val(),
        post_code: $('[name="post_code"]').val(),
        country: $('[name="country"]').val(),
        mobile: $('[name="mobile"]').val(),
        landline: $('[name="landline"]').val(),


        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'contact_information_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Contact information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#contact_information_form').modal('toggle');

});


$('#save_online_contact_information_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        email: $('[name="email"]').val(),
        alternative_email: $('[name="alternative_email"]').val(),
        facebook: $('[name="facebook"]').val(),
        linkedin: $('[name="linkedin"]').val(),
        twitter: $('[name="twitter"]').val(),
        other_social: $('[name="other_social"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'online_contact_information_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Contact information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#online_contact_information_form').modal('toggle');

});


$('#save_next_of_kin_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        next_of_kin_title: $('[name="next_of_kin_title"]:checked').val(),
        next_of_kin_forename: $('[name="next_of_kin_forename"]').val(),
        next_of_kin_surname: $('[name="next_of_kin_surname"]').val(),
        next_of_kin_telephone: $('[name="next_of_kin_telephone"]').val(),
        next_of_kin_email: $('[name="next_of_kin_email"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'next_of_kin_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Next of kin information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#next_of_kin_form').modal('toggle');

});


$('#save_course_details_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        course_name: $('[name="course_name"]').val(),
        course_level: $('[name="course_level"]:checked').val(),
        awarding_body: $('[name="awarding_body"]').val(),
        intake_year: $('[name="intake_year"]').val(),
        intake: $('[name="intake"]').val(),
        study_mode: $('[name="study_mode"]:checked').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'course_details_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Course information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#course_details_form').modal('toggle');

});


$('#save_educational_qualifications_form').click(function(){
    console.log($('[name="english_language_level"]:checked').map(function () {
        return this.value;
    }).get());

    $.post( base_url+"students/amendments", {

        english_language_level: $('[name="english_language_level[]"]:checked').map(function () {
            return this.value;
        }).get(),
        english_language_level_other: $('[name="english_language_level_other"]').val(),
        qualification_1: $('[name="qualification_1"]').val(),
        qualification_1_other: $('[name="qualification_1_other"]').val(),
        institution_1: $('[name="institution_1"]').val(),
        qualification_start_date_1: $('[name="qualification_start_date_1"]').val(),
        qualification_end_date_1: $('[name="qualification_end_date_1"]').val(),
        qualification_grade_1: $('[name="qualification_grade_1"]').val(),

        qualification_2: $('[name="qualification_2"]').val(),
        qualification_2_other: $('[name="qualification_2_other"]').val(),
        institution_2: $('[name="institution_2"]').val(),
        qualification_start_date_2: $('[name="qualification_start_date_2"]').val(),
        qualification_end_date_2: $('[name="qualification_end_date_2"]').val(),
        qualification_grade_2: $('[name="qualification_grade_2"]').val(),

        qualification_3: $('[name="qualification_3"]').val(),
        qualification_3_other: $('[name="qualification_3_other"]').val(),
        institution_3: $('[name="institution_3"]').val(),
        qualification_start_date_3: $('[name="qualification_start_date_3"]').val(),
        qualification_end_date_3: $('[name="qualification_end_date_3"]').val(),
        qualification_grade_3: $('[name="qualification_grade_3"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'educational_qualifications_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Educational information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#educational_qualifications_form').modal('toggle');

});


$('#save_work_experience_form').click(function(){
    console.log($('[name="english_language_level"]:checked').map(function () {
        return this.value;
    }).get());

    $.post( base_url+"students/amendments", {

        occupation_1: $('[name="occupation_1"]').val(),
        occupation_2: $('[name="occupation_2"]').val(),
        occupation_3: $('[name="occupation_3"]').val(),

        company_name_1: $('[name="company_name_1"]').val(),
        company_name_2: $('[name="company_name_2"]').val(),
        company_name_3: $('[name="company_name_3"]').val(),

        main_duties_and_responsibilities_1: $('[name="main_duties_and_responsibilities_1"]').val(),
        main_duties_and_responsibilities_2: $('[name="main_duties_and_responsibilities_2"]').val(),
        main_duties_and_responsibilities_3: $('[name="main_duties_and_responsibilities_3"]').val(),

        occupation_start_date_1: $('[name="occupation_start_date_1"]').val(),
        occupation_start_date_2: $('[name="occupation_start_date_2"]').val(),
        occupation_start_date_3: $('[name="occupation_start_date_3"]').val(),

        occupation_end_date_1: $('[name="occupation_end_date_1"]').val(),
        occupation_end_date_2: $('[name="occupation_end_date_2"]').val(),
        occupation_end_date_3: $('[name="occupation_end_date_3"]').val(),

        currently_working_1: $('[name="currently_working_1"]:checked').val(),
        currently_working_2: $('[name="currently_working_2"]:checked').val(),
        currently_working_3: $('[name="currently_working_3"]:checked').val(),


        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'work_experience_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success(' Work information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#work_experience_form').modal('toggle');

});


$('#save_payment_information_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {
/*
        course_fees: $('[name="course_fees[]"]:checked').map(function () {
            return this.value;
        }).get(),

        payment_status: $('[name="payment_status[]:checked"]').map(function () {
            return this.value;
        }).get(),*/
        course_fees: $('[name="course_fees"]:checked').val(),

        payment_status: $('[name="payment_status"]:checked').val(),

        total_fee: $('[name="total_fee"]').val(),

        deposit: $('[name="deposit"]').val(),
        deposit_date: $('[name="deposit_date"]').val(),
        deposit_method: $('[name="deposit_method"]').val(),

        installment_1: $('[name="installment_1"]').val(),
        installment_1_date: $('[name="installment_1_date"]').val(),
        installment_1_method: $('[name="installment_1_method"]').val(),

        installment_2: $('[name="installment_2"]').val(),
        installment_2_date: $('[name="installment_2_date"]').val(),
        installment_2_method: $('[name="installment_2_method"]').val(),

        installment_3: $('[name="installment_3"]').val(),
        installment_3_date: $('[name="installment_3_date"]').val(),
        installment_3_method: $('[name="installment_3_method"]').val(),


        late_admin_fee: $('[name="late_admin_fee"]').val(),
        late_fee: $('[name="late_fee"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'payment_information_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('Payment information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#payment_information_form').modal('toggle');

});

$('#save_bqu_only_form').click(function(){
    console.log('clicked');

    $.post( base_url+"students/amendments", {

        application_received_date: $('[name="application_received_date"]').val(),
        supervisor: $('[name="supervisor"]').val(),

        token: $('[name="_token"]').val(),
        t: $.now(),
        s:'validate',
        se:'bqu_only_form',
        san: $('[name="san_for_amendments"]').val(),
        ls_student_number: $('[name="ls_student_number_for_amendments"]').val()
    })
        .done(function( data ) {
            if(data == 1){
                pnotify_success('BQu only information succesfuly updated for <strong>'+$('#top_san_display').html()+'</strong> & <strong>'+$('#top_lssn_display').html()+'</strong>');
            }else{
                pnotify_error('Data amendment failure.<br><strong>Please contact BQu IT Team</strong>');
            }
        });


    $('#bqu_only_form').modal('toggle');

});