<?php
	include("../connection.php");

if(!empty($_POST) and isset($_POST))
{	
	$eID = $_POST['pk'];
    $col_name = $_POST['name'];
	$data = trim($_POST['value']);
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
	
	if(!empty($data)){
		$query = "UPDATE casuals SET `fname`='".$fname."', `mname`='".$mname."', `lname`='".$lname."' WHERE `id`='".$eID."'";
		mysqli_query($conn, $query);
	}
	else {
		header('HTTP 400 Bad Request', true, 400);
		echo "This field is required!";
	} 
}
?>