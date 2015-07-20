@extends('layouts.main')


@section('content')

<div class="panel-group m-b" id="accordion2">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                          Custom Filters
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                                   <form class="bs-example form-horizontal">
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Module</label>
                                          <div class="col-lg-10">

                                             <select id="module" class="chosen-select"  name="module" data-placeholder="Choose a module..." style="min-width:300px;">
                                                      <option value="">Please select a Module</option>
                                               @foreach($modules as $module)
                                                    <option value="{{ $module->name }}" >{{ $module->name }}</option>

                                               @endforeach
                                               </select>
                                            <!--<span class="help-block m-b-none">Example block-level help text here.</span>-->
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-lg-2 control-label">Element</label>
                                          <div class="col-lg-10">
                                              <select id="element" class="chosen-select"  name="element" data-placeholder="Choose a module..." style="min-width:300px;">
  <option value="">Please select a Element</option>
                                          <option value="Element 1" >Element 1</option>
                                          <option value="Element 2" >Element 2</option>
                                     </select>
                                          </div>
                                        </div>
                                            <div class="form-group">
                                              <label class="col-lg-2 control-label">Marker 1</label>
                                              <div class="col-lg-10">
                                                   {{ Form::select('marker_1', $markers,'',['class'=>'chosen-select col-sm-12','id'=>'marker_1']);  }}
                                              </div>
                                            </div>
                                                <div class="form-group">
                                          <label class="col-lg-2 control-label">Markser 2</label>
                                          <div class="col-lg-10">
                             {{ Form::select('marker_2', $markers,'',['class'=>'chosen-select col-sm-12','id'=>'marker_2']);  }}
                                          </div>
                                        </div>
                                    </form>

                        </div>
                      </div>
                    </div>

                  </div>

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
                  <table class="table table-striped m-b-none" data-ride="datatables" id="test_i">
                    <thead>
                      <tr>
                        <th width="8%">SAN</th>
                        <th width="12%">LS student number</th>
                        <th width="35%">Name(s)</th>
                        <th width="35%">Module</th>
                        <th width="35%">Element</th>
                        <th width="35%">Marker1</th>
                        <th width="35%">Marker2</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
            <?php

                $course_id = DB::table('application_courses')->where('name','=',urldecode(Request::segment(3)))->first()->id;
                $modules = DB::table('modules')->where('course_id','=',$course_id)->get();

            ?>
            @foreach ($modules as $module)
                <?php
                    $elements = DB::table('module_elements')->where('module_id','=',$module->id)->get();
                ?>
                @foreach ($elements as $element)
                         @foreach ($students as $student_with_san)

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
                        <td>{{ $module->name }}</td>
                        <td>{{ $element->name }}</td>
                        <td>

                        <?php
                        $markers = DB::table('student_module_markers_allocation')
                        		->where('san','=',$student->san)
                        		->where('element_id','=',$element->id)
                        		->get();//return $already_exists;


                        ?>
                        @if(!empty($markers))
                            {{ ModuleMarker::getNameByID( $markers[0]->marker_1) }}
                        @endif
                        </td>
                        <td>                        @if(!empty($markers))
                                                        {{ ModuleMarker::getNameByID( $markers[0]->marker_2) }}
                                                    @endif</td>
                                                   <td style="min-width: 120px;">
                        @if (Sentry::getUser()->hasAccess('students.more'))

                                                   <a class="btn btn-sm btn-primary" id="{{ $element->id.'_'.$student_with_san->san }}" href="#modal_{{ $element->id.'_'.$student_with_san->san }}" data-toggle="modal">Update Marks</a>
                        @endif
                                                   </td>
                                                 </tr>

                                            @endforeach

                 @endforeach
            @endforeach



                    </tbody>
                  </table>
                </div>
 </section>





            @foreach ($modules as $module)
                <?php
                    $elements = DB::table('module_elements')->where('module_id','=',$module->id)->get();
                ?>
                @foreach ($elements as $element)
                         @foreach ($students as $student_with_san)

                <?php
                    $student = DB::table('students')->where('san','=',$student_with_san->san)->orderBy('id','desc')->first();

                   ?>
                    <?php /* ?><tr>
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
                        <td>{{ $module->name }}</td>
                        <td>{{ $element->name }}</td>
                        <td>

                        <?php
                        $markers = DB::table('student_module_markers_allocation')
                        		->where('san','=',$student->san)
                        		->where('element_id','=',$element->id)
                        		->get();//return $already_exists;


                        ?>
                        @if(!empty($markers))
                            {{ ModuleMarker::getNameByID( $markers[0]->marker_1) }}
                        @endif
                        </td>
                        <td>                        @if(!empty($markers))
                                                        {{ ModuleMarker::getNameByID( $markers[0]->marker_2) }}
                                                    @endif</td>
                                                   <td style="min-width: 120px;">
                        @if (Sentry::getUser()->hasAccess('students.more'))

                                                   <a class="btn btn-sm btn-primary" id="{{ $element->id.'_'.$student_with_san->san }}" href="#modal_{{ $element->id.'_'.$student_with_san->san }}" data-toggle="modal">Update Marks</a>
                        @endif
                       </td>
                     </tr><?php */ ?>

                     <div class="modal fade" id="modal_{{ $element->id.'_'.$student_with_san->san }}">
                         <div class="modal-dialog" style="width:80%">
                           <div class="modal-content">
                               <div class="modal-header">
                                 <button data-dismiss="modal" class="close" type="button">×</button>
                                 <h4 class="modal-title">Student({{ $student->ls_student_number }}) Marks input</h4>
                                 <div class="row">
                                     <div class="col-sm-6 b-r">
                                    <p>{{ urldecode(Request::segment(3)) }} - {{ $module->name }} - {{ $element->name }}</p>
                                    <p>LS Student Number - <a class="text-info" target="_blank" href="{{ URL::to('students').'/'.$student->san }}">{{ $student->ls_student_number }}</a> | SAN -  <a class="text-info" target="_blank" href="{{ URL::to('students').'/'.$student->san }}">{{ $student->san }}</a></p>
                                     </div>

                                     <div class="col-sm-6 b-r">
                                     <?php
                                     $markers = DB::table('student_module_markers_allocation')
                                            ->where('san','=',$student->san)
                                            ->where('element_id','=',$element->id)
                                            ->get();//return $already_exists;
                                     ?>
                                      @if(!empty($markers))
                                         <p>Marker 1 - {{ ModuleMarker::getNameByID( $markers[0]->marker_1) }}</p>
                                         <p>Marker 2 - {{ ModuleMarker::getNameByID( $markers[0]->marker_2) }}</p>
                                      @endif
                                     </div>
                                 </div>

                               </div>
                               <div class="modal-body">
                               <div class="row">
                                 <div class="col-sm-8">
                                     <?php
                                         $marking_criterias = DB::table('module_element_marking_criteria')->where('element_id','=',$element->id)->get();
                                     ?>
                                     <section class="panel panel-default">
                                     <div class="table-responsive">
                                                       <table class="table table-striped b-t b-light">
                                                         <thead>
                                                           <tr>
                                                              <th data-toggle="class" class="th-sortable active">Criteria

                                                               </span>
                                                             </th>
                                                             <th>Marks ( Marker 1 )</th>
                                                             <th>Marks ( Marker 2 )</th>
                                                             <th></th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>



                                     @foreach ($marking_criterias as $marking_criteria)

                                                           <tr>
                                                             <td>{{$marking_criteria->name }}</td>
                                                             <td><input type="text" id="marks_{{$marking_criteria->id.'_'.$student->san }}"></td>
                                                             <td><input type="text" id="marks_{{$marking_criteria->id.'_'.$student->san }}"></td>
                                                             <td> <a class="btn btn-primary save_marks" href="#" id="{{$marking_criteria->id.'_'.$student->san }}" class="">Update Marks</a></td>
                                                           </tr>
