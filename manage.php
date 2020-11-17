<?php
error_reporting(0);
include '../login/dbc.php';
page_protect();
include("access.php");
include("connection.php");
$admin = "SELECT * FROM employees WHERE employee_ID='PB0009'";
$admin_result = mysqli_query($conn, $admin) or die('request "Could not execute SQL query" '.$admin);
$senior = mysqli_fetch_assoc($admin_result);
$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_result = mysqli_query ($conn, $sql ) or die ('request "Could not execute SQL query" '.$sql);

$sqlmt = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultmt = mysqli_query ($conn, $sqlmt ) or die ('request "Could not execute SQL query" '.$sqlmt);
$sqlft = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultft = mysqli_query ($conn, $sqlft ) or die ('request "Could not execute SQL query" '.$sqlft);

$snr = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnr = mysqli_query ($conn, $snr ) or die ('request "Could not execute SQL query" '.$snr);

$snrm = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' and employees.TitleOfCourtesy='Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnrm = mysqli_query ($conn, $snrm ) or die ('request "Could not execute SQL query" '.$snrm);
$snrf = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank='1' and employees.TitleOfCourtesy<>'Mr.' GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultsnrf = mysqli_query ($conn, $snrf ) or die ('request "Could not execute SQL query" '.$snrf);

$jnr = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.HireDate, department.dpt_name, contracts.starting_date, contracts.due_date, section.section_name FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id LEFT OUTER JOIN `contracts` ON employees.employee_ID=contracts.employee_ID WHERE employees.apt_status is null AND employees.rank=2 GROUP BY employees.employee_ID ORDER BY employees.rank asc, employees.employee_ID asc";

$sql_resultjnr = mysqli_query ($conn, $jnr ) or die ('request "Could not execute SQL query" '.$jnr);

