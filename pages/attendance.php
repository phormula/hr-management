<?php 
error_reporting(0);
include '../../login/dbc.php';
page_protect();
include("../access.php");
include("../connection.php");

$snr = "SELECT * FROM employees WHERE employee_ID='PB0009'";

$sql_resultsnr = mysqli_query ($conn, $snr ) or die ('request "Could not execute SQL query" '.$snr);

$senior = mysqli_fetch_assoc($sql_resultsnr);

		$sql = "SELECT * FROM casuals";


$sql_result = mysqli_query ($conn, $sql ) or die ('request "Could not execute SQL query" '.$sql);
$table = "active";
$casuals_table = "active";
$casual_attendance_table = "active";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Casual Attendance - Piccadilly Biscuits Ltd.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- jQuery 2.1.4 --><script>$.noConflict();</script>
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
     <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
	<script src="../bootstrap/bootstrap-editable.js" type="text/javascript"></script>
	
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/skin-orange.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/square/_all.css">
	
	<link rel="stylesheet" type="text/css" href="../plugins/datatables/dataTables.bootstrap.css"/>
	 <!--Date Picker Css-->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <link href="../bootstrap/css/bootstrap-editable.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
   tr.empp{ cursor:pointer}
.popover2.top2 {
    margin-top: -10px;
}
.fade2.in2 {
    opacity: 1;
}
.popover2 {
    top: 0;
    left: 0;
    max-width: 276px;
    padding: 10px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: left;
    white-space: normal;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
}
.fade2 {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}
.popover2.top2 > .arrow2 {
    top: 50%;
	left: -11px;
	margin-top: -11px;
	border-right-color: #999;
	border-right-color: rgba(0,0,0,.25);
	border-left-width: 0;
}
.popover2 > .arrow2 {
    border-width: 11px;
}
.popover2 > .arrow2, .popover2 > .arrow2::after {
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}

.popover3.top3 {
    margin-top: -10px;
}
.fade3.in3 {
    opacity: 1;
}
.popover3 {
    top: 0;
    left: 0;
    max-width: 276px;
    padding: 10px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: left;
    white-space: normal;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
}
.fade3 {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}
.popover3.top3 > .arrow3 {
    top: 50%;
	left: -11px;
	margin-top: -11px;
	border-right-color: #999;
	border-right-color: rgba(0,0,0,.25);
	border-left-width: 0;
}
.popover3 > .arrow3 {
    border-width: 11px;
}
.popover3 > .arrow3, .popover3 > .arrow3::after {
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}
#numpresent{
	color: #4CAF50;
}
#numabsent{
	color: #B63221;
}
#numexcuse{
	color: #B2D4E4;
}
#numpermission{
	color: #EB92A4;
}
.numbers{
	
}
   </style> 
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <?php include("idle.php"); ?>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("../header.php");?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <?php include("../menu.php"); ?>
	  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Attendance
            <small>Register</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Table View</a></li>
            <li class="active">All Casuals</li>
          </ol>
        </section>

        <!-- Main content -->
       <section class="content" id="user">
          <div class="row">
            <div class="col-xs-12">
           <!-- /.box -->

              <div class="box">
                <div class="box-header">
                  <div class="numbers"><h3><span>Present: <span id="numpresent">0</span></span><span style="margin-left:10%">Absent: <span id="numabsent">0</span></span><span style="margin-left:10%">Excused Duty: <span id="numexcuse">0</span></span><span style="margin-left:10%">Permission: <span id="numpermission">0</span></span></h3></div><br>
<div class="col-lg-8"><button type="button" class="btn btn-primary" id="asleave" > Add Casual</button><button class="btn btn-default" id="refresh" style="margin-left: 30px;"><i class="fa fa-refresh"></i> Refresh Page</button><button id="enable" class="btn btn-primary" style="margin-left: 30px; width: 21%;"><i class="fa fa-edit"></i> <b>Edit</b></button><button type="button" class="btn btn-danger" style="margin-left:30px" id="del_button"><i class="fa fa-trash-o"></i> Delete Casual</button></div> <div class="col-lg-4"><div class="form-group">
                      <label for="dt" class="col-sm-2 control-label">Date</label>
                      <div class="col-sm-10">
                        <input class="form-control" readonly style="background: #FFF;" id="dt" placeholder="Click to Select Date" type="text">
                      </div>
                    </div></div>
