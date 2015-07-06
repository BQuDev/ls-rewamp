<!DOCTYPE html>
<html lang="en" class="app bg-light">
<head>  
  <meta charset="utf-8" />
  <title>LS Student Administration @section('title') @show</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
{{ HTML::style('css/bootstrap.css'); }}
{{ HTML::style('css/animate.css'); }}
{{ HTML::style('css/font-awesome.min.css'); }}
{{ HTML::style('css/icon.css'); }}
{{ HTML::style('css/font.css'); }}
{{ HTML::style('css/app.css'); }}
{{ HTML::style('pnotify/pnotify.core.min.css'); }}
{{ HTML::style('pnotify/pnotify.buttons.min.css'); }}
@section('post_css')
@show

    <!--[if lt IE 9]>
{{ HTML::script('js/ie/html5shiv.js'); }}
{{ HTML::script('js/ie/respond.min.js'); }}
{{ HTML::script('js/ie/excanvas.js'); }}
  <![endif]-->
</head>
<body class="">
    <section class="hbox stretch">
    <!-- .aside -->
        <aside class="bg-black aside-md hidden-print" id="nav">
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!--<span class="thumb avatar pull-left m-r">
                        <img src="{{ URL::to('/').'/images/a0.png' }}"  alt="">

                        <i class="on md b-black"></i>
                      </span>-->
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">{{ Sentry::getUser()->first_name }}&nbsp;&nbsp;{{ Sentry::getUser()->last_name }} </strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block"><?php



                        $user = Sentry::getUser()->getGroups();

                        foreach($user as $group)
                        {
                             echo $group->name;
                        }
                        ?>
                        </span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      <li>
                        <a href="{{ URL::to('/').'/help' }}">Help</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="{{ URL::to('/').'/logout' }}"  >Logout</a>
                      </li>
                    </ul>
                  </div>
                </div>


                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Main menu</div>
                  <ul class="nav nav-main" data-ride="collapse">

                  <li <?php if(Request::segment(1) == "students") echo 'class="active"'; ?>>
                                        <a href="#" class="auto">
                                          <span class="pull-right text-muted">
                                            <i class="i i-circle-sm-o text"></i>
                                            <i class="i i-circle-sm text-active"></i>
                                          </span>
                                          <i class="i i-lab icon">
                                          </i>
                                          <span class="font-bold">Applications</span>
                                        </a>
                                        <ul class="nav dk">
                                            <?php if (Sentry::getUser()->hasAccess('students.index')){  ?>
                                                            <li>
                                                             <a href="{{ URL::to('/students') }}/">
                                                               <i class="i i-docs icon">
                                                               </i>
                                                               <span class="font-bold">All Applications</span>
                                                             </a>
                                                           </li>
                                                           <?php } ?>
                                               <?php if (Sentry::getUser()->hasAccess('students.create')){  ?>
                                                                            <li >
                                                                         <a href="{{ URL::to('/students/create') }}/">

                                                                            <i class="i i-file2 icon">
                                                                            </i>
                                                                            <span class="font-bold">Add New Application</span>
                                                                          </a>

                                                                        </li>
                                          <?php } ?>
                                         <?php if (Sentry::getUser()->hasAccess('students.validate')){  ?>
                                         <li >
                                                   <a href="{{ URL::to('students/validate') }}">

                                                      <i class="i  i-checked icon">
                                                      </i>
                                                      <span class="font-bold">Validate Admissions</span>
                                                    </a>

                                                  </li>
                                                   <?php } ?>
                                                   <?php if (Sentry::getUser()->hasAccess('students.verify')){  ?>
                                                                                            <li >
                                                                                                      <a href="{{ URL::to('students/verify') }}">

                                                                                                         <i class="i  i-phone2 icon">
                                                                                                         </i>
                                                                                                         <span class="font-bold">Verify Admissions</span>
                                                                                                       </a>

                                                                                                     </li>
                                                                                                      <?php } ?>
                                      <?php if (Sentry::getUser()->hasAccess('students.verify')){  ?>
                                                     <li >
                                                               <a href="{{ URL::to('students/verify') }}">

                                                                  <i class="fa fa-edit icon">
                                                                  </i>
                                                                  <span class="font-bold">Amendments</span>
                                                                </a>

                                                              </li>
                                                               <?php } ?>
                                                   <?php if (Sentry::getUser()->hasAccess('students.export')){  ?>
                      <li >
                                                                   <a href="{{ URL::to('/export') }}/">

                                                                      <i class="i i-file-excel icon">
                                                                      </i>
                                                                      <span class="font-bold">Export</span>
                                                                    </a>

                                                                  </li>
                                                                   <?php } ?>


                                          </ul></li>
                                          <li <?php if(Request::segment(1) == "modules") echo 'class="active"'; ?>>
                                                                                  <a href="#" class="auto">
                                                                                    <span class="pull-right text-muted">
                                                                                      <i class="i i-circle-sm-o text"></i>
                                                                                      <i class="i i-circle-sm text-active"></i>
                                                                                    </span>
                                                                                    <i class="i i-lab icon">
                                                                                    </i>
                                                                                    <span class="font-bold">Modules</span>
                                                                                  </a>


