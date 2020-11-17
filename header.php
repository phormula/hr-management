<?php
/* include '../login/dbc.php';
page_protect(); */

$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === 
FALSE ? 'http' : 'https';            // Get protocol HTTP/HTTPS
$host     = $_SERVER['HTTP_HOST'];   // Get  www.domain.com
$script   = $_SERVER['SCRIPT_NAME']; // Get folder/file.php
$params   = $_SERVER['QUERY_STRING'];// Get Parameters occupation=odesk&name=ashik

$currentUrl = $protocol . '://' . $host . $script ; // Adding all


$pos = strrpos($currentUrl,"/");
$url = substr_replace($currentUrl,"",$pos)."/" ;

$url_q = "SELECT * FROM `base_url` WHERE `id`=1";

$url_results = mysqli_query ($conn ,$url_q ) or die ('request "Could not execute SQL query" '.$url_q);

$burl = mysqli_fetch_assoc($url_results);

	//$burl = $row2["url"];

define("BASE_URL", $burl["url"]);

?>
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
                  <img src="<?php echo constant("BASE_URL"); ?>images/avatar.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['user_name'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
				  <div id="shop">
						<div class="contentimg">
							<img src="<?php echo constant("BASE_URL"); ?>images/avatar.jpg" class="img-circle" alt="User Image">
							<a href="#" title="Edit" id="edituser"><i class=" fa fa-edit"></i></a>
						</div>
					</div>
                    
                    <p>
                      <?php echo $_SESSION['user_name'];?>
                      <small>User since <?php echo date('F, Y', strtotime($_SESSION['date'])); ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
				  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo $protocol . '://' . $host; ?>/login/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>