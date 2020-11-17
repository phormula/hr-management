<?php
error_reporting(0);
include("../../../../../config.php");

$snr = "SELECT * FROM employees WHERE employee_ID='PB0009'";

$sql_resultsnr = mysql_query ($snr, $connection ) or die ('request "Could not execute SQL query" '.$snr);

$senior = mysql_fetch_assoc($sql_resultsnr);

if($_REQUEST["year"]){
	$order=" ORDER BY no_of_years desc, ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$add_years = ", YEAR(`apt_statusDate`)-YEAR(HireDate) AS no_of_years, ABS(month(`apt_statusDate`) - month(`HireDate`)) as month, ABS(day(`apt_statusDate`) - day(`HireDate`)) as day";
	}

if ($_REQUEST["string"]<>'') {
	$search_string = " AND (FirstName LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR LastName LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";	
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
}
if ($_REQUEST["department"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$search_city = " AND employees.department='".mysql_real_escape_string($_REQUEST["department"])."'";	
	$title = " in ".mysql_real_escape_string($_REQUEST["department"]);
}

if ($_REQUEST["rank"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$search_rank = " AND employees.rank='".mysql_real_escape_string($_REQUEST["rank"])."'";	
}


if ($_REQUEST["section"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$search_section = " AND section='".mysql_real_escape_string($_REQUEST["section"])."'";	
}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]."".$add_years." WHERE Hiredate >= '".mysql_real_escape_string($_REQUEST["from"])."' AND to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["from"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$sql = "SELECT ".$SETTINGS["data_table"].".employee_ID, ".$SETTINGS["data_table"].".FirstName, ".$SETTINGS["data_table"].".LastName, ".$SETTINGS["data_table"].".Position, ".$SETTINGS["data_table2"].".dpt_name".$add_years." FROM ".$SETTINGS["data_table"]." INNER JOIN ".$SETTINGS["data_table2"]." ON ".$SETTINGS["data_table"].".department=".$SETTINGS["data_table2"].".id WHERE HireDate = '".mysql_real_escape_string($_REQUEST["from"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else if ($_REQUEST["to"]<>'') {
	$order=" ORDER BY ".$SETTINGS["data_table"].".rank asc, ".$SETTINGS["data_table"].".employee_ID asc";
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]."".$add_years." WHERE to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_city.$search_section.$search_rank.$order;
} else {
	//$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE EmployeeID>0".$search_string.$search_city;
	if(empty($_REQUEST)){
		$order=" ORDER BY ".$SETTINGS["data_table"].".employee_ID asc, ".$SETTINGS["data_table"].".rank asc";}
		$sql = "SELECT e.employee_ID, e.TitleOfCourtesy, e.FirstName, e.Middle_name, e.LastName, e.Position, d.dpt_name, s.section_name, YEAR(e.`apt_statusDate`)-YEAR(e.HireDate) AS no_of_years, ABS(month(e.`apt_statusDate`) - month(e.`HireDate`)) as month, ABS(day(e.`apt_statusDate`) - day(e.`HireDate`)) as day, a.* FROM contracts a JOIN (SELECT `employee_ID`, MAX(`due_date`) due_date FROM contracts GROUP BY `employee_ID`) b ON a.`employee_ID`=b.`employee_ID` and a.`due_date`=b.`due_date` INNER JOIN employees e ON a.`employee_ID`=e.`employee_ID` INNER JOIN department d ON e.department=d.id INNER JOIN section s ON e.section=s.id WHERE a.`due_date` <= now()".$search_string.$search_city.$search_section.$search_rank;
}