<!-- modal div -->
<select class="form-control" id="mysize" style="display:none">
                        <option value="standart" selected>Standart</option>
                          <option value="small">Small</option>
                          <option value="large">Large</option>
                        </select>
						
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
			<!-- modal div -->	
<script type="text/javascript">		
  $('#refresh').click(function() {
	  var re_data = new FormData();    
	re_data.append('atdate', '0000-00-00');
			 
	//instead of $.post() we are using $.ajax()
	//that's because $.ajax() has more options and flexibly.
  	$.ajax({
        url: 'cas_del.php',
        data: re_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'json',
        success: function(response){
				if(response.type != 'good'){
					alert(response.text);
				}
				else{
				window.location = window.location.href;
				}
		},
		error: function(errorThrown){
				alert("There is an error with AJAX!");
			} 
    });
}); 


</script>
                </div><!-- /.box-header -->
               
                <div class="box-body table-responsive" id="tablev">
				<div id="del_cas"></div>
         <table id="example1" class="table table-responsive table-bordered table-hover">
                   <thead>
  <tr>
  <th>Employee ID</th>
  <th>Name</th>
  <th>Present</th>
  <th>Excused Duty</th> 
  <th>Permission</th> 
  </tr>
  </thead>
  </table>
	  
      
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
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
<!-- DataTables -->
    <script src="../plugins/datatables/datatables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
   
    <!--Date Picker-->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript">	
