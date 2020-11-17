<?php
error_reporting(0);
/* include '../../../login/dbc3.php';
page_protect();
include("../../access.php"); */
include("../../connection.php");


if($_REQUEST["year"]){
	$order=" ORDER BY no_of_years desc, employees.rank asc, employees.employee_ID asc";
	$add_years = ", YEAR(NOW())-YEAR(HireDate) AS no_of_years, ABS(month(now()) - month(`HireDate`)) as month, ABS(day(now()) - day(`HireDate`)) as day";
	}

if ($_REQUEST["string"]<>'') {
	$search_string = " AND (FirstName LIKE '%".mysqli_real_escape_string($conn, $_REQUEST["string"])."%' OR LastName LIKE '%".mysqli_real_escape_string($conn, $_REQUEST["string"])."%')";	
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
}
if ($_REQUEST["department"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_city = " AND e.department='".mysqli_real_escape_string($conn, $_REQUEST["department"])."'";	
}

if ($_REQUEST["rank"]<>'') {
	if($_REQUEST["rank"]=="3"){
		$date = "AND contracts.`due_date` > NOW()";}
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_rank = " AND e.rank='".mysqli_real_escape_string($conn, $_REQUEST["rank"])."'";	
}


if ($_REQUEST["section"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_section = " AND e.section='".mysqli_real_escape_string($conn, $_REQUEST["section"])."'";	
}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT * FROM employees".$add_years." WHERE HireDate >= '".mysqli_real_escape_string($conn, $_REQUEST["from"])."' AND HireDate <= '".mysqli_real_escape_string($conn, $_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["from"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT employees.employee_ID, employees.FirstName, employees.LastName, employees.Position, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE HireDate ='".mysqli_real_escape_string($conn, $_REQUEST["from"])."' OR Year(`HireDate`)='".mysqli_real_escape_string($conn, $_REQUEST["from"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT * FROM employees".$add_years." WHERE to_date <= '".mysqli_real_escape_string($conn, $_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if($_REQUEST["retire_yr"] <>''){
	$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE Year(DATE_ADD(`BirthDate`,INTERVAL 60 YEAR))='".mysqli_real_escape_string($conn, $_REQUEST["retire_yr"])."' AND employees.apt_status is null".$search_string.$search_city.$search_section.$search_rank.$order;
	}else {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
		$sql = "SELECT a.`employee_ID`, e.TitleOfCourtesy, e.FirstName, e.Middle_name, e.LastName,a.`starting_date`, a.`leave_type`, a.`designated_leave_days`, a.`num_used`, a.`num_left`, add_workday(a.`starting_date`,(a.`num_used` - 1)) as end_date FROM  employee_leave a  JOIN (SELECT `employee_ID`, MAX(`starting_date`) starting_date FROM employee_leave GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`starting_date`=b.`starting_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` WHERE add_workday(a.`starting_date`,(a.`num_used` - 1))>now()".$search_string.$search_city.$search_section.$search_rank.$date;
}

$sql_result = mysqli_query ($conn ,$sql ) or die ('request "Could not execute SQL query" ');
/*LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID LEFT OUTER JOIN `employee_types` ON employees.rank=employee_types.id */
$table = "active";
$leave_table = "active";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>All Employees on Leave</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- jQuery 2.1.4 --><script>$.noConflict();</script>
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
     <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="../../plugins/select2/select2.full.min.js"></script>
 
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/skin-orange.min.css">
    <link rel="stylesheet" type="text/css" href="../../plugins/datatables/dataTables.bootstrap.css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style type="text/css">
   tr.empp{ cursor:pointer}
   .color-palette {
        height: 35px;
        line-height: 35px;
        text-align: center;
      }
      .color-palette-set {
        margin-bottom: 15px;
      }
      .color-palette span {
        display: none;
        font-size: 12px;
      }
      .color-palette:hover span {
        display: block;
      }
      .color-palette-box h4 {
        position: absolute;
        top: 100%;
        left: 25px;
        margin-top: -40px;
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        display: block;
        z-index: 7;
      }
	  .disabl {
    opacity: .65;
    filter: alpha(opacity=65);
}
   </style> 
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <?php include("idle.php"); ?>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("../../header.php"); ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
     <?php include("../../menu.php"); ?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Employees on Leave
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Table View</a></li>
            <li class="active">Leave</li>
          </ol>
        </section>

        <!-- Main content -->
         <section class="content">
          <div class="row">
            <div class="col-xs-12">
           <!-- /.box -->

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">All Employees on Leave</h3><br><br>
<button class="btn btn-info pull-left bg-aqua" data-toggle="control-sidebar"><i class="fa fa-search"></i> Advance Filter</button><button class="btn btn-default pull-left" style="margin-left:15px" id="refresh"><i class="fa fa-refresh"></i> Refresh Page</button>
<script type="text/javascript">
  $('#refresh').click(function() {
   window.location = window.location.href;
});</script>
                </div><!-- /.box-header -->
               
                <div class="box-body table-responsive" id="tablev">

                  <table id="example1" class="table table-bordered table-hover" width="100%">
                   <thead>
  <tr class="bg-black disabled">
  <th>Name</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>Report Date</th>
  <td>Leave Type</td>
  <th>Entitlements (Days)</th>
  <th>Taken (Days)</th>
  <th>Balance (Days)</th> 
  </tr>
  </thead><tbody>
<?php while ($row = mysqli_fetch_array($sql_result)) {
	if($row["leave_type"]==1){$repDate = date("Y-m-d", strtotime($row["end_date"]. ' + 3 weekdays'));}elseif($row["leave_type"]==3){ 
	$repDate = date("Y-m-d", strtotime($row["starting_date"]. ' + '.$row["num_used"].' days'));}elseif($row["leave_type"]==4){ 
	$repDate = date("Y-m-d", strtotime($row["starting_date"]. ' + '.$row["num_used"].' days'));}
	else{
	$repDate = date("Y-m-d", strtotime($row["end_date"]. ' + 1 weekdays'));}
	?>

  <tr data-href="../../profile_detail.php?id=<?php echo $row["employee_ID"]; ?>" class="empp <?php $date1 = new DateTime();$date2 = new DateTime($repDate);$interval = $date1->diff($date2);if(($interval->days +2)<= 5){echo "bg-red disabl color-palette ";}else{echo "bg-green color-palette";} ?>">
    <td><?php echo "".$row["TitleOfCourtesy"]." ".$row["FirstName"]." ".$row["Middle_name"]." ".$row["LastName"]; ?></td>
    <td><?php echo date(" jS F\, Y ", strtotime($row["starting_date"])); ?></td>
    <td><?php
		$sqlholi = "SELECT * FROM `holidays`";

		$sql_resultholi = mysqli_query ($conn ,$sqlholi ) or die ('request "Could not execute SQL query" '.$sqlholi);
		
		$holi = array();
		while($row_holiday = mysqli_fetch_array($sql_resultholi)){
			$holi[] = $row_holiday["date"];
		}

		$counter = 0;
		foreach($holi as $key => $holi_val){
				if(date('m-d', strtotime($holi_val)) > date('m-d', strtotime($rowl["starting_date"])) && date('m-d', strtotime($holi_val)) <= date('m-d', strtotime($report_date))){		
					$counter++;
				}
		} 
		$to = date(" jS F\, Y ", strtotime($row["end_date"]. ' + '.$counter.' weekdays'));
		
		if($row["leave_type"]==1){
			echo date(" jS F\, Y ", strtotime($to. ' + 2 weekdays'));
		}
		elseif($row["leave_type"]==3){
			$maternity = $row["num_used"] - 1;
			echo date(" jS F\, Y ", strtotime($row["starting_date"]. ' + '.$maternity.' days'));
		}
		elseif($row["leave_type"]==4){
			$sick = $row["num_used"] - 1;
			echo date(" jS F\, Y ", strtotime($row["starting_date"]. ' + '.$sick.' days'));
		}
		else{
			echo date(" jS F\, Y ", strtotime($to));
		}
		?>
	</td>
    <td><?php 
		if($row["leave_type"]==1){
			echo date(" jS F\, Y ", strtotime($to. ' + 3 weekdays'));
		}
		elseif($row["leave_type"]==3){ 
			echo date(" jS F\, Y ", strtotime($row["starting_date"]. ' + '.$row["num_used"].' days'));
		}
		elseif($row["leave_type"]==4){ 
			echo date(" jS F\, Y ", strtotime($row["starting_date"]. ' + '.$row["num_used"].' days'));
		}
		else{
			echo date(" jS F\, Y ", strtotime($to. ' + 1 weekdays'));
		} 
		?>
		</td>
    <td><?php 
		$lt = "SELECT name FROM `leave_type` WHERE `id`='".$row["leave_type"]."'";
		$ltr = mysqli_query ($conn ,$lt ) or die ('request "Could not execute SQL query" '.$lt);
		$rlt = mysqli_fetch_assoc($ltr);
		echo $rlt["name"]; 
		?>
	</td>
    <td><?php 
		if($row["leave_type"]==1){
			echo $row["designated_leave_days"].' + 2 traveling days';
			}
		else{
			echo $row["designated_leave_days"];
		} 
		?>
	</td>
	<td><?php 
		if($row["leave_type"]==1){
			echo $row["num_used"].' + 2 traveling days';
		}
		else{
			echo $row["num_used"];
		}
		?>
	</td>
   <td><?php echo $row["num_left"]; ?></td>	
  </tr>
<?php
	}
?>
</tbody></table>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-search"></i> Filter</a></li>
          
        </ul>
        <!-- Tab panes -->
        
          <!-- Home tab content -->
          <div class="tab-content tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <form class="filter" name="form1" id="filt" method="post" action="" style="color:#FFF"><div class="form-group">
Department<?php  
$sqld = "SELECT * FROM department"; 
$sql_resultd = mysqli_query ($conn ,$sqld ) or die ('request "Could not execute SQL query" '.$sqld);
?> 
<select id="department" class="form-control select2" name="department">
  <option disabled="disabled" value="" selected="selected">Select Department</option> 
<?php 
while ($rowd = mysqli_fetch_array($sql_resultd, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rowd['id'];?>"> 
<?php echo $rowd['dpt_name'];?> 
</option>   
<?php } ?> 
</select></div><?php  
$sqls = "SELECT * FROM section"; 
$sql_results = mysqli_query ($conn ,$sqls ) or die ('request "Could not execute SQL query" '.$sqls);
?>
 <div class="form-group">By Section<select class="form-control select2" id="section" name="section">
  <option disabled="disabled" value="" selected="selected">Select Section</option> 
<?php 
while ($rows = mysqli_fetch_array($sql_results, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rows['id'];?>"> 
<?php echo $rows['section_name'];?> 
</option>   
<?php } ?> 
</select></div><div class="form-group">By Rank<?php  
$sqlr = "SELECT * FROM employee_types"; 
$sql_resultr = mysqli_query ($conn ,$sqlr ) or die ('request "Could not execute SQL query" '.$sqlr);
?> 
<select class="form-control select2" id="rank" name="rank">
  <option disabled="disabled" value="" selected="selected">Select Rank</option> 
<?php 
while ($rowr = mysqli_fetch_array($sql_resultr, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rowr['id'];?>"> 
<?php echo $rowr['types'];?> 
</option>   
<?php } ?> 
</select></div><input name="button" type="submit" class="btn btn-info pull-left" id="button" value="Filter"/><a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-default pull-right">Reset</a>
            </form>
<!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

      </aside><!-- /.control-sidebar --> 
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    
    <script type="text/javascript">
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
</script> 
     <!-- DataTables -->
    <script type="text/javascript" src="../../plugins/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../../plugins/datatables/extensions/JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/pdfmake-0.1.18/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/DataTables-1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/pdfmake-0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/DataTables-1.10.11/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/buttons.colVis.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="../../plugins/datatables/extensions/Buttons-1.1.2/js/buttons.print.min.js"></script>
     <!-- Select2 -->
    
    
    <!-- page script -->
    <script>
	$(function () {
        $("#example1").DataTable({
		 "dom": 'lBfrtip',
		 "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]});
      });
    </script>
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        
      });
    </script>
</body>
</html>

