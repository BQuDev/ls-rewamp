@extends('layouts.main')


@section('content')

<div class="m-b-md">
	<form class="navbar-form navbar-left " role="search">
        <div class="form-group">
             <div class="input-group" style="min-width:1080px;">
                     <span class="input-group-btn">
                       <span class="btn btn-sm bg-white b-white btn-icon" style="min-height:50px;font-size:24px;"><i class="fa fa-search"></i></span>
                     </span>
                     <input type="text" style="min-height:50px;font-size:24px;" id="search_text" class="form-control input-sm no-border" placeholder="Search Name , Group , Account Status ...">
                   </div>

        </div>
      </form>
      </div>

              <br>
              <br>

<style>
.btncustom{   position: absolute;
              right: 2%;
              top: 50%;
              margin-top: 1.5%;
              z-index:100;}
.ssc{position:relative;}
</style>
 <section class="panel panel-default">
<div class="ssc">
                <a href="#" class="btn btn-sm btn-success btncustom">Add New User Group</a></div>

                <div class="table-responsive">

                  <table class="table table-striped m-b-none" data-ride="datatables" id="student_datatable">
                    <thead>
                      <tr>
                        <th width="35%">Name</th>
                        <th width="8%">Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($groups as $group)



                       <tr>

                           <td>{{ $group->name }}</td>
                           <td style="min-width: 120px;">
@if (Sentry::getUser()->hasAccess('students.more'))
                           <a class="btn btn-sm btn-warning" href="{{ URL::to('/settings/user-management/user-groups/'.$group->name) }}">Edit Permissions</a>&nbsp;&nbsp;
                           <a class="btn btn-sm btn-danger" href="{{ URL::to('/students/') }}">Delete</a>&nbsp;&nbsp;
@endif
                           </td>
                         </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </section>
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
   <li class="active"><a href="{{ URL::to('/students') }}">Applications</a></li>

 @stop