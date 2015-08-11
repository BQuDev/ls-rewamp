<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>LS Student Administration</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/icon.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />  
  <link rel="stylesheet" href="../pnotify/pnotify.core.min.css" type="text/css" />  
  <link rel="stylesheet" href="../pnotify/pnotify.buttons.min.css" type="text/css" /> 
<style>  
.bg-black {
    background-color: #000;
    color: #656b93;
}
</style>  
    <!--[if lt IE 9]>
    <script src="../js/ie/html5shiv.js"></script>
    <script src="../js/ie/respond.min.js"></script>
    <script src="../js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a target="_blank"  href="/" class="navbar-brand">
          <img src="https://lsadmin.net/images/logo.png" class="m-r-sm" alt="lsadmin.net">
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav hidden-xs">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="i i-grid"></i>
          </a>
          <section class="dropdown-menu aside-lg bg-white on animated fadeInLeft">
            <div class="row m-l-none m-r-none m-t m-b text-center">
            </div>
          </section>
        </li>
      </ul>
      <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-sm bg-white b-white btn-icon"><i class="fa fa-search"></i></button>
            </span>
            <input type="text" class="form-control input-sm no-border" placeholder="Search apps, projects...">            
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            
           <?php  echo Sentry::getUser()->first_name; ?> &nbsp;&nbsp; <?php  echo Sentry::getUser()->last_name ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">            
           <li class="dropdown">
          
              <a href="docs.html">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a target="_blank"  href="/logout" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
        </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     
                       
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">  <?php  echo Sentry::getUser()->first_name; ?> &nbsp;&nbsp; <?php  echo Sentry::getUser()->last_name ?> </strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block"></span>
                      </span>
                    </a>
                            <ul class="dropdown-menu animated fadeInRight">

            <li>
              <a href="docs.html">Help</a>
            </li>
            <li class="divider"></li>
            <li>
              <a target="_blank"  href="/logout" data-toggle="ajaxModal" >Logout</a>
            </li>
          </ul>
                  </div>
                </div>                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div>
				   <ul class="nav nav-main" data-ride="collapse">
                  <?php if (Sentry::getUser()->hasAccess('students.index')){  ?>
                   <li>
                    <a target="_blank"  href="/students">
                      <i class="i i-docs icon">
                      </i>
                      <span class="font-bold">Home</span>
                    </a>
                  </li>
                  <?php } ?>
                           
                    
					<li class="active">
    <a href="#" class="auto">
        <span class="pull-right text-muted">
                        </span>
        <i class="i i-docs icon">
                        </i>
        <span class="font-bold">Marks Input</span>
    </a>
    <ul class="nav dk">
        <li class="active">
            <a href="#" class="auto">
                <span class="pull-right text-muted">
                        </span>
                </i>
                <span class="font-bold">BA Marketing</span>
            </a>
            <ul class="nav dk">
                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">International Marketing</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-IM-A-02">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>
                        <li>
                            <a target="_blank"  href="/student-marks-IM-A-02">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 2</span>
                            </a>

                        </li>





                    </ul>
                </li>
                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Marketing Consultancy</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-MC-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>
                        <li>
                            <a target="_blank"  href="/student-marks-MC-A-02">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 2</span>
                            </a>

                        </li>





                    </ul>
                </li>


                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Organisational Change Management</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-OCM-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Retail Marketing</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-RM-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>

                    </ul>
                </li>


                <li class="active">
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Strategic Management Analysis</span>
                    </a>
                    <ul class="nav dk">

                        <li class="active">
                            <a target="_blank"  href="/student-marks-SMA-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Sustainable Management Futures</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-SMF-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Undergraduate Major Project</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-UGMP-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>

                    </ul>
                </li>


            </ul>
        </li>
        <li>
            <a href="#" class="auto">
                <span class="pull-right text-muted">
                        </span>
                </i>
                <span class="font-bold">MA</span>
            </a>
            <ul class="nav dk">
                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Marketing Design and Innovation</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-MDI-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>


                    </ul>
                </li>
                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Postgraduate Major Project</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-PMP_MA-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>


                    </ul>
                </li>

                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Research Methods for Business and Management</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-RMBM_MA-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>
                        <li>
                            <a target="_blank"  href="/student-marks-RMBM_MA-A-02">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 2</span>
                            </a>

                        </li>


                    </ul>
                </li>





            </ul>
        </li>
        <li>
            <a href="#" class="auto">
                <span class="pull-right text-muted">
                        </span>
                </i>
                <span class="font-bold">MBA</span>
            </a>
            <ul class="nav dk">

                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Marketing Design and Innovation</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-MDI_mba-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>


                    </ul>
                </li>


                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Postgraduate Major Project</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-PMP_MBA-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>


                    </ul>
                </li>



                <li>
                    <a href="#" class="auto">
                        <span class="pull-right text-muted">
                        </span>
                        </i>
                        <span class="font-bold">Research Methods for Business and Management</span>
                    </a>
                    <ul class="nav dk">

                        <li>
                            <a target="_blank"  href="/student-marks-RMBM_MBA-A-01">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 1</span>
                            </a>

                        </li>
                        <li>
                            <a target="_blank"  href="/student-marks-RMBM_MBA-A-02">

                                <i class="i i-dot"></i>
                                <span class="font-bold">Element 2</span>
                            </a>

                        </li>


                    </ul>
                </li>




            </ul>
        </li>


    </ul>
