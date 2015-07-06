@extends('layouts.main')


@section('content')

{{ HTML::style('pnotify/pnotify.core.min.css'); }}
{{ HTML::style('pnotify/pnotify.buttons.min.css'); }}
<div class="col-sm-12">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Marks-Input</header>
                    <div class="panel-body">
                      {{ Form::open(array('url' =>URL::to("/").'/students',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create')) }}

                        <div class="form-group">
                          <label class="col-lg-2 control-label">LS Student Number</label>
                          <div class="col-lg-10">
                             {{ Form::select('ls_student_number', $ls_student_numbers,Request::segment(3),['class'=>'chosen-select col-sm-12']);  }}
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Course</label>
                          <div class="col-lg-10">
                                <div id="course_name"></div>
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Module</label>
                          <div class="col-lg-10">
                            {{ Form::select('module', $modules,'',['class'=>'chosen-select col-sm-12','disabled'=>'']);  }}
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Element</label>
                          <div class="col-lg-10">
                            {{ Form::select('element', $elements,'',['class'=>'chosen-select col-sm-12','disabled'=>'']);  }}
                          </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="row">
                                                             <div class="col-lg-6">
                                                            <div class="form-group">
                                                              <label class="col-lg-2 control-label"></label>
                                                              <div class="col-lg-10">

                                    							 <label class="col-lg-12 control-label"> Initial Mark</label>
                                                              </div>
                                                            </div>
                                                            </div>
                                                             <div class="col-lg-6">
                                                            <div class="form-group">
                                                              <div class="col-lg-12">

                                    							 <label class="col-lg-12 control-label">Remark</label>
                                                              </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                    <div class="row">
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="col-lg-2 control-label">Test</label>
                                      <div class="col-lg-10">
            							 {{ Form::text('test', '',['placeholder'=>'Initial Mark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <div class="col-lg-12">
            							 {{ Form::text('test_remark', '',['placeholder'=>'Remark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="col-lg-2 control-label">Course</label>
                                      <div class="col-lg-10">
            							 {{ Form::text('course', '',['placeholder'=>'Initial Mark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <div class="col-lg-12">
            							 {{ Form::text('course_remark', '',['placeholder'=>'Remark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="col-lg-2 control-label">Retake</label>
                                      <div class="col-lg-10">
            							 {{ Form::text('retake', '',['placeholder'=>'Initial Mark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                     <div class="col-lg-6">
                                    <div class="form-group">
                                      <div class="col-lg-12">
            							 {{ Form::text('retake_remark', '',['placeholder'=>'Remark','disabled'=>'','class'=>'form-control','data-min'=>'0','data-max'=>'100','data-trigger'=>'keyup']); }}

                                      </div>
                                    </div>
                                    </div>
                                    </div>

  <div class="row">
                         <div class="col-lg-12">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Comments</label>
                          <div class="col-lg-10">
                            {{ Form::textarea('comments', '',['placeholder'=>'Comments','class'=>'form-control']); }}
                            </div>
                        </div>


                        </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-10">
                            <div class="checkbox i-checks">
                                                                           <label>
                                                                          {{ Form::checkbox('confirm_save', '1',false,array('data-required'=>'true')); }}
                                                                           <i></i>
                                                                           Confirm Save
                                                                           </label>
                                                                        </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-10">
                             {{ Form::submit('Save', array('class' => 'btn btn-s-md btn-primary','id'=>'save')) }}
                          </div>
                        </div>
                      {{ Form::close() }}
                    </div>
                  </section>
                </div>
@stop


@section('post_css')
{{ HTML::style('js/chosen/chosen.css'); }}
@stop

@section('post_js')
  {{ HTML::script('pnotify/pnotify.core.min.js'); }}
    {{ HTML::script('pnotify/pnotify.buttons.min.js'); }}
    {{ HTML::script('js/module_marks_input_create.js'); }}

  <script type="text/javascript">
  if('{{Request::segment(4) }}'){
  $('[name="ls_student_number"]').val('{{Request::segment(4) }}').trigger("chosen:updated");
     $.ajax({
             url: "{{ url('/modules/marks-input/create/module/dropdown')}}",
             data: {token: $('[name="_token"]').val(),option: '{{Request::segment(4) }}'},
             success: function (data) {console.log('success');
                 $('[name="module"]').empty();
                 var model = $('[name="module"]');
                 model.empty();
                 model.append("<option value='0'>Please Select an Option</option>");
                 $('#course_name').html(data[1]);
                 $.each(data[0], function(index, element) {
                     model.append("<option value='"+ index +"'>" + element + "</option>");
                 });
                 $('[name="module"]').prop('disabled',false);
                 $('[name="module"]').trigger("chosen:updated");

             },
             type: "GET"
          });


  }else{
    $('[name="ls_student_number"]').prepend("<option value='0'>Please Select an Option</option>").val('0').trigger("chosen:updated");
  }

var stack_bottomright = {"dir1": "down", "dir2": "left"};
      $('[name="ls_student_number"]').change(function(){
      if($('[name="ls_student_number"]').val() != 0){
      $.ajax({
           url: "{{ url('/modules/marks-input/create/module/dropdown')}}",
           data: {token: $('[name="_token"]').val(),option: $('[name="ls_student_number"]').val()},
           success: function (data) {console.log('success');
               $('[name="module"]').empty();
               var model = $('[name="module"]');
               model.empty();
               model.append("<option value='0'>Please Select an Option</option>");
               $('#course_name').html(data[1]);
               $.each(data[0], function(index, element) {
                   model.append("<option value='"+ index +"'>" + element + "</option>");
               });
               $('[name="module"]').prop('disabled',false);
               $('[name="module"]').trigger("chosen:updated");

           },
           type: "GET"
        });
        }else{
            $('[name="module"]').prop('disabled',true);
            $('[name="module"]').trigger("chosen:updated");
        }

      });
      $('[name="module"]').change(function(){
      if($('[name="module"]').val() != 0){
          $.ajax({
              url: "{{ url('/modules/marks-input/create/elements/dropdown')}}",
              data: {token: $('[name="_token"]').val(),option: $('[name="module"]').val()},
              success: function (data) {console.log('success');
                  $('[name="element"]').empty();
                  var model = $('[name="element"]');
                  model.empty();
                  model.append("<option value='0'>Please Select an Option</option>");

                  $.each(data, function(index, element) {
                      model.append("<option value='"+ index +"'>" + element + "</option>");
                  });

                  $('[name="element"]').prop('disabled',false);
                  $('[name="element"]').trigger("chosen:updated");

                                   $('[name="test"]').val('')
                                   $('[name="test_remark"]').val(''),
                                   $('[name="course"]').val(''),
                                   $('[name="course_remark"]').val(''),
                                   $('[name="retake"]').val(''),
                                   $('[name="retake_remark"]').val(''),
                                   $('[name="element"]').val(),
                                   $('[name="comments"]').val('')
              },
              type: "GET"
          });}
          else{
          $('[name="element"]').prop('disabled',true);
          $('[name="element"]').trigger("chosen:updated");
          }
      });

      $('[name="element"]').change(function(){
          if($('[name="element"]').val() != 0){
             $('[name="test"]').prop('disabled',false);
             $('[name="test_remark"]').prop('disabled',false);
             $('[name="course"]').prop('disabled',false);
             $('[name="course_remark"]').prop('disabled',false);
             $('[name="retake"]').prop('disabled',false);
             $('[name="retake_remark"]').prop('disabled',false);
              $('#student_create').parsley('destroy');
                     // Re-assign parsley to the form to include the second page now
                     $('#student_create').parsley();

            $.ajax({
              url: "{{ url('/modules/marks-input/get_student_marks')}}",
              data: {token: $('[name="_token"]').val(),ls_student_number: $('[name="ls_student_number"]').val(),element: $('[name="element"]').val()},
              success: function (data) {

                 if(!jQuery.isEmptyObject(data)){

                 var arr = $.map(data, function(el) { return el; });console.log(arr);

                $('[name="test"]').val(arr[1])
                $('[name="test_remark"]').val(arr[2]),
                $('[name="course"]').val(arr[3]),
                $('[name="course_remark"]').val(arr[4]),
                $('[name="retake"]').val(arr[5]),
                $('[name="retake_remark"]').val(arr[6]),
                $('[name="element"]').val(),
                $('[name="comments"]').val(arr[10])


                 }else{
                 $('[name="test"]').val('')
                 $('[name="test_remark"]').val(''),
                 $('[name="course"]').val(''),
                 $('[name="course_remark"]').val(''),
                 $('[name="retake"]').val(''),
                 $('[name="retake_remark"]').val(''),
                 $('[name="element"]').val(),
                 $('[name="comments"]').val('')

                 }
              },
              type: "GET"
          });


          }else{





                                         $('[name="test"]').val('')
                                         $('[name="test_remark"]').val(''),
                                         $('[name="course"]').val(''),
                                         $('[name="course_remark"]').val(''),
                                         $('[name="retake"]').val(''),
                                         $('[name="retake_remark"]').val(''),
                                         $('[name="element"]').val(),
                                         $('[name="comments"]').val('')
              $('[name="test"]').prop('disabled',true);
                        $('[name="test_remark"]').prop('disabled',true);
                        $('[name="course"]').prop('disabled',true);
                        $('[name="course_remark"]').prop('disabled',true);
                        $('[name="retake"]').prop('disabled',true);
                        $('[name="retake_remark"]').prop('disabled',true);
          }
      });

      $( "#save" ).click(function( event ) {
		  event.preventDefault();
	/*	  $('#student_create').parsley().subscribe('parsley:form:validate', function (formInstance) {

    // if one of these blocks is not failing do not prevent submission
    // we use here group validation with option force (validate even non required fields)
    if (formInstance.isValid('block1', true) || formInstance.isValid('block2', true)) {
      $('.invalid-form-error-message').html('');
      return;
    }
    // else stop form submission
    formInstance.submitEvent.preventDefault();

    // and display a gentle message
    $('.invalid-form-error-message')
      .html("You must correctly fill the fields of at least one of these two blocks!")
      .addClass("filled");
    return;
  });*/



      if($('#student_create').parsley('validate')){
        $.ajax({
                      url: "{{ url('/modules/marks-input/create')}}",
                      data: {
                      token: $('[name="_token"]').val(),
                      ls_student_number: $('[name="ls_student_number"]').val(),
                      test: $('[name="test"]').val(),
                      test_remark: $('[name="test_remark"]').val(),
                      course: $('[name="course"]').val(),
                      course_remark: $('[name="course_remark"]').val(),
                      retake: $('[name="retake"]').val(),
                      retake_remark: $('[name="retake_remark"]').val(),
                      element: $('[name="element"]').val(),
                      comments: $('[name="comments"]').val()
                      },
                      success: function (data) {
                        if(data == 'Added'){
                        console.log('success');
                         new PNotify({
                                                title: 'Data saved successfully',
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
                                            });
                        }else if(data == '0 element'){
                             new PNotify({
                                    title: 'Please select an Element',
                                    notice:'success',
                                    text: 'Please select an Element and Save again',
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



                      },
                      type: "POST"
	  });}


      });


      </script>
        <!-- parsley -->
      {{ HTML::script('js/parsley/parsley.min.js'); }}
      {{ HTML::script('js/parsley/parsley.extend.js'); }}


@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li><a href="{{ URL::to('/modules') }}">Modules</a></li>
   <li><a href="{{ URL::to('/modules/marks-input/') }}">Marks - Input</a></li>
   <li class="active">Add Marks</li>

 @stop