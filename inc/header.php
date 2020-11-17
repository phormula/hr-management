<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Session.php";
Session::init();



spl_autoload_register(function($classes){

  include 'classes/'.$classes.".php";

});


$users = new Users();


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee Dashboard - Piccadilly Biscuits Ltd.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/skin-orange.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php //include "idle.php"; ?>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
  
  <?php
  
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  // Session::set('logout', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  // <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  // <strong>Success !</strong> You are Logged Out Successfully !</div>');
  Session::destroy();
}
?>
    <!-- Site wrapper -->
    <div class="wrapper">
<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>PB</b>L</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Piccadilly Biscuits </b>Ltd</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
             
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="images/avatar.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php
$username = Session::get('username');
if (isset($username)) {
  echo $username;
}
 ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
				  <div id="shop">
						<div class="contentimg">
							<img src="images/avatar.jpg" class="img-circle" alt="User Image">
							<a href="#" title="Edit" id="edituser"><i class=" fa fa-edit"></i></a>
						</div>
					</div>
                    
                    <p>
                      <?php $username = Session::get('username');
if (isset($username)) {
  echo $username;
}?>
                      <small>User since </small>
                    </p>
                  </li>
                  <!-- Menu Body -->
				  <?php 
if (Session::get('id') == TRUE) {
 if (Session::get('roleid') == '1') { 
/*******************************END**************************/
?>
                  <li class="user-body">
                    <div class="col-xs-12 btn btn-default text-center">
                      <a href="admin.php">Admin Panel</a>
                    </div>
                  </li>
				  <?php } }?>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php?id=<?php echo Session::get("id"); ?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="?action=logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
