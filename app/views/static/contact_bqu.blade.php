@extends('layouts.main')


@section('content')

<?php

$user = Sentry::getUser();

$user_groups =$user->getGroups();
$user_group = '';

foreach($user_groups as $group)
{
     $user_group =  $user_group .', '.$group->name;
}
$user_group = rtrim($user_group, ",");
?>

<div class="row">
<div class="col-lg-12">
                  <!-- .comment-list -->
                  <section class="comment-list block">
                        <!-- comment form -->
                                      <article class="comment-item media" id="comment-form">
                                        <a class="pull-left thumb-sm avatar">{{ HTML::image('images/a6.png', '', array('class' => 'img-circle')) }}</a>
                                        <section class="media-body">
                                          {{ Form::open(array('url' =>URL::to("contact-bqu"),  'class'=>'m-b-none','method' => 'post','id'=>'contact_bqu_create')) }}
                                            <div class="input-group">
                                              {{ Form::text('comment','',['placeholder'=>'Input your comment here','class'=>'form-control']); }}
                                              <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">POST</button>
                                              </span>
                                            </div>
                                         {{ Form::close() }}
                                        </section>
                                      </article>
                                      <br>
@foreach($comments as $comment)
@if($comment->created_by == Sentry::getUser()->id)
                    <article id="comment-id-3" class="comment-item">
                      <a class="pull-left thumb-sm avatar">{{ HTML::image('images/a9.png', '', array('class' => 'img-circle')) }}</a>
                      <span class="arrow left"></span>
                      <section class="comment-body panel panel-default">
                        <header class="panel-heading">
                          <a href="#">{{ Sentry::getUser()->first_name }}&nbsp;&nbsp;{{ Sentry::getUser()->last_name }}</a>
                          <label class="label bg-success m-l-xs">{{ $user_group }}</label>
                          <span class="text-muted m-l-sm pull-right">
                            <i class="fa fa-clock-o"></i>
                            {{ Carbon::now()->subMinutes((round(strtotime(Carbon::now()->toDateTimeString()/60)*60)) - (round(strtotime('2015-07-06 13:18:33')/60)*60))->diffForHumans() }}
                          </span>
                        </header>
                        <div class="panel-body">
                          <div>{{ $comment->message }}</div>
                          <div class="comment-action m-t-sm">
                            <a href="#comment-id-3" data-dismiss="alert" class="btn btn-default btn-xs">
                              <i class="fa fa-trash-o text-muted"></i>
                              Remove
                            </a>
                          </div>
                        </div>
                      </section>
                    </article>
@endif
@if($comment->created_by == 1)
                    <article id="comment-id-4" class="comment-item">
                      <a class="pull-left thumb-sm avatar">{{ HTML::image('images/a5.png', '', array('class' => 'img-circle')) }}</a>
                      <span class="arrow left"></span>
                      <section class="comment-body panel panel-default">
                        <header class="panel-heading">
                          <a href="#">Super Administrator</a>
                          <label class="label bg-primary m-l-xs">Super Administrator</label>
                          <span class="text-muted m-l-sm pull-right">
                            <i class="fa fa-clock-o"></i>
                            {{ Carbon::now()->subMinutes(2)->diffForHumans() }}
                          </span>
                        </header>
                        <div class="panel-body">
                          <div>{{ $comment->message }}</div>
                          <div class="comment-action m-t-sm">
                            <a href="#" data-toggle="class" class="btn btn-default btn-xs">
                              <i class="fa fa-star-o text-muted text"></i>
                              <i class="fa fa-star text-danger text-active"></i>
                              Like
                            </a>
                            <a href="#comment-form" class="btn btn-default btn-xs"><i class="fa fa-mail-reply text-muted"></i> Reply</a>
                          </div>
                        </div>
                      </section>
                    </article>
                    @endif
@endforeach
                  </section>
                  <!-- / .comment-list -->
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