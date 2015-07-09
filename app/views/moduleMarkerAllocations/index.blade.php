@extends('layouts.main')


@section('content')

<div class="m-b-md">
	<form class="navbar-form navbar-left " role="search">
        <div class="form-group">
             <div class="input-group" style="min-width:1080px;">
                     <span class="input-group-btn">
                       <span class="btn btn-sm bg-white b-white btn-icon" style="min-height:50px;font-size:24px;"><i class="fa fa-search"></i></span>
                     </span>
                     <input type="text" style="min-height:50px;font-size:24px;" id="search_text" class="form-control input-sm no-border" placeholder="Search Name , LS Student Number , SAN  ...">
                   </div>

        </div>
      </form>
      </div>

              <br>
              <br>


 <section class="panel panel-default">

                <div class="table-responsive">
                  <table class="table table-striped m-b-none" data-ride="datatables" id="student_datatable">
                    <thead>
                      <tr>
                        <th width="8%">SAN</th>
                        <th width="12%">LS student number</th>
                        <th width="35%">Name(s)</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($students as $student_with_san)
<form>
                    <?php
                        $student = DB::table('students')->where('san','=',$student_with_san->san)->orderBy('id','desc')->first();

                       ?>
                       <tr>
                           <td><span id="san_{{ $student->san }}">{{ $student->san }}</span></td>
                           <td>{{ $student->ls_student_number  }}</td>
                           <td>
                           @if(!is_null($student))
                           {{ $student->title.' '.
                            $student->initials_1.' '.
                            $student->initials_2.' '.
                            $student->initials_3.' '.
                            $student->forename_1.' '.
                            $student->forename_2.' '.
                            $student->forename_3.' '.
                            $student->surname }}
                           @endif
                           </td>

                           <td style="min-width: 120px;">
@if (Sentry::getUser()->hasAccess('students.more'))

                           <a class="btn btn-sm btn-primary" id="{{ $student->san }}" href="#modal_{{ $student_with_san->san }}" data-toggle="modal">Assign Marker</a>
@endif
                           </td>
                         </tr>
                         </form>
                    @endforeach

                    </tbody>
                  </table>
                </div>
 </section>

 @foreach ($students as $student_with_san)
<div class="modal fade" id="modal_{{ $student_with_san->san }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ urldecode(Request::segment(3)) }} ({{ $student_with_san->san }})</h4>
          </div>
          <div class="modal-body">
          <?php
            $modules = DB::table('modules')->where('course_id','=',$course_id)->get();
          ?>

            <div class="panel-group m-b" id="accordion_{{ $student_with_san->san }}">
            @foreach($modules as $module)

                <div class="panel panel-default">
                  <div class="panel-heading">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_{{ $student_with_san->san }}" href="#collapse_{{ $module->id }}_{{ $student_with_san->san }}">
                      {{ $module->name }}
                    </a>
                  </div>
                  <div id="collapse_{{ $module->id }}_{{ $student_with_san->san }}" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body text-sm">
                     <?php
                        $elements = DB::table('module_elements')->where('module_id','=',$module->id)->get();
                      ?>
                      @foreach($elements as $element)
                      <div class="row">
                            <div class="col-lg-12">
                            <span id="element_{{ $element->id }}_{{ $student_with_san->san }}" style="visibility:hidden">{{ $element->id }}</span>
                                <div class="row">
                                    <div class="col-lg-2">
                                        {{ $element->name }}
                                    </div>
                                    <div class="col-lg-4">
                                    <?php
                                    $marker_1 = 'marker_1_'.$element->id.'_'.$student_with_san->san

                                    ?>
                                        {{ Form::select($marker_1, $markers,'',['class'=>'chosen-select col-sm-4' ,'style'=>'min-width:50px !important','id'=>$marker_1]);  }}
                                    </div>
                                    <div class="col-lg-4">
                                    <?php
                                    $marker_2 = 'marker_2_'.$element->id.'_'.$student_with_san->san
                                    ?>
                                         {{ Form::select($marker_2, $markers,'',['class'=>'chosen-select col-sm-4' ,'style'=>'width:50px !important','id'=>$marker_2]);  }}
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-sm btn-primary save_markers" id="{{ $element->id.'_'.$student_with_san->san }}" href="#">Save</a>
                                    </div>
                                </div><hr>
                            </div>
                       </div>
                       @endforeach
                    </div>
                  </div>
                </div>
                 @endforeach
              </div>

          </div>
          <div class="modal-footer">

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      </div><!-- /.modal-dialog -->
  @endforeach

