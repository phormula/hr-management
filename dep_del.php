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
	$id = $_POST["id"];
	
	
		  //Sanitize input data using PHP filter_var().
	$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '1emaths';
$datab = 'northwind';
	$mysqli2 = new mysqli($hostname,$username,$password,$datab);

//Output any connection error
if ($mysqli2->connect_error) {
    die('Error : ('. $mysqli2->connect_errno .') '. $mysqli2->connect_error);
}

//MySqli Select Query
$results2 = $mysqli2->query("SELECT image FROM `dependance` WHERE `EMPID`='".$emp_id."' AND `id`='".$id."'");
$row2 = $results2->fetch_assoc();

// Frees the memory associated with a result
$results2->free();

// close connection
$mysqli2->close();
		
		if(!empty($row2["image"])){
		if(is_file($row2["image"])){
		unlink($row2["image"]);}}
   
    		$query1 = "DELETE FROM `dependance` WHERE `EMPID`='".$emp_id."' AND `id`='".$id."'";
			 mysqli_query($conn, $query1) or die(json_encode(array("type"=>"error", "text" =>"request Could not execute SQL query ".$query1.""))); 
			$output = json_encode(array("type"=>"message", "text" => 'Dependant record deleted successfully'));
			//unlink($row);
        	die($output);
}

?>