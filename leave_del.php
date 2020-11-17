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
	
	if(is_array($_POST["id"])){
		$no = count($_POST["id"]);
		
		$emp_id = $_POST["emp"];
			
		for($i=0;$i < $no; $i++){
			$id = $_POST["id"][$i];
	
			$query2 = "DELETE FROM `employee_leave` WHERE `employee_ID`='".$emp_id."' AND `id`='".$id."'";
			
			mysqli_query($conn, $query2) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query2.'')));
		}
	
		$output = json_encode(array('type'=>'message', 'text' => 'Employee leave record deleted successfully'));
        die($output);
	}
}

?>