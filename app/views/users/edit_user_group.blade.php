@extends('layouts.main')


@section('content')
<?php
    $permissions = DB::table('groups')->where('name','=',urldecode(Request::segment(4)))->get();
?>
{{ Form::open(array('url' =>URL::to("/settings/user-management/user-groups/update_permissions"),  'class'=>'form-horizontal','method' => 'post','data-validate'=>'parsley','id'=>'student_create')) }}
          <div class="row">
            <div class="col-sm-6 portlet">
              <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                  <ul class="nav nav-pills pull-right">
                    <li>
                      <a href="#" class="panel-toggle text-muted"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a>
                    </li>
                  </ul>
                  <h4>Students</h4>
                </header>
                <section class="panel-body">
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                             <input type="checkbox" value="students.index" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students Main View <small> &nbsp;&nbsp;<span class="label label-success">Normal</span></small></a>
                      <small class="block m-t-xs">User can view all the students in a table. But cannot see more details with this permission.</small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.show" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students More Details<small>&nbsp;&nbsp; <span class="label label-success">Normal</span></small></a>
                      <small class="block m-t-xs">User can view all the details of the student.</small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.validate" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students Validate<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                      <small class="block m-t-xs">User can edit application data of the student. Does <span class="text-danger">NOT</span> send mail to LS to verify data. For <span class="text-danger">BQu USE ONLY</span> </small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.verify" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students Verify<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                      <small class="block m-t-xs">User van verify required data of students.Does <span class="text-danger">NOT</span> send mail to LS to verify data. For <span class="text-danger">BQu USE ONLY</span>  </small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.amendments" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students Amendments<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                      <small class="block m-t-xs">User can view all the details of the student and also user can update student data.</small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.create" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Students Adding<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                      <small class="block m-t-xs">User can view add any nmber of students .<span class="text-danger">( SAN REQUIRED )</span> </small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="students.reject" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Student Rejection<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                      <small class="block m-t-xs">User can reject/remove students from the system. <span class="text-danger">DATA WILL BE NOT DELETED</span> </small>
                    </div>
                  </article>
                </section>
              </section>
            </div>
            <div class="col-sm-6 portlet">
              <section class="panel panel-default portlet-item">
                <header class="panel-heading">
                   <h4>Data Export</h4>
                </header>
                <section class="panel-body">

                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="export.mastersheet" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">BQu Master Sheet<small>&nbsp;&nbsp; <span class="label label-success">Normal</span></small></a>
                      <small class="block m-t-xs"> Contain all student application data.  </small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>
                  <article class="media">
                    <div class="pull-left">
                      <span class="fa-stack fa-lg">
                        <div class="checkbox i-checks">
                          <label>
                         <input type="checkbox" value="export.marksheet" name="permissions[]">
                          <i></i>
                          </label>
                       </div>
                      </span>
                    </div>
                    <div class="media-body">
                      <a href="#" class="h4">Mark Input Sheet<small>&nbsp;&nbsp; <span class="label label-success">Normal</span></small></a>
                      <small class="block m-t-xs">Includes students all marks and course data.</small>
                    </div>
                  </article>
                  <div class="line pull-in"></div>

                </section>
              </section>
                            <section class="panel panel-default portlet-item">
                              <header class="panel-heading">
                                 <h4>Modules</h4>
                              </header>
                              <section class="panel-body">

                                <article class="media">
                                  <div class="pull-left">
                                    <span class="fa-stack fa-lg">
                                      <div class="checkbox i-checks">
                                        <label>
                                       <input type="checkbox" value="modules.supervisor_allocation" name="permissions[]">
                                        <i></i>
                                        </label>
                                     </div>
                                    </span>
                                  </div>
                                  <div class="media-body">
                                    <a href="#" class="h4">Supervisor Allocation<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                                    <small class="block m-t-xs"> Contain all student application data.  </small>
                                  </div>
                                </article>
                                <div class="line pull-in"></div>
                                <article class="media">
                                  <div class="pull-left">
                                    <span class="fa-stack fa-lg">
                                      <div class="checkbox i-checks">
                                        <label>
                                       <input type="checkbox" value="modules.marker_allocation" name="permissions[]">
                                        <i></i>
                                        </label>
                                     </div>
                                    </span>
                                  </div>
                                  <div class="media-body">
                                    <a href="#" class="h4">Marker Allocation<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                                    <small class="block m-t-xs">Includes students all marks and course data.</small>
                                  </div>
                                </article>
                                <div class="line pull-in"></div>
                                <article class="media">
                                  <div class="pull-left">
                                    <span class="fa-stack fa-lg">
                                      <div class="checkbox i-checks">
                                        <label>
                                       <input type="checkbox" value="modules.marks_input" name="permissions[]">
                                        <i></i>
                                        </label>
                                     </div>
                                    </span>
                                  </div>
                                  <div class="media-body">
                                    <a href="#" class="h4">Marks Input<small>&nbsp;&nbsp; <span class="label label-warning">Warning</span></small></a>
                                    <small class="block m-t-xs">Includes students all marks and course data.</small>
                                  </div>
                                </article>
                              </section>
                            </section>
            </div>
          </div>
<div id="row">
 <div class="line line-dashed b-b line-lg pull-in"></div>
                                       <div class="form-group">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-9">
                                             <div class="checkbox i-checks">
                                                <label>
                                               {{ Form::checkbox('confirm_save', '1',false,array('data-required'=>'true')); }}
                                                <i></i>
                                                Confirm Save
                                                </label>
                                             </div>
                                          </div>
                                       </div><br><br>
<div class="line line-dashed b-b line-lg pull-in"></div>
                      <div class="form-group">
                         <label class="col-sm-3 control-label"> </label>
                         <div class="col-sm-9">
                         {{ Form::submit('Save', array('class' => 'btn btn-s-md btn-primary')) }}
                         </div>
                      </div>
</div>

{{ Form::hidden('group_name', Request::segment(4)) }}
{{ Form::close() }}
@stop


 @section('breadcrumb')
   <li><a href="{{ URL::to('/students') }}">Settings</a></li>
   <li><a href="{{ URL::to('/students') }}">User Management</a></li>
   <li><a href="{{ URL::to('/students') }}">User Groups</a></li>
   <li class="active"><a href="{{ URL::to('/students/create') }}">User Group</a></li>
 @stop


@section('post_css')
{{ HTML::style('js/chosen/chosen.css'); }}
@stop

@section('post_js')


 {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}
 {{ HTML::script('js/jquery.ui.touch-punch.min.js'); }}
 {{ HTML::script('js/jquery-ui-1.10.3.custom.min.js'); }}

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
 </div>
  @stop