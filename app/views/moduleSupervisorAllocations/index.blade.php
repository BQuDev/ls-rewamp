@extends('layouts.main')


@section('content')

<div class="m-b-md">
	<form class="navbar-form navbar-left " role="search">
        <div class="form-group">
             <div class="input-group" style="min-width:1080px;">
                     <span class="input-group-btn">
                       <span class="btn btn-sm bg-white b-white btn-icon" style="min-height:50px;font-size:24px;"><i class="fa fa-search"></i></span>
                     </span>
                     <input type="text" style="min-height:50px;font-size:24px;" id="search_text" class="form-control input-sm no-border" placeholder="Search Name , LS Student Number , SAN , Status ...">
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
                        <th width="15%">Name(s)</th>
                        <th width="40%">Supervisor</th>
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($students as $student_with_san)

                    <?php
                        $student = DB::table('students')->where('san','=',$student_with_san->san)->orderBy('id','desc')->first();

                       $supervisor_allocation_status = DB::table('module_supervisor_allocation')->orderBy('id','desc')->where('san','=',$student->san)->get();
if($student->ls_student_number > 0){
                       ?>
					   <form>
                       <tr>
                           <td><span id="san_{{ $student->san }}">{{ $student->san }}</span></td>
                           <td>{{ $student->ls_student_number  }}</td>
                           <td>
                           @if(!is_null($student))
                           {{ $student->title.' './*
                            $student->initials_1.' '.
                            $student->initials_2.' '.
                            $student->initials_3.' '.
                            */$student->forename_1/*.' '.
                            $student->forename_2.' '.
                            $student->forename_3.' '.
                            $student->surname*/ }}
                           @endif
                           </td>
                           <td>



                           <select id="select_{{ $student->san }}" class="chosen-select"  name="supervisor" data-placeholder="Choose a country..." style="min-width:300px;">
                                  <option id="0">Please select a Supervisor</option>
                           @foreach($supervisors as $supervisor)
                           @if((!empty($supervisor_allocation_status))&&($supervisor_allocation_status[0]->supervisor_id == $supervisor->id))
                                <option id="{{ $supervisor->id }}" selected="selected">{{ $supervisor->name }}</option>
                           @else
                                <option id="{{ $supervisor->id }}" >{{ $supervisor->name }}</option>
                           @endif
                           @endforeach
                              </select>
                           </td>
                           <td>
                           @if(!empty($supervisor_allocation_status))
                           @if($supervisor_allocation_status[0]->supervisor_id > 0)
                                <span class="label bg-success">Supervisor Allocated</span>
                           @else

                           @endif
                           @endif
                           </td>
                           <td style="min-width: 120px;">
@if (Sentry::getUser()->hasAccess('students.more'))

                           <a class="btn btn-sm btn-primary assign_supervisor" id="{{ $student->san }}" href="#">Assign Supervisor</a>
@endif
                           </td>
                         </tr>
						 
                         </form>
						
				<?php
}
                       ?>		
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </section>
@stop


@section('post_css')
{{ HTML::style('js/datatables/datatables.css'); }}
{{ HTML::style('js/chosen/chosen.css'); }}
{{ HTML::style('pnotify/pnotify.core.min.css'); }}
{{ HTML::style('pnotify/pnotify.buttons.min.css'); }}
@stop

@section('post_js')
  {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
   {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}

     {{ HTML::script('pnotify/pnotify.core.min.js'); }}
       {{ HTML::script('pnotify/pnotify.buttons.min.js'); }}

  <script>
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


  $('.assign_supervisor').click(function(){
        //console.log($(this).attr('id'));
        var select = '#select_'+$(this).attr('id');
        var san = '#san_'+$(this).attr('id');
        //console.log(select);
        //console.log($(select).attr('id'));
        //console.log($(select).val());
        //console.log($(san).html());
        var selectedVal =$(select).val();
if(selectedVal === 'Please select a Supervisor' ){ console.log('kk'+selectedVal);

               new PNotify({
                     title: 'Please select a supervisor',
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
            url: "{{ url('modules/supervisor-allocation')}}",
            data: {token: $('[name="_token"]').val(),san: $(san).html(),supervisor:$(select).val()},
            success: function (data) {
               if(data == 1){
               new PNotify({
                       title: 'Supervisor Successfully assigned',
                       text: ' Supervisor Successfully assigned to '+$(san).html(),
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
                          title: 'Supervisor not assigned',
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
                              title: 'Supervisor already assigned',
                              text:' Supervisor already assigned to '+$(san).html(),
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

  </script>

@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li class="active"><a href="{{ URL::to('/students') }}">Applications</a></li>

 @stop