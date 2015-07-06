
$(function() {



    $('[name="instalment_payment_method_1"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="instalment_payment_method_2"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="instalment_payment_method_3"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="nationality"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="information_source"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="agents_laps"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="admission_manager"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="qualification_1"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="qualification_2"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="qualification_3"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="tt_country"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="country"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="course_name"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
    $('[name="awarding_body"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");


    /*
     *   Parsley validation added
     *
     */

    $('#student_create').parsley();


    /*
     *   Other text fields . Hide/Show by drop down selection
     *
     */





});


