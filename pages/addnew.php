<?php
error_reporting(0);
/* include '../../login/dbc2.php';
page_protect();
include("../access.php"); */
include("../connection.php");

$snr = "SELECT * FROM employees WHERE employee_ID='PB0009'";

$sql_resultsnr = mysqli_query ($conn ,$snr ) or die ('request "Could not execute SQL query" '.$snr);

$senior = mysqli_fetch_assoc($sql_resultsnr);

if($_REQUEST["year"]){
	$order=" ORDER BY no_of_years desc, employees.rank asc, employees.employee_ID asc";
	$add_years = ", YEAR(NOW())-YEAR(HireDate) AS no_of_years, ABS(month(now()) - month(`HireDate`)) as month, ABS(day(now()) - day(`HireDate`)) as day";
	}

if ($_REQUEST["string"]<>'') {
	$search_string = " AND (FirstName LIKE '%".mysqli_real_escape_string($conn ,$_REQUEST["string"])."%' OR LastName LIKE '%".mysqli_real_escape_string($conn ,$_REQUEST["string"])."%' OR Middle_name LIKE '%".mysqli_real_escape_string($conn ,$_REQUEST["string"])."%')";	
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
}
if ($_REQUEST["department"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_city = " AND employees.department='".mysqli_real_escape_string($conn ,$_REQUEST["department"])."'";	
}

if ($_REQUEST["rank"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_rank = " AND employees.rank='".mysqli_real_escape_string($conn ,$_REQUEST["rank"])."'";	
}


if ($_REQUEST["section"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$search_section = " AND section='".mysqli_real_escape_string($conn ,$_REQUEST["section"])."'";	
}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT * FROM employees".$add_years." WHERE Hiredate >= '".mysqli_real_escape_string($conn ,$_REQUEST["from"])."' AND to_date <= '".mysqli_real_escape_string($conn ,$_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["from"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT employees.employee_ID, employees.FirstName, employees.LastName, employees.Position, department.dpt_name".$add_years." FROM employees INNER JOIN department ON employees.department=department.id WHERE HireDate = '".mysqli_real_escape_string($conn ,$_REQUEST["from"])."' OR Year(`HireDate`)='".mysqli_real_escape_string($conn ,$_REQUEST["from"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["to"]<>'') {
	$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
	$sql = "SELECT * FROM employees".$add_years." WHERE to_date <= '".mysqli_real_escape_string($conn ,$_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if($_REQUEST["retire_yr"] <>''){
	$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE Year(DATE_ADD(`BirthDate`,INTERVAL 60 YEAR))='".mysqli_real_escape_string($conn ,$_REQUEST["retire_yr"])."' AND employees.apt_status is null".$search_string.$search_city.$search_section.$search_rank.$order;
	}else {
		$order=" ORDER BY employees.rank asc, employees.employee_ID asc";
		$sql = "SELECT employees.employee_ID, employees.TitleOfCourtesy, employees.FirstName, employees.Middle_name, employees.LastName, employees.Position, employees.PhotoPath, department.dpt_name, section.section_name ".$add_years." FROM employees INNER JOIN department ON employees.department=department.id INNER JOIN section ON employees.section=section.id WHERE employees.apt_status is null".$search_string.$search_city.$search_section.$search_rank.$order;
}

$sql_result = mysqli_query ($conn ,$sql ) or die ('request "Could not execute SQL query" '.$sql); 

$addnew = "active";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add New Employee</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
     <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
	 <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
 
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
    <!--Date Picker Css-->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <style type="text/css">
	.mar-top{margin-top:20px}
	</style>
    <!-- fonts -->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />
		
		
		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->
        <!-- include BlockUI -->
<script src="../../login/js/jquery.blockUI.js"></script>
  <?php include("idle.php"); ?>
<script>
$(document).ready(function() {

    $('#submit').click(function() { 
        $.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
 
        setTimeout($.unblockUI, 800); 
    }); 
}); </script>
  <script>
  $(document).ready(function() {

$(document).on("input", "#lname", function (){
				var m_data = new FormData();    
            m_data.append('fname', $("input#fname").val());
			m_data.append('lname', $("#lname").val());
			 
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and flexibly.
  			$.ajax({
              url: 'check.php',
              data: m_data,
              processData: false,
              contentType: false,
              type: 'POST',
              dataType:'json',
              success: function(response){
                 
				 if(response.type == 'available'){ //load json data from server and output message     
					$("#success").html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+response.text+'</div>');
				}   
 				 },
			  error: function(errorThrown){
				  $('#success').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>A server error has occured</div>');
//        alert("There is an error with AJAX!");
    } 
            });
			});
});
</script>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php include("../header.php"); ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
       <?php include("../menu.php"); ?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add New Employee
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> 
            <li class="active">Add New</li>
          </ol>
        </section>

        <!-- Main content -->
         <section class="content">
          <div class="row">
            <div class="col-xs-12">
           <!-- /.box -->

              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Fill out the form to add new <b>employee</b></h3><br>

                </div><!-- /.box-header -->
               
                <div class="box-body">
                <!--<div class="row">-->
       <form  name="sentMessage" class="well" id="myform" method="post" action="process.php">
<div class="row">
<div class="col-md-12"><div class="col-xs-11">
                    <button type="submit" id="submit" class="btn btn-primary">Add Employee</button> &nbsp;&nbsp;<button class="btn btn-default" type="reset">Reset</button><legend>&nbsp;</legend>
                    </div></div>
                <div class="col-md-12">
                
                <div id="success"> </div>
                  <div class="form-group">
                    <legend>Name</legend>
                    <div class="col-xs-2">
                    <select id="toc" class="form-control select2" required name="toc" style="width:100%" data-placeholder="Select Title" data-allow-clear="true">
<option value="" disabled  selected="selected">Select Title</option>
<option value="Mr.">Mr.</option>   
<option value="Mrs.">Mrs.</option>
<option value="Miss">Miss</option>
				</select>
                </div>
                    <div class="col-xs-3">
                    <input type="text" class="form-control" placeholder="First" id="fname" required/>
                       </div>
                       <div class="col-xs-4">
                       <input type="text" class="form-control" placeholder="Middle" id="mname"/>
                       </div>
                       <div class="col-xs-3">
                       <input type="text" class="form-control" placeholder="Last" id="lname" required/>
                       </div>
                  </div><!-- /.form-group -->
                  <div class="form-group">
                    <legend>&nbsp;</legend>
                    <div class="col-xs-3"><label>Socail Security Number</label>
                    <input type="text" class="form-control" placeholder="Enter Socail Security Number" id="ssid"/></div>
                    <div class="col-xs-3"><label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" id="email"/></div>
                       <div class="col-xs-3"><label>Phone Number</label>
                    <input type="text" class="form-control" placeholder="Enter Phone number" id="phone" /></div>
                       <div class="col-xs-3"><label>Date of Birth</label>
                    <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div><input type="text" class="form-control" placeholder="Enter Date of Birth" 
			   	            id="dob" required/></div>
                  </div></div><!-- /.form-group -->
                  <div class="form-group">
<?php  
$sqld = "SELECT * FROM department"; 
$sql_resultd = mysqli_query ($conn ,$sqld ) or die ('request "Could not execute SQL query" '.$sqld);
?> 
				<legend>&nbsp;</legend>
                    <div class="col-xs-4"><label>Department</label>
				<select id="department" data-placeholder="Select Department" data-allow-clear="true" class="form-control select2" required name="department" style="width:100%" >
                <option value="" disabled  selected="selected">Select Department</option>
<?php 
while ($rowd = mysqli_fetch_array($sql_resultd)) 
{ ?> 
				<option value="<?php echo $rowd['id'];?>"> 
<?php echo $rowd['dpt_name'];?> 
				</option>   
<?php } ?> 
				</select>
                </div>
<?php  
$sqls = "SELECT * FROM section"; 
$sql_results = mysqli_query ($conn ,$sqls ) or die ('request "Could not execute SQL query" '.$sqls);
?>
                    <div class="col-xs-4"><label>Section</label>
                    <select class="form-control select2" id="section" data-placeholder="Select Section" data-allow-clear="true" required name="section" style="width:100%">
                 <option value="" disabled  selected="selected">Select Section</option>   
<?php 
while ($rows = mysqli_fetch_array($sql_results)) 
{ ?> 
					<option value="<?php echo $rows['id'];?>"> 
<?php echo $rows['section_name'];?> 
					</option>   
<?php } ?> 
					</select></div>
					<?php  
$sqlr = "SELECT * FROM employee_types"; 
$sql_resultr = mysqli_query ($conn ,$sqlr ) or die ('request "Could not execute SQL query" '.$sqlr);
?> 
					<div class="col-xs-4"><label>Rank</label>
					<select class="form-control select2" id="rank" required name="rank" data-placeholder="Select Rank" data-allow-clear="true" style="width:100%"> 
                    <option value="" disabled  selected="selected">Select Rank</option>
<?php 
while ($rowr = mysqli_fetch_array($sql_resultr)) 
{ ?> 
					<option value="<?php echo $rowr['id'];?>"> 
<?php echo $rowr['types'];?>
					</option>   
<?php } ?> 
					</select>
                    </div>
                    
                    <div class="col-xs-4 mar-top"><label>Position</label>
					<input type="text" class="form-control" placeholder="Enter Employee's Position" id="position" required/>
                    </div>
                    
                    <div class="col-xs-4 mar-top"><label>Appointment Date</label>
                    <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
					<input type="text" class="form-control" placeholder="Select Appointment Date" id="apd" required/>
                    </div></div>
                    <div class="col-xs-4 mar-top"><label>Start Date</label>
                    <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
					<input type="text" class="form-control" placeholder="Select Start Date" id="sd" required/>
                    </div></div>
                    <div class="form-group">
                    <?php  
$sqle = "SELECT * FROM employees"; 
$sql_resulte = mysqli_query ($conn ,$sqle ) or die ('request "Could not execute SQL query" '.$sqle);
?> 
					<div class="col-xs-4 mar-top"><label>Reports To</label>
					<select class="form-control select2" id="report" data-placeholder="Select Supervisor" data-allow-clear="true" name="report" style="width:100%"> 
                    <option value="" disabled  selected="selected">Select Supervisor</option>
<?php 
while ($rowe = mysqli_fetch_array($sql_resulte)) 
{ ?> 
					<option value="<?php echo $rowe['id'];?>"><?php echo $rowe["FirstName"]." ".$rowe["Middle_name"]." ".$rowe["LastName"];?>  
					</option>   
<?php } ?> 
					</select>
                    </div>
                    <div class="col-xs-4 mar-top">
                    <label>Upload Image</label>
                    <input  type="file" name="avatar" />
                    </div>
                    <div class="col-xs-4 mar-top">
                    <label>Address</label>
                    <textarea class="form-control" id="address" placeholder="Enter Residential Address"></textarea>
                    </div>
                    
                    
                    
				 </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div>
              </div>
            </form>
            <!--</div>-->
                
                <div class="col-sm-offset-3 col-sm-6">
      
	</div>
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

      
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    
     <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!--Date Picker-->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    
    <script>
	$('#dob, #apd, #sd').datepicker({
    autoclose: true,
    todayHighlight: true,
	changeyear:	true,
	format: "yyyy-mm-dd"
		});
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
       
      });
	  $("#phone").inputmask({"mask": "999-999 9999"});
		 if ($("#phone").inputmask("isComplete")){
    			$("#submit_btn").removeAttr("disabled");
  			}
    </script>
    <!-- basic scripts -->
		<!--[if !IE]> -->
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		
		<!-- ace scripts -->
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="../assets/js/ace-elements.min.js"></script>
		
		<script type="text/javascript">
				jQuery(function($) {
				
				var $form = $('#myform');
				//you can have multiple files, or a file input with "multiple" attribute
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;

				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Select or drop files here',
					btn_change: null,
					droppable: true,
					thumbnail: 'large',
					
					maxSize: 110000,//bytes
					allowExt: ["jpeg", "jpg", "png", "gif"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],

					before_remove: function() {
						if(upload_in_progress)
							return false;//if we are in the middle of uploading a file, don't allow resetting file input
						return true;
					},

					preview_error: function(filename , code) {
						//code = 1 means file load error
						//code = 2 image load error (possibly file is not an image)
						//code = 3 preview failed
					}
				})
				file_input.on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
					if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
					
					//you can reset previous selection on error
					//ev.preventDefault();
					//file_input.ace_file_input('reset_input');
				});
				
				
				var ie_timeout = null;//a time for old browsers uploading via iframe
				
				$form.on('submit', function(e) {
					e.preventDefault();
				
					 var name = $("input#fname").val();  
       var email = $("input#email").val(); 
       var msg = $("textarea#message").val();
        var firstName = name; // For Success/Failure Message
           // Check for white space in name for Success/Fail message
        if (firstName.indexOf(' ') >= 0) {
	   firstName = name.split(' ').slice(0, -1).join(' ');
         } 
					var files = file_input.data('ace_input_files');
					if( !files || files.length == 0 ) {files = null;
						};//no files selected
										
					var deferred ;
					if( "FormData" in window ) {
						//for modern browsers that support FormData and uploading files via ajax
						//we can do >>> var formData_object = new FormData($form[0]);
						//but IE10 has a problem with that and throws an exception
						//and also browser adds and uploads all selected files, not the filtered ones.
						//and drag&dropped files won't be uploaded as well
						
						//so we change it to the following to upload only our filtered files
						//and to bypass IE10's error
						//and to include drag&dropped files as well
						formData_object = new FormData();//create empty FormData object
						
						//serialize our form (which excludes file inputs)
						$.each($form.serializeArray(), function(i, item) {
							//add them one by one to our FormData 
							formData_object.append(item.name, item.value);							
						});
						//and then add files
						$form.find('input[type=file]').each(function(){
							var field_name = $(this).attr('name');
							//for fields with "multiple" file support, field name should be something like `myfile[]`

							var files = $(this).data('ace_input_files');
							if(files && files.length > 0 ) {
								for(var f = 0; f < files.length; f++) {
									formData_object.append(field_name, files[f]);
								}
							}
							
						});
						
								formData_object.append('toc', $("#toc").select2("val"));
						formData_object.append('fname', $("input#fname").val());
								formData_object.append('mname', $("input#mname").val());
						formData_object.append('lname', $("#lname").val());
						formData_object.append('ssid', $("#ssid").val());
								formData_object.append('email', $("input#email").val());
								formData_object.append('phone', $("input#phone").val());
								formData_object.append('dddd', $("input#dob").val());
								formData_object.append('department', $("#department").select2("val"));
								formData_object.append('section', $("#section").select2("val"));
								formData_object.append('rank', $("#rank").select2("val"));
								formData_object.append('position', $("input#position").val());
								formData_object.append('apd', $("input#apd").val());
								formData_object.append('sd', $("input#sd").val());
								formData_object.append('report', $("#report").select2("val"));
								formData_object.append('address', $("textarea#address").val());
	

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);
						
						deferred = $.ajax({
							        url: $form.attr('action'),
							       type: $form.attr('method'),
							processData: false,//important
							contentType: false,//important
							   dataType: 'json',
							       data: formData_object,
								   
							/**
							,
							xhr: function() {
								var req = $.ajaxSettings.xhr();
								if (req && req.upload) {
									req.upload.addEventListener('progress', function(e) {
										if(e.lengthComputable) {	
											var done = e.loaded || e.position, total = e.total || e.totalSize;
											var percent = parseInt((done/total)*100) + '%';
											//percentage of uploaded file
										}
									}, false);
								}
								return req;
							},
							beforeSend : function() {
							},
							success : function() {
							}*/
						})

					}
					else {
						//for older browsers that don't support FormData and uploading files via ajax
						//we use an iframe to upload the form(file) without leaving the page

						deferred = new $.Deferred //create a custom deferred object
						
						var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
						var temp_iframe = 
								$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
								frameborder="0" width="0" height="0" src="about:blank"\
								style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
								.insertAfter($form)

						$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');
						
						temp_iframe.data('deferrer' , deferred);
						//we save the deferred object to the iframe and in our server side response
						//we use "temporary-iframe-id" to access iframe and its deferred object
						
						$form.attr({
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
									});

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);//display an overlay with loading icon
						$form.get(0).submit();
						
						
						//if we don't receive a response after 30 seconds, let's declare it as failed!
						ie_timeout = setTimeout(function(){
							ie_timeout = null;
							temp_iframe.attr('src', 'about:blank').remove();
							deferred.reject({'status':'fail', 'message':'Timeout!'});
						} , 30000);
					}


					////////////////////////////
					//deferred callbacks, triggered by both ajax and iframe solution
					deferred
					.done(function(result) {//success
						//format of `result` is optional and sent by server
						//in this example, it's an array of multiple results for multiple uploaded files
						
						var message = '';
						//for(var i = 0; i < result.length; i++) {
							if(result.status == 'OK') {
								message = result.message;
								clss = "alert-success";
							}
							else if(result.status == 'NOTOK') {
								message = result.message+'<br>Continue to add employee?<br><button class="btn btn-default" id="continue">Yes</button><button class="btn btn-default">No</button>';
								clss = "alert-warning";
							}
							else {
								message = "File not saved. " + result.message;
								clss = "alert-danger";
							}
							//message += "\n";
						//}
						

				 $('#success').html('<div class="alert '+clss+'" id="succ"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+message+'</div>');
 						    
 		  //clear all fields
 		  $('#contactForm').trigger("reset");
					})
					.fail(function(result) {//failure
						$('#success').html('<div class="alert alert-danger" id="succ"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+result.message+'</div>');
			
					})
					.always(function() {//called on both success and failure
						if(ie_timeout) clearTimeout(ie_timeout)
						ie_timeout = null;
						upload_in_progress = false;
						file_input.ace_file_input('loading', false);
					});

					deferred.promise();
				});


				//when "reset" button of form is hit, file field will be reset, but the custom UI won't
				//so you should reset the ui on your own
				$form.on('reset', function() {
					$(this).find('input[type=file]').ace_file_input('reset_input_ui');
				});
				$form.focus(function() {
     $('#success').html('');
  });


				if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

			});
			
			
			
			$(document).on('click', '#continue', function (){
				$('#succ').replaceWith('');
				var $form = $('#myform');
				//you can have multiple files, or a file input with "multiple" attribute
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;

				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Select or drop files here',
					btn_change: null,
					droppable: true,
					thumbnail: 'large',
					
					maxSize: 110000,//bytes
					allowExt: ["jpeg", "jpg", "png", "gif"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],

					before_remove: function() {
						if(upload_in_progress)
							return false;//if we are in the middle of uploading a file, don't allow resetting file input
						return true;
					},

					preview_error: function(filename , code) {
						//code = 1 means file load error
						//code = 2 image load error (possibly file is not an image)
						//code = 3 preview failed
					}
				})
				file_input.on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
					if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
					
					//you can reset previous selection on error
					//ev.preventDefault();
					//file_input.ace_file_input('reset_input');
				});
				
				
				var ie_timeout = null;//a time for old browsers uploading via iframe
				
				 
					var files = file_input.data('ace_input_files');
					if( !files || files.length == 0 ) {files = null;
						};//no files selected
										
					var deferred ;
					if( "FormData" in window ) {
						//for modern browsers that support FormData and uploading files via ajax
						//we can do >>> var formData_object = new FormData($form[0]);
						//but IE10 has a problem with that and throws an exception
						//and also browser adds and uploads all selected files, not the filtered ones.
						//and drag&dropped files won't be uploaded as well
						
						//so we change it to the following to upload only our filtered files
						//and to bypass IE10's error
						//and to include drag&dropped files as well
						formData_object = new FormData();//create empty FormData object
						
						//serialize our form (which excludes file inputs)
						$.each($form.serializeArray(), function(i, item) {
							//add them one by one to our FormData 
							formData_object.append(item.name, item.value);							
						});
						//and then add files
						$form.find('input[type=file]').each(function(){
							var field_name = $(this).attr('name');
							//for fields with "multiple" file support, field name should be something like `myfile[]`

							var files = $(this).data('ace_input_files');
							if(files && files.length > 0 ) {
								for(var f = 0; f < files.length; f++) {
									formData_object.append(field_name, files[f]);
								}
							}
							
						});
						
								formData_object.append('toc', $("#toc").select2("val"));
						formData_object.append('fname', $("input#fname").val());
								formData_object.append('mname', $("input#mname").val());
						formData_object.append('lname', $("#lname").val());
								formData_object.append('email', $("input#email").val());
								formData_object.append('phone', $("input#phone").val());
								formData_object.append('dddd', $("input#dob").val());
								formData_object.append('department', $("#department").select2("val"));
								formData_object.append('section', $("#section").select2("val"));
								formData_object.append('rank', $("#rank").select2("val"));
								formData_object.append('position', $("input#position").val());
								formData_object.append('apd', $("input#apd").val());
								formData_object.append('sd', $("input#sd").val());
								formData_object.append('report', $("#report").select2("val"));
								formData_object.append('address', $("textarea#address").val());
	

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);
						
						deferred = $.ajax({
							        url: 'continue.php',
							       type: $form.attr('method'),
							processData: false,//important
							contentType: false,//important
							   dataType: 'json',
							       data: formData_object,
								   
							/**
							,
							xhr: function() {
								var req = $.ajaxSettings.xhr();
								if (req && req.upload) {
									req.upload.addEventListener('progress', function(e) {
										if(e.lengthComputable) {	
											var done = e.loaded || e.position, total = e.total || e.totalSize;
											var percent = parseInt((done/total)*100) + '%';
											//percentage of uploaded file
										}
									}, false);
								}
								return req;
							},
							beforeSend : function() {
							},
							success : function() {
							}*/
						})

					}
					else {
						//for older browsers that don't support FormData and uploading files via ajax
						//we use an iframe to upload the form(file) without leaving the page

						deferred = new $.Deferred //create a custom deferred object
						
						var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
						var temp_iframe = 
								$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
								frameborder="0" width="0" height="0" src="about:blank"\
								style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
								.insertAfter($form)

						$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');
						
						temp_iframe.data('deferrer' , deferred);
						//we save the deferred object to the iframe and in our server side response
						//we use "temporary-iframe-id" to access iframe and its deferred object
						
						$form.attr({
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
									});

						upload_in_progress = true;
						file_input.ace_file_input('loading', true);//display an overlay with loading icon
						$form.get(0).submit();
						
						
						//if we don't receive a response after 30 seconds, let's declare it as failed!
						ie_timeout = setTimeout(function(){
							ie_timeout = null;
							temp_iframe.attr('src', 'about:blank').remove();
							deferred.reject({'status':'fail', 'message':'Timeout!'});
						} , 30000);
					}


					////////////////////////////
					//deferred callbacks, triggered by both ajax and iframe solution
					deferred
					.done(function(result) {//success
						//format of `result` is optional and sent by server
						//in this example, it's an array of multiple results for multiple uploaded files
						
						var message = '';
						//for(var i = 0; i < result.length; i++) {
							if(result.status == 'OK') {
								message = result.message;
								clss = "alert-success";
							}
							else if(result.status == 'NOTOK') {
								message = result.message;
								clss = "alert-warning";
							}
							else {
								message = "File not saved. " + result.message;
								clss = "alert-danger";
							}
							//message += "\n";
						//}
						
				
				 $('#success').html('<div class="alert '+clss+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" title="Close">&times</button>'+message+'</div>');
 						    
 		  //clear all fields
 		  $('#contactForm').trigger("reset");
					})
					.fail(function(result) {//failure
						$('#success').html("<div class='alert alert-danger'>");
            	$('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            	 .append( "</button>");
            	$('#success > .alert-danger').append(result.message);
 	        $('#success > .alert-danger').append('</div>');
			
					})
					.always(function() {//called on both success and failure
						if(ie_timeout) clearTimeout(ie_timeout)
						ie_timeout = null;
						upload_in_progress = false;
						file_input.ace_file_input('loading', false);
					});

					deferred.promise();
				});


				//when "reset" button of form is hit, file field will be reset, but the custom UI won't
				//so you should reset the ui on your own
				$form.on('reset', function() {
					$(this).find('input[type=file]').ace_file_input('reset_input_ui');
				});
				$form.focus(function() {
     $('#success').html('');
  });


				if(location.protocol == 'file:') alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

		</script>
</body>
</html>

