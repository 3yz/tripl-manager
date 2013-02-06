<!DOCTYPE html>
<html lang="en">
  <head>
    
    <!-- start: Meta -->
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta name="author" content="3yz">
    <!-- end: Meta -->
    
    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->
    
    <!-- start: CSS -->
    <link id="bootstrap-style" href="<?php echo URL::base(TRUE) ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL::base(TRUE) ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link id="base-style" href="<?php echo URL::base(TRUE) ?>assets/css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="<?php echo URL::base(TRUE) ?>assets/css/style-responsive.css" rel="stylesheet">
    <base href="<?php echo URL::base(TRUE) ?>" />
    <!-- end: CSS -->

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- <link rel="shortcut icon" href="<?php echo URL::base(TRUE) ?>assets/img/favicon.ico"> -->
  </head>

  <body>
    <div id="overlay">
      <div class="loader">
        <?php echo HTML::image('assets/img/progress2.gif'); ?>
      </div>
    </div>  
    <?php if(Auth::instance()->logged_in(array('manager')) || Auth::instance()->logged_in(array('admin'))): ?>
    <!-- start: Header -->
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php Route::get('manager')->uri() ?>"> 
            <!-- <img alt="Perfectum Dashboard" src="<?php echo URL::base(TRUE) ?>public/manager/img/logo20.png" />  -->
            <span class="hidden-phone">Manager</span>
          </a>
                  
          <?php if(Auth::instance()->logged_in(array('manager')) || Auth::instance()->logged_in(array('admin'))): ?>
          <!-- start: Header Menu -->
          <div class="nav-no-collapse header-nav">
            <ul class="nav pull-right">
              <!-- start: User Dropdown -->
              <li class="dropdown">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="icon-user icon-white"></i>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon-user"></i> Perfil</a></li>
                  <li>
                    <?php echo HTML::anchor('manager/logout', '<i class="icon-off"></i> Sair') ?>
                  </li>
                </ul>
              </li>
              <!-- end: User Dropdown -->
            </ul>
          </div>
          <!-- end: Header Menu -->
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- start: Header -->
    <?php endif; ?>
  
    
    <div class="container-fluid">
      <?php if(Auth::instance()->logged_in(array('manager')) || Auth::instance()->logged_in(array('admin'))): ?>
      <div class="row-fluid">        
        <!-- start: Main Menu -->
        <div class="span2 main-menu-span">
          <div class="nav-collapse sidebar-nav">
            <?php echo View::factory('manager/templates/_menu'); ?>            
          </div><!--/.well -->
        </div><!--/span-->
        <!-- end: Main Menu -->        

        <!-- start: Content -->
        <div id="content" class="span10">
          <?php echo $content ?>
        </div><!--/#content.span10-->
        <hr>
      </div><!--/fluid-row-->
        
      <div class="modal hide fade" id="delete-modal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h3>Remover Usuário</h3>
        </div>
        <div class="modal-body">
          <p>Deseja realmente remover esse usuário?</p>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">Fechar</a>
          <a href="" id="confirm-link" class="btn btn-danger">Confirmar</a>
        </div>
      </div>
    
      <div class="clearfix"></div>
    
      <footer>
        <p>
          <span style="text-align:left;float:right">&copy; <a href="http://3yz.com" target="_blank">3yz</a> - <?php echo date('Y') ?></span>
        </p>
      </footer>
      <?php else: ?>
      <div class="row-fluid">
        <div class="row-fluid">
          <style type="text/css">
            body { background: url(<?php echo URL::base(true); ?>/assets/img/bg-login-3yz.jpg) !important; }
          </style>
          <?php echo $content ?>
        </div>
      </div>
      <?php endif; ?>
    </div><!--/.fluid-container-->

    <!-- start: JavaScript-->
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/bootstrap.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.cookie.js"></script>
    <script src='<?php echo URL::base(TRUE) ?>assets/js/fullcalendar.min.js'></script>
    <script src='<?php echo URL::base(TRUE) ?>assets/js/jquery.dataTables.min.js'></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/excanvas.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.flot.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.flot.pie.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.flot.stack.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.flot.resize.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.chosen.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.uniform.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/tiny_mce/jquery.tinymce.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.noty.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.elfinder.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.raty.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.iphone.toggle.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.uploadify-3.1.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.gritter.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.imagesloaded.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.masonry.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.knob.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/jquery.sparkline.min.js"></script>
    <script src="<?php echo URL::base(TRUE) ?>assets/js/custom.js"></script>
    <!-- end: JavaScript-->
    
  </body>
</html>
