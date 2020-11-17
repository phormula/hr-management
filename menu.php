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

$hostname = 'localhost';
$username = 'phormula';
$password = '11emaths';
$datab = 'emaleck2';
	$mysqli2 = new mysqli($hostname,$username,$password,$datab);
if ($mysqli2->connect_error) {
    die('Error : ('. $mysqli2->connect_errno .') '. $mysqli2->connect_error);
}

$results2 = $mysqli2->query("SELECT * FROM `base_url` WHERE `id`=1");
$row2 = $results2->fetch_assoc();

$results2->free();
$mysqli2->close();

	$burl = $row2["url"];

define("BASE_URL", $row2["url"]);
?>
<!-- Left side column. contains the sidebar -->
     <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo constant("BASE_URL"); ?>images/avatar.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['user_name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" class="form-control live-search-box" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu live-search-list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview <?php echo $dashboard; ?>">
              <a href="<?php echo constant("BASE_URL"); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
              
            </li>
			<li class="treeview <?php echo $table; ?>">
              <a href="#">
                <i class="fa fa-table"></i>
                <span>Table View</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $all_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/tableview.php"><i class="fa fa-circle-o"></i> All Employees</a></li>
                <li class="<?php echo $leave_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/leave.php"><i class="fa fa-circle-o"></i> Leave</a></li>
                <li class="<?php echo $terminated_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/terminated.php"><i class="fa fa-circle-o"></i> Terminated</a></li>
                <li class="<?php echo $resigned_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/resigned.php"><i class="fa fa-circle-o"></i> Resigned</a></li>
                <li class="<?php echo $retired_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/retired.php"><i class="fa fa-circle-o"></i> Retired</a></li>
                <li class="<?php echo $vacated_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/vacated.php"><i class="fa fa-circle-o"></i> Vacated</a></li>
				<li class="<?php echo $deceased_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/deceased.php"><i class="fa fa-circle-o"></i> Deceased</a></li>
                <li class="<?php echo $casuals_table; ?>">
                  <a href="#"><i class="fa fa-circle-o"></i> Casuals <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li class="<?php echo $all_casuals_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/casual.php"><i class="fa fa-circle-o"></i> All Casuals</a></li>
                    <li class="<?php echo $term_casual_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/term_casual.php"><i class="fa fa-circle-o"></i> Terminated (Casuals)</a></li>
                    <li class="<?php echo $casual_attendance_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/attendance.php"><i class="fa fa-circle-o"></i> Atendance Register</a></li>
                  </ul>
                </li>
                <li class="<?php echo $expired_contract_table; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/table/expired.php"><i class="fa fa-circle-o"></i> Expired Contracts</a></li>
              </ul>
            </li>
			<li class="treeview <?php echo $profile; ?>">
              <a href="#">
                <i class="fa fa-picture-o"></i>
                <span>Profile View</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $all_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/profileview.php"><i class="fa fa-circle-o"></i> All Employees</a> <span class="label label-primary pull-right">4</span></li>
                <li class="<?php echo $terminated_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/terminated.php"><i class="fa fa-circle-o"></i> Terminated</a></li>
                <li class="<?php echo $resigned_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/resigned.php"><i class="fa fa-circle-o"></i> Resigned</a></li>
                <li class="<?php echo $retired_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/retired.php"><i class="fa fa-circle-o"></i> Retired</a></li>
                <li class="<?php echo $vacated_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/vacated.php"><i class="fa fa-circle-o"></i> Vacated</a></li>
				<li class="<?php echo $deceased_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/deceased.php"><i class="fa fa-circle-o"></i> Deceased</a></li>
                <li class="<?php echo $casuals_profile; ?>">
                  <a href="#"><i class="fa fa-circle-o"></i> Casuals <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li class="<?php echo $all_casuals_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/casual.php"><i class="fa fa-circle-o"></i> All Casuals</a></li>
                    <li class="<?php echo $term_casual_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/term_casual.php"><i class="fa fa-circle-o"></i> Terminated (Casuals)</a></li>
                  </ul>
                </li>
                <li class="<?php echo $expired_contract_profile; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/profile/expired.php"><i class="fa fa-circle-o"></i> Expired Contracts</a></li>
              </ul>
            </li>
            <li class="<?php echo $profile_detail; ?>">
              <a>
                <i class="glyphicon glyphicon-user"></i> <span>Profile Detail</span> <small class="label pull-right bg-green">view</small>
              </a>
            </li>
			<li class="treeview <?php echo $report; ?>">
              <a href="#">
                <i class="fa  fa-book"></i>
                <span>Report</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $annual_report; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/report/leave.php"><i class="fa fa-circle-o"></i> Annual Leave Report</a></li>
				<li class="<?php echo $maternity_report; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/report/maternity.php"><i class="fa fa-circle-o"></i> Maternity Leave Report</a></li>
				<li class="<?php echo $sick_report; ?>"><a href="<?php echo constant("BASE_URL"); ?>pages/report/sick.php"><i class="fa fa-circle-o"></i> Sick Leave Report</a></li>
              </ul>
            </li>
            <li class="<?php echo $addnew; ?>">
              <a href="<?php echo constant("BASE_URL"); ?>pages/addnew.php" title="Add new employee">
                <i class="glyphicon glyphicon-plus"></i> <span>Add New</span> 
              </a>
            </li>
			<li class="<?php echo $manage; ?>">
              <a href="<?php echo constant("BASE_URL"); ?>manage.php" title="Add new employee">
                <i class="fa fa-wrench"></i> <span>Manage Database</span> 
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>