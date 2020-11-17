<?php
/* include '../login/dbc.php';
page_protect(); */
include("../connection.php");
if($_POST){
	
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }
	
	if(isset($_POST["cid"])){
		//Sanitize input data using PHP filter_var().
		$cid = $_POST["cid"]; 
			 		 
		$querysel = "SELECT id FROM `casuals` WHERE `CasualID`='".$cid."'";
		$query_resultsel = mysqli_query($conn, $querysel) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$querysel.'')));
		
		while( $row = mysqli_fetch_array($query_resultsel) ) {
			$query1 = "DELETE FROM `casuals` WHERE `id`='".$row["id"]."'";
			mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.'')));
			 
			$output = json_encode(array("type"=>"message", "text" => 'Casual record deleted successfully'));
			die($output);
		}
	}
	elseif(isset($_POST["atdate"])){
		$queryat = "SELECT * FROM `attendance_date`";
		$query_resultat = mysqli_query($conn, $queryat) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$queryat.'')));
		$rowat = mysqli_num_rows($query_resultat);
		
		if($rowat > 0){
			$sql_insert1 = "UPDATE `attendance_date` SET `date`='".$_POST["atdate"]."' WHERE `id`='1'";
			mysqli_query($conn, $sql_insert1) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert1.''))));
			
			$sql_count2 = "SELECT COUNT(*) AS noexcuse FROM `cas_attendance` WHERE `Excuse`=1 AND Date='".$_POST["atdate"]."'";
			$count2_result = mysqli_query($conn, $sql_count2) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count2.'')));
			$excuse = mysqli_fetch_assoc($count2_result);//number on excused duty
			
			$sql_count1 = "SELECT COUNT(*) AS nopresent FROM `cas_attendance` WHERE `Present`=1 AND Date='".$_POST["atdate"]."'";
			$count1_result = mysqli_query($conn, $sql_count1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count1.'')));
			$present = mysqli_fetch_assoc($count1_result);//number present
			
			$sql_count3 = "SELECT COUNT(*) AS nopermission FROM `cas_attendance` WHERE `Permission`=1 AND Date='".$_POST["atdate"]."'";
			$count3_result = mysqli_query($conn, $sql_count3) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count3.'')));
			$permission = mysqli_fetch_assoc($count3_result);//number on permission
			
			
			$sql_count0 = "SELECT COUNT(*) AS noabsent FROM `casuals` WHERE DATE(date) <= '".$_POST["atdate"]."'";
			$count0_result = mysqli_query($conn, $sql_count0) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count0.'')));
			$absenti = mysqli_fetch_assoc($count0_result);
			if($absenti["noabsent"]==0){
				$absent= "N/A";
			}
			else{
			$absent = $absenti["noabsent"] - $present["nopresent"] - $excuse["noexcuse"] - $permission["nopermission"];//number absent
			}
			
			$output = json_encode(array('type'=>'good', 'text' => 'Updated', 'present' => $present["nopresent"], 'excuse' => $excuse["noexcuse"], 'permission' => $permission["nopermission"], 'absent' => $absent));
        	die($output);
		}
		else{
			$sql_insert = "INSERT INTO `attendance_date` (`date`) VALUES('".$_POST["atdate"]."')";
			mysqli_query($conn, $sql_insert) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert.''))));
			
			$sql_count2 = "SELECT COUNT(*) AS noexcuse FROM `cas_attendance` WHERE `Excuse`=1 AND Date='".$_POST["atdate"]."'";
			$count2_result = mysqli_query($conn, $sql_count2) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count2.'')));
			$excuse = mysqli_fetch_assoc($count2_result);//number on excused duty
			
			$sql_count1 = "SELECT COUNT(*) AS nopresent FROM `cas_attendance` WHERE `Present`=1 AND Date='".$_POST["atdate"]."'";
			$count1_result = mysqli_query($conn, $sql_count1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count1.'')));
			$present = mysqli_fetch_assoc($count1_result);//number present
			
			$sql_count3 = "SELECT COUNT(*) AS nopermission FROM `cas_attendance` WHERE `Permission`=1 AND Date='".$_POST["atdate"]."'";
			$count3_result = mysqli_query($conn, $sql_count3) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count3.'')));
			$permission = mysqli_fetch_assoc($count3_result);//number on permission
			
			
			$sql_count0 = "SELECT COUNT(*) AS noabsent FROM `casuals` WHERE DATE(date) <= '".$_POST["atdate"]."'";
			$count0_result = mysqli_query($conn, $sql_count0) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count0.'')));
			$absenti = mysqli_fetch_assoc($count0_result);
			$absent = $absenti["noabsent"] - $present["nopresent"] - $excuse["noexcuse"] - $permission["nopermission"];//number absent
			
			$output = json_encode(array('type'=>'good', 'text' => 'Inserted', 'present' => $present["nopresent"], 'excuse' => $excuse["noexcuse"], 'permission' => $permission["nopermission"], 'absent' => $absent));
        	die($output);
		}
	}
}

?>