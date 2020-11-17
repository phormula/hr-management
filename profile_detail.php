<?php
/* error_reporting(0);
include '../login/dbc.php';
page_protect();
include("access.php"); */
include("connection.php");

if(empty($_GET["id"])){die('<center style="font-weight: bold; color:#F00">You cannot access this page like this</center>');}

$snr = "SELECT * FROM employees WHERE employee_ID='PB0009'";

$sql_resultsnr = mysqli_query ($conn , $snr ) or die ('request "Could not execute SQL query" '.$snr);

$senior = mysqli_fetch_assoc($sql_resultsnr);

?>

<?php 
$emp_id = $_GET["id"];

	//$sql = "SELECT * FROM employees WHERE EmployeeID>0".$search_string.$search_city;
	$sql = "SELECT e.id as id, e.employee_ID as emp_id, e.SSID as SSID, e.TitleOfCourtesy as emp_title, e.FirstName as emp_firstname, e.Middle_name as emp_middlename,e.phone as phone,e.email as email, e.LastName as emp_lastname, e.BirthDate as emp_bdate, e.HireDate as emp_hdate, e.Position as emp_position, e.PhotoPath as emp_photopath, e.Address as emp_address, e.rank as rank, d.dpt_name as employee_dpt, s.section_name as sec_name, r.types as emp_rank, e.Notes as otherinfo, m.id as m_id, m.employee_ID as mID, m.TitleOfCourtesy as mtitle, m.FirstName as mFirstname, m.Middle_name as mMname, m.LastName as mLastname FROM `employees` e INNER JOIN `department` d ON e.department=d.id INNER JOIN section s ON e.section=s.id LEFT JOIN `employees` m ON e.ReportsTo=m.id INNER JOIN `employee_types` r ON e.rank=r.id WHERE e.employee_ID='".$emp_id."'";

$sql2 = "SELECT count(employee_id) as 'count_of_dInvolvement' FROM disciplinary_actions WHERE employee_id='".$emp_id."'";

$sql3 = "SELECT DATE_ADD(`BirthDate`,INTERVAL 60 YEAR) AS DateToRetire FROM employees WHERE `employee_ID`='".$emp_id."'";

$sqla = "SELECT e.apt_statusDate as statDate, e.apt_status as apt_status, e.inactive_letter as inactive_letter, a.termination_reason as status FROM `employees` e INNER JOIN `appointment_status` a ON e.apt_status=a.id WHERE e.employee_ID='".$emp_id."'";

$query_pdf = "SELECT * FROM `disciplinary_actions` WHERE `employee_id`='".$emp_id."'";

$result_pdf = mysqli_query ($conn ,$query_pdf ) or die ('request "Could not execute SQL query" '.$query_pdf); 

$query_pdf2 = "SELECT * FROM `employees` WHERE `employee_id`='".$emp_id."'";

$result_pdf2 = mysqli_query ($conn ,$query_pdf2 ) or die ('request "Could not execute SQL query" '.$query_pdf2);

$sql_result3 = mysqli_query ($conn ,$sql3 ) or die ('request "Could not execute SQL query" '.$sql3);

$sql_result2 = mysqli_query ($conn ,$sql2 ) or die ('request "Could not execute SQL query" '.$sql2);

$sql_resulta = mysqli_query ($conn ,$sqla ) or die ('request "Could not execute SQL query" '.$sqla);

$sql_result = mysqli_query ($conn ,$sql ) or die ('request "Could not execute SQL query" '.$sql);
$row = mysqli_fetch_assoc($sql_result);
$row3 = mysqli_fetch_assoc($sql_result3);
$rowa = mysqli_fetch_assoc($sql_resulta);
$rowpdf = mysqli_fetch_assoc($result_pdf2);

$profile_detail = "active";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile Detail for <?php echo ''.$row["emp_firstname"].' '; if(!empty($row["emp_middlename"])){echo ''.$row["emp_middlename"].'&nbsp;';} echo ''.$row["emp_lastname"];?></title>
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
    <?php if(!empty($rowa)){	echo '<style type="text/css">.nav-tabs-custom > .nav-tabs > li.active {
    border-top-color: rgb(221, 75, 57);
}</style>';} ?>

<style type="text/css">
.selected{background-color: #C9302C}
#avatar{width: 200px}


</style>
<?php include "idlep.php"; ?>
<script>
$(document).ready(function() {
	
$('a[data-toggle="tab"]').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});

$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href");
    localStorage.setItem('selectedTab', id)
});

var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab != null) {
    $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
}

});
</script>

  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini sidebar-collapse">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("header.php");?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include("menu.php"); ?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header row">
        <span class="col-lg-3"><h1 style="margin-top:0px">
            Employee Profile </h1></span><span class="col-lg-2"><button class="btn btn-default" id="refresh"><i class="fa fa-refresh"></i> Refresh Page</button></span><span class="col-lg-5"><button class="btn btn-default btn-danger" id="delete"><i class="fa fa-trash-o"></i> Delete Employee</button></span>
                        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="delModalLabel"></h4>
                      </div>
                      <div class="modal-body" id="delmodal-bodyku">
                      </div>
                      <div class="modal-footer" id="delmodal-footerq">
                      </div>
                    </div>
                  </div>
                </div>
                        
          <script language="javascript">
       $(document).on('click', '#delete', function (){
        
            var sizes=document.getElementById('mysize').value;
            var contentd = '<div id="contact_results"></div><b style="font-size:16px">Are you sure you want to delete <?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?> record from the system?</b><br><br><button type="button" id="yes" class="btn btn-default bg-green" onClick="delete_record();"><i class="glyphicon glyphicon-ok"></i> Yes</button><button type="button" style="margin-left:10px" id="no" class="btn btn-default bg-red" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> No</button><br><br><br><div class="alert alert-info alert-dismissable"><h4><i class="icon fa fa-info"></i> Note</h4>Deleted records cannot be recovered or undone.</div>';
            var titled = 'Delete <?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?> from database?';
            var footerd = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            setModalBox(titled,contentd,footerd,sizes);
            $('#delModal').modal('show');
			document.getElementById('delmodal-bodyku').innerHTML=contentd;
            document.getElementById('delModalLabel').innerHTML=titled;
            document.getElementById('delmodal-footerq').innerHTML=footerd;			
        });
        function setModalBox(titled,contentd,footerd,$sizes)
        {
                        if($size == 'large')
            {
                $('#delModal').attr('class', 'modal fade bs-example-modal-lg')
                             .attr('aria-labelledby','myLargeModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-lg');
            }
            if($size == 'standart')
            {
                $('#delModal').attr('class', 'modal fade')
                             .attr('aria-labelledby','delModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }
            if($size == 'small')
            {
                $('#delModal').attr('class', 'modal fade bs-example-modal-sm')
                             .attr('aria-labelledby','mySmallModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-sm');
            }
		}
		
		$(document).on('click', '#yes', function (){ 	   
	    var proceed = true;
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append('emp', '<?php echo $emp_id;?>');
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'delete.php',
              data: m_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 
				 if(response.type == 'error'){ //load json data from server and output message     
					$("#contact_results").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>');
				}else{
					
				    $("#contact_results").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'<br><b style="font-size:17px">You will be redirected after <span id="lblCount" style="text-transform:uppercase"></span>&nbsp;seconds.</b></div>');
				var seconds = 5;
        $("#lblCount").html(seconds);
        setInterval(function () {
            seconds--;
            $("#lblCount").html(seconds);
            if (seconds == 0) {
                window.location = "pages/table/tableview.php";
            }
        }, 1000);	
				}   
 				 },
			  error: function(errorThrown){
				  $('#contact_results').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>');
//        alert("There is an error with AJAX!");
    } 
            });
			

        }
});	
        </script> 
<script type="text/javascript">
$('#refresh').click(function() {
	localStorage.clear();
	window.location = window.location.href;
});
$('#myTab a').click(function (e) {
	e.preventDefault();
	var pattern=/#.+/gi //use regex to get anchor(==selector)
	var contentID = e.target.toString().match(pattern)[0]; //get anchor   
	$('.nav-tabs a[href="'+contentID+'"]').tab('show') ;         
});
</script>
          <ol class="breadcrumb col-lg-2">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="user">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box <?php if(empty($rowa)){	echo 'box-primary';}else{echo 'box-danger';}?>">
                <div class="box-body box-profile">
