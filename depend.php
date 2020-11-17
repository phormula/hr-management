<?php
error_reporting(0);
include '../login/dbc.php';
page_protect();
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
    $name      = $_POST["name"];
    $dob     = $_POST["dob"];
    $dtype   = $_POST["dtype"];
	$emp_id = $_POST["emp"];
   
	if($dtype=="Spouse"){
		$sqlspouse = "SELECT * FROM `dependance` WHERE `EMPID`='".$emp_id."' AND `type`='Spouse'";

		$sql_resultspouse = mysqli_query($conn, $sqlspouse) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$sqlspouse.'')));
		$rowspouse = mysqli_fetch_assoc($sql_resultspouse);
		if($rowspouse){$output = json_encode(array('type'=>'error', 'text' => 'Spouse record already taken<br><br>Edit instead'));
        die($output); //output error}
$dob='';}}
			else{
				$dob = $_POST["dob"];
			}

  if(isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])){
  		//Is file size is less than allowed size.
  		$folder = "employees_files/".$emp_id."_particulers/dependant/";
  		$Random_Number      = rand(0, 9999999999);
		$uploadfile = "".$folder."dependant".$Random_Number . basename($_FILES['image']['name']);
	 
		if ($_FILES["image"]["size"] > 5242880) {
		$output = json_encode(array('type'=>'error', 'text' => 'File size is too big.'));
        die($output); //output error
		}
	
	//allowed file type Server side check
		switch(strtolower($_FILES['image']['type']))
			{
			//allowed file types
			case 'image/jpeg':
			case 'image/pjpeg':
			case 'image/png':
				break;
			default:
				$output = json_encode(array('type'=>'error', 'text' => 'Unsupported File type. Please upload an "image" file'));
       			 die($output); //output error
			}
	
		if(is_dir($folder))
  		{	
			
		if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
    		$query1 = "INSERT INTO `northwind`.`dependance` (`id`, `EMPID`, `Name`, `dob`, `image`, `type`) VALUES (NULL, '$emp_id', '$name', '$dob', '$uploadfile', '$dtype')";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
		
			$output = json_encode(array('type'=>'message', 'text' => 'Dependant Added Successfully'));
        	die($output);
			} 
			else {
    			$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  		}
else{
			
				mkdir($folder, 0777, true);
 			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
    		$query1 = "INSERT INTO `northwind`.`dependance` (`id`, `EMPID`, `Name`, `dob`, `image`, `type`) VALUES (NULL, '$emp_id', '$name', '$dob', '$uploadfile', '$dtype')";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
		
			$output = json_encode(array('type'=>'message', 'text' => 'Dependant Added Successfully'));
        	die($output);
			} 
			else {
    			$output = json_encode(array('type'=>'error', 'text' => 'Possible file upload attack.'));
        		die($output);
				}
  			}
	 }
	elseif(isset($_POST) && !isset($_FILES['image']['tmp_name'])){
			$query1 = "INSERT INTO `northwind`.`dependance` (`id`, `EMPID`, `Name`, `dob`, `type`) VALUES (NULL, '$emp_id', '$name', '$dob', '$dtype')";
			 mysqli_query($conn, $query1) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$query1.''))); 
		
			$output = json_encode(array('type'=>'message', 'text' => 'Dependant Added Successfully','path' => 'http://192.168.0.16/piccadilly/images/avatar.jpg'));
        	die($output);
			}
			
 
}

?>