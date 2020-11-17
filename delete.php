<?php
/* include '../login/dbc.php';
page_protect(); */
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
	$emp_id = $_POST["emp"];
   
    		$query1 = "DELETE FROM `employees` WHERE `employee_ID`='".$emp_id."'";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
			$output = json_encode(array('type'=>'message', 'text' => 'Employee record deleted successfully'));
        	die($output);
}

?>