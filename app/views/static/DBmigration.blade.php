@extends('layouts.main')


@section('content')


<div class="row">
    <div class="col-lg-12">
      {{ Form::open(array('url' =>URL::to("migrate"),  'class'=>'form-horizontal','method' => 'post','id'=>'contact_bqu_create')) }}


          </div>
          <div class="form-group">
                      {{ Form::label('username', 'Take', array('class' => 'col-lg-2 control-label'));  }}
            <div class="col-sm-10">

                   {{ Form::text('take','',['placeholder'=>'','class'=>'form-control']); }}
            </div>

          </div>
          <div class="form-group">
                      {{ Form::label('username', 'Skip', array('class' => 'col-lg-2 control-label'));  }}
            <div class="col-sm-10">

                   {{ Form::text('skip','',['placeholder'=>'','class'=>'form-control']); }}
            </div>

          </div>

        <div class="input-inline">
         <button class="btn btn-primary" type="submit">Migrate</button>
        </div>
     {{ Form::close() }}
    </div>
</div>
@stop


@section('post_css')
{{ HTML::style('js/datatables/datatables.css'); }}
@stop

@section('post_js')
  {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
  <script>

    $('#student_datatable').dataTable({
"sPaginationType": "full_numbers"
    });


    oTable = $('#student_datatable').dataTable();
  $('#search_text').keyup(function(){
         oTable.fnFilter($(this).val());
  })

  $('#student_datatable_filter').hide();

  </script>

@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li class="active"><a href="{{ URL::to('/contact-bqu') }}">Contact BQu-IT Team</a></li>

 @stop