<?php 
if($row["emp_photopath"] != ""){
	if (file_exists($row["emp_photopath"])) {
		echo '<img src="'.$row["emp_photopath"].'" data-pk="'.$emp_id.'" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image for '.$row["employee_ID"].'"/>';
	}
	else{echo '<img style="min-width:200px; min-height:200px" data-pk="'.$emp_id.'" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image might have been deleted or renamed manually on the server. Please upload a new one '.$row["employee_ID"].'"/>';
	}
}
else{ echo '<!-- <div id="shop"><div class="contentimg"> --><img src="images/avatar.jpg" data-pk="'.$emp_id.'" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image for '.$row["employee_ID"].'"/><!--<a href="#">Counter-Strike 1.6 Steam</a> </div></div>-->';
} 
?>
        
                  <h3 class="profile-username text-center">
             <span><span data-type='select' data-url="process.php" data-original-title="Edit Title" data-pk="<?php echo $emp_id;?>" class="title" data-name="TitleOfCourtesy"><?php echo $row["emp_title"]; ?></span></span>&nbsp;<span> <span class="xedit" data-original-title="Edit First Name" data-pk="<?php echo $emp_id;?>" data-name="FirstName" title="First Name"><?php echo ''.$row["emp_firstname"].'';?></span>&nbsp;</span><span><span class="xedit" data-original-title="Edit Middle Name" data-pk="<?php echo $emp_id;?>" data-name="Middle_name"><?php if(!empty($row["emp_middlename"])){echo ''.$row["emp_middlename"].'&nbsp;';}?></span><?php if(empty($row["emp_middlename"])){echo '&nbsp;';}?></span><span><span class="xedit" data-original-title="Edit Last Name" data-pk="<?php echo $emp_id;?>" data-name="LastName"><?php echo ''.$row["emp_lastname"].'';?></span></span></h3>
                  <p class="text-muted text-center"><span><span class="xedit" data-original-title="Edit Position" data-pk="<?php echo $emp_id;?>" data-name="Position"><?php echo $row["emp_position"];?></span></span></p>

                  <ul class="list-group list-group-unbordered box1st">
                    <li class="list-group-item">
                      <b>Age</b> <a class="pull-right"><?php
$birthday = date_create($row["emp_bdate"]);
$age = $birthday->diff(new DateTime);
if(empty($row["emp_bdate"])){echo "N/A";}else{ echo $age->y;}
?></a>
                    </li>
                 <script type="text/javascript">
	<?php echo '$( document ).ready(function() {';
   if(empty($rowa)){echo "$('.stat_date').hide();";}
   else{echo "$('.stat_date').show();";} echo "});";?>
   </script>

                    <li class="list-group-item">
                      <b>Rank</b> <a class="pull-right"><span><span class="rank" data-type="select" data-original-title="Edit Rank" data-pk="<?php echo $emp_id;?>" data-name="rank"><?php echo $row["emp_rank"];?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Disciplinary Involvement</b> <span id="myTab"><a href="#settings" class="pull-right"><?php if($row2["count_of_dInvolvement"]>0){echo $row2["count_of_dInvolvement"];}else{echo 'None';}?></a></span>
                    </li>
                    <li class="list-group-item">
                      <b>Appointment</b> <a class="pull-right"><span><span class="status" data-type="select2" data-original-title="Edit Rank" data-pk="<?php echo $emp_id;?>" data-name="apt_status"><?php if(empty($rowa)){
		echo '<b style="color:#6BB36B">Active</b>';}else{echo $rowa["status"];} ?></span></span></a>
                    </li>
                    <li class="list-group-item stat_date"><b>Date</b> <a class="pull-right"><span><span class="vacation privacy_result" data-title="Date of Removal" data-type="date" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd" data-pk="<?php echo $emp_id;?>" data-placement="right" data-name="apt_statusDate"><?php if(!empty($rowa["statDate"])){echo date("jS F\, Y ", strtotime($rowa["statDate"]));}?></span></span></a></li>
                  </ul>

                  <button id="enable" class="btn btn-primary btn-block <?php if(empty($rowa)){	echo '';}else{echo 'btn-danger';}?>"><i class=" fa fa-edit"></i> <b>Edit</b></button>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#activity" data-toggle="tab">Main</a></li>
<?php if($row["rank"]<>4){echo '<li><a href="#dependances" data-toggle="tab">Dependants</a></li>';} ?>
				  <li><a href="#timeline" data-toggle="tab">Leave Details</a></li>
                  <li><a href="#settings" data-toggle="tab">Disciplinary Files</a></li>
<?php if($row["rank"]==3){echo '<li><a href="#contract" data-toggle="tab">Contract Details</a></li>';} ?>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                                           
                  <ul class="list-group list-group-unbordered" style="width:90%; padding-left:35px">
                    <li class="list-group-item">
                      <b>Staff ID</b> <a class="pull-right"><?php echo $row["emp_id"];
?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Social Security Number</b> <a class="pull-right"><span><span class="xedit" data-original-title="Edit Social Security Number" data-pk="<?php echo $emp_id;?>" data-name="SSID"><?php echo $row["SSID"]; ?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Date of Birth</b><a class="pull-right"><span><span class="vacation" data-name="BirthDate" data-type="date" data-placement="left" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd" data-pk="<?php echo $emp_id;?>"  data-title="Select Date of birth"><?php if(!empty($row["emp_bdate"])){echo date("jS F\, Y ", strtotime($row["emp_bdate"]));}?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Phone Number</b> <a class="pull-right"><span><span class="xedit" data-original-title="Edit Phone Number" data-pk="<?php echo $emp_id;?>" data-name="phone"><?php echo $row["phone"]; ?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Email Address</b> <a class="pull-right"><span><span class="xedit" data-original-title="Edit Email Address" data-pk="<?php echo $emp_id;?>" data-name="email"><?php echo $row["email"]; ?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Position</b> <a class="pull-right"><span><span class="xedit" data-original-title="Edit Position" data-pk="<?php echo $emp_id;?>" data-name="Position"><?php echo $row["emp_position"];?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Department</b> <a class="pull-right"><span><span class="department" data-original-title="Edit Department" data-pk="<?php echo $emp_id;?>" data-name="department" data-type="select2"><?php echo $row["employee_dpt"]; ?></span></span></a>
                    </li>
                    <li class="list-group-item">
                      <b>Section</b> <a class="pull-right"><span><span class="section" data-type="select2" data-original-title="Edit Section" data-pk="<?php echo $emp_id;?>" data-name="section"><?php echo $row["sec_name"]; ?></span></span></a>
                    </li>
