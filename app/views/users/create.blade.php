@extends('layouts.main')


@section('content')


<div class="row" style="min-height: 50px;"></div>
<div class="row">
<div class="col-lg-8">
{{ Form::open(array('url' =>URL::to("/").'/users',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create')) }}

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('username', 'Username ', array('class' => 'col-lg-2 control-label'));  }}
                <div class="col-sm-10">

                         {{ Form::text('username','',['placeholder'=>'Username','class'=>'form-control']); }}
                </div>

              </div>
</div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('password', 'Password', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::password('password',['placeholder'=>'Password','class'=>'form-control']); }}
                          </div>
            </div>
</div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('password', 'Password', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::password('password1',['placeholder'=>'Re-Type Password','class'=>'form-control']); }}
                          </div>
            </div>
</div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('first_name', 'First Name', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::text('first_name','',['placeholder'=>'First Name','class'=>'form-control']); }}
                          </div>
            </div>
</div>

<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('last_name', 'Last Name', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::text('last_name','',['placeholder'=>'Last Name','class'=>'form-control']); }}
                          </div>
            </div>
</div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('group', 'Group', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::select('group', $groups,'',['class'=>'chosen-select form-control']);  }}
                          </div>
            </div>
</div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('company', 'Company', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::select('company', $companies,'',['class'=>'chosen-select form-control']);  }}
                          </div>
            </div>
</div>
<div class="row" style="font-size: 16px">
             <div class="form-group">
                          {{ Form::label('time_zone', 'Time Zone', array('class' => 'col-lg-2 control-label'));  }}
                          <div class="col-sm-10">

                         {{ Form::select('time_zone', DateTimeZone::listIdentifiers(DateTimeZone::ALL),'',['class'=>'chosen-select form-control']);  }}
                          </div>
            </div>
</div>
<div class="line line-dashed b-b line-lg pull-in"></div>
                                       <div class="form-group">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-9">
                                             <div class="checkbox i-checks">
                                                <label>
                                               {{ Form::checkbox('confirm_save', '1',false,array('data-required'=>'true')); }}
                                                <i></i>
                                                Confirm Add User
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="line line-dashed b-b line-lg pull-in"></div>
                           <div class="form-group">
                              <label class="col-sm-3 control-label"> </label>
                              <div class="col-sm-9">
                              {{ Form::submit('Save', array('class' => 'btn btn-s-md btn-primary')) }}
                              </div>
                           </div>
{{ Form::close() }}
   </div>
<div class="col-lg-4">

   </div>
   </div>
</div>
@stop


 @section('breadcrumb')
   <li><a href="{{ URL::to('/students') }}">Settings</a></li>
   <li><a href="{{ URL::to('/students') }}">User Management</a></li>
   <li class="active"><a href="{{ URL::to('/students/create') }}">Add New User</a></li>
 @stop


@section('post_css')
{{ HTML::style('js/chosen/chosen.css'); }}
@stop

@section('post_js')
<script type="text/javascript">





    $('#information_source').change(function(){
        if($('#information_source').val()==3){
            //$('[name="agents_laps"]').prop('disabled', true);
            //$('[name="agents_laps"]').val(0);
        }
        $.ajax({
            url: "{{ url('students/create/information_source/dropdown')}}",
            data: {token: $('[name="_token"]').val(),option: $('#information_source').val()},
            success: function (data) {console.log('success');
                $('[name="agent_names"]').empty();
                var model = $('[name="agents_laps"]');
                model.empty();
                model.append("<option value='0'>Please Select an Option</option>");
                $.each(data, function(index, element) {
                    model.append("<option value='"+ index +"'>" + element + "</option>");
                });
                model.append("<option value='10000'>Other</option>");
                $('[name="agents_laps"]').trigger("chosen:updated");
            },
            type: "GET"
        });
    });



    $('#intake_year').change(function(){
        $.ajax({
            url: "{{ url('students/create/intakes/dropdown')}}",
            data: {token: $('[name="_token"]').val(),option: $('#intake_year').val()},
            success: function (data) {
                $('[name="intake_month"]').empty();
                var model = $('[name="intake_month"]');
                model.empty();
                $.each(data, function(index, element) {
                    model.append("<option value='"+ index +"'>" + element + "</option>");
                });
                $('[name="intake_month"]').trigger("chosen:updated");
            },
            type: "GET"
        });
    });

    function checkSanAvailability(){
        if(!isEmpty($('#san').val())){
            $.ajax({
                url: "{{ url('students/create/checkSanAvailability')}}",
                data: {token: $('[name="_token"]').val(),option: $('#san').val()},
                success: function (data) {
                    console.log(data);
                    if(data =='Available'){
                        $('#san').removeClass("parsley-error").addClass( "parsley-success" );
                        $('#san_not_available').hide();
                    }else{
                        $('#san').removeClass("parsley-success").addClass( "parsley-error" );
                        $('#san_not_available').show();
                    }
                },
                type: "GET"

            });}
    }

</script>

 {{ HTML::script('js/student_create.js'); }}

 {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}
  <!-- parsley -->
{{ HTML::script('js/parsley/parsley.min.js'); }}
{{ HTML::script('js/parsley/parsley.extend.js'); }}
<style>
#san.parsley-success{
  color: #468847;
  background-color: #DFF0D8;
  border: 1px solid #D6E9C6;
}

#san.parsley-error {
  color: #B94A48;
  background-color: #F2DEDE;
  border: 1px solid #EED3D7;
}

</style>
@stop

@section('main_menu')

 @stop

 @section('san')
 <div align="center">
 <span id="top_san_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">SAN : </span>
 <span id="top_lssn_display" class="nav navbar-nav navbar-center input-s-lg m-t m-l-n-xs" style="color: black;font-size: 24px !important">LS SN : </span>
 </div>
  @stop