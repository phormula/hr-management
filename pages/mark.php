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
	
	$sql_del = "DELETE FROM `cas_attendance` WHERE `Present`=0 AND `Excuse`=0 AND `Permission`=0";
			mysqli_query($conn, $sql_del) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.''))));
			
	//number of attendance : present, absent, excused duty, permission
	
	
	
		
	
	//END number of attendance : present, absent, excused duty, permission END
	
	$querys = "SELECT MAX(id) as CUR FROM `cas_attendance`";
	$query_result = mysqli_query($conn, $querys) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$querys.'')));
	$row = mysqli_fetch_array($query_result);
	$cur_id = $row["CUR"];
	$newid = $cur_id +1;
   
	if(isset($_POST["excuse"])){
		$sql = "SELECT * FROM `cas_attendance` WHERE CasualID='".$_POST["casid"]."' AND Date='".$_POST["date"]."'";
		$sql_query = mysqli_query($conn, $sql) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql.'')));
		$rowt = mysqli_fetch_assoc($sql_query);
		$rown = mysqli_num_rows($sql_query);
		
		if($rown > 0){
			$sql_insert1 = "UPDATE `cas_attendance` SET `Excuse`=".$_POST["excuse"]." WHERE `CasualID`='".$_POST["casid"]."'";
			
			mysqli_query($conn, $sql_insert1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert1.'')));
			mysqli_query($conn, $sql_del) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.'')));
			
			$sql_count2 = "SELECT COUNT(*) AS noexcuse FROM `cas_attendance` WHERE `Excuse`=1 AND Date='".$_POST["date"]."'";
			$count2_result = mysqli_query($conn, $sql_count2) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count2.'')));
			$excuse = mysqli_fetch_assoc($count2_result);//number on excused duty
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Absent</b>', 'num' => $excuse["noexcuse"]));
        	die($output);
		}
		else{
			$sql_insert = "INSERT INTO `cas_attendance` (`id`, `CasualID`, `Date`, `Excuse`) VALUES('".$newid."', '".$_POST["casid"]."', '".$_POST["date"]."', '".$_POST["excuse"]."')";
			
			mysqli_query($conn, $sql_insert) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert.'')));
			mysqli_query($conn, $sql_del) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.'')));
			
			$sql_count2 = "SELECT COUNT(*) AS noexcuse FROM `cas_attendance` WHERE `Excuse`=1 AND Date='".$_POST["date"]."'";
			$count2_result = mysqli_query($conn, $sql_count2) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count2.'')));
			$excuse = mysqli_fetch_assoc($count2_result);//number on excused duty
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Absent</b>', 'num' => $excuse["noexcuse"]));
        	die($output);
			}
	}
	elseif(isset($_POST["present"])){
		$sql = "SELECT * FROM `cas_attendance` WHERE CasualID='".$_POST["casid"]."' AND Date='".$_POST["date"]."'";
		$sql_query = mysqli_query($conn, $sql) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql.'')));
		$rowt = mysqli_fetch_assoc($sql_query);
		$rown = mysqli_num_rows($sql_query);
		
		if($rown > 0){
			$sql_insert1 = "UPDATE `cas_attendance` SET `Present`=".$_POST["present"]." WHERE `CasualID`='".$_POST["casid"]."'";
			
			mysqli_query($conn, $sql_insert1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert1.'')));
			mysqli_query($conn, $sql_del) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.'')));
			
			$sql_count1 = "SELECT COUNT(*) AS nopresent FROM `cas_attendance` WHERE `Present`=1 AND Date='".$_POST["date"]."'";
			$count1_result = mysqli_query($conn, $sql_count1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count1.'')));
			$present = mysqli_fetch_assoc($count1_result);//number present
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Present</b>', 'num' => $present["nopresent"]));
        	die($output);
		}
		else{
			$sql_insert = "INSERT INTO `cas_attendance` (`id`, `CasualID`, `Date`, `Present`, `Excuse`, `Permission`) VALUES('".$newid."', '".$_POST["casid"]."', '".$_POST["date"]."', '".$_POST["present"]."', '0', '0')";
			
			mysqli_query($conn, $sql_insert) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert.'')));
			mysqli_query($conn, $sql_del) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.'')));
			
			$sql_count1 = "SELECT COUNT(*) AS nopresent FROM `cas_attendance` WHERE `Present`=1 AND Date='".$_POST["date"]."'";
			$count1_result = mysqli_query($conn, $sql_count1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count1.'')));
			$present = mysqli_fetch_assoc($count1_result);//number present
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Present</b>', 'num' => $present["nopresent"]));
        	die($output);
		}
	}
	elseif(isset($_POST["permission"])){
		$sql = "SELECT * FROM `cas_attendance` WHERE CasualID='".$_POST["casid"]."' AND Date='".$_POST["date"]."'";
		$sql_query = mysqli_query($conn, $sql) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql.'')));
		$rowt = mysqli_fetch_assoc($sql_query);
		$rown = mysqli_num_rows($sql_query);
			
		if($rown > 0){
			$sql_insert1 = "UPDATE `cas_attendance` SET `Permission`=".$_POST["permission"]." WHERE `CasualID`='".$_POST["casid"]."'";
		
			mysqli_query($conn, $sql_insert1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert1.'')));
			mysqli_query($conn, $sql_del) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.'')));
			
			$sql_count3 = "SELECT COUNT(*) AS nopermission FROM `cas_attendance` WHERE `Permission`=1 AND Date='".$_POST["date"]."'";
			$count3_result = mysqli_query($conn, $sql_count3) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count3.'')));
			$permission = mysqli_fetch_assoc($count3_result);//number on permission
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Permission</b>', 'num' => $permission["nopermission"]));
        	die($output);
		}
		else{
			$sql_insert = "INSERT INTO `cas_attendance` (`id`, `CasualID`, `Date`, `Present`) VALUES('".$newid."', '".$_POST["casid"]."', '".$_POST["date"]."', '".$_POST["permission"]."')";
			
			mysqli_query($conn, $sql_insert) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_insert.''))));
			mysqli_query($conn, $sql_del) or die (die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_del.''))));
			
			$sql_count3 = "SELECT COUNT(*) AS nopermission FROM `cas_attendance` WHERE `Permission`=1 AND Date='".$_POST["date"]."'";
			$count3_result = mysqli_query($conn, $sql_count3) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sql_count3.'')));
			$permission = mysqli_fetch_assoc($count3_result);//number on permission
			
			$output = json_encode(array('type'=>'available', 'text' => '<b>Marked as Permission</b>', 'num' => $permission["nopermission"]));
        	die($output);
		}
	}
	 
}

?>