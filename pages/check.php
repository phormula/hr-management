<?php
/* include '../login/dbc.php';
page_protect(); */
//include("config.php");
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
	$hostname = 'localhost';

/*** mysql username ***/
$username = 'phormuula';

/*** mysql password ***/
$password = '11emaths';
$datab = 'emaleck2';
	$mysqli2 = new mysqli($hostname,$username,$password,$datab);

//Output any connection error
if ($mysqli2->connect_error) {
    die('Error : ('. $mysqli2->connect_errno .') '. $mysqli2->connect_error);
}

//MySqli Select Query
$results2 = $mysqli2->query("SELECT * FROM `employees` WHERE `FirstName`='".$_POST['fname']."' and `LastName`='".$_POST['lname']."'");
$row2 = $results2->fetch_assoc();

// Frees the memory associated with a result
$results2->free();

// close connection
$mysqli2->close();
	 if($row2){
		 $output = json_encode(array('type'=>'available', 'text' => '<b>Similar Name Found In database</b>'));
        	die($output);
			}
			else{
		 $output = json_encode(array('type'=>'NOTavailable', 'text' => 'No Similar Name Found In database'));
        	die($output);
			}
}

?>