@stop


@section('post_css')
{{ HTML::style('js/datatables/datatables.css'); }}
{{ HTML::style('js/chosen/chosen.css'); }}
{{ HTML::style('pnotify/pnotify.core.min.css'); }}
{{ HTML::style('pnotify/pnotify.buttons.min.css'); }}
<style>
=
</style>

@stop

@section('post_js')
  {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
   {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}

     {{ HTML::script('pnotify/pnotify.core.min.js'); }}
       {{ HTML::script('pnotify/pnotify.buttons.min.js'); }}

  <script>
  fixChoosen()
  $(".chosen-select").chosen({width: "100%"}).prepend("<option value='0'>Please Select an Option</option>").val(0).trigger("chosen:updated");
var stack_bottomright = {"dir1": "down", "dir2": "left"};
    $('#student_datatable').dataTable({
"sPaginationType": "full_numbers"
    });
    $(".chosen-select").chosen();


    oTable = $('#student_datatable').dataTable();
  $('#search_text').keyup(function(){
         oTable.fnFilter($(this).val());
  })

  $('#student_datatable_filter').hide();


  $('.save_markers').click(function(){
        //console.log($(this).attr('id'));
        var marker_1 = '#marker_1_'+$(this).attr('id');
        var marker_2 = '#marker_2_'+$(this).attr('id');
        var san = '#san_'+$(this).attr('id');
        //console.log(marker_2);
        //console.log($(select).attr('id'));
        var element_id = $('#element_'+$(this).attr('id'));
       // console.log($(this).attr('id'));
        //console.log($(element_id).html());
        //console.log($(san).html());
        //var selectedVal =$(select).val();
if(($(marker_1).val() == 0 )&($(marker_2).val() == 0 ))
{
               new PNotify({
                     title: 'Please select a Markers',
                    notice:'info',
                    type : 'info',
                    buttons: {
                        closer: true,
                        sticker: true
                    },
                    animate_speed: 100,
                    opacity: .9,
                    hide: true,
                    stack: stack_bottomright
                  })
}else{
        $.ajax({
            url: "{{ url('modules/marker-allocation')}}",
            data: {token: $('[name="_token"]').val(),san: $(san).html(),element:$(element_id).html(),marker_1:$(marker_1).val(),marker_2:$(marker_2).val()},
            success: function (data) {
               if(data == 1){
               new PNotify({
                       title: 'Marker Successfully assigned',
                       text: ' Marker Successfully assigned to '+$(san).html(),
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
                   }else if(data == 0){
                   new PNotify({
                          title: 'Marker not assigned',
                          text: 'Please contact BQu IT team',
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
                   }else if(data == 3){
                       new PNotify({
                              title: 'Marker already assigned',
                              text:' Marker already assigned to '+$(san).html(),
                              notice:'info',
                              type : 'info',
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

function fixChoosen() {
   var els = jQuery(".chosen-select");
   els.on("chosen:showing_dropdown", function () {
      $(this).parents("div").css("overflow", "visible");
   });
   els.on("chosen:hiding_dropdown", function () {
      var $parent = $(this).parents("div");

      // See if we need to reset the overflow or not.
      var noOtherExpanded = $('.chosen-with-drop', $parent).length == 0;
      if (noOtherExpanded)
         $parent.css("overflow", "");
   });
}
  </script>

@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li class="active"><a href="{{ URL::to('/students') }}">Applications</a></li>

 @stop