$manage = "active";
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
	<!--Date Picker-->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	<script src="bootstrap/bootstrap-editable.js" type="text/javascript"></script> 
 
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
    
    <link href="bootstrap/css/bootstrap-editable.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/ace-fonts.css" />
     <!--Date Picker Css-->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
		

	<link rel="stylesheet" href="assets/css/jquery.gritter.css" />
	<link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap.css"/>
    
    <script src="dist/js/moment.min.js"></script>  

	<link href="dist/css/select2.css" rel="stylesheet">
    <script src="dist/js/select2.js"></script> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php include "idle.php"; ?>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("header.php");?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include("menu.php"); ?>
	  
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small><button id="enable" class="btn btn-primary" style="margin-left: 15px; width: 12%;"><i class="fa fa-edit"></i> <b>Edit</b> <small id="state" style="font-size: 75%; margin-left: 5px; color: #fff">disabled</small></button><button id="addnew" class="btn btn-primary bg-green" title="Add new record to database" style="margin-left: 15px; width: 12%;"><i class="fa fa-plus"></i> <b>Add New</b> </button>
			
			
			
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Manage HR Database</li>
          </ol>
        </section>
		
		<div class="modal fade" id="renModal" tabindex="-1" role="dialog" aria-labelledby="renModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="renModalLabel"></h4>
                      </div>
                      <div class="modal-body" id="renmodal-bodyku"></div>
                      <div class="modal-footer" id="renmodal-footerq"></div>
					</div>
                </div>
            </div>
			
			<select class="form-control" id="mysize" style="display:none">
                <option value="standart" selected>Standart</option>
                <option value="small">Small</option>
                <option value="large">Large</option>
            </select>
			
         <!-- Main content -->
        <section class="content" id="user">
          <div class="row">
            <div class="col-md-6">
              <!-- DEPARTMENTS -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">DEPARTMENT</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered">
					<thead>
						<tr>
						  <th style="width: 10px">#</th>
						  <th>Department</th>
						  <th>Head Of Department</th>
						</tr>
					</thead>
                    <tbody>
						<?php 
						$q = "SELECT d.id as did, d.dpt_name, d.hod ,e.* FROM `department` d LEFT OUTER JOIN employees e ON d.hod=e.employee_ID ORDER BY d.`dpt_name`"; //select first ten of users tests
						$r = mysqli_query ($conn, $q) or die("Query: $q\n<br />MySQL Error: " . mysqli_error($conn));

						$i = 0;

						while($row = mysqli_fetch_array($r, MYSQLI_ASSOC) ) {
							$i += 1;
						?>
						<tr>
						  <td><?php echo $i; ?></td>
						  <td>
							<span class="dedit" id="dpt_name" data-param="department" data-pk="<?php echo $row["did"];?>" data-name="dpt_name" data-title="Edit Department" data-type="text"><?php echo $row["dpt_name"]; ?></span>
						  </td>
						  <td><span class="hod" id="hod" data-param="department" data-pk="<?php echo $row["did"];?>" data-name="hod" data-title="Edit Head of Department" data-type="select2"><?php echo $row["TitleOfCourtesy"]." ".$row["FirstName"]." ".$row["Middle_name"]." ".$row["LastName"]; ?></span></td>
						</tr>
						<?php } ?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- RANKS -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">RANKS</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered">
					<thead>
						<tr>
						  <th style="width: 10px">#</th>
						  <th>Rank</th>
						</tr>
					</thead>
                    <tbody>
						<?php 
						$qt = "SELECT * FROM `employee_types` ORDER BY `types`"; //select first ten of users tests
						$rt = mysqli_query ($conn, $qt) or die("Query: $q\n<br />MySQL Error: " . mysqli_error($conn));

						$j = 0;

						while($rowt = mysqli_fetch_array($rt, MYSQLI_ASSOC) ) {
							$j += 1;
						?>
						<tr>
						  <td><?php echo $j; ?></td>
						  <td>
							<span class="dedit" id="types" data-param="rank" data-pk="<?php echo $rowt["id"];?>" data-name="types" data-title="Edit Rank" data-type="text"><?php echo $rowt["types"]; ?></span>
						  </td>
						</tr>
						<?php } ?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (LEFT) -->
                        
			<div class="col-md-6">
              <!-- SECTIONS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Section</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered">
					<thead>
						<tr>
						  <th style="width: 10px">#</th>
						  <th>Section</th>
						</tr>
					</thead>
                    <tbody>
						<?php 
						$qs = "SELECT * FROM `section` ORDER BY `section_name`"; //select first ten of users tests
						$rs = mysqli_query ($conn, $qs) or die("Query: $q\n<br />MySQL Error: " . mysqli_error($conn));

						$k = 0;

						while($rows = mysqli_fetch_array($rs, MYSQLI_ASSOC) ) {
							$k += 1;
						?>
						<tr>
						  <td><?php echo $k; ?></td>
						  <td>
							<span class="dedit" id="section_name" data-param="section" data-pk="<?php echo $rows["id"];?>" data-name="section_name" data-title="Edit Section" data-type="text"><?php echo $rows["section_name"]; ?></span>
						  </td>
						</tr>
						<?php } ?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- BAR CHART --
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Bar Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body --
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Holidays</h3>
				  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                  <!--<div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>-->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="holidays">
                    <thead>
						<tr>
						  <th>ID</th>
						  <th>Name</th>
						  <th>Date</th>
						  <th>Description</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$holi = "SELECT * FROM `holidays` ORDER BY 3"; //select first ten of users tests
						$r = mysqli_query ($conn, $holi) or die("Query: $holi\n<br />MySQL Error: " . mysqli_error($conn));

						$l = 0;

						while($rowh = mysqli_fetch_array($r, MYSQLI_ASSOC) ) {
							$l += 1;
						?>
						<tr>
						  <td><?php echo $l; ?></td>
						  <td>
							<span class="dedit" id="holi_name" data-param="holiday" data-pk="<?php echo $rowh["id"];?>" data-name="Name" data-title="Edit Holiday Name" data-type="text"><?php echo $rowh["Name"]; ?></span>
						  </td>
						  <td><?php echo date("jS F\ ", strtotime($rowh["date"])); ?></td>
						  <td><span class="dedit" id="hdescription" data-param="holiday" data-pk="<?php echo $rowh['id'];?>" data-name="description" data-title="Edit Description" data-type="textarea"><?php echo $rowh["description"]; ?></span></td>
						</tr>
						<?php } ?>
					</tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
	 <!-- DataTables -->
    <script type="text/javascript" src="plugins/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/extensions/JSZip-2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/pdfmake-0.1.18/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/DataTables-1.10.11/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/pdfmake-0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/DataTables-1.10.11/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/buttons.colVis.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="plugins/datatables/extensions/Buttons-1.1.2/js/buttons.print.min.js"></script>
	
	
	<script>
	/*Renew Contract*/