function reload(){   
	$.fn.editable.defaults.mode = 'inline';
	$('.xedit').editable({
			disabled: true,
			url: 'editable.php',
	});

	//iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red, #excuse, #present, #permission').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_minimal-red',
		  increaseArea: '20%'
        });	
		
		if($('#dt').val().length > 0){
					$('input[type="checkbox"]').iCheck('enable');
		}
		else{
			$('input[type="checkbox"]').iCheck('disable');
		}

	$(document).on('change', '#dt', function (){
		if($('#dt').val().length > 0){
			$('input[type="checkbox"]').iCheck('enable');
		}
		else{
			$('input[type="checkbox"]').iCheck('disable');
		}
	});
	
	$(document).on('ifChecked', '#present', function (){
		var casid = $(this).closest('td').prev('td').prev('td').find('p').html();
		var excuse = $(this).closest('td').next('td').find('#excuse');
		var permission = $(this).closest('td').next('td').next('td').find('#permission');
		$ppp = $(this).closest('td').find('div#ppp');
		setTimeout(function() {
			$($ppp).fadeOut("slow");
			$($ppp).html('');
		}, 1500);
		
		var e_data = new FormData();    
		e_data.append('casid', casid);
		e_data.append('date', $("input#dt").val());
		e_data.append('present', '1');
		
		$(excuse).iCheck('disable');
		$(permission).iCheck('disable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($ppp).show();
						$($ppp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:120px"><button type="button" class="close arrow23" data-dismiss="alert" aria-hidden="true" title="Close">&times</button><div style="top: 50%;" class="arrow2"></div><b>Marked Present</b></div>');
						$('#numpresent').html(response.num);
					}
					/* else{
						alert(response.text);
					} */					
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });	
    });
	
	$(document).on('ifUnchecked', '#present', function (){
		var casid = $(this).closest('td').prev('td').prev('td').find('p').html();
		var excuse = $(this).closest('td').next('td').find('#excuse');
		var permission = $(this).closest('td').next('td').next('td').find('#permission');
		$ppp = $(this).closest('td').find('div#ppp');
		setTimeout(function() {
			$($ppp).fadeOut("slow");
			$($ppp).html('');
		}, 1500);
		
		var e_data = new FormData();    
		e_data.append('casid', casid);
		e_data.append('date', $("input#dt").val());
		e_data.append('present', '0');
		
		$(excuse).iCheck('enable');
		$(permission).iCheck('enable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($ppp).show();
						$($ppp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:180px"><div style="top: 50%;" class="arrow2"></div><b>Marked Absent</b></div>');
						$('#numpresent').html(response.num);
					}
					/* else{
						alert(response.text);
					}  */  
 			},
			error: function(errorThrown){
					alert("There is an error with AJAX!");
			} 
        });	
    });

	$(document).on('ifChecked', '#excuse', function (){
		var casid = $(this).closest('td').prev('td').prev('td').prev('td').find('p').html();
		var present = $(this).closest('td').prev('td').find('#present');
		var permission = $(this).closest('td').next('td').find('#permission');
		$popp = $(this).closest('td').find('div#popp');
		setTimeout(function() {
			$($popp).fadeOut("slow");
		}, 1500);
		
		var e_data = new FormData();    
		e_data.append('casid', casid);
		e_data.append('date', $("input#dt").val());
		e_data.append('excuse', '1');
		
		$(present).iCheck('disable');
		$(permission).iCheck('disable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($popp).show();
						$($popp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:120px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button><div style="top: 50%;" class="arrow2"></div><b>Excused Duty</b></div>');
						$('#numexcuse').html(response.num);
					}
					/* else{
						alert(response.text);
					} */   
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });	
    });
	
	$(document).on('ifUnchecked', '#excuse', function (){
		var casid = $(this).closest('td').prev('td').prev('td').prev('td').find('p').html();
		var present = $(this).closest('td').prev('td').find('#present');
		var permission = $(this).closest('td').next('td').find('#permission');
		$popp = $(this).closest('td').find('div#popp');
		setTimeout(function() {
			$($popp).fadeOut("slow");
		}, 1500);
		
		var e_data = new FormData();    
		e_data.append('casid', casid);
		e_data.append('date', $("input#dt").val());
		e_data.append('excuse', '0');
		
		$(present).iCheck('enable');
		$(permission).iCheck('enable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($popp).show();
						$($popp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:180px"><div style="top: 50%;" class="arrow2"></div><b>Excused Duty Undone</b></div>');
						$('#numexcuse').html(response.num);
					}
					/* else{
						alert(response.text);
					} */   
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });	
    });
	
	$(document).on('ifChecked', '#permission', function (){
		var casidp = $(this).closest('td').prev('td').prev('td').prev('td').prev('td').find('p').html();
		var presentp = $(this).closest('td').prev('td').prev('td').find('#present');
		var excusep = $(this).closest('td').prev('td').find('#excuse');
		$pppp = $(this).closest('td').find('div#pppp');
		setTimeout(function() {
			$($pppp).fadeOut("slow");
		}, 1500);
		
		var p_data = new FormData();    
		p_data.append('casid', casidp);
		p_data.append('date', $("input#dt").val());
		p_data.append('permission', '1');
		
		$(presentp).iCheck('disable');
		$(excusep).iCheck('disable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: p_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($pppp).show();
						$($pppp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:130px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button><div style="top: 50%;" class="arrow2"></div><b>Permission granted</b></div>');
						$('#numpermission').html(response.num);
					}
					/* else{
						alert(response.text);
					}  */  
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });	
    });
	
	$(document).on('ifUnchecked', '#permission', function (){
		var casid = $(this).closest('td').prev('td').prev('td').prev('td').prev('td').find('p').html();
		var present = $(this).closest('td').prev('td').prev('td').find('#present');
		var excuse = $(this).closest('td').prev('td').find('#excuse');
		$pppp = $(this).closest('td').find('div#pppp');
		setTimeout(function() {
			$($pppp).fadeOut("slow");
		}, 1500);
		
		var e_data = new FormData();    
		e_data.append('casid', casid);
		e_data.append('date', $("input#dt").val());
		e_data.append('permission', '0');
		
		$(present).iCheck('enable');
		$(excuse).iCheck('enable');
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'mark.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'available'){ //load json data from server and output message   
						$($pppp).show();
						$($pppp).html('<div class="popover2 fade2 top2 in2" style="z-index: 1060;display: block;position: absolute; margin-left: 30px; padding-top: 1px; width:180px"><div style="top: 50%;" class="arrow2"></div><b>Permission Cancelled</b></div>');
						$('#numpermission').html(response.num);
					}
					/* else if(response.type == 'error'){
						alert(response.text);
					} */   
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });	
    });
}    