<?php if($row["rank"]==3){
		$sqc = "SELECT * FROM `contracts` where `employee_ID`='".$emp_id."' ORDER BY `starting_date` desc LIMIT 1";
		$sqc_result = mysqli_query ($conn ,$sqc ) or die ('request "Could not execute SQL query" '.$sqc);
		$roc = mysqli_fetch_assoc($sqc_result);
	
		echo '<li class="list-group-item">
                <b>Date of Appointment</b>
				<a class="pull-right"><span><span class="vacation" data-name="AptDate" data-type="date" data-placement="left" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd" data-pk="'.$emp_id.'"  data-title="Select Date of Appointment">'.date("jS F\, Y ", strtotime($roc["AptDate"])).'</span></span></a></li><li class="list-group-item"><b>Start Date</b><a class="pull-right"><span><span class="vacation" data-name="starting_date" data-type="date" data-placement="left" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd" data-pk="'.$emp_id.'"  data-title="Select Start Date">'.date("jS F\, Y ", strtotime($roc["starting_date"])).'</span></span></a></li>';
		$due = $roc["due_date"];
		if(strtotime($due) < time()){
			echo "<li class='list-group-item'><b>Due Date</b><a class='pull-right'><span id='blinkText' style='color:#f00'>".date("jS F\, Y ", strtotime($due))."</span></a></li>";
		}
		else{
			echo "<li class='list-group-item'><b>Due Date</b><a class='pull-right'><span style='color:#53C13F'>".date("jS F\, Y ", strtotime($due))."</span></a></li>";
			}
	}
    else if($row["rank"]==4){
		echo "<li class='list-group-item'><b>Date of Appointment</b><a class='pull-right'>".date("jS F\, Y ", strtotime($row["emp_hdate"]))."</a></li>";
		}
    else{
		echo '<li class="list-group-item"><b>Date of Appointment</b><a class="pull-right"><span><span class="vacation" data-name="HireDate" data-type="date" data-placement="left" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd" data-pk="'.$emp_id.'"  data-title="Select Appointment Date">'; 
		if(!empty($row["emp_hdate"])){
			echo date("jS F\, Y ", strtotime($row["emp_hdate"]));
		}echo "</span></span></a></li>";
		$date = new DateTime($row["emp_bdate"]);
		$date->add(new DateInterval('P60Y'));
		$format = "jS F\, Y ";
		echo "<li class='list-group-item'><b>Date To Retire</b><a class='pull-right'>".$date->format($format)."</a></li>";
	}?>
					<li class="list-group-item">
                      <b>Reports To</b> 
					  <a class="pull-right" href="#" style="cursor:pointer">
						<span>
							<span class="reports" data-original-title="Edit Supervisor" data-pk="<?php echo $emp_id;?>" data-name="ReportsTo" data-type="select2"><?php echo $row["mtitle"]." ".$row["mFirstname"]." ".$row["mMname"]." ".$row["mLastname"]; ?></span>
						</span>
					  </a>
                    </li>

					<li class="list-group-item">
                      <b>Residentail Address</b><br>
					  <a style="margin-left: 25px"><span><span id="address" data-title="Edit Residentail Address" data-pk="<?php echo $emp_id;?>" data-name="Address" data-type="textarea"><?php echo $row["emp_address"]; ?></span></span></a>
                    </li>
					
                  </ul>
                      
                    </div><!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                 

                      
                    </div><!-- /.post -->

                  </div><!-- /.tab-pane -->
	<?php if($row["rank"]<>4){ ?>
				                    <div class="tab-pane" id="dependances" style="min-height:405px">

<button type="button" class="btn btn-danger pull-left" id="dep_del_button"><i class="fa fa-trash-o"></i> Delete</button><button type="button" class="btn btn-default pull-left" id="print" style="margin-left:15px"><i class="fa fa-print"></i> Print</button><button type="button" class="btn btn-primary pull-right" id="adddep" ><i class="fa fa-plus"></i> Add New Dependant</button><br>
<br><script>
    function printData()
{
   var divToPrint=document.getElementById("depend");
   
   var mywindow = window.open("");
    mywindow.document.write('<html moznomarginboxes mozdisallowselectionprint moznomarginboxes mozdisallowselectionprint><head><title>Dependant Info for <?php echo $row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?></title>');
	mywindow.document.write('<link rel="stylesheet" type="text/css" media="all" href="plugins/datatables/dataTables.bootstrap.css"/>');  
    mywindow.document.write('<style type="text/css">body { font-size: 12px; }img{border: 1px #000 solid;} </style></head><body>');
	mywindow.document.write('<table width="100%"><tr><td width="20%"><center style="font-size: 54px;"><?php echo substr($row["emp_lastname"],0,1); ?></center></td><td style="vertical-align: middle;"  width="60%"><center><img src="images/picca1.png" class="profile-user-img img-circle" id="avatar" style="width:80px; height:80px; margin-right:20px; border:none" alt="logo"/><span style="font-size: 16px; font-weight: 500;line-height: 1.1;">PICCADILLY BISCUITS LIMITED</span><br><span style="font-size: 16px; font-weight: 500;line-height: 1.1;margin-left: -81px;margin-top: -24px;position: absolute;">STAFF DEPENDANT INFORMATION</span></center></td><td><?php if($row["emp_photopath"] != ""){if (file_exists($row["emp_photopath"])) {echo '<img src="'.$row["emp_photopath"].'" style="width:100px; height:100px; float:right" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image for '.$row["employee_ID"].'"/>';}else{echo '<img style="width:100px; height:100px" data-pk="'.$emp_id.'" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image might have been deleted or renamed manually on the server. Please upload a new one '.$row["employee_ID"].'"/>';}}else{ echo '<img src="images/avatar.jpg" style="width:100px; height:100px" class="profile-user-img img-responsive img-circle" id="avatar" alt="Profile Image for '.$row["employee_ID"].'"/>';} ?></td></tr></table>');
	mywindow.document.write('<br><br><br><h4>Name Of Staff: <?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?></h4>');
    mywindow.document.write(divToPrint.outerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.print(); 
	mywindow.close();
}

$('#print').on('click',function(){
printData();
})
    </script><div id="del_dep"></div>
<div id="depend">
<?php $sqlsp = "SELECT * FROM `dependance` WHERE EMPID='".$emp_id."' AND type='Spouse'";

$sql_resultsp = mysqli_query ($conn ,$sqlsp ) or die ('request "Could not execute SQL query" '.$sqlsp);
$row_sp = mysqli_fetch_assoc($sql_resultsp); ?>
<h4 id="spou" data-id="<?php echo $row_sp["id"];?>">Name Of Spouse: <?php 
if (mysqli_num_rows($sql_resultsp)>0) { if(!empty($row_sp["image"])){
echo '<img src="'.$row_sp["image"].'" style="width:80px; margin-right:5px" class="profile-user-img img-circle" data-pk="'.$emp_id.'" data-pk2="'.$row_sp["id"].'" id="'.$row_sp["id"].'avatar" alt="dependant image"/> <span id="dependa" data-title="Edit Spouse Name" data-param="'.$row_sp["id"].'" data-pk="'.$emp_id.'" data-name="Name" data-type="text">'.$row_sp["Name"].'</span>';}else{echo '<img src="images/avatar.jpg" style="width:80px; margin-right:5px" class="profile-user-img img-circle" data-pk="'.$emp_id.'" data-pk2="'.$row_sp["id"].'" id="'.$row_sp["id"].'avatar" alt="dependant image"/> <span id="dependa" data-title="Edit Spouse Name" data-param="'.$row_sp["id"].'" data-pk="'.$emp_id.'" data-name="Name" data-type="text">'.$row_sp["Name"].'</span>';}}
else{echo "N/A";}?>
</h4>
<br>

<table class="table table-bordered table-striped" id="children">
<thead>
  <tr>
	<th>Name of Dependant / Children</th>
    <th>Date of Birth</th>
    <th>Age (Years)</th>
  </tr>
</thead>
<tbody>
<?php
$sqld = "SELECT * FROM `dependance` WHERE EMPID='".$emp_id."' AND type<>'Spouse'";

$sql_resultd = mysqli_query ($conn ,$sqld ) or die ('request "Could not execute SQL query" '.$sqld);
if (mysqli_num_rows($sql_resultd)>0) {
	while ($row_dep = mysqli_fetch_assoc($sql_resultd)) {
?>

  <tr data-id="<?php echo $row_dep["id"];?>">
  	<td style="vertical-align: middle;"><?php if(!empty($row_dep["image"])){echo '<img src="'.$row_dep["image"].'" style="width:80px; margin-right:5px" class="profile-user-img img-circle" data-pk="'.$emp_id.'" data-pk2="'.$row_dep["id"].'" id="'.$row_dep["id"].'avatar" alt="dependant image"/> <span id="'.$row_dep["id"].'dependan" data-title="Edit Dependant Name" data-param="'.$row_dep["id"].'" data-pk="'.$emp_id.'" data-name="Name" data-type="text">'.$row_dep["Name"].'</span>';}else{echo '<img src="images/avatar.jpg" style="width:80px; margin-right:5px" class="profile-user-img img-circle" data-pk="'.$emp_id.'" data-pk2="'.$row_dep["id"].'" id="'.$row_dep["id"].'avatar" alt="dependant image"/> <span id="'.$row_dep["id"].'dependan" data-title="Edit Dependant Name" data-param="'.$row_dep["id"].'" data-pk="'.$emp_id.'" data-name="Name" data-type="text">'.$row_dep["Name"].'</span>';} ?></td>
    <td style="vertical-align: middle;"><span id="<?php echo $row_dep["id"];?>depend_date" data-title="Edit Dependant BirthDate" data-param="<?php echo $row_dep["id"]; ?>" data-pk="<?php echo $emp_id; ?>" data-name="dob" data-type="date" data-placement="left" data-viewformat="dd MM, yyyy" data-format="yyyy-mm-dd"><?php echo date(" jS F\, Y ", strtotime($row_dep["dob"])); ?></span></td>
    <td style="vertical-align: middle;"><?php
$birth = date_create($row_dep["dob"]);
$aged = $birth->diff(new DateTime);
if(empty($row_dep["dob"])){echo "N/A";}
elseif(($aged->y)<1){if(($aged->m)<1){echo $aged->d." days(s)";}else{echo $aged->m." month(s)";}}
else{echo $aged->y;}
?> </td>
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="3">No dependant added yet.</td></tr>
<?php	
}
?>
</tbody>
</table>
</div>

<div class="modal fade" id="myModald" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabeld"></h4>
                      </div>
                      <div class="modal-body" id="mmodal-bodykud">
                      </div>
                      <div class="modal-footer" id="mmodal-footerqd">
                      </div>
                    </div>
                  </div>
                </div>
                  </div>
	<?php }?><!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline" style="min-height:405px">

                        <select class="form-control" id="mysize" style="display:none">
                        <option value="standart" selected>Standart</option>
                          <option value="small">Small</option>
                          <option value="large">Large</option>
                        </select>
                    

<button type="button" class="btn btn-primary pull-left btn-danger" id="button" ><i class="fa fa-trash-o"></i> Delete Leave</button><button type="button" class="btn btn-primary pull-right" id="asleave" > Assign Leave</button><br>
<br><div id="del_leave"></div>
<?php
$orderl=" ORDER BY employees.rank asc, employees.employee_ID asc";
		//$sqll = "SELECT * FROM `employee_leave` WHERE YEAR(add_workday(`starting_date`,(`num_used` - 1)))=YEAR(now()) and employee_ID='".$emp_id."'";


//$sql_resultl = mysqli_query ($conn ,$sqll ) or die ('request "Could not execute SQL query" '.$sqll);
//$row = mysqli_fetch_assoc($sql_result);
?><h3>Below is the Leave Table</h3>
<table id="example1" class="table table-bordered table-hover" style="width:100%">
<thead>
<tr>
<th colspan="2">Period</th>
  <th colspan="5"><div align="center">Details</div></th>
</tr>
  <tr>
    <th>From</th>
    <th>To</strong></th>
    <th>Leave Type</th>
        <th>Entitlements (Days)</th>
        <th>Taken (Days)</th>
        <th>Balance (Days)</th>
        <th>Letter</th> 
  </tr></thead><tbody>
<?php
	while ($rowl = mysqli_fetch_assoc($sql_resultl)) {
?>
  <tr data-id="<?php echo $rowl["id"];?>">
    <td><?php echo date(" jS F\, Y ", strtotime($rowl["starting_date"])); ?></td>
    <td><?php 
		$sqlholi = "SELECT * FROM `holidays`";

		$sql_resultholi = mysqli_query ($conn ,$sqlholi ) or die ('request "Could not execute SQL query" '.$sqlholi);
		
		$holi = array();
		while($row_holiday = mysqli_fetch_array($sql_resultholi)){
			$holi[] = $row_holiday["date"];
		}
		
		
		$report_date1= date('d-m-Y', strtotime($rowl["starting_date"]. ' - 1 weekdays'));
		$report_date= date('d-m-Y', strtotime($report_date1. ' + '.$rowl["num_used"].' weekdays'));

		$counter = 0;
		foreach($holi as $key => $holi_val){
				if(date('m-d', strtotime($holi_val)) > date('m-d', strtotime($rowl["starting_date"])) && date('m-d', strtotime($holi_val)) <= date('m-d', strtotime($report_date))){		
					$counter++;
				}
		} 
		$to = date(" jS F\, Y ", strtotime($report_date. ' + '.$counter.' weekdays'));
		if($rowl["leave_type"]==1){
			echo date(" jS F\, Y ", strtotime($to. ' + 2 weekdays'));
		}
		elseif($rowl["leave_type"]==3){ 
			$maternity = $rowl["num_used"] - 1;
			echo date(" jS F\, Y ", strtotime($rowl["starting_date"]. ' + '.$maternity.' days'));
		}
		elseif($rowl["leave_type"]==4){ 
			$maternity = $rowl["num_used"] - 1;
			echo date(" jS F\, Y ", strtotime($rowl["starting_date"]. ' + '.$maternity.' days'));
		}
		else{
			echo date(" jS F\, Y ", strtotime($to));
		} 
		?>
	</td>
    <td><?php 
		$lt = "SELECT name FROM `leave_type` WHERE `id`='".$rowl["leave_type"]."'";
		$ltr = mysqli_query ($conn ,$lt ) or die ('request "Could not execute SQL query" '.$lt);
		$rlt = mysqli_fetch_assoc($ltr);
		echo $rlt["name"]; 
		?>
	</td>
    <td><?php 
		if($rowl["leave_type"]==1){
			echo $rowl["designated_leave_days"].' + 2 traveling days';
		}
		else{ 
			echo $rowl["designated_leave_days"];
		} 
		?>
	</td>
   <td><?php 
		if($rowl["leave_type"]==1){
			echo $rowl["num_used"].' + 2 traveling days';
		}
		else{
			echo $rowl["num_used"];
		} 
	   ?>
   </td>
   <td><?php echo $rowl["num_left"]; ?></td>
   <td><?php 
		if(!empty($rowl["letter"])){
			echo '<a href="'.$rowl["letter"].'" target="_blank" class="hovertext" >View Letter</a>';
		}
		else{
			echo 'No letter';
		} 
	   ?>
   </td>
</tr>
<?php } ?>
</tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                      </div>
                      <div class="modal-body" id="mmodal-bodyku">
                      </div>
                      <div class="modal-footer" id="mmodal-footerq">
                      </div>
                    </div>
                  </div>
                </div>
                  </div><!-- /.tab-pane -->
<?php if($row["rank"]==3){ ?>
<div class="tab-pane" id="contract" style="min-height:405px">Contract details <button class="btn btn-default btn-success pull-right" id="renew" onClick="open_renew();"><i class="fa fa-retweet"></i> Renew Contract</button><br>
<?php
$sql_con = "SELECT * FROM `contracts` WHERE `employee_id`='".$emp_id."' AND `due_date` < NOW()";

$result_con = mysqli_query ($conn ,$sql_con ) or die ('request "Could not execute SQL query" '.$sql_con);
?> 
<table class="table table-striped table-bordered">
  <tr>
  	<th>Appointment Date</th>
    <th>Start Date</th>
    <th>End Date</th> 
    <th>Letter</th>
  </tr>


<?php if (mysqli_num_rows($result_con)>0) {
	while ($row_con = mysqli_fetch_assoc($result_con)) {
?>
  <tr>
  	<td><?php echo date(" jS F\, Y ", strtotime($row_con["AptDate"])); ?></td>
    <td><?php echo date(" jS F\, Y ", strtotime($row_con["starting_date"])); ?></td>
    <td><?php echo date(" jS F\, Y ", strtotime($row_con["due_date"])); ?></td>
    <td><?php if(!empty($row_con["letter"])){ echo '<a href="'.$row_con["letter"].'">View Letter</a>';}else{echo 'No Letter';} ?></td>
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="2">No previous Contract(s) awarded.</td></tr>
<?php	
}
?>
</table>              <div class="modal fade" id="renModal" tabindex="-1" role="dialog" aria-labelledby="renModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="renModalLabel"></h4>
                      </div>
                      <div class="modal-body" id="renmodal-bodyku">
                      </div>
                      <div class="modal-footer" id="renmodal-footerq">
                      </div>
                    </div>
                  </div>
                </div>
                        
           </div><?php }?>
                  <div class="tab-pane" id="settings" style="min-height:405px">
                    Disciplinary files here <br><br><br><b style="text-decoration:blink">NOT YET UPDATED</b>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
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
       <!-- Modal form-->
                
                <!-- end of modal ------------------------------>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
<?php  
$sqld = "SELECT * FROM department"; 
$sql_resultd = mysqli_query ($conn ,$sqld ) or die ('request "Could not execute SQL query" '.$sqld);
 
$sqls = "SELECT * FROM section"; 
$sql_results = mysqli_query ($conn ,$sqls ) or die ('request "Could not execute SQL query" '.$sqls);
  
$sqlr = "SELECT * FROM employee_types"; 
$sql_resultr = mysqli_query ($conn ,$sqlr ) or die ('request "Could not execute SQL query" '.$sqlr);

if($row["rank"]==4){$stat = " WHERE id>5";}else{$stat = " LIMIT 5";}
$sqlap = "SELECT * FROM `appointment_status`".$stat; 
$sql_resultap = mysqli_query ($conn ,$sqlap ) or die ('request "Could not execute SQL query" '.$sqlap);

$sqlre = "SELECT * FROM employees WHERE employee_ID<>'$emp_id'"; 
$sql_resultre = mysqli_query ($conn ,$sqlre ) or die ('request "Could not execute SQL query" '.$sqlre);
?> 

<script src="plugins/datatables/datatables.min.js"></script>
 
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
     <!-- Select2 -->
    
   <script language="javascript">
(function blink() { 
    $('.blink').fadeOut(500).fadeIn(500, blink); 
})();
   $(document).on("input", "#days", function(e) {
    this.value = this.value.replace(/[^0-9\.]/g,'');
});

/* Add New Dependant */	
$('#myModald').on('hidden.bs.modal', function () {location.reload(true);
});

       $(document).on('click', '#adddep', function (){
		   
            var size=document.getElementById('mysize').value;
            var content = '<form role="form" id="contact_form" method="post"><div id="contact_results"></div><div class="form-group row"><div class="col-xs-6"><label for="leavetype">Dependant Type <span style="color:#C00">*</span></label><select class="form-control" id="dtype" required name="dtype"><option value="" disabled  selected="selected">Select Dependant Type</option><option value="Spouse">Spouse</option><option value="child">Child or Other</option></select></div><div class="col-xs-6"><label for="name">Name <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="name" placeholder="Enter Name"><div class="form-group"></div></div></div><div class="form-group row"><div class="col-xs-6"><label for="InputFile">Image Upload</label><input id="image" name="image" type="file"></div><div class="col-xs-6" id="ddob"></div></div><button type="submit" class="btn btn-default" id="addd_btn">Submit</button></form>';
            var title = 'Add New Dependant to <b><?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?></b>';
            var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            setModalBox(title,content,footer,size);
			document.getElementById('mmodal-bodykud').innerHTML=content;
            document.getElementById('myModalLabeld').innerHTML=title;
            document.getElementById('mmodal-footerqd').innerHTML=footer;
            $('#myModald').modal('show');
			
			$(document).on('change', '#dtype', function(){
    if( $(this).val()!=="Spouse"){
		$("#ddob").html('<label for="sd">Date Of Birth <span style="color:#C00">*</span></label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" required class="form-control" id="doob" placeholder="Click to select date"></div>');
    $("#ddob").show();
    }
    else{
	$("#ddob").html('');	
    $("#ddob").hide();
    }
});
			$('.input-group.date, #doob').datepicker({
    autoclose: true,
	format: 'yyyy-mm-dd',
    todayHighlight: true,
	
		});

        });
        function setModalBox(title,content,footer,$size)
        {
            
            if($size == 'large')
            {
                $('#myModald').attr('class', 'modal fade bs-example-modal-lg')
                             .attr('aria-labelledby','myLargeModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-lg');
            }
            if($size == 'standart')
            {
                $('#myModald').attr('class', 'modal fade')
                             .attr('aria-labelledby','myModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }
            if($size == 'small')
            {
                $('#myModald').attr('class', 'modal fade bs-example-modal-sm')
                             .attr('aria-labelledby','mySmallModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-sm');
            }
		}
			
			$(document).on('click', '#addd_btn', function (s){   
			   s.preventDefault();    	   
	    var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields	
			
		$("#contact_form input[required], #contact_form select[required], #contact_form textarea[required]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				$('#contact_form #contact_results').html("<div class='alert alert-danger'>");
            	$('#contact_form #contact_results > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#contact_form #contact_results > .alert-danger').append("One or more required fields are empty");
 	        $('#contact_form #contact_results > .alert-danger').append('</div>');
				proceed = false; //set do not proceed flag
			}	
		});
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var dep_data = new FormData();    
            dep_data.append( 'dtype', $('#dtype').val());
            dep_data.append( 'name', $('#name').val());
            dep_data.append( 'dob', $('#doob').val());
			dep_data.append( 'emp', '<?php echo $emp_id;?>');
			dep_data.append( 'image', $('input[name=image]')[0].files[0]);
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'depend.php',
              data: dep_data,
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
				$("#contact_form #contact_results").html(output);
              },
			  error: function(errorThrown){
        alert("There is an error with AJAX!");
    } 
            });
			

        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required], #contact_form  select[required], #contact_form textarea[required]").keyup(function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
	$('#contact_form  input[required], #contact_form  select[required], #contact_form textarea[required]').click(function () {
    $(this).css('border-color',''); 
        $("#result").slideUp();
});

/* Assign Leave */
$('#myModal').on('hidden.bs.modal', function () {location.reload(true);
});

       $(document).on('click', '#asleave', function (){
            var size=document.getElementById('mysize').value;
            var content = '<form role="form" id="contact_form" method="post"><div id="contact_results"></div><div class="form-group row"><div class="col-xs-6"><label for="sd">Year <span style="color:#C00">*</span></label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" required class="form-control" id="year" placeholder="Click to select year"></div></div><div class="col-xs-6"><label for="sd">Start Date <span style="color:#C00">*</span></label><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" required class="form-control" id="sd" placeholder="Click to select date"></div><div class="form-group"></div></div></div><div class="form-group row"><div class="col-xs-6"><label for="days">Number of Days <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="days" placeholder="Enter number of days"></div><div class="col-xs-6"><label for="leavetype">Leave Type <span style="color:#C00">*</span></label><select class="form-control" id="leavetype" required name="leavetype"><option value="" disabled  selected="selected">Select Leave Type</option><option value="1">Annual Leave</option><option value="2">Part Leave</option><option value="3">Maternity Leave</option><option value="4">Sick Leave</option></select></div></div><div class="form-group row"><div class="col-xs-6"><label for="comment">Comment</label><textarea  rows="3" cols="30" name="comment" id="comment" class="form-control" placeholder="Enter comments"></textarea></div><div class="col-xs-6"><label for="InputFile">File input</label><input id="file_attach" name="file_attach" type="file"></div></div><button type="submit" class="btn btn-default" id="submit_btn">Submit</button></form>';
            var title = 'Assign Leave to <b><?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?></b>';
            var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            setModalBox(title,content,footer,size);
			document.getElementById('mmodal-bodyku').innerHTML=content;
            document.getElementById('myModalLabel').innerHTML=title;
            document.getElementById('mmodal-footerq').innerHTML=footer;
            $('#myModal').modal('show');
			$('.input-group.date, #sd').datepicker({
    autoclose: true,
	daysOfWeekHighlighted: "0,6",
	daysOfWeekDisabled: "0,6",
	format: 'yyyy-mm-dd',
    todayHighlight: true,
	
		});
		$('#year').datepicker( {
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
	}).on('changeDate', function(e){
    $(this).datepicker('hide');
	});

        //Initialize Select2 Elements
        $(".select2").select2({
			width: 200,
			placeholder: 'Select Leave Type'});
        });
        function setModalBox(title,content,footer,$size)
        {
            
            if($size == 'large')
            {
                $('#myModal').attr('class', 'modal fade bs-example-modal-lg')
                             .attr('aria-labelledby','myLargeModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-lg');
            }
            if($size == 'standart')
            {
                $('#myModal').attr('class', 'modal fade')
                             .attr('aria-labelledby','myModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }
            if($size == 'small')
            {
                $('#myModal').attr('class', 'modal fade bs-example-modal-sm')
                             .attr('aria-labelledby','mySmallModalLabel');
                $('.modal-dialog').attr('class','modal-dialog modal-sm');
            }
		}
			
			$(document).on('click', '#submit_btn', function (s){   
			   s.preventDefault();    	   
	    var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields	
			
		$("#contact_form input[required], #contact_form select[required], #contact_form textarea[required]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				$('#contact_form #contact_results').html("<div class='alert alert-danger'>");
            	$('#contact_form #contact_results > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#contact_form #contact_results > .alert-danger').append("One or more required fields are empty");
 	        $('#contact_form #contact_results > .alert-danger').append('</div>');
				proceed = false; //set do not proceed flag
			}
			/* if($('#leavetype').val ==1){
				$('input#days').removeAttr('required');​​​​​
			}
			 */	
		});
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append( 'start', $('#sd').val());
            m_data.append( 'year', $('#year').val());
            m_data.append( 'nod', $('#days').val());
            m_data.append( 'leavetype', $('#leavetype').val());
            m_data.append( 'comment', $('#comment').val());
			m_data.append( 'emp', '<?php echo $emp_id;?>');
			m_data.append( 'letter', $('input[name=file_attach]')[0].files[0]);
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'leave.php',
              data: m_data,
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
				$("#contact_form #contact_results").html(output);
              },
			  error: function(errorThrown){
        alert("There is an error with AJAX!");
    } 
            });
			

        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required], #contact_form  select[required], #contact_form textarea[required]").keyup(function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
	$('#contact_form  input[required], #contact_form  select[required], #contact_form textarea[required]').click(function () {
    $(this).css('border-color',''); 
        $("#result").slideUp();
});