$('#renModal').on('hidden.bs.modal', function () {location.reload(true);
});

$(document).on('click', '#addnew', function (){
            var size=document.getElementById('mysize').value;
            var content = '<form class="form-horizontal" role="form" method="post" id="addnewForm"><div id="addnewResult"></div><div class="form-group row"><div class="col-xs-6"><label for="tabletype">Table Type <span style="color:#C00">*</span></label><select class="form-control" id="ttype" required name="ttype"><option value="" disabled  selected="selected">Select Table Type</option><option value="department">Department</option><option value="section">Section</option><option value="rank">Rank</option><option value="holidays">Holidays</option></select></div></div><div id="adddata"></div><button type="submit" class="btn btn-default" id="addd_btn">Submit</button></form>';
            var title = "Add New Record To Database Table";
            var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            setModalBox(title,content,footer,size);
			document.getElementById('renmodal-bodyku').innerHTML=content;
            document.getElementById('renModalLabel').innerHTML=title;
            document.getElementById('renmodal-footerq').innerHTML=footer;
            $('#renModal').modal('show');
		/*  $('.input-group, #hdate').datepicker({
    autoclose: true,
	daysOfWeekHighlighted: "0,6",
	daysOfWeekDisabled: "0,6",
	format: 'yyyy-mm-dd',
    todayHighlight: true,
	
		}); */
		
});

<?php
	$sql_mr = "SELECT * FROM employees WHERE apt_status is null";
	$sql_resultmr = mysqli_query($conn, $sql_mr) or die(mysqli_error($conn));
	?>

