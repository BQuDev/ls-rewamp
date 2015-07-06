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


 <section class="panel panel-default">

                <div class="table-responsive">
                  <table class="table table-striped m-b-none" data-ride="datatables" id="student_datatable">
                    <thead>
                      <tr>
                        <th width="35%">Name(s)</th>
                        <th width="20%">Group</th>
                        <th width="20%">Company</th>
                        <th width="10%">Status</th>
                        <th width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $user)
                    <?php
                    //$s = DB::table('students')->where('id','=',$user->id)->first();
                   // $student_application_status = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->first();
                    $user_group_id = DB::table('users_groups')->where('user_id','=',$user->id)->first()->group_id;
                    $user_group_name = DB::table('groups')->where('id','=',$user_group_id)->first()->name;
                    $company_row = DB::table('users_more_details')->where('user_id','=',$user->id)->first();
                    if($company_row != null){
                    $company_abbreviation =  DB::table('users_companies')->where('id','=',$company_row->company)->first()->abbreviation;
                    }else{
                    $company_abbreviation = "";
                    }

                    $status = '';
                    /// Find the user using the user id
                         $user_status = Sentry::getUserProvider()->findById($user->id);
                         $throttle = Sentry::findThrottlerByUserId($user->id);
                 // Check if the user is activated or not
                    if ($user_status->isActivated())
                    {
                        // User is Activated
                        $status = '<span class="label bg-success">Activated</span>';
                    }else if($throttle->isBanned())
                    {
                        // User is Banned
                         $status = '<span class="label bg-warning">Banned</span>';
                    }
                    ?>
                       <tr>
                           <td>{{ $user->first_name.' '.$user->last_name }}</td>
                           <td>{{ $user_group_name }}</td>
                           <td>{{ $company_abbreviation }}</td>
                           <td>{{ $status }}</td>
                           <td style="min-width: 120px;">
@if (Sentry::getUser()->hasAccess('students.more'))
                           <a class="btn btn-sm btn-primary" href="{{ URL::to('/students/') }}">More</a>
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