/*Renew Contract*/
$('#renModal').on('hidden.bs.modal', function () {location.reload(true);
});

$(document).on('click', '#renew', function (){
            var size=document.getElementById('mysize').value;
            var content = '<form class="form-horizontal" role="form" method="post" id="renewForm"><div id="renewResult"></div><div class="form-group"><label for="aptdate" class="col-sm-4 control-label">Appointment Date <span style="color:#C00">*</span></label><div class="col-sm-8"><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" required class="form-control" id="aptdate" placeholder="Click to select date"></div></div><div class="form-group"><label for="startdate" class="col-sm-4 control-label" style="margin-top: 13px;">Start Date <span style="color:#C00">*</span></label><div class="col-sm-7" style="margin-top: 15px; left: 4px;"><div class="input-group date"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="text" required class="form-control" id="startdate" placeholder="Click to select date"><br></div></div><div class="form-group" style="margin-top: 106px;"><label for="conLetter" class="col-sm-4 control-label">Upload Letter</label><div class="col-sm-8" style="left: 6px;"><input id="conLetter" name="conLetter" type="file"></div></div><div class="form-group"><div class="col-sm-offset-4 col-sm-8"><button type="submit" class="btn btn-default" id="btn-renew">Submit</button></div></div></form>';
            var title = "Renew <b><?php echo $row["emp_title"].' '.$row["emp_firstname"].' '.$row["emp_middlename"].' '.$row["emp_lastname"].'';?>'s</b> Contract";
            var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
            setModalBox(title,content,footer,size);
			document.getElementById('renmodal-bodyku').innerHTML=content;
            document.getElementById('renModalLabel').innerHTML=title;
            document.getElementById('renmodal-footerq').innerHTML=footer;
            $('#renModal').modal('show');
			$('.input-group.date, #aptdate').datepicker({
    autoclose: true,
	daysOfWeekHighlighted: "0,6",
	daysOfWeekDisabled: "0,6",
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
			
			$(document).on('click', '#btn-renew', function (c){ 
			   c.preventDefault();    	   
	    var goon = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields
       $("#renewForm input[required], #renewForm select[required], #renewForm textarea[required]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				$('#renewForm #renewResult').html("<div class='alert alert-danger'>");
            	$('#renewForm #renewResult > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#renewForm #renewResult > .alert-danger').append("One or more required fields are empty");
 	        $('#renewForm #renewResult > .alert-danger').append('</div>');
				goon = false; //set do not proceed flag
			}
				
		});
	   
        if(goon) //everything looks good! proceed...
        {
           //data to be sent to server         
            var ren_data = new FormData();    
            ren_data.append( 'aptdate', $('#aptdate').val());
             ren_data.append( 'startdt', $('#startdate').val());
			ren_data.append( 'emp', '<?php echo $emp_id;?>');
			ren_data.append( 'letter', $('input[name=conLetter]')[0].files[0]);
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'renew.php',
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
				$("#renewForm #renewResult").html(output);
              },
			  error: function(errorThrown){
				  		alert("There is an error with AJAX!");
    } 
            });
			

        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $(document).on('keyup', '#renewForm input[required], #renewForm  select[required], #renewForm textarea[required]' , function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
	$(document).on('click','#renewForm input[required], #renewForm select[required], #renewForm textarea[required]' , function () {
    $(this).css('border-color',''); 
        $("#result").slideUp();
});
        
        </script>
    <!-- page script -->
    <script>
	$(document).ready(function() {
    var table = $('#example1').DataTable({
		 "dom": 'lBfrtip',
		 "order": [],
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
 
    $('#example1 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
			$(this).css('background-color', '#C9302C');
			$(this).css('color', '#FFF');
			$(this).find('td').find('span').css('color', '#FFF');
        }
    } );
	
	$('#children tbody').on( 'dblclick', 'tr', function () {
        if ( $(this).hasClass('selectedd') ) {
            $(this).removeClass('selectedd');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
        }
        else {
            //table.$('tr.selected').removeClass('selected');
            $(this).addClass('selectedd');
			$(this).css('background-color', '#C9302C');
			$(this).css('color', '#FFF');
			$(this).find('td').find('span').css('color', '#FFF');
        }
    } );
	
	$(document).on('dblclick', '#spou', function () {
        if ( $(this).hasClass('selectedd') ) {
            $(this).removeClass('selectedd');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('span').css('color', '');
        }
        else {
            //table.$('tr.selected').removeClass('selected');
            $(this).addClass('selectedd');
			$(this).css('background-color', '#C9302C');
			$(this).css('color', '#FFF');
			$(this).find('span').css('color', '#FFF');
        }
    } );
 
 /*DELETE Leave ROW*/
 /* trigger delete leave row */
    $(document).on('click', '#button', function () {
		if ( $('#example1 tbody tr').hasClass('selected') ) {
            $("#del_leave").html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>Are you sure you want to delete the selected Leave? <br> <button type="button" id="yes_leave" class="btn btn-default">Yes</button><button type="button" style="margin-left:10px" id="no" class="btn btn-default" data-dismiss="alert" aria-hidden="true" title="Close">No</button></div>');
       //table.row('.selected').remove().draw( false );
        }
        else {
            $("#del_leave").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>No row selected</div>');
       //table.row('.selected').remove().draw( false );
        }
		
    } );
	
	/* Delete leave row (Ajax) */
	$(document).on('click', '#yes_leave', function (){ 	   
	    var proceed = true;
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append('emp', '<?php echo $emp_id;?>');
			$('.selected').each(function() {
				m_data.append('id[]', $(this).attr('data-id'));
			});
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'leave_del.php',
              data: m_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 
				 if(response.type == 'error'){ //load json data from server and output message     
					$("#del_leave").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>');
				}else{
					
				    $("#del_leave").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'<br></div>');
					var seconds = 2;
        setInterval(function () {
            seconds--;
            if (seconds == 0) {
                location.reload(true);
            }
        }, 1000);
					
				}   
 				 },
			  error: function(errorThrown){
				  $('#del_leave').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>');
//        alert("There is an error with AJAX!");
    } 
            });
			

        }
});	
/*END DELETE Leave ROW*/

 /*DELETE Dependant ROW*/
 /* trigger delete dependant row */
    $(document).on('click', '#dep_del_button', function () {
		if ( $('#children tbody tr, #spou').hasClass('selectedd') ) {
            $("#del_dep").html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>Are you sure you want to delete the selected Dependant? <br> <button type="button" id="yes_dep" class="btn btn-default">Yes</button><button type="button" style="margin-left:10px" id="no" class="btn btn-default" data-dismiss="alert" aria-hidden="true" title="Close">No</button></div>');
       //table.row('.selected').remove().draw( false );
        }
        else {
            $("#del_dep").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>No row selected</div>');
       //table.row('.selected').remove().draw( false );
        }
		
    } );
	
	/* Delete Dependant row (Ajax) */
	$(document).on('click', '#yes_dep', function (){ 	   
	    var proceed = true;
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append('emp', '<?php echo $emp_id;?>');
			m_data.append('id', $('.selectedd').attr('data-id'));
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'dep_del.php',
              data: m_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 
				 if(response.type == 'error'){ //load json data from server and output message     
					$("#del_dep").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>');
				}else{
					
				    $("#del_dep").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'<br></div>');
					var seconds = 2;
        setInterval(function () {
            seconds--;
            if (seconds == 0) {
                location.reload(true);
            }
        }, 1000);
					
				}   
 				 },
			  error:function(x,e) {
    if (x.status==0) {
        alert('You are offline!!\n Please Check Your Network.');
    } else if(x.status==404) {
        alert('Requested URL not found.');
    } else if(x.status==500) {
        alert('Internel Server Error.');
    } else if(e=='parsererror') {
        alert('Error.\nParsing JSON Request failed.');
    } else if(e=='timeout'){
        alert('Request Time out.');
    } else {
        alert('Unknow Error.\n'+x.responseText);
    }
} 
            });
			

        }
});	
/*END DELETE Dependant ROW*/
} );
    </script>  
    
 <!--<script src="bootstrap/js/demo.js"></script>-->
  <script type="text/javascript">
  jQuery(document).ready(function() {
$.fn.editable.defaults.mode = 'popup';
 //enable / disable
   $('#enable').click(function() {
       $('#user .editable').editable('toggleDisabled');
   });    
    
    //editables 
    $('.xedit').editable({
		   disabled: true,
		url: 'process.php',
    });
	
	$('#dependa').editable({
		disabled: true,
		url: 'process_dep.php',
         params: function(params) {
        // add additional params from data-attributes of trigger element
        params.param1 = $(this).editable().data('param');
        return params;
		}
		  
    });
	<?php $sqlddd = "SELECT * FROM `dependance` WHERE EMPID='".$emp_id."' AND type<>'Spouse'"; $sql_resultddd = mysqli_query ($conn ,$sqlddd ) or die ('request "Could not execute SQL query" '.$sqlddd); if (mysqli_num_rows($sql_resultddd)>0) {while ($row_dddep = mysqli_fetch_assoc($sql_resultddd)) { ?>
	$('#<?php echo $row_dddep["id"].'dependan'; ?>').editable({
		disabled: true,
		url: 'process_dep.php',
         params: function(params) {
        // add additional params from data-attributes of trigger element
        params.param1 = $(this).editable().data('param');
        return params;
		}
		  
    });
	
	$('#<?php echo $row_dddep["id"].'depend_date'; ?>').editable({
		disabled: true,
		url: 'process_dep.php',
		datepicker: {
            todayBtn: 'linked'
        },
         params: function(params) {
        // add additional params from data-attributes of trigger element
        params.param1 = $(this).editable().data('param');
        return params;
		}
		  
    });
	<?php }	} ?>
    
    $('#firstname').editable({
        validate: function(value) {
           if($.trim(value) == '') return 'This field is required';
        }
    });
    
    $('#sex').editable({
        prepend: "not selected",
        source: [
            {value: 1, text: 'Male'},
            {value: 2, text: 'Female'}
        ],
        display: function(value, sourceData) {
             var colors = {"": "gray", 1: "green", 2: "blue"},
                 elem = $.grep(sourceData, function(o){return o.value == value;});
                 
             if(elem.length) {    
                 $(this).text(elem[0].text).css("color", colors[value]); 
             } else {
                 $(this).empty(); 
             }
        }   
    });      
    
    $('#group').editable({
       showbuttons: false 
    });   

    $('.vacation').editable({
		disabled: true,
		url: 'process.php',
        datepicker: {
            todayBtn: 'linked'
        } 
    });  
        
    $('#dob').editable({disabled: true,});      
    
    $('#meeting_start').editable({
        format: 'yyyy-mm-dd hh:ii',    
        viewformat: 'dd/mm/yyyy hh:ii',
        validate: function(v) {
           if(v && v.getDate() == 10) return 'Day cant be 10!';
        },
        datetimepicker: {
           todayBtn: 'linked',
           weekStart: 1
        }        
    });            
    
    $('#address').editable({
		disabled: true,
		mode: 'inline',
		url: 'process.php',
        showbuttons: 'bottom'
    }); 
    
    $('#note').editable(); 
    $('#pencil').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
   });   
   
    $('.title').editable({
		disabled: true,
		ajaxOptions : {
        type : 'post'
    },
        source: [
              {value: 'Mr.', text: 'Mr.'},
              {value: 'Mrs.', text: 'Mrs.'},
              {value: 'Miss', text: 'Miss'}
           ]
    });