<ul class="nav dk">
                                            <?php /*if (Sentry::getUser()->hasAccess('modules.index')){  ?>
                                                            <li>
                                                             <a href="{{ URL::to('/modules') }}/">
                                                               <i class="i i-docs icon">
                                                               </i>
                                                               <span class="font-bold">All Modules</span>
                                                             </a>
                                                           </li>
                                                           <?php } */ ?>
                                               <?php if (Sentry::getUser()->hasAccess('modules.index_marks_input')){  ?>
                                                                            <li >
                                                                         <a href="{{ URL::to('/modules/marks-input') }}/">

                                                                            <i class="i i-pencil2 icon">
                                                                            </i>
                                                                            <span class="font-bold">Marks Input</span>
                                                                          </a>

                                                                        </li>
                                          <?php } ?>






                                          </ul>




<!--<li style="position: absolute; bottom: 5px;width: 100%">
                      <a href="{{ URL::to('/contact-bqu') }}/">
                        <i class="i i-circle-sm text-danger-dk"></i>
                        <span>Contact BQu</span>
                      </a>
                    </li>-->

                    @section('main_menu')
                    @show
                   </ul>
                  <div class="line dk hidden-nav-xs"></div>
                  <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm"></div>
                  <ul class="nav">
                    @section('sub_menu')
                    @show
                  </ul>
                  <div class="text-muted text-xs hidden-nav-xs padder m-t-sm m-b-sm"></div>
                  <ul class="nav">

                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>

            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="{{ URL::to('/').'/logout' }}"  class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
    <!-- /.aside -->
    <section id="content">
      <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable wrapper">  
                  
				  
                  @yield('content')
                </section>
              </section>
            </section>
            <aside class="aside-md">
              <section class="vbox">
                
                <section class="scrollable wrapper-md bg-light dker">
                               
                </section>
              </section>
            </aside>
          </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
  </section>
   {{ HTML::script('js/jquery.min.js'); }}
   {{ HTML::script('js/chosen/chosen.jquery.min.js'); }}

  <!-- Bootstrap -->
  {{ HTML::script('js/bootstrap.js'); }}
  {{ HTML::script('js/app.plugin.js'); }}
  <!-- App -->

    {{ HTML::script('js/app.js'); }}
    {{ HTML::script('js/slimscroll/jquery.slimscroll.min.js'); }}
    {{ HTML::script('js/app.plugin.js'); }}

    {{ HTML::script('pnotify/pnotify.core.min.js'); }}
    {{ HTML::script('pnotify/pnotify.buttons.min.js'); }}
	
<!-- Notification -->
<script type="text/javascript">
var stack_bottomright = {"dir1": "down", "dir2": "left"};
</script>
@if (Notify::all())
    <div class="container1">
        @foreach (Notify::get('success') as $alert)
            <script type="text/javascript">
                $(function(){
                    new PNotify({
                        title: '{{ $alert }}',
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
                    });
                });
            </script>
        @endforeach

        @foreach (Notify::get('error') as $alert)
            <script type="text/javascript">
                            $(function(){
                                new PNotify({
                                    title: '{{ $alert }}',
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
                            });
                        </script>
        @endforeach

        @foreach (Notify::get('info') as $alert)
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $alert }}
            </div>
        @endforeach

        @foreach (Notify::get('warning') as $alert)
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $alert }}
            </div>
        @endforeach
    </div>
@endif

<?php Session::forget('notify_messages'); ?>
    @section('post_js')
    @show
</body>
</html>