$(document).on('change', '#ttype', function (){
	
	if($(this).val() == 'department'){
		$('#adddata').html('<div class="form-group row"><div class="col-xs-6"><label for="dptname">Dependant Name <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="dptname" placeholder="Enter Department Name"></div><div class="col-xs-6"><label for="name">Head of Department <span style="color:#C00">*</span></label><select class="form-control shod" id="hodd" required name="hodd" style="width:100%" data-placeholder="Select Title" data-allow-clear="true"><option value="" disabled  selected="selected">Select HOD</option><?php while ($rowmr = mysqli_fetch_assoc($sql_resultmr)) { ?><option value="<?php echo $rowmr['employee_ID'];?>"><?php echo $rowmr["TitleOfCourtesy"]." ".$rowmr["FirstName"]." ".$rowmr["Middle_name"]." ".$rowmr["LastName"]; ?></option><?php } ?></select></div></div>');
	}
	else if($(this).val() == 'section'){
		$('#adddata').html('<div class="form-group row"><div class="col-xs-6"><label for="secname">Section Name <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="secname" placeholder="Enter Section Name"></div></div>');
	}
	else if($(this).val() == 'rank'){
		$('#adddata').html('<div class="form-group row"><div class="col-xs-6"><label for="rankname">Rank Name <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="rankname" placeholder="Enter Rank Name"></div></div>');
	}
	else if($(this).val() == 'holidays'){
		$('#adddata').html('<div class="form-group row"><div class="col-xs-6"><label for="dptname">Dependant Name <span style="color:#C00">*</span></label><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" class="form-control" placeholder="Enter Date of Holiday" id="hdate" required/></div></div><div class="col-xs-6"><label for="name">Head of Department <span style="color:#C00">*</span></label><select class="form-control shod" id="hodd" required name="hodd" style="width:100%" data-placeholder="Select Title" data-allow-clear="true"><option value="" disabled  selected="selected">Select HOD</option><?php while ($rowmr = mysqli_fetch_assoc($sql_resultmr)) { ?><option value="<?php echo $rowmr['employee_ID'];?>"><?php echo $rowmr["TitleOfCourtesy"]." ".$rowmr["FirstName"]." ".$rowmr["Middle_name"]." ".$rowmr["LastName"]; ?></option><?php } ?></select></div></div>');
	}
	else{
		$('#adddata').html('');
	}
	$(".shod").select2();
	$('#hdate').datepicker({
    autoclose: true,
	daysOfWeekHighlighted: "0,6",
	format: 'yyyy-mm-dd',
    todayHighlight: true,
	
		});
});

	
        function setModalBox(title,content,footer,$size)
        {
            
            if($size == 'large')
            {
                $('#renModal').attr('class', 'modal fade bs-example-modal-lg')
                             .attr('aria-labelledby','myLargeModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-lg');
            }
            if($size == 'standart')
            {
                $('#renModal').attr('class', 'modal fade')
                             .attr('aria-labelledby','myModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }
            if($size == 'small')
            {
                $('#renModal').attr('class', 'modal fade bs-example-modal-sm')
                             .attr('aria-labelledby','mySmallModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-sm');
            }
		}
			
	$(document).on('click', '#addd_btn', function (c){ 
		c.preventDefault();    	   
	    var goon = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields
		$("#addnewForm input[required], #addnewForm select[required], #addnewForm textarea[required]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				$('#addnewForm #addnewResult').html("<div class='alert alert-danger'>");
            	$('#addnewForm #addnewResult > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#addnewForm #addnewResult > .alert-danger').append("One or more required fields are empty");
 	        $('#addnewForm #addnewResult > .alert-danger').append('</div>');
				goon = false; //set do not proceed flag
			}
				
		});
	   
        if(goon) //everything looks good! proceed...
        {
           //data to be sent to server         
            var ren_data = new FormData();    
            ren_data.append( 'addnew', 'todb');    
            ren_data.append( 'dptname', $('#dptname').val());
             ren_data.append( 'hod', $('#hodd').val());
			ren_data.append( 'secname', $('#secname').val());
			ren_data.append( 'rankname', $('#rankname').val());
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'hr_process.php',
              data: ren_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 //load json data from server and output message     
 				if(response.type == 'error'){ //load json data from server and output message     
					output = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>';
				}else{
				    output = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>';
					
				}
				$("#addnewForm #addnewResult").html(output);
              },
			  error: function(errorThrown){
				  		alert("There is an error with AJAX!");
					} 
            });
			

        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $(document).on('keyup', '#addnewForm input[required], #addnewForm  select[required], #addnewForm textarea[required]' , function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
	$(document).on('click','#addnewForm input[required], #addnewForm select[required], #addnewForm textarea[required]' , function () {
		$(this).css('border-color',''); 
        $("#result").slideUp();
	});
	
	$(function () {	
        var table = $("#example1, #example2, #holidays").DataTable({
		 "dom": 'lBfrtip',
		 "iDisplayLength": 5,
		 "aLengthMenu": [[5, 10, 15, 25, 35, 50, 100, -1], [5, 10, 15, 25, 35, 50, 100, "All"]],
		  "aaSorting": [],
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
	
	$(document).on('click', '#enable', function() {
		$('#user .editable').editable('toggleDisabled');
		
		var state = $('#user').find('span');
			if ( $(state).hasClass('editable-disabled') ) {
				$('#state').html('disabled');
			}
            else{
				$('#state').html('enabled'); 
			}
		
		$('#example1 tbody tr').each( function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
        }
		});
	});
	
	$(document).on('click', 'li.paginate_button a', function() {
		$('#user .editable').editable('option', 'disabled', true);
		
		var state = $('#user').find('span');
			
		if ( $(state).hasClass('editable-disabled') ) {
			$('#state').html('disabled');
		}
        else{
			$('#state').html('enabled'); 
		}
	});
	
	$('.dedit').editable({
		mode: 'inline',
		disabled: true,
		url: 'hr_process.php',
         params: function(params) {
        // add additional params from data-attributes of trigger element
        params.param1 = $(this).editable().data('param');
        return params;
		}
    });
	
	<?php
	$sql_r = "SELECT * FROM employees";
	$sql_resultr = mysqli_query($conn, $sql_r) or die(mysqli_error($conn));
	?>
	$('.hod').editable({
		mode: 'inline',
		disabled: true,
		url: 'hr_process.php',
        source : [ 
<?php while ($rowe = mysqli_fetch_assoc($sql_resultr)) { ?>
			{ 
				value : '<?php echo $rowe['employee_ID'];?>', 
				text : '<?php echo $rowe["TitleOfCourtesy"]." ".$rowe["FirstName"]." ".$rowe["Middle_name"]." ".$rowe["LastName"]; ?>'
			},
<?php } ?>
				],
         params: function(params) {
        // add additional params from data-attributes of trigger element
        params.param1 = $(this).editable().data('param');
        return params;
		},
		select2: {
            width: 200,
            placeholder: 'Select HOD',
            allowClear: true
        }
    });
	
	
	
	</script>
  </body>
</html>
