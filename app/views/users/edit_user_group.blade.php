@extends('layouts.main')


@section('content')


<div class="row" style="min-height: 50px;"></div>
<div class="row">
<div class="col-lg-8">
{{ Form::open(array('url' =>URL::to("settings/user-management/user-groups/update_permissions").'',  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create')) }}

<section class="panel panel-default">
                <header class="panel-heading">
                  Responsive Table
                </header>
                <div class="row wrapper">


                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>

                        <th> </th>
                        <th colspan="4" style="text-align:center;vertical-align:middle;">Student</th>
                        <th></th>
                        <th width="30"></th>
                      </tr>
                      <tr>

                        <th data-toggle="class">Group Name</th>
                        <th>Create</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th width="30"></th>
                        <th width="30"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @fore
                      <tr>
                        <td>BQu</td>
                        <td><label class="checkbox m-n i-checks"><input value="students.index" type="checkbox" name="bqu[]"><i></i></label></td>
                        <td><label class="checkbox m-n i-checks"><input value="students.more" type="checkbox" name="bqu[]"><i></i></label></td>
                        <td><label class="checkbox m-n i-checks"><input value="students.create" type="checkbox" name="post[]"><i></i></label></td>
                        <td><label class="checkbox m-n i-checks"><input value="students.verify" type="checkbox" name="post[]"><i></i></label></td>
                        <td></td>
                        <td></td>

                      </tr>

                    </tbody>
                  </table>
                </div>
                <footer class="panel-footer">
                  <div class="row">


                  </div>
                </footer>
              </section>
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


 {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}
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