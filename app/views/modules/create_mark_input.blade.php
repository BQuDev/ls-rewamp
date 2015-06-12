@extends('layouts.main')


@section('content')
<div class="col-sm-12">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Marks-Input</header>
                    <div class="panel-body">
                      <form class="bs-example form-horizontal">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">LS Student Number</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="LS Student Number" class="form-control">

                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Course</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Course" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Module</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Module" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Element</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Element" class="form-control">
                          </div>
                        </div>
                        <div class="line line-dashed b-b line-lg pull-in"></div>
                        <div class="row">
                         <div class="col-lg-6">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Test</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Test" class="form-control">
                          </div>
                        </div>
                        </div> <div class="col-lg-6">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Course</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Course" class="form-control">
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                         <div class="col-lg-6">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Course Remark</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Course Remark" class="form-control">
                          </div>
                        </div>
                        </div> <div class="col-lg-6">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Resit</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Resit" class="form-control">
                          </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                         <div class="col-lg-6">
                        <div class="form-group">
                          <label class="col-lg-2 control-label">Resit Remark</label>
                          <div class="col-lg-10">
                            <input type="test" placeholder="Resit Remark" class="form-control">
                          </div>
                        </div>
                        </div> <div class="col-lg-6">

                        </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-10">
                            <div class="checkbox i-checks">
                              <label>
                                <input type="checkbox"><i></i> Confirm Save
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-sm btn-default" type="submit">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </section>
                </div>
@stop


@section('post_css')

@stop

@section('post_js')

@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li><a href="{{ URL::to('/modules') }}">Modules</a></li>
   <li><a href="{{ URL::to('/modules/marks-input/') }}">Marks - Input</a></li>
   <li class="active"><a href="{{ URL::to('/modules/marks-input/reate') }}">Add Marks</a></li>

 @stop