$('.rank').editable({
		disabled: true,
		url: 'process.php',
        source : [ 
<?php while ($rowr = mysqli_fetch_array($sql_resultr, mysqli_ASSOC)) { ?>
{ value : '<?php echo $rowr['id'];?>', text : '<?php echo $rowr['types'];?>'},<?php } ?>]
    });
	
	$('.status').editable({
		disabled: true,
		url: 'process.php',
		 inputclass: 'input-sm privacy-select',
        source : [{value:'null', text: 'Active'}, 
<?php while ($rowap = mysqli_fetch_array($sql_resultap)) {?>
{ value : '<?php echo $rowap['id'];?>', text : '<?php echo $rowap['termination_reason'];?>'},<?php } ?>],
		select2: {
            width: 200,
            placeholder: 'Select Status',
            allowClear: true
        }
    });
	
$('.section').editable({
		disabled: true,
		url: 'process.php',
        source : [ 
<?php while ($rows = mysqli_fetch_array($sql_results, mysqli_ASSOC)) { ?>
{ value : '<?php echo $rows['id'];?>', text : '<?php echo $rows['section_name'];?>'},<?php } ?>],
		select2: {
            width: 200,
            placeholder: 'Select Section',
            allowClear: true
        }
    });
	
$('.department').editable({
		disabled: true,
		url: 'process.php',
        source : [ 
<?php while ($rowd = mysqli_fetch_array($sql_resultd, mysqli_ASSOC)){ ?>
{ value : '<?php echo $rowd['id'];?>', text : '<?php echo $rowd['dpt_name'];?>'},<?php } ?>],
		select2: {
            width: 200,
            placeholder: 'Select Department',
            allowClear: true
        }
    });	  
	
	$('.reports').editable({
		disabled: true,
		url: 'process.php',
        source : [ {value: 'null', text: 'None'},
<?php while ($rowre = mysqli_fetch_array($sql_resultre, mysqli_ASSOC)){ ?>
{ value : '<?php echo $rowre['id'];?>', text : '<?php echo "".$rowre["TitleOfCourtesy"]." ".$rowre["FirstName"]." ".$rowre["Middle_name"]." ".$rowre["LastName"];?>'},<?php } ?>],
		select2: {
            width: 200,
            placeholder: 'Select Supervisor',
            allowClear: true
        }
    });	    
	
	$(function(){
            $('.box1st').on('change', ".privacy-select", function(){
            if ($(this).val() != "null") {
            $(".stat_date").show();
    }else if($('.editable-cancel').data('clicked')){$(".stat_date").hide();}else{$(".stat_date").hide();}
                
            });
        });                 
         

});

	</script> 
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!--Date Picker-->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    
    <!-- basic scripts -->
		<!--[if !IE]> -->
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		
		
		
		</script>
		<script src="assets/js/x-editable/ace-editable.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		
		<script type="text/javascript">
		jQuery(function($) {
			$.fn.editable.defaults.mode = 'inline';
			$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
										'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    


			try {//ie8 throws some harmless exceptions, so let's catch'em

				//first let's add a fake appendChild method for Image element for browsers that have a problem with this
				//because editable plugin calls appendChild, and it causes errors on IE
				try {
					document.createElement('IMG').appendChild(document.createElement('B'));
				} catch(e) {
					Image.prototype.appendChild = function(el){}
				}

				var last_gritter
				$('#avatar').editable({
					disabled: true,
					type: 'image',
					name: 'avatar',
					accept: 'image/*;capture=camcorder',
					value: null,
					image: {
						//specify ace file input plugin's options here
						btn_choose: 'Change Avatar',
						droppable: true,
						maxSize: 110000,//~100Kb

						//and a few extra ones here
						name: 'avatar',//put the field name here as well, will be used inside the custom plugin
						accept: 'image/*;capture=camcorder',
						on_error : function(error_type) {//on_error function will be called when the selected file has a problem
							if(last_gritter) $.gritter.remove(last_gritter);
							if(error_type == 1) {//file format error
								last_gritter = $.gritter.add({
									title: 'File is not an image!',
									text: 'Please choose a jpg|gif|png image!',
									class_name: 'gritter-error gritter-center'
								});
							} else if(error_type == 2) {//file size rror
								last_gritter = $.gritter.add({
									title: 'File too big!',
									text: 'Image size should not exceed 100Kb!',
									class_name: 'gritter-error gritter-center'
								});
							}
							else {//other error
							}
						},
						on_success : function() {
							$.gritter.removeAll();
						}
					},
					url: function(params) {
						// ***UPDATE AVATAR HERE*** //
						var submit_url = 'process.php';//please modify submit_url accordingly
						var deferred = null;
						var avatar = '#avatar';

						//if value is empty (""), it means no valid files were selected
						//but it may still be submitted by x-editable plugin
						//because "" (empty string) is different from previous non-empty value whatever it was
						//so we return just here to prevent problems
						var value = $(avatar).next().find('input[type=hidden]:eq(0)').val();
						if(!value || value.length == 0) {
							deferred = new $.Deferred
							deferred.resolve();
							return deferred.promise();
						}

						var $form = $(avatar).next().find('.editableform:eq(0)')
						var file_input = $form.find('input[type=file]:eq(0)');
						var pk = $(avatar).attr('data-pk');//primary key to be sent to server

						var ie_timeout = null


						if( "FormData" in window ) {
							var formData_object = new FormData();//create empty FormData object
							
							//serialize our form (which excludes file inputs)
							$.each($form.serializeArray(), function(i, item) {
								//add them one by one to our FormData 
								formData_object.append(item.name, item.value);							
							});
							//and then add files
							$form.find('input[type=file]').each(function(){
								var field_name = $(this).attr('name');
								var files = $(this).data('ace_input_files');
								if(files && files.length > 0) {
									formData_object.append(field_name, files[0]);
								}
							});

							//append primary key to our formData
							formData_object.append('pk', pk);

							deferred = $.ajax({
										url: submit_url,
									   type: 'POST',
								processData: false,//important
								contentType: false,//important
								   dataType: 'json',//server response type
									   data: formData_object
							})
						}
						else {
							deferred = new $.Deferred

							var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
							var temp_iframe = 
									$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
									frameborder="0" width="0" height="0" src="about:blank"\
									style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
									.insertAfter($form);
									
							$form.append('<input type="hidden" name="temporary-iframe-id" accept="image/*;capture=camcorder" value="'+temporary_iframe_id+'" />');
							
							//append primary key (pk) to our form
							$('<input type="hidden" name="pk" accept="image/*;capture=camcorder"/>').val(pk).appendTo($form);
							
							temp_iframe.data('deferrer' , deferred);
							//we save the deferred object to the iframe and in our server side response
							//we use "temporary-iframe-id" to access iframe and its deferred object

							$form.attr({
									  action: submit_url,
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
							});

							$form.get(0).submit();

							//if we don't receive any response after 30 seconds, declare it as failed!
							ie_timeout = setTimeout(function(){
								ie_timeout = null;
								temp_iframe.attr('src', 'about:blank').remove();
								deferred.reject({'status':'fail', 'message':'Timeout!'});
							} , 30000);
						}


						//deferred callbacks, triggered by both ajax and iframe solution
						deferred
						.done(function(result) {//success
							var res = result[0];//the `result` is formatted by your server side response and is arbitrary
							if(res.status == 'OK') $(avatar).get(0).src = res.url;
							else alert(res.message);
						})
						.fail(function(result) {//failure
							alert("There was an error");
						})
						.always(function() {//called on both success and failure
							if(ie_timeout) clearTimeout(ie_timeout)
							ie_timeout = null;	
						});

						return deferred.promise();
						// ***END OF UPDATE AVATAR HERE*** //
					},
						
					success: function(response, newValue) {
					}
				})
			}catch(e) {}
		});

					
		if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");
		</script>
        
        <script type="text/javascript">
		jQuery(function($) {
			$.fn.editable.defaults.mode = 'inline';
			$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
										'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    


			try {//ie8 throws some harmless exceptions, so let's catch'em

				//first let's add a fake appendChild method for Image element for browsers that have a problem with this
				//because editable plugin calls appendChild, and it causes errors on IE
				try {
					document.createElement('IMG').appendChild(document.createElement('B'));
				} catch(e) {
					Image.prototype.appendChild = function(el){}
				}

				var last_gritter
				$('#<?php echo $row_sp["id"];?>avatar').editable({
					disabled: true,
					type: 'image',
					name: 'avatar',
					accept: 'image/*;capture=camcorder',
					value: null,
					image: {
						//specify ace file input plugin's options here
						btn_choose: 'Change Avatar',
						droppable: true,
						maxSize: 110000,//~100Kb

						//and a few extra ones here
						name: 'avatar',//put the field name here as well, will be used inside the custom plugin
						accept: 'image/*;capture=camcorder',
						on_error : function(error_type) {//on_error function will be called when the selected file has a problem
							if(last_gritter) $.gritter.remove(last_gritter);
							if(error_type == 1) {//file format error
								last_gritter = $.gritter.add({
									title: 'File is not an image!',
									text: 'Please choose a jpg|gif|png image!',
									class_name: 'gritter-error gritter-center'
								});
							} else if(error_type == 2) {//file size rror
								last_gritter = $.gritter.add({
									title: 'File too big!',
									text: 'Image size should not exceed 100Kb!',
									class_name: 'gritter-error gritter-center'
								});
							}
							else {//other error
							}
						},
						on_success : function() {
							$.gritter.removeAll();
						}
					},
					url: function(params) {
						// ***UPDATE AVATAR HERE*** //
						var submit_url = 'process_dep.php';//please modify submit_url accordingly
						var deferred = null;
						var avatar = '#<?php echo $row_sp["id"];?>avatar';

						//if value is empty (""), it means no valid files were selected
						//but it may still be submitted by x-editable plugin
						//because "" (empty string) is different from previous non-empty value whatever it was
						//so we return just here to prevent problems
						var value = $(avatar).next().find('input[type=hidden]:eq(0)').val();
						if(!value || value.length == 0) {
							deferred = new $.Deferred
							deferred.resolve();
							return deferred.promise();
						}

						var $form = $(avatar).next().find('.editableform:eq(0)')
						var file_input = $form.find('input[type=file]:eq(0)');
						var pk = $(avatar).attr('data-pk');//primary key to be sent to server
						var pk2 = $(avatar).attr('data-pk2');

						var ie_timeout = null


						if( "FormData" in window ) {
							var formData_object = new FormData();//create empty FormData object
							
							//serialize our form (which excludes file inputs)
							$.each($form.serializeArray(), function(i, item) {
								//add them one by one to our FormData 
								formData_object.append(item.name, item.value);							
							});
							//and then add files
							$form.find('input[type=file]').each(function(){
								var field_name = $(this).attr('name');
								var files = $(this).data('ace_input_files');
								if(files && files.length > 0) {
									formData_object.append(field_name, files[0]);
								}
							});

							//append primary key to our formData
							formData_object.append('pk', pk);
							formData_object.append('pk2', pk2);

							deferred = $.ajax({
										url: submit_url,
									   type: 'POST',
								processData: false,//important
								contentType: false,//important
								   dataType: 'json',//server response type
									   data: formData_object
							})
						}
						else {
							deferred = new $.Deferred

							var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
							var temp_iframe = 
									$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
									frameborder="0" width="0" height="0" src="about:blank"\
									style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
									.insertAfter($form);
									
							$form.append('<input type="hidden" name="temporary-iframe-id" accept="image/*;capture=camcorder" value="'+temporary_iframe_id+'" />');
							
							//append primary key (pk) to our form
							$('<input type="hidden" name="pk" accept="image/*;capture=camcorder"/>').val(pk).appendTo($form);
							
							temp_iframe.data('deferrer' , deferred);
							//we save the deferred object to the iframe and in our server side response
							//we use "temporary-iframe-id" to access iframe and its deferred object

							$form.attr({
									  action: submit_url,
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
							});

							$form.get(0).submit();

							//if we don't receive any response after 30 seconds, declare it as failed!
							ie_timeout = setTimeout(function(){
								ie_timeout = null;
								temp_iframe.attr('src', 'about:blank').remove();
								deferred.reject({'status':'fail', 'message':'Timeout!'});
							} , 30000);
						}


						//deferred callbacks, triggered by both ajax and iframe solution
						deferred
						.done(function(result) {//success
							var res = result[0];//the `result` is formatted by your server side response and is arbitrary
							if(res.status == 'OK') $(avatar).get(0).src = res.url;
							else alert(res.message);
						})
						.fail(function(result) {//failure
							alert("There was an error");
						})
						.always(function() {//called on both success and failure
							if(ie_timeout) clearTimeout(ie_timeout)
							ie_timeout = null;	
						});

						return deferred.promise();
						// ***END OF UPDATE AVATAR HERE*** //
					},
						
					success: function(response, newValue) {
					}
				})
			}catch(e) {}
		});

					
		if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");
		</script>
		
	<?php $sqldd = "SELECT * FROM `dependance` WHERE EMPID='".$emp_id."' AND type<>'Spouse'"; $sql_resultdd = mysqli_query ($conn ,$sqldd ) or die ('request "Could not execute SQL query" '.$sqldd); if (mysqli_num_rows($sql_resultdd)>0) {while ($row_ddep = mysqli_fetch_assoc($sql_resultdd)) { ?>	
		
		<script type="text/javascript">
		jQuery(function($) {
			$.fn.editable.defaults.mode = 'inline';
			$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			$.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
										'<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    


			try {//ie8 throws some harmless exceptions, so let's catch'em

				//first let's add a fake appendChild method for Image element for browsers that have a problem with this
				//because editable plugin calls appendChild, and it causes errors on IE
				try {
					document.createElement('IMG').appendChild(document.createElement('B'));
				} catch(e) {
					Image.prototype.appendChild = function(el){}
				}

				var last_gritter
				$('#<?php echo $row_ddep["id"].'avatar'; ?>').editable({
					disabled: true,
					type: 'image',
					name: 'avatar',
					accept: 'image/*;capture=camcorder',
					value: null,
					image: {
						//specify ace file input plugin's options here
						btn_choose: 'Change Avatar',
						droppable: true,
						maxSize: 110000,//~100Kb

						//and a few extra ones here
						name: 'avatar',//put the field name here as well, will be used inside the custom plugin
						accept: 'image/*;capture=camcorder',
						on_error : function(error_type) {//on_error function will be called when the selected file has a problem
							if(last_gritter) $.gritter.remove(last_gritter);
							if(error_type == 1) {//file format error
								last_gritter = $.gritter.add({
									title: 'File is not an image!',
									text: 'Please choose a jpg|gif|png image!',
									class_name: 'gritter-error gritter-center'
								});
							} else if(error_type == 2) {//file size rror
								last_gritter = $.gritter.add({
									title: 'File too big!',
									text: 'Image size should not exceed 100Kb!',
									class_name: 'gritter-error gritter-center'
								});
							}
							else {//other error
							}
						},
						on_success : function() {
							$.gritter.removeAll();
						}
					},
					url: function(params) {
						// ***UPDATE AVATAR HERE*** //
						var submit_url = 'process_dep.php';//please modify submit_url accordingly
						var deferred = null;
						var avatar = '#<?php echo $row_ddep["id"].'avatar'; ?>';

						//if value is empty (""), it means no valid files were selected
						//but it may still be submitted by x-editable plugin
						//because "" (empty string) is different from previous non-empty value whatever it was
						//so we return just here to prevent problems
						var value = $(avatar).next().find('input[type=hidden]:eq(0)').val();
						if(!value || value.length == 0) {
							deferred = new $.Deferred
							deferred.resolve();
							return deferred.promise();
						}

						var $form = $(avatar).next().find('.editableform:eq(0)')
						var file_input = $form.find('input[type=file]:eq(0)');
						var pk = $(avatar).attr('data-pk');//primary key to be sent to server
						var pk2 = $(avatar).attr('data-pk2');

						var ie_timeout = null


						if( "FormData" in window ) {
							var formData_object = new FormData();//create empty FormData object
							
							//serialize our form (which excludes file inputs)
							$.each($form.serializeArray(), function(i, item) {
								//add them one by one to our FormData 
								formData_object.append(item.name, item.value);							
							});
							//and then add files
							$form.find('input[type=file]').each(function(){
								var field_name = $(this).attr('name');
								var files = $(this).data('ace_input_files');
								if(files && files.length > 0) {
									formData_object.append(field_name, files[0]);
								}
							});

							//append primary key to our formData
							formData_object.append('pk', pk);
							formData_object.append('pk2', pk2);

							deferred = $.ajax({
										url: submit_url,
									   type: 'POST',
								processData: false,//important
								contentType: false,//important
								   dataType: 'json',//server response type
									   data: formData_object
							})
						}
						else {
							deferred = new $.Deferred

							var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
							var temp_iframe = 
									$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
									frameborder="0" width="0" height="0" src="about:blank"\
									style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
									.insertAfter($form);
									
							$form.append('<input type="hidden" name="temporary-iframe-id" accept="image/*;capture=camcorder" value="'+temporary_iframe_id+'" />');
							
							//append primary key (pk) to our form
							$('<input type="hidden" name="pk" accept="image/*;capture=camcorder"/>').val(pk).appendTo($form);
							
							temp_iframe.data('deferrer' , deferred);
							//we save the deferred object to the iframe and in our server side response
							//we use "temporary-iframe-id" to access iframe and its deferred object

							$form.attr({
									  action: submit_url,
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
							});

							$form.get(0).submit();

							//if we don't receive any response after 30 seconds, declare it as failed!
							ie_timeout = setTimeout(function(){
								ie_timeout = null;
								temp_iframe.attr('src', 'about:blank').remove();
								deferred.reject({'status':'fail', 'message':'Timeout!'});
							} , 30000);
						}


						//deferred callbacks, triggered by both ajax and iframe solution
						deferred
						.done(function(result) {//success
							var res = result[0];//the `result` is formatted by your server side response and is arbitrary
							if(res.status == 'OK') $(avatar).get(0).src = res.url;
							else alert(res.message);
						})
						.fail(function(result) {//failure
							alert("There was an error");
						})
						.always(function() {//called on both success and failure
							if(ie_timeout) clearTimeout(ie_timeout)
							ie_timeout = null;	
						});

						return deferred.promise();
						// ***END OF UPDATE AVATAR HERE*** //
					},
						
					success: function(response, newValue) {
					}
				})
			}catch(e) {}
		});

					
		if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");
		</script>
		<?php }	} ?>
</body>
</html>
