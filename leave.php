<?php
error_reporting(0);
include '../login/dbc.php';
page_protect();
include("connection.php");
if($_POST){
	
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }
   
    //Sanitize input data using PHP filter_var().
    $start      = $_POST["start"];
    $nod     	= $_POST["nod"];
    $leavetype  = $_POST["leavetype"];
    $comment   	= $_POST["comment"];
	$emp_id 	= $_POST["emp"];
	$year 		= $_POST["year"];
   
    $sql = "SELECT YEAR(NOW())-YEAR(HireDate) AS no_of_years, rank FROM `employees` where `employee_ID`='".$emp_id."'";
	$sql_result = mysqli_query ($conn, $sql ) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql.''))));
	$row = mysqli_fetch_assoc($sql_result);
	
	$sql2 = "SELECT * FROM `entitle_leave_days`";
	$sql_result2 = mysqli_query ($conn, $sql2 ) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql2.''))));
	$row2 = mysqli_fetch_assoc($sql_result2);
	
		if($row["no_of_years"]>=1 and $row["no_of_years"]<5 and $row["rank"]==2){
		$entitle = $row2["one_to_five_years"];}
		else if($row["no_of_years"]>=5 and $row["no_of_years"]<10 and $row["rank"]==2){
		$entitle = $row2["btn_five_and_ten"];}
		else if($row["rank"]==1){$entitle = $row2["senior"];}
		else if($row["rank"]==3){$entitle = $row2["contract"];}
		else{
		$entitle = $row2["above_ten_years"];}
 		if($leavetype==1){$no_of_days = $entitle;}
		elseif($leavetype==3){$no_of_days = $row2["maternity"];}
		else{$no_of_days = $nod;}	

  if(isset($_FILES['letter']['tmp_name']) && !empty($_FILES['letter']['tmp_name'])){
  		//Is file size is less than allowed size.
  		$folder = "employees_files/".$emp_id."_particulers/leave/";
  		$Random_Number      = rand(0, 9999999999);
		$uploadfile = "".$folder."leave".$Random_Number . basename($_FILES['letter']['name']);
	 
		if ($_FILES["letter"]["size"] > 5242880) {
		$output = json_encode(array('type'=>'error', 'text' => 'File size is too big.'));
        die($output); //output error
		}
	
	//allowed file type Server side check
		switch(strtolower($_FILES['letter']['type']))
			{
			//allowed file types
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				$output = json_encode(array('type'=>'error', 'text' => 'Unsupported File type. Please upload a "pdf" file'));
       			 die($output); //output error
			}
	
		if(is_dir($folder))
  		{
			
			$no_of_days = $nod;
			$start_date = $start;
			$type = $leavetype;
			$sql3 = "SELECT * FROM `employee_leave` WHERE `employee_ID`='$emp_id' AND `year`='$year' AND `leave_type`<>3 AND `leave_type`<>4 ORDER BY `starting_date` desc LIMIT 1";
	$sql_result3 = mysqli_query ($conn, $sql3 ) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql3.''))));
	$row3 = mysqli_fetch_assoc($sql_result3);
	if($start_date <= $row3["starting_date"]){$output = json_encode(array('type'=>'error', 'text' => 'Leave <b>"Start Date"</b> must be after last leave date'));
        		die($output);}
				
				
	if(mysqli_num_rows($sql_result3)>0){
			if($leavetype==1){
				$no_of_days = $row3["num_left"];
				$total_left = $row3["num_left"];}
			elseif($leavetype==3){
				$no_of_days = $row2["maternity"];
				$total_left = $row2["maternity"];}
			elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;}
			else{
				$total_left = $row3["num_left"];
				$no_of_days = $nod;}
				$num_left = $total_left - $no_of_days;}
	else{
			if($leavetype==1){
				$no_of_days = $entitle;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;}
			elseif($leavetype==3){
				$total_left = $row2["maternity"];
				$no_of_days = $row2["maternity"];
				$num_left = $total_left - $no_of_days;
				}
				elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;
				$num_left = $total_left - $no_of_days;
				}
			else{
				$no_of_days = $nod;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;}
				}
				
				
		if($row3["leave_type"]==2 && $leavetype==2 && $nod > $total_left){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);}
		if($row3["leave_type"]==1 && $leavetype==1 && $row3["num_left"]==0 && !empty($row3["employee_ID"])){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);}
			
		if (move_uploaded_file($_FILES['letter']['tmp_name'], $uploadfile)) {
    		$query1 = "INSERT INTO `employee_leave`(`year`, `employee_ID`, `leave_type`, `designated_leave_days`, `num_used`, `num_left`, `starting_date`, `letter`, `comment`) VALUES('$year', '$emp_id', '$type', '$total_left', '$no_of_days', '$num_left', '$start_date', '$uploadfile', '$comment')";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
			if($leavetype==1){
			$annual_days = $no_of_days+2;
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$annual_days.' weekdays'));}
		elseif($leavetype==3){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));}
		elseif($leavetype==4){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));}
		else{$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' weekdays'));}
		
			//echo $next_date;
			$report_date1 = date('d-m-Y', strtotime($report_date. ' + 1 weekdays')) ;
			$output = json_encode(array('type'=>'message', 'text' => 'Leave Assinged Successfully<br />Employee will report on <b>'.$report_date.'</b>'));
        	die($output);
			} 
			else {
    			$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  		}