<span id="san_{{$marking_criteria->id.'_'.$student->san }}" style="display: none">{{ $student->san }}</span>
<span id="marking_criteria_{{$marking_criteria->id.'_'.$student->san }}" style="display: none">{{ $marking_criteria->id }}</span>
                                     @endforeach
                                                            </tbody>
                                                       </table>
                                                        </div>

                                                                     </section>
                                                   
                                  </div>
                                  <div class="col-sm-4">
                                  </div>
                                 </div>
                               </div>
                               <div class="modal-footer">
                                 <a data-dismiss="modal" class="btn btn-default" href="#">Close</a>
                                 <a class="btn btn-primary" href="#">Save</a>
                               </div>
                             </div><!-- /.modal-content -->
                         </div><!-- /.modal-dialog -->
                     </div>

                        @endforeach
                 @endforeach
            @endforeach


@stop


@section('post_css')
{{ HTML::style('js/datatables/datatables.css'); }}
{{ HTML::style('js/chosen/chosen.css'); }}
{{ HTML::style('pnotify/pnotify.core.min.css'); }}
{{ HTML::style('pnotify/pnotify.buttons.min.css'); }}
<style>

</style>

@stop

@section('post_js')
  {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
  {{ HTML::script('js/datatables/jquery.dataTables.columnFilter.js'); }}
   {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}

     {{ HTML::script('pnotify/pnotify.core.min.js'); }}
       {{ HTML::script('pnotify/pnotify.buttons.min.js'); }}

  <script>
$(document).ready( function () {

  $('#test_i').dataTable().columnFilter({aoColumns:[
                                       				{  sSelector: "#name" },
                                       				{  sSelector: "#module" },
                                       				{  sSelector: "#element" },
                                       				{  sSelector: "#marker1" },
                                       				{  sSelector: "#marker2" },
                                       				{  sSelector: "#action" },
                                       				null,null
                                       				]}
                                       			);
  $('#test_i_filter').css('display','none');

} );

  fixChoosen();

   $(".chosen-select").chosen({width: "100%"}).trigger("chosen:updated");
  $('[name="marker_1"]').chosen({width: "100%"}).prepend("<option value=''>Please Select an Option</option>").val(0).trigger("chosen:updated");
  $('[name="marker_2"]').chosen({width: "100%"}).prepend("<option value=''>Please Select an Option</option>").val(0).trigger("chosen:updated");
var stack_bottomright = {"dir1": "down", "dir2": "left"};
    $('#student_datatable').dataTable({
"sPaginationType": "full_numbers"
    });
    $(".chosen-select").chosen();


    oTable = $('#test_i').dataTable();
  $('#search_text').keyup(function(){
         oTable.fnFilter($(this).val());
  });

$('[name="module"]').change(function(){
        oTable.fnFilter($('[name="module"]').val(),3);
});
$('[name="element"]').change(function(){console.log($('[name="element"]').val());
       oTable.fnFilter($('[name="element"]').val(),4);
});
$('[name="marker_1"]').change(function(){
       oTable.fnFilter($('[name="marker_1"]').val(),5);
});
$('[name="marker_2"]').change(function(){
        oTable.fnFilter($('[name="marker_2"]').val(),6);
});

  $('#student_datatable_filter').hide();


  $('.save_marks').click(function(){
        //console.log($(this).attr('id'));
        var marks = '#marks_'+$(this).attr('id');
       // var marker_2 = '#marker_2_'+$(this).attr('id');
        var marking_criteria_id = '#marking_criteria_'+$(this).attr('id');
        var san = '#san_'+$(this).attr('id');
       // console.log(marker_1);
        //console.log($(select).attr('id'));
        var element_id = $('#element_'+$(this).attr('id'));
       // console.log($(this).attr('id'));
        //console.log($(element_id).html());
        //console.log(san);
        console.log($(san).html());
        console.log($(marks).val());
        //var selectedVal =$(select).val();
if($(marks).val() == '' )
{
               new PNotify({
                     title: 'Please insert marks',
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
}else{/*
        $.ajax({
            url: "{{ url('modules/marks')}}",
            data: {token: $('[name="_token"]').val(),
            san: $(san).html(),
            marking_criteria:$(marking_criteria_id).html(),
            marks:$(marks).val()
            },
            success: function (data){
            console.log(data);*/
              // if(data == 1){
               new PNotify({
                       title: 'Marks Added Successfully',
                       text: ' Marks Added Successfully to '+$(san).html(),
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
                  /* }else if(data == 0){
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
                       }*/

/*
            },
            type: "POST"
        });*/}

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