$(document).ready(function() {
	//Datatable
	var table = $("#example1").DataTable({
		"dom": 'lBfrtip',
		"lengthMenu": [[10, 20, 50, 250, 500, 1000], [10, 20, 50, 250, 500, 1000]],
		"iDisplayLength": 10,
		"oLanguage": {"sEmptyTable":  "No Casual found" },
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
        ],
		"bProcessing": true,
        "serverSide": true,
        "ajax":{
			url :"response.php", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            error:	function(){
					$("#example1_processing").css("display","none");
            }
        },
		"drawCallback": function(settings) {
						console.log(settings.json);
						reload();	
		},
	});

	$(document).on('click', 'button.close.arrow23', function(e){
		e.preventDefault;
		$(this).remove();
	});
		
	$('#example1 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
        }
        else {
			var editt = $(this).find('span');
			if ( $(editt).hasClass('editable-disabled') ) {
				$(this).addClass('selected');
			$(this).css('background-color', '#C9302C');
			$(this).css('color', '#FFF');
			$(this).find('td').find('span').css('color', '#FFF');
			}
            else{
            $(this).removeClass('selected');            
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
			}
		}
    });
	
	$(document).on('click', '#enable', function() {
		$('#user .editable').editable('toggleDisabled');
		$('#example1 tbody tr').each( function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
			$(this).css('background-color', '');
			$(this).css('color', '');
			$(this).find('td').find('span').css('color', '');
        }
		});
	}); 
	
	 /*DELETE Casual*/
 /* trigger delete Casual */
    $(document).on('click', '#del_button', function () {
		if ( $('#example1 tbody tr').hasClass('selected') ) {
            $("#del_cas").html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>Are you sure you want to delete detail for <b>'+$('.selected').find('td:nth-child(2)').html()+'</b>? <br> <button type="button" id="yes_cas" class="btn btn-default">Yes</button><button type="button" style="margin-left:10px" id="no" class="btn btn-default" data-dismiss="alert" aria-hidden="true" title="Close">No</button></div>');
		}
        else {
            $("#del_cas").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>No Casual selected<br>Please Select a Casual to delete in the list!!!</div>');
        }
		
    });

//Cancel Casual delete
	$(document).on('click', '#no', function (){ 
		$('#example1 tbody tr').each( function () {
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
				$(this).css('background-color', '');
				$(this).css('color', '');
				$(this).find('td').find('span').css('color', '');
			}
		});
	});
	
	/* Confirm Delete Casual (Ajax) */
	$(document).on('click', '#yes_cas', function (){ 	   
	    var proceed = true;
       
        if(proceed){ //everything looks good! proceed...
   
           //data to be sent to server         
            var del_data = new FormData(); 
			var casualid = $('.selected').find('td:first p').html();
			del_data.append('cid', casualid);
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
				url: 'cas_del.php',
				data: del_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'json',
				success: function(response){
					 
					if(response.type == 'error'){ //load json data from server and output message     
						$("#del_cas").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>');
					}
					else{
						$("#del_cas").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'<br>Refreshing Table list in <b id="lblCount" style="text-transform:uppercase"></b></div>');
						
						var seconds = 5;
						$("#lblCount").html(seconds);
						setInterval(function () {
							seconds--;
							$("#lblCount").html(seconds);
							if (seconds == 0) {
								$("#del_cas").html('');
								table.row('.selected').remove().draw( false );
							}
						}, 1000);
						
					}   
				},
				error: function(errorThrown){
					$('#del_cas').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>');
				} 
            });
			
        }
	});	
