
$(function() {

    /*
     *   Hide / Show sections
     *
     */

    $( "#add_more_qualifications" ).click(function() {$( "#qualification_container_2" ).show( "slow", function() { }); $( "#add_more_qualifications" ).hide();});
    $( "#add_more_qualifications_2" ).click(function() {$( "#qualification_container_3" ).show( "slow", function() { });$( "#add_more_qualifications_2" ).hide();});
    $( "#add_more_occupations_1" ).click(function() {$( "#occupation_container_2" ).show( "slow", function() { });$( "#add_more_occupations_1" ).hide();});
    $( "#add_more_occupations_2" ).click(function() { $( "#occupation_container_3" ).show( "slow", function() { });$( "#add_more_occupations_2" ).hide();});


    /*
    *   Dropdown fixed values
    *
    */

    $('#supervisor').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="deposit_payment_method_1"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="instalment_payment_method_1"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="instalment_payment_method_2"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="instalment_payment_method_3"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="nationality"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="information_source"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="agents_laps"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="admission_manager"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="qualification_1"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="qualification_2"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="qualification_3"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="tt_country"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="country"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="course_name"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="awarding_body"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="deposit_method"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="installment_1_method"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="installment_2_method"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="installment_3_method"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");
    $('[name="intake"]').prepend("<option value='0'>Please Select an Option</option>").trigger("chosen:updated");


    /*
     *   Parsley validation added
     *
     */

    $('#student_create').parsley();


    /*
     *   Other text fields . Hide/Show by drop down selection
     *
     */


    $('[name="agents_laps_other"]').hide();
    $('[name="admission_managers_other"]').hide();
    $('[name="qualification_1_other"]').hide();
    $('[name="qualification_2_other"]').hide();
    $('[name="qualification_3_other"]').hide();

    $('[name="agents_laps"]').append("<option value='10000'>Other</option>").trigger("chosen:updated");
    $('[name="admission_manager"]').append("<option value='10000'>Other</option>").trigger("chosen:updated");
    $('[name="qualification_1"]').append("<option value='10000'>Other</option>").trigger("chosen:updated");
    $('[name="qualification_2"]').append("<option value='10000'>Other</option>").trigger("chosen:updated");
    $('[name="qualification_3"]').append("<option value='10000'>Other</option>").trigger("chosen:updated");

    $('[name="agents_laps"]').change(function(){if($(this).val() == 10000){$('[name="agents_laps_other"]').show();}else{$('[name="agents_laps_other"]').hide();}});
    $('[name="admission_manager"]').change(function(){if($(this).val() == 10000){$('[name="admission_managers_other"]').show();}else{$('[name="admission_managers_other"]').hide();}});
    $('[name="qualification_1"]').change(function(){if($(this).val() == 10000){$('[name="qualification_1_other"]').show();}else{$('[name="qualification_1_other"]').hide();}});
    $('[name="qualification_2"]').change(function(){if($(this).val() == 10000){$('[name="qualification_2_other"]').show();}else{$('[name="qualification_2_other"]').hide();}});
    $('[name="qualification_3"]').change(function(){if($(this).val() == 10000){$('[name="qualification_3_other"]').show();}else{$('[name="qualification_3_other"]').hide();}});





    $( "#san" ).keydown(function() {
        $('#top_san_display').html('SAN : '+this.value);
        // $('#top_san_display').append($(this).val());

    });
    $( "#ls_student_number" ).keydown(function() {
        $('#top_lssn_display').html('LS SN : '+this.value);
        // $('#top_lssn_display').append($(this).val());
    });









});







$('#san_not_available').hide();

function isEmpty(str) {
    // return (!str || 0 === str.length);
    return (!str || /^\s*$/.test(str));
}
