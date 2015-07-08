<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>  
  <meta charset="utf-8" />
  <title>Scale | Web Application</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	{{ HTML::style('css/bootstrap.css'); }}  
	{{ HTML::style('css/animate.css'); }}  
	{{ HTML::style('css/font-awesome.min.css'); }}  
	{{ HTML::style('css/icon.css'); }}  
	{{ HTML::style('css/font.css'); }}  
	{{ HTML::style('css/app.css'); }}  
    <!--[if lt IE 9]>
   {{ HTML::script('js/ie/html5shiv.js'); }}
   {{ HTML::script('js/ie/respond.min.js'); }}
   {{ HTML::script('js/ie/excanvas.js'); }}
  <![endif]-->
</head>
<body class="">
    <section id="content">
    <div class="row m-n">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
          <h1 class="h text-white animated fadeInDownBig">404</h1>
        </div>
        <div class="list-group bg-info auto m-b-sm m-b-lg">
          <a href="{{ URL::to('/') }}" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-home icon-muted"></i> Goto homepage
          </a>
          <a href="mailto:damith.harischandrathilaka@bquintelligence.com" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip
          </a>
          <a href="#" class="list-group-item">
            <i class="fa fa-chevron-right icon-muted"></i>
            <span class="badge bg-info lt">+9411 2 585660</span>
            <i class="fa fa-fw fa-phone icon-muted"></i> Call us
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>BQu Services (Pvt) Ltd<br>&copy; {{ date('Y') }}</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
   {{ HTML::script('js/jquery.min.js'); }}
  <!-- Bootstrap -->
   {{ HTML::script('js/bootstrap.js'); }}
  <!-- App -->
	 {{ HTML::script('js/app.js'); }}
	 {{ HTML::script('js/slimscroll/jquery.slimscroll.min.js'); }}
	 {{ HTML::script('js/app.plugin.js'); }}
</body>
</html>