/*END DELETE Casual*/
	   
	$(document).on('change', '#dt', function (){
		var e_data = new FormData();    
		e_data.append('atdate', $("input#dt").val());
			 
		//instead of $.post() we are using $.ajax()
		//that's because $.ajax() has more options and flexibly.
  		$.ajax({
            url: 'cas_del.php',
            data: e_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){     
					if(response.type == 'good'){ //load json data from server and output message   
						$('#numpresent').html(response.present);   
						$('#numexcuse').html(response.excuse);   
						$('#numpermission').html(response.permission);   
						$('#numabsent').html(response.absent);
						table.ajax.reload();
					}
					else{
						alert(response.text);
					}
 			},
			error: function(errorThrown){
				 /* $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>'); */
					alert("There is an error with AJAX!");
			} 
        });
    }); 

	var re_data = new FormData();    
	re_data.append('atdate', '0000-00-00');
			 
	//instead of $.post() we are using $.ajax()
	//that's because $.ajax() has more options and flexibly.
  	$.ajax({
        url: 'cas_del.php',
        data: re_data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'json',
        success: function(response){
					if(response.type != 'good'){
						alert(response.text);
					}
		},
		error: function(errorThrown){
				alert("There is an error with AJAX!");
			} 
    });
	
});

	$('#dt').datepicker({
    autoclose: true,
    todayHighlight: true,
	changeyear:	true,
	clearBtn: true,
	format: "yyyy-mm-dd"
		});
    </script>
	
<script language="javascript">
	$(document).on('click', '#asleave', function (){
		var size=document.getElementById('mysize').value;
		var content = '<form role="form" class="addnew" id="contact_form" method="post"><div id="contact_results"></div><legend></legend><div class="form-group"><div class="col-xs-6"><label>Full Name <span style="color:#C00">*</span></label><div class="input-group date"><input type="text" required class="form-control" style="width: 159%;" id="fname" placeholder="Enter Full Name"></div></div><div class="col-xs-6"><label for="days">Department <span style="color:#C00">*</span></label><input type="text" required class="form-control" id="dpt" placeholder="Enter Department"></div></div><br><br><div class="form-group"><div class="col-xs-6" style="margin-top: 27px;"><button type="submit" class="btn btn-default" id="submit_btn">Submit</button></div></div></form>';
		var title = '<b style="color:#C00">Create New Casual</b>';
		var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		setModalBox(title,content,footer,size);
		document.getElementById('mmodal-bodyku').innerHTML=content;
		document.getElementById('myModalLabel').innerHTML=title;
		document.getElementById('mmodal-footerq').innerHTML=footer;
		$('#myModal').modal('show');
				
	});

	function setModalBox(title,content,footer,$size){
            
        if($size == 'large'){
            $('#myModal').attr('class', 'modal fade bs-example-modal-lg')
                         .attr('aria-labelledby','myLargeModalLabel');
            $('.modal-dialog').attr('class','modal-dialog modal-lg');
        }
        if($size == 'standart'){
            $('#myModal').attr('class', 'modal fade')
                         .attr('aria-labelledby','myModalLabel');
            $('.modal-dialog').attr('class','modal-dialog');
        }
        if($size == 'small'){
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
		});
       
        if(proceed) //everything looks good! proceed...
        {
           //data to be sent to server         
            var m_data = new FormData();    
            m_data.append( 'fname', $('#fname').val());
            m_data.append( 'dpt', $('#dpt').val());
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
				url: 'casual.php',
				data: m_data,
				processData: false,
				contentType: false,
				type: 'POST',
				dataType:'json',
				success: function(response){
                 
					 //load json data from server and output message     
					if(response.type == 'error'){ //load json data from server and output message     
						output = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>';
					}
					else{
						output = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>';
					}
					$("#contact_form #contact_results").html(output);
					$("#contact_form").find("input").val("");
				},
				error:  function(errorThrown){
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
</script>	
</body>
</html>