</li>
</ul>

<div class="line dk hidden-nav-xs"></div>
                  
                  <div class="line dk hidden-nav-xs"></div>
               
                  
               
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
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
          <section class="vbox">          



    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-touch.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular-animate.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/csv.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/pdfmake.js"></script>
    <script src="http://ui-grid.info/docs/grunt-scripts/vfs_fonts.js"></script>
    <script src="../js/angular/ui-grid-unstable.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/angular/ui-grid-unstable.min.css">
    <link rel="stylesheet" type="text/css" href="../js/angular/a.css">

    <style>

        .grid {
            width: 100%;
            height:458px;
        }
		
		.checkbox {
     margin-top: 5px; 
     margin-bottom: 0px; 
}

.checkbox + .checkbox  {
    margin-top: 5px;
}
    </style>


<div ng-app="app">
<div ng-controller="MainCtrl">

<br>

<div class="row">

<div class="col-sm-12">
                <div class="form-group">
                          <div class="col-lg-7">
                            <div class="checkbox i-checks">
	  <label>
		<input id="auto_refresh" type="checkbox"><i></i> Auto calculate when all the marks are inserted to the student.
	  </label>
	</div>
                          </div>
						  <div class="col-sm-5">	
						  <div style="float:right">	
     <button id="saveButton" type="button" class="btn btn-success" onclick="dummysave()">Save All</button>	&nbsp;&nbsp;&nbsp;&nbsp;<button id="refreshButton" type="button" class="btn btn-primary" ng-click="refreshData()">Calculate marks</button>	&nbsp;&nbsp;&nbsp;&nbsp;<button id="excel_export" type="button" class="btn btn-primary" ng-click="excel_export()">Excel Export ( All data )</button>
</div>&nbsp;&nbsp;
</div>
						  
                        </div>
                </div>

</div>

<div class="form-group">
  <div class="col-lg-offset-2 col-lg-10">
	
  </div>
</div>


	<!--<strong>Calls Pending:</strong> <span ng-bind="callsPending"></span>
    
	<br>
    <br>
    <strong>Data Length:</strong> {{ gridOptions.data.length | number }}
    <br>
    <strong>Last Cell Edited:</strong> {{msg.lastCellEdited}}
    <br>-->
    <div ui-grid="gridOptions" ui-grid-edit ui-grid-cellnav class="grid"></div>
    <!--<br>
    <div><strong>Last file uploaded:</strong></div>
    <div>{{lastFile}}</div>-->
</div>
</div>

         
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../js/app.plugin.js"></script>
    <script src="../pnotify/pnotify.core.min.js"></script>
    <script src="../pnotify/pnotify.buttons.min.js"></script>
	    <script src="../js/angular/ba/sma/e01.js"></script>
		
</body>
</html>