else{
	   		
   			$no_of_days = $nod;
			$start_date = $start;
			$type = $leavetype;
			$sql3 = "SELECT * FROM `employee_leave` WHERE `employee_ID`='$emp_id' AND `year`='$year' AND `leave_type`<>3 AND `leave_type`<>4 ORDER BY `starting_date` desc LIMIT 1";
			$sql_result3 = mysqli_query ($conn, $sql3 ) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql3.''))));
			$row3 = mysqli_fetch_assoc($sql_result3);
			if($start_date <= $row3["starting_date"]){
				$output = json_encode(array('type'=>'error', 'text' => 'Leave <b>"Start Date"</b> must be after last leave date'));
        		die($output);}
				
	if(mysqli_num_rows($sql_result3)>0){
			if($leavetype==1){
				$no_of_days = $row3["num_left"];
				$total_left = $row3["num_left"];}
			elseif($leavetype==3){
				$no_of_days = $row2["maternity"];
				$total_left = $row2["maternity"];}
			elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;}
			else{
				$total_left = $row3["num_left"];
				$no_of_days = $nod;}
				$num_left = $total_left - $no_of_days;}
	else{
			if($leavetype==1){
				$no_of_days = $entitle;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;}
			elseif($leavetype==3){
				$total_left = $row2["maternity"];
				$no_of_days = $row2["maternity"];
				$num_left = $total_left - $no_of_days;
				}
				elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;
				$num_left = $total_left - $no_of_days;
				}
			else{
				$no_of_days = $nod;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;}
				}
				
				
				if($row3["leave_type"]==2 && $leavetype==2 && $nod > $total_left){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);}
		if($row3["leave_type"]==1 && $leavetype==1 && $row3["num_left"]==0 && !empty($row3["employee_ID"])){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);}
			
				mkdir($folder, 0777, true);
 			if (move_uploaded_file($_FILES['letter']['tmp_name'], $uploadfile)) {
    			$query1 = "INSERT INTO `employee_leave`(`year`, `employee_ID`, `leave_type`, `designated_leave_days`, `num_used`, `num_left`, `starting_date`, `letter`, `comment`) VALUES('$year', '$emp_id', '$type', '$total_left', '$no_of_days', '$num_left', '$start_date', '$uploadfile', '$comment')";
 				mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
				

			if($leavetype==1){
			$annual_days = $no_of_days+2;
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$annual_days.' weekdays'));}
		elseif($leavetype==3){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));}
		elseif($leavetype==4){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));}
		else{$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' weekdays'));}
		
			//echo $next_date;
			$report_date1 = date('d-m-Y', strtotime($report_date. ' + 1 weekdays')) ;
			$output = json_encode(array('type'=>'message', 'text' => 'Leave Assinged Successfully<br />Employee will report on <b>'.$report_date.'</b>'));
        	die($output);
				} 
			else {
				$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  			}
	 }
	elseif(isset($_POST) && !isset($_FILES['letter']['tmp_name'])){
		$no_of_days = $nod;
		$start_date = $start;
		$type = $leavetype;
			
		$sql3 = "SELECT * FROM `employee_leave` WHERE `employee_ID`='$emp_id' AND `year`='$year' AND `leave_type`<>3 AND `leave_type`<>4 ORDER BY `starting_date` desc LIMIT 1";
		$sql_result3 = mysqli_query ($conn, $sql3 ) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql3.''))));
		$row3 = mysqli_fetch_assoc($sql_result3);
	
		if($start_date <= $row3["starting_date"]){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave <b>"Start Date"</b> must be after last leave date'));
        	die($output);
		}
		
		if(mysqli_num_rows($sql_result3)>0){
			if($leavetype==1){
				$no_of_days = $row3["num_left"];
				$total_left = $row3["num_left"];
			}
			elseif($leavetype==3){
				$no_of_days = $row2["maternity"];
				$total_left = $row2["maternity"];
			}
			elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;
			}
			else{
				$total_left = $row3["num_left"];
				$no_of_days = $nod;
			}
			$num_left = $total_left - $no_of_days;
		}
		else{
			if($leavetype==1){
				$no_of_days = $entitle;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;
			}
			elseif($leavetype==3){
				$total_left = $row2["maternity"];
				$no_of_days = $row2["maternity"];
				$num_left = $total_left - $no_of_days;
			}
			elseif($leavetype==4){
				$total_left = $nod;
				$no_of_days = $nod;
				$num_left = $total_left - $no_of_days;
			}
			else{
				$no_of_days = $nod;
				$total_left = $entitle;
				$num_left = $total_left - $no_of_days;}
			}
			
		if($row3["leave_type"]==2 && $leavetype==2 && $nod > $total_left){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);
		}
		if($row3["leave_type"]==1 && $leavetype==1 && $row3["num_left"]==0 && !empty($row3["employee_ID"])){
			$output = json_encode(array('type'=>'error', 'text' => 'Leave balance exhausted!!!<br>No leave entitlemens'));
        	die($output);
		}	
		
    	$query1 = "INSERT INTO `employee_leave`(`year`, `employee_ID`, `leave_type`, `designated_leave_days`, `num_used`, `num_left`, `starting_date`, `comment`) VALUES('$year', '$emp_id', '$type', '$total_left', '$no_of_days', '$num_left', '$start_date', '$comment')";
		mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
			
		if($leavetype==1){
			$annual_days = $no_of_days+2;
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$annual_days.' weekdays'));
		}
		elseif($leavetype==3){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));
		}
		elseif($leavetype==4){
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' days'));
		}
		else{
			$report_date= date(" jS F\, Y ", strtotime($start. ' + '.$no_of_days.' weekdays'));
		}
		
		//echo $next_date;
		$report_date1 = date('d-m-Y', strtotime($report_date. ' + 1 weekdays')) ;
		$output = json_encode(array('type'=>'message', 'text' => 'Leave Assinged Successfully<br />Employee will report on <b>'.$report_date.'</b>'));
        die($output);
	}
			
 
}

?>