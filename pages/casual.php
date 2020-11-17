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
   
    //Sanitize input data using PHP filter_var().
	$dpt = $_POST["dpt"];
	$data = $_POST["fname"];
	$remove = array('/\b(mrs)\b/i', '/\b(mr)\b/i', '/\b(miss)\b/i');
	$replace = array("", "", "");
	$clower =  preg_replace('/[.,]/' , '', strtolower($data), 1);
	$output = strtoupper(preg_replace($remove, $replace, $clower, 1));
	$fname = strtok($output, " ");
	$clname = explode(' ', $output);
	$lname = array_pop($clname);
	if(str_word_count($output) > 2){
		$out_lname = substr($output, 0, strrpos($output, " "));
		$mname = trim(str_ireplace($fname, "", $out_lname));
	}else {
		$mname = "";
	}
	
	$querys = "SELECT MAX(id) as CUR FROM `casuals`";
	$query_result = mysqli_query($conn, $querys) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$querys.'')));
	$row = mysqli_fetch_array($query_result);
	$cur_id = $row["CUR"];
	$newid = $cur_id +1;
	if($newid>9 and $newid<100){
		$num = "00".$newid;
	}
	elseif($newid>99 and $newid<1000){
		$num = "0".$newid;
	}
	elseif($newid>999){
		$num = $newid;
	}
	else{
		$num = "000".$newid;
	}
	$casid = "PBC".$num;

    		$query1 = "INSERT INTO `casuals`(`id`, `CasualID`, `fname`, `mname`, `lname`, `Department`, `date`) VALUES ('$newid','$casid', '$fname', '$mname', '$lname','$dpt', NOW())";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
	
			$output = json_encode(array('type'=>'message', 'text' => 'New Casual added successfully'));
        	die($output);

}

?>