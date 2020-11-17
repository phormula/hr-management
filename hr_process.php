<?php
/* include '../login/dbc.php';
page_protect(); */
include("connection.php");
if(!empty($_POST) and isset($_POST)){
	
	if($_POST['addnew'] == 'todb'){
		if(!empty($_POST['dptname']) && !empty($_POST['hod'])){
			$dptname = $_POST['dptname'];
			$hod = $_POST['hod'];
			
			$queryd = "INSERT INTO `department`(`dpt_name`, `hod`) VALUES('$dptname', '$hod')";
			 mysqli_query($conn, $queryd) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$queryd.''))); 
			
			$output = json_encode(array('type'=>'message', 'text' => 'New Department Added Successfully'));
			die($output);
		}
		elseif(!empty($_POST['secname'])){
			$secname = $_POST['secname'];
			
			$querysec = "INSERT INTO `section`(`section_name`) VALUES('$secname')";
			 mysqli_query($conn, $querysec) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$querysec.''))); 
			
			$output = json_encode(array('type'=>'message', 'text' => 'New Section Added Successfully'));
			die($output);
		}
		elseif(!empty($_POST['rankname'])){
			$rankname = $_POST['rankname'];
			
			$queryr = "INSERT INTO `employee_types`(`types`) VALUES('$rankname')";
			 mysqli_query($conn, $queryr) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$queryr.''))); 
			
			$output = json_encode(array('type'=>'message', 'text' => 'New Rank Added Successfully'));
			die($output);
		}
	}
	else{
		//Sanitize input data using PHP filter_var().
		$colname = trim($_POST["name"]);    
		$pk = trim($_POST["pk"]);
		$value = trim($_POST["value"]);
		
		if(!empty($value)){
			if(isset($_POST['param1']) && $_POST['param1']=="department"){
				$sid = $_POST['param1'];
				$querym = "UPDATE `department` SET `$colname`='$value' WHERE `id`='$pk'";
				mysqli_query($conn, $querym) or die(mysqli_error($conn)); 
				
			}
			elseif(isset($_POST['param1']) && $_POST['param1']=="section"){
				$sid = $_POST['param1'];
				$querym = "UPDATE `section` SET `$colname`='$value' WHERE `id`='$pk'";
				mysqli_query($conn, $querym) or die(mysqli_error($conn)); 
				
			}
			elseif(isset($_POST['param1']) && $_POST['param1']=="holiday"){
				$sid = $_POST['param1'];
				$queryh = "UPDATE `holidays` SET `$colname`='$value' WHERE `id`='$pk'";
				mysqli_query($conn, $queryh) or die(mysqli_error($conn)); 
				
			}
		}
		else {
			header('HTTP 400 Bad Request', true, 400);
			echo "This field is required!";
		}
	}
}

?>