$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>List of Expired Contracts</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- jQuery 2.1.4 -->
    <script src="../../../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <!-- Bootstrap 3.3.5 -->
    <script src="../../../../../bootstrap/js/bootstrap.min.js"></script>
     <!-- SlimScroll -->
    <script src="../../../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../../../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../../../dist/js/demo.js"></script>
    
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->

	<!-- Downloadify (https://github.com/dcneiner/Downloadify#readme) script (Downloadify helps to download javascript-generated file even in old browsers which do not supports Data URI scheme for data streaming) -->
	<script type="text/javascript" src="downloadify.min.js"></script>
	<!-- helper file for Downloadify-->
	<script type="text/javascript" src="swfobject.js"></script>
	<!-- bytescoutpdf.js script containing BytescoutPDF class to generate PDF file -->
	<script type="text/javascript" src="bytescoutpdf1.15.150.js"></script>
	<!-- Helper script with CheckDataURISupport() function to determine if current browser supports Data URI scheme -->
	<script type="text/javascript" src="checkdatauri.js"></script>
    
    <script type="text/javascript">
	function CreatePDF(IsInternetExplorer8OrLower) {
	
	var pdf = new BytescoutPDF();

    // set document properties: Title, subject, keywords, author name and creator name
    pdf.propertiesSet("Sample document title", "Sample subject", "keyword1, keyword 2, keyword3", "Document Author Name", "Document Creator Name");

    // add new page
    pdf.pageAdd();
    
    pdf.textSetBoxPadding(3);

    // set text box
    pdf.textSetBox(50, 50, 500, 500);
    // and draw a rectangle around it
   // pdf.graphicsDrawRectangle(50, 50, 500, 500);

    // add aligned text:

    pdf.textSetAlign(BytescoutPDF.CENTER);
	pdf.fontSetSize(26);

    // set font style with parameters: bold, italic, underline
    pdf.fontSetStyle(true, false, false);
    pdf.textAddToBox('Piccadilly Biscuits Limited', true);
	if (!IsInternetExplorer8OrLower) // images and drawings from canvas are supported on IE version 9 and higher, other modern browsers should work fine
{
    // load image from local file
    pdf.imageLoadFromUrl('image1.jpg');
    // place this mage at given X, Y coordinates on the page
    pdf.imagePlace(170, 90);

} 
pdf.fontSetSize(24);

    // set font style with parameters: bold, italic, underline
    pdf.fontSetStyle(true, false, false);
    pdf.textAddToBox('HR Report', false);

	pdf.pageAdd();
	pdf.textSetAlign(BytescoutPDF.CENTER);
	pdf.fontSetStyle(true, false, true);
	pdf.textAddToBox("Content",true);
    // return BytescoutPDF object instance
    return pdf;
}

</script>
 
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../../../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../../../assets/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../../../dist/css/skins/skin-orange.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../../plugins/datatables/dataTables.bootstrap.css"/>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <style type="text/css">
   tr.empp{ cursor:pointer}
   </style> 
    <!-- Select2 -->
    <link rel="stylesheet" href="../../../../../plugins/select2/select2.min.css">
  
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../../../../../piccadilly" class="logo">
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
                  <img src="data:image/jpeg;base64,<?php echo base64_encode( $senior["Photo"] );?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo ''.$senior["FirstName"].' '.$senior["Middle_name"].' '.$senior["LastName"];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode( $senior["Photo"] );?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo ''.$senior["FirstName"].' '.$senior["Middle_name"].' '.$senior["LastName"].' - '.$senior["Position"];?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
       <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="data:image/jpeg;base64,<?php echo base64_encode( $senior["Photo"] );?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ''.$senior["FirstName"].' '.$senior["Middle_name"].' '.$senior["LastName"].'';?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="../../../../../../piccadilly">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
              
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-table"></i>
                <span>Table View</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../../../table/tableview.php"><i class="fa fa-circle-o"></i> All Employees</a></li>
                <li><a href="../../../../table/leave.php"><i class="fa fa-circle-o"></i> Leave</a></li>
                <li><a href="../../../../table/terminated.php"><i class="fa fa-circle-o"></i> Terminated</a></li>
                <li><a href="../../../../table/resigned.php"><i class="fa fa-circle-o"></i> Resigned</a></li>
                <li><a href="../../../../table/retired.php"><i class="fa fa-circle-o"></i> Retired</a></li>
                <li><a href="../../../../table/vacated.php"><i class="fa fa-circle-o"></i> Vacated</a></li>
                <li><a href="../../../../table/term_casual.php"><i class="fa fa-circle-o"></i> Terminated (Casuals)</a></li>
                <li class="active"><a href=""><i class="fa fa-circle-o"></i> Expired Contracts</a></li>
              </ul>
            </li>
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-picture-o"></i>
                <span>Profile View</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../../../profile/profileview.php"><i class="fa fa-circle-o"></i> All Employees</a> <span class="label label-primary pull-right">4</span></li>
                <li><a href="../../../../profile/terminated.php"><i class="fa fa-circle-o"></i> Terminated</a></li>
                <li><a href="../../../../profile/resigned.php"><i class="fa fa-circle-o"></i> Resigned</a></li>
                <li><a href="../../../../profile/retired.php"><i class="fa fa-circle-o"></i> Retired</a></li>
                <li><a href="../../../../profile/vacated.php"><i class="fa fa-circle-o"></i> Vacated</a></li>
                <li><a href="../../../../profile/term_casual.php"><i class="fa fa-circle-o"></i> Terminated (Casuals)</a></li>
              </ul>
            </li>
            <li>
              <a href="#">
                <i class="glyphicon glyphicon-user"></i> <span>Profile Detail</span> <small class="label pull-right bg-green">view</small>
              </a>
            </li>
            <li>
              <a href="../../../../addnew.php" title="Add new employee">
                <i class="glyphicon glyphicon-plus"></i> <span>Add New</span> 
              </a>
            </li>
            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Employees On Leave
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../../../../../piccadilly"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  <h3 class="box-title">Employees On Leave</h3><br>
<br><button class="btn btn-info pull-left bg-aqua" data-toggle="control-sidebar"><i class="fa fa-search"></i> Advance Filter</button>

                </div><!-- /.box-header -->
               
                <div class="box-body" id="tablev">

<hr/>
                  
<!-- hidden images for pdf generation - BEGIN -->
<div id="pdfreportimages" style="display: none;">
    <img src="image1.jpg" id="pdfimage1"> 
    <img src="image2.jpg" id="pdfimage2"> 

</div>
<div id="getpdf">
<div>
</div>

			</div>
			</br>
			<script type="text/javascript">
				// 1st method implementation:
				// this function creates "a href" link to stream PDF via "Data URI scheme" feature supported in almost all modern browsers 	
				// uses div with "getpdf" id to place links
				// PDFContentBase64 parameter = pdf file content encoded with base64 encoding
				function CreatePDFDownloadLink(PDFContentBase64) 
				{
					// find "getpdf" DIV element that we use to show the link to view or download PDF 
					var pdfdiv = document.getElementById("getpdf");

					// check if we have Data URI enabled (using CheckDataURISupport() function from checkdatauri.js)
					if (CheckDataURISupport()) {
					
					    var warningNotice = "";
					    // added on May 5, 2015:
					    // check if we should show the message about Mac OS X Chrome/Chromium limitation:
					    // check if generated PDF size exceeds 128KB security limit used in Mac OS X version of Google Chrome
					    if (PDFContentBase64.length>128*1024)
					    {
					      
					    }
						

						// create the button code
						var buttonCode = '<button onclick=\"' + 'location.href = \'data:application\/pdf;base64,' + PDFContentBase64 + '\'";' + 
						'id=\"showPDFButton\" class=\"buttonClass\">Show PDF on Button click</button>';
                        
			                        // add the button code to the pdfdiv element existing code
                        			pdfdiv.innerHTML += buttonCode;

					}
					else {
						// Data URI is not supported so we should display the notice
						pdfdiv.innerHTML = "<h3><font color=\"red\">data URI scheme is not supported in current browser (seems like you are on IE8 or lower, you should use the 2nd method instead)</font><h3>";
					}
				};
			</script>
		
	   
			
			</br>
			<!-- downloadify element to show Download button made with Downloadify (works in almost all browsers including old ones) -->
			<div id="downloadify">
				You must have Flash 10 installed to download this file.


 <!-- important info about local server - end -->

			</div>
			</br>
			<script type="text/javascript">
				// [2] method implementation:
				// this function uses free "Downloadify" plugin that makes possible to download files generated by javascript
				// in almost all browsers (even in old versions)
				// this function places "download" button in div with "downloadify" id
				// PDFContentBase64 parameter = pdf file content encoded with base64 encoding 
				function CreatePDFDownloadifyButton(PDFContentBase64, WeHaveInternetExplorer8OrLower ) {

					// we use base64 encoding by default
					var dataTypeParam = 'base64';


						if (WeHaveInternetExplorer8OrLower )
						{
							dataTypeParam = 'string';					
						}

					Downloadify.create('downloadify', { // parameter to tell that we should place "Download" button in DIV element with "Downloadify" id
						filename: 'Sample.pdf', // filename to use when user want to save PDF file
						data: PDFContentBase64, // pass data encoded with base64
						onComplete: function () { alert('Sample.pdf has been saved!'); }, // message to show once saving local file has been completed
						onCancel: function () { alert('You have cancelled saving Sample.pdf'); }, // message to show if user canceled saving file (canceled Save File dialog)
						onError: function () { alert('Error occured while generating PDF file, please contact support@bytescout.com'); }, // message to show on error if something goes wrong
						transparent: false, // enable transparency for the button or not
						swf: 'downloadify.swf', // filename of SWF button (required for some old browsers)
						downloadImage: 'download.png', // image to use as a surface for download button
						width: 100, // width of the button
						height: 30, // height of the button
						append: false, // replace button to the current content of "Downloadify" div element or replace (we replace)
						dataType: dataTypeParam // set data type encoding
					});
				};                     
			</script>
		
	<!-- main part initializing and generating PDF - begin -->
	<!-- Source code sample with CreatePDF() function that uses bytescoutpdf.js API to generate PDF file and returns BytescoutPDF object instance -->
	<script type="text/javascript" src="createpdf.js"></script>
	<!-- main script to generate PDF and once PDF is generated then create links to download and/or view PDF -->
	<script type="text/javascript">


function getInternetExplorerVersion()
// Returns the version of Internet Explorer or a -1
// (indicating the use of another browser).
{
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}

	// checking if we are on IE, if IE then checking version
	ieversion = getInternetExplorerVersion(); // returns version for IE or -1 for non-IE browser

	var WeHaveInternetExplorer8OrLower = false;

					// if we are on IE 8 or earlier we can not use images and base64
					if (ieversion > -1)
					{ 
						if (ieversion < 9)
						{
							WeHaveInternetExplorer8OrLower = true;							
						}
					}

		if (WeHaveInternetExplorer8OrLower)
		{
			alert('You using on Internet Explorer 8 or lower so BytescoutPDF.js works in limited mode.\n\nThe limitation for IE8 (and lower):\nImages and Canvas drawings are not supported while generating PDF due to limitations of IE8 (and lower versions) and lack of HTML5 canvas\n\nMost modern desktop and mobile browsers should work fine.');
		}


    // define global variable "pdf" to store pdf generating object
    var pdf;
		
		
    // set pdf generation call to execute only after the whole window document is loaded		
    // REQUIRED WHEN YOU USE IMAGES WITH PDF FOR FIREFOX and IE: we use JQuery script to use $(window).onload() function event
    // so PDF generation runs only AFTER the whole page and all of its elements are loaded into the browser
    // if you use images in your PDF - see <!-- hidden images for pdf generation --> block above and put your images into this hidden block to preload them before pdf generation starts
	$(window).load(function(){

	    // calls CreatePDF() from createpdf.js to generate PDF file and return BytescoutPDF object instance		    	
        pdf = CreatePDF(WeHaveInternetExplorer8OrLower);		
		
		// now we set "onload" event for our PDF object into a custom function which will create links to view and download PDF once the generation is done
		// this is neccessary as PDF generation may take some time especially if you use images (so images should be downloaded and encoded)
		// so this function below will be called in "onload" event which is fired once PDF file generation has been completed
		pdf.onload(function() {

            // get generated PDF file in a form of encoded string
            var PDFContentBase64 = "";

	    // if we are on IE 8 or earlier we can not use base64. Browser variable is declared in getbrowserversion.js
 	    if (WeHaveInternetExplorer8OrLower )
	    {
		// we get the content as a string (non encoded as IE8 and Downloadify not working with base64)
		PDFContentBase64 = pdf.getText();
	    }
	    else{
	    // else we are using base64 encoded pdf
		PDFContentBase64 = pdf.getBase64Text();
	    }

            // now we create links to view or download PDF file generated (using method [1] - via "Data URI" supported in latest versions of most major browsers)
            CreatePDFDownloadLink(PDFContentBase64);
            // now we create "Download" button using "Downloadify" script which is aimed to provide a way to download generated file in almost all browsers (including old ones)
            CreatePDFDownloadifyButton(PDFContentBase64, WeHaveInternetExplorer8OrLower );
        });    
        
    }); // window.onload() end
  


	</script>
	<!-- main part initializing and generating PDF - end -->
	<!-- source code -->
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
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-search"></i> Filter</a></li>
          
        </ul>
        <!-- Tab panes -->
        
          <!-- Home tab content -->
          <div class="tab-content tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <form class="filter" name="form1" id="filt" method="post" action="" style="color:#FFF"><div class="form-group"> Appointment Date<br>
From: </label>
    <input name="from" type="text" maxlength="10" id="from" size="10" style="color:#000" placeholder="Date" value="<?php echo $_REQUEST["from"]; ?>" /> <label for="to">to: </label>
<input name="to" maxlength="10" style="width: 72px; color:#000" type="text" placeholder="Date" id="to" size="10" value="<?php echo $_REQUEST["to"]; ?>"/></div><div class="form-group">
Department<?php  
$sqld = "SELECT * FROM department"; 
$sql_resultd = mysql_query ($sqld, $connection ) or die ('request "Could not execute SQL query" '.$sqld);
?> 
<select id="department" class="form-control select2" name="department">
  <option disabled="disabled" value="" selected="selected">Select Department</option> 
<?php 
while ($rowd = mysql_fetch_array($sql_resultd, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rowd['id'];?>"> 
<?php echo $rowd['dpt_name'];?> 
</option>   
<?php } ?> 
</select></div><?php  
$sqls = "SELECT * FROM section"; 
$sql_results = mysql_query ($sqls, $connection ) or die ('request "Could not execute SQL query" '.$sqls);
?>
 <div class="form-group">By Section<select class="form-control select2" id="section" name="section">
  <option disabled="disabled" value="" selected="selected">Select Section</option> 
<?php 
while ($rows = mysql_fetch_array($sql_results, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rows['id'];?>"> 
<?php echo $rows['section_name'];?> 
</option>   
<?php } ?> 
</select></div><div class="form-group">By Rank<?php  
$sqlr = "SELECT * FROM employee_types"; 
$sql_resultr = mysql_query ($sqlr, $connection ) or die ('request "Could not execute SQL query" '.$sqlr);
?> 
<select class="form-control select2" id="rank" name="rank">
  <option disabled="disabled" value="" selected="selected">Select Rank</option> 
<?php 
while ($rowr = mysql_fetch_array($sql_resultr, MYSQL_ASSOC)) 
{ ?> 
<option value="<?php echo $rowr['id'];?>"> 
<?php echo $rowr['types'];?> 
</option>   
<?php } ?> 
</select></div><input name="button" type="submit" class="btn btn-info pull-left" id="button" value="Filter"/><a href="<?php echo $_SERVER['../../../../table/REQUEST_URI']; ?>" class="btn btn-default pull-right">Reset</a>
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
    <script src="../../../../../plugins/datatables/datatables.min.js"></script>
    <script src="../../../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
     <!-- Select2 -->
    <script src="../../../../../plugins/select2/select2.full.min.js"></script>
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
        //Money Euro
        $("[data-mask]").inputmask();

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

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
</body>
</html>

