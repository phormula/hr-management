<?php
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
    $start      = $_POST["startdt"];
    $apt     = $_POST["aptdate"];
	$emp_id = $_POST["emp"];
	$date = new DateTime($sd);
$interval = new DateInterval('P6M');

$date->add($interval);
	
	if(empty($_POST["start"]) && empty($_POST["aptdate"])) {
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Required Fields are empty'
        ));
        die($output); //exit script outputting json data
    }
	
  if(isset($_FILES['letter']['tmp_name']) && !empty($_FILES['letter']['tmp_name'])){
  		//Is file size is less than allowed size.
  		$folder = "employees_files/".$emp_id."_particulers/contract/";
  		$Random_Number      = rand(0, 9999999999);
		$uploadfile = "".$folder."contract".$Random_Number . basename($_FILES['letter']['name']);
	 
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
			 $start      = $_POST["start"];
    $apt     = $_POST["aptdate"];
	$emp_id = $_POST["emp"];
	$date = new DateTime($sd);
$interval = new DateInterval('P6M');

$date->add($interval);
				if (move_uploaded_file($_FILES['letter']['tmp_name'], $uploadfile)) {
    		$query1 = "INSERT INTO `contracts`(`employee_ID`, `AptDate`, `starting_date`, `due_date`, `letter`) VALUES('$emp_id', '$apt', '$start', '".$date->format('Y-m-d')."', '$uploadfile')";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
			
			$output = json_encode(array('type'=>'message', 'text' => 'Contract renewed Successfully'));
        	die($output);
			} 
			else {
    			$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  		}
		else{
	   		
				mkdir($folder, 0777, true);
 			if (move_uploaded_file($_FILES['letter']['tmp_name'], $uploadfile)) {
				 $start      = $_POST["start"];
    $apt     = $_POST["aptdate"];
	$emp_id = $_POST["emp"];
	$date = new DateTime($sd);
$interval = new DateInterval('P6M');

$date->add($interval);
    			$query1 = "INSERT INTO `contracts`(`employee_ID`, `AptDate`, `starting_date`, `due_date`, `letter`) VALUES('$emp_id', '$apt', '$start', '".$date->format('Y-m-d')."', '$uploadfile')";
 				mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
				$output = json_encode(array('type'=>'message', 'text' => '<b>Contract renewed Successfully</b>'));
        		die($output); 
				} 
			else {
				$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  			}
	 }
	elseif(isset($_POST) && !isset($_FILES['letter']['tmp_name'])){
			
	$start = $_POST["startdt"];
    		$apt = $_POST["aptdate"];
			$emp_id = $_POST["emp"];
			$date = new DateTime($start);
$interval = new DateInterval('P6M');

$date->add($interval);

    		$query1 = "INSERT INTO `contracts`(`employee_ID`, `AptDate`, `starting_date`, `due_date`) VALUES('$emp_id', '$apt', '$start', '".$date->format('Y-m-d')."')";
			mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
			
			$output = json_encode(array("type"=>"message", "text" => "Leave Assinged Successfully<br />Employee will report on"));
			die($output);
			}
			
 
}

?>