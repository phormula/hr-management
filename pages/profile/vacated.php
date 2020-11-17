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
	$search_city = " AND employees.department='".mysqli_real_escape_string($conn, $_REQUEST["department"])."'";	
}

if ($_REQUEST["rank"]<>'') {
	if($_REQUEST["rank"]=="3"){
		$date = "AND contracts.`due_date` > NOW()";}
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_rank = " AND employees.rank='".mysqli_real_escape_string($conn, $_REQUEST["rank"])."'";	
}


if ($_REQUEST["section"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_section = " AND section='".mysqli_real_escape_string($conn, $_REQUEST["section"])."'";	
}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT employees.employee_ID, employees.SSID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, employee_types.types, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID LEFT OUTER JOIN `employee_types` ON employees.rank=employee_types.id WHERE employees.apt_status is null AND employees.rank<>4 AND employees.HireDate>='".mysqli_real_escape_string($conn, $_REQUEST["from"])."' AND employees.HireDate<='".mysqli_real_escape_string($conn, $_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$date." GROUP BY employees.employee_ID".$order;
} else if ($_REQUEST["from"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT employees.employee_ID, employees.FirstName, employees.LastName, employees.Position, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE HireDate ='".mysqli_real_escape_string($conn, $_REQUEST["from"])."' OR Year(`HireDate`)='".mysqli_real_escape_string($conn, $_REQUEST["from"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT * FROM employees".$add_years." WHERE to_date <= '".mysqli_real_escape_string($conn, $_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if($_REQUEST["retire_yr"] <>''){
	$sql = "SELECT employees.employee_ID, employees.SSID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, employee_types.types, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID LEFT OUTER JOIN `employee_types` ON employees.rank=employee_types.id WHERE Year(DATE_ADD(`BirthDate`,INTERVAL 60 YEAR))='".mysqli_real_escape_string($conn, $_REQUEST["retire_yr"])."' AND employees.apt_status is null".$search_string.$search_city.$search_section.$search_rank." GROUP BY employees.employee_ID".$order;
	}else {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
		$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.PhotoPath, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE employees.apt_status='4'".$search_string.$search_city.$search_section.$search_rank.$order;
}

$sql_result = mysqli_query ($conn ,$sql ) or die ('request "Could not execute SQL query" '.$sql);
$profile = "active";
$vacated_profile = "active";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if (isset($_REQUEST["section"])){
		$sqlsec = "SELECT section_name FROM section WHERE id='".mysqli_real_escape_string($conn, $_REQUEST["section"])."'"; 
$sql_resultsec = mysqli_query ($conn ,$sqlsec ) or die ('request "Could not execute SQL query" '.$sqlsec);
$rowsec = mysqli_fetch_array($sql_resultsec, MYSQL_ASSOC); ?>Vacated Employees in <?php echo $rowsec["section_name"];}else{ ?>Vacated Employees<?php }?></title>
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
	<!--Date Picker Css-->
    <link rel="stylesheet" href="../../plugins/datetimepicker/bootstrap-datetimepicker.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style type="text/css">
   tr.empp{ cursor:pointer}
   .table thead { display:none}
   </style> 
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <script>
  $(document).ready(function() {
localStorage.clear();
});
</script>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

		<?php include("../../header.php"); ?>

      <!-- =============================================== -->

      
            <?php include("../../menu.php"); ?>
            
             
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Vacated Employee List
          </h1><small>Profile View</small>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Profile View</a></li>
            <li class="active">Vacated</li>
          </ol>
        </section>

        <!-- Main content -->
         <section class="content">
          <div class="row">
            <div class="col-xs-12">
           <!-- /.box -->

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Vacated Employee List in Profile View</h3><br>
<button class="btn btn-info pull-left bg-aqua" data-toggle="control-sidebar"><i class="fa fa-search"></i> Advance Filter</button><button class="btn btn-default pull-left" style="margin-left:15px" id="refresh"><i class="fa fa-refresh"></i> Refresh Page</button>
<script type="text/javascript">
  $('#refresh').click(function() {
   window.location = window.location.href;
});</script>
                </div><!-- /.box-header -->
               
                <div class="box-body">
                  <table id="example1" class="table table-hover">
                   <thead>
  <tr>
  <th>Employee ID</th>
  <th>Name</th>
  <th>Position</th>
  <th>Department</th>
  <th>Section</th>
  </tr>
  </thead>
  <tbody>
<?php
$num_rows = 0;
$current_class = "";
	while ($row = mysqli_fetch_array($sql_result)) {
//if($i % 2 == 0){ $class = 'even';} else {$class = 'odd';}
$current_class = "even";
    if($num_rows % 2 == 0){
        $current_class = "odd";
    }

    $num_rows++;						
?>

  <tr data-href="../../profile_detail.php?id=<?php echo $row["employee_ID"]; ?>" class="empp">
  <td>&nbsp;</td>
  <td style="margin-left:50px">
      <?php 
        if($row["PhotoPath"] != ""){
          if(file_exists('../../'.$row["PhotoPath"])){
            echo "<img class='img-circle profile-user-img img-responsive' src='../../".$row["PhotoPath"]."' style='width:140px' alt='Profile Image for ".$row["employee_ID"]."'/>";
          }
          else{
            echo "<img src='../../images/avatar.jpg' class='img-circle profile-user-img img-responsive'  style='width:140px' alt='Profile Image for ".$row["employee_ID"]."'/>";
          }
        }
        else{ 
          echo "<img src='../../images/avatar.jpg' class='img-circle profile-user-img img-responsive'  style='width:140px' alt='Profile Image for ".$row["employee_ID"]."'/>";
        } 
      ?>
    </td>
    <td style="margin-left:100px"><h4><?php echo "".$row["TitleOfCourtesy"]." ".$row["FirstName"]." ".$row["Middle_name"]." ".$row["LastName"]; ?></h4><?php echo $row["employee_ID"]; ?><br>
<?php echo $row["Position"]; ?><br>
<span style="color:#00C0EF">Click for Details</span></td>
    
    <td></td>
    <td></td>
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
            <h3 class="control-sidebar-heading">Advance Filter</h3>
            <form class="filter" name="form1" id="filt" method="post" action="" style="color:#FFF"><div class="form-group"> Appointment Date<br>
From: </label>
    <input name="from" type="text" maxlength="10" id="from" size="10" style="color:#000" placeholder="Date" value="<?php echo $_REQUEST["from"]; ?>" /> <label for="to">to: </label>
<input name="to" maxlength="10" style="width: 72px; color:#000" type="text" placeholder="Date" id="to" size="10" value="<?php echo $_REQUEST["to"]; ?>"/></div><div class="form-group">Employees to Retire In:
<input name="retire_yr" type="date" placeholder="Enter Year" id="retire_yr" maxlength="4" value="<?php echo $_REQUEST["retire_yr"]; ?>" style="width:95%; color:#000"/></div><div class="form-group">
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
$sqlr = "SELECT * FROM employee_types LIMIT 3"; 
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
</select></div>
<div class="checkbox">
                      <label>
                        <input type="checkbox" name="year"> Show working Years
                      </label>
                    </div><input name="button" type="submit" class="btn btn-info pull-left" id="button" value="Filter"/><a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-default pull-right">Reset</a>
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
    <script src="../../plugins/datatables/datatables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
     <!-- Select2 -->
    
    <!--Date Picker-->
    <script src="../../plugins/datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    
    <!-- page script -->
    <script>
	$(function () {
        $("#example1").DataTable();
      });
    </script>
    <script>
	$(document).ready(function(){
      $("#form").datetimepicker({
        format: "yyyy-mm-dd",
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to').datetimepicker('setStartDate', minDate);
    });
    
      $("#to").datetimepicker({
      format: "yyyy-mm-dd",
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
      });
     });
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        /* $('#to, #apd, #sd').datepicker({
    autoclose: true,
    todayHighlight: true,
	changeyear:	true,
	format: "yyyy-mm-dd"
		}); */
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
       
      });

        /* $("#from").datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
        onSelect: function(selected) {
          $("#to").datepicker("option","maxDate", selected)
        }
    });
    $("#to").datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		setStartDate: $("from").val(),
        onSelect: function(selected) {
           $("#from").datepicker("option","minDate", selected)
        }
	}); */
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