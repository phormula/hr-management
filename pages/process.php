<?php
/* include '../../login/dbc2.php';
page_protect(); */
include("../connection.php");
 //please note that request will fail if you upload a file larger
 //than what is supported by your PHP or Webserver settings
 sleep(1);//to simulate some delay for local host
 
 //is this an ajax request or sent via iframe(IE9 and below)?
 $ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';

 //our operation result including `status` and `message` which will be sent to browser 
 $result = array();
 if(isset($_FILES['avatar'])){
 $file = $_FILES['avatar'];
 
 
 if( is_string($file['name']) ) {
	//single file upload, file['name'], $file['type'] will be a string
	$result[] = validateAndSave($file);
 }
 else if( is_array($file['name']) ) {
	//multiple files uploaded
	$file_count = count($file['name']);

    //in PHP if you upload multiple files with `avatar[]` name, $file['name'], $file['type'], etc will be an array
	for($i = 0; $i < $file_count; $i++) {
		$file_info = array(
			    'name' => $file['name'][$i],
			    'type' => $file['type'][$i],
			    'size' => $file['size'][$i],
			'tmp_name' => $file['tmp_name'][$i],
			   'error' => $file['error'][$i]
		);
		$result[] = validateAndSave($file_info);
	}
 }/*fname', $("input#fname").val());
								formData_object.append('mname', $("input#mname").val());
						formData_object.append('lname', $("#lname").val());
								formData_object.append('email', $("input#email").val());
								formData_object.append('phone', $("input#phone").val());
								formData_object.append('dddd', $("input#dob").val());
								formData_object.append('department', $("input#department").val());
								formData_object.append('section', $("input#section").val());
								formData_object.append('rank', $("input#rank").val());
								formData_object.append('position', $("input#position").val());
								formData_object.append('apd', $("input#apd").val());
								formData_object.append('sd', $("input#sd").val());
								formData_object.append('report', $("input#report").val());
								formData_object.append('address'*/
 }else{
	 $hostname = 'localhost';

/*** mysql username ***/
$username = 'phormula';

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
		 $result['status'] = 'NOTOK';
			$result['message'] = 'Similar Record Found In database!';
			}
	 else{
	 $hostname = 'localhost';

/*** mysql username ***/
$username = 'phormula';

/*** mysql password ***/
$password = '11emaths';
$datab = 'emaleck2';
	$mysqli = new mysqli($hostname,$username,$password,$datab);

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//MySqli Select Query
$results = $mysqli->query("SELECT MAX(TRIM(LEADING 'PB' FROM `employee_ID`)) as emp_id FROM `employees`");
$row = $results->fetch_assoc();

// Frees the memory associated with a result
$results->free();

// close connection
$mysqli->close();


   
	$last_emp_id = empty($row['emp_id'])?0:$row['emp_id'];
	  $cur_emp_num = ($last_emp_id+1);
if($cur_emp_num <10){ 
$pre = "PB000";}
else if($cur_emp_num >9 && $cur_emp_num<100){
	$pre ="PB00";}
	else if($cur_emp_num>99 && $cur_emp_num<1000){
		$pre = "PB0";}
		else{$pre = "PB";}
$emp_id = $pre.$cur_emp_num;
	 
	 $toc = $_POST["toc"];
	 $fname = $_POST['fname'];
	 $mname = $_POST['mname'];
	 $lname = $_POST['lname'];
	 if(empty($_POST['ssid'])){$ssid = "NULL";}else{$ssid = "'".$_POST['ssid']."'";}
$email_address = $_POST['email'];
$phone = $_POST["phone"];
$dob = $_POST["dddd"];
$department = $_POST["department"];
$section = $_POST["section"];
$rank = $_POST["rank"];
$position = $_POST["position"];
$apd = $_POST["apd"];
$sd = $_POST["sd"];
$report = $_POST["report"];
$address = $_POST['address'];
	
$query1 = "INSERT INTO employees (`employee_ID`, `SSID`, `TitleOfCourtesy`, `FirstName`, `Middle_name`, `LastName`, `phone`, `email`, `department`, `section`, `rank`, `Position`, `BirthDate`, `HireDate`, `Address`, `ReportsTo`) VALUES('$emp_id', $ssid, '$toc', '$fname', '$mname', '$lname', '$phone', '$email_address', '$department', '$section', '$rank', '$position', '$dob', '$apd', '$address', '$report') ";
    
	mysqli_query ($conn ,$query1) or die(json_encode(array('status'=>'ERR', 'message' =>'request "Could not execute SQL query" '.$query1.'')));
	
	if($rank ==3){
		$date = new DateTime($sd);
$interval = new DateInterval('P6M');

$date->add($interval);
		

    /*** INSERT data ***/
    $query2 = "INSERT INTO `contracts`(`employee_ID`, `AptDate`, `starting_date`, `due_date`) VALUES('$emp_id', '$apd', '$sd','".$date->format('Y-m-d')."') ";
    mysqli_query ($conn ,$query2) or die(json_encode(array('status'=>'ERR', 'message' =>'request "Could not execute SQL query" '.$query2.'')));
    }
//everything seems OK
			$result['status'] = 'OK';
			$result['message'] = 'New Employee Added Successfully!';
			//include new thumbnails `url` in our result and send to browser
			$result['url'] = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/';}
 }
 $result = json_encode($result);
 if($ajax) {
	//if request was ajax(modern browser), just echo it back
	echo $result;
 }
 else {
	//if request was from an older browser not supporting ajax upload
	//then we have used an iframe instead and the response is sent back to the iframe as a script
	echo '<script language="javascript" type="text/javascript">';
	echo 'window.top.window.jQuery("#'.$_POST['temporary-iframe-id'].'").data("deferrer").resolve('.$result.');';
	echo '</script>';
 }




 function validateAndSave($file) {
	 $result = array();
 	 if(!preg_match('/^image\//' , $file['type'])
		//if file type is not an image
		|| !preg_match('/\.(jpe?g|gif|png)$/' , $file['name'])
			//or extension is not valid
			|| getimagesize($file['tmp_name']) === FALSE
				//or file info such as its size can't be determined, so probably an invalid image file
		)
	 {
		//then there is an error
		die(json_encode(array('status'=>'ERR', 'message' =>'Invalid file format! BIG')));
	 }
	 else if($file['size'] > 110000) {
		//if size is larger than what we expect
		die(json_encode(array('status'=>'ERR', 'message' =>'Please choose a smaller file!')));
	 }
	 else if($file['error'] != 0 || !is_uploaded_file($file['tmp_name'])) {
		//if there is an unknown error or temporary uploaded file is not what we thought it was
		die(json_encode(array('status'=>'ERR', 'message' =>'Unspecified error!')));
	 }
	 else {
		 /*** mysql hostname ***/
$hostname = 'localhost';


/*** mysql username ***/
$username = 'phormula';

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
		die(json_encode(array('status'=>'NOTOK', 'message' =>'Similar Record Found In database!')));
			}
	 else{
	$mysqli = new mysqli($hostname,$username,$password,$datab);

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//MySqli Select Query
$results = $mysqli->query("SELECT MAX(TRIM(LEADING 'PB' FROM `employee_ID`)) as emp_id FROM `employees`");
$row = $results->fetch_assoc();

// Frees the memory associated with a result
$results->free();

// close connection
$mysqli->close();
   
	$last_emp_id = empty($row['emp_id'])?0:$row['emp_id'];
	  $cur_emp_num = ($last_emp_id+1);
if($cur_emp_num <10){ 
$pre = "PB000";}
else if($cur_emp_num >9 && $cur_emp_num<100){
	$pre ="PB00";}
	else if($cur_emp_num>99 && $cur_emp_num<1000){
		$pre = "PB0";}
		else{$pre = "PB";}
$emp_id = $pre.$cur_emp_num;

$folder = "../employees_files/".$emp_id."_particulers/image/";
		//save file inside current directory using a safer version of its name
		mkdir($folder, 0777, true);
  $save_path = $folder.preg_replace('/[^\w\.\- ]/', '', $file['name']);
		//thumbnail name is like filename-thumb.jpg
		$thumb_path = preg_replace('/\.(.+)$/' , '', $save_path).'_'.$emp_id.'-img.jpg';

		if(
			//if we were not able to move the uploaded file from its temporary location to our desired path
			!move_uploaded_file($file['tmp_name'] , $save_path)
			OR
			//or unable to resize image to our desired size
			!resize($save_path, $thumb_path, 150))
		{
			die(json_encode(array('status'=>'ERR', 'message' =>'Unable to save file!')));
		}

		else {
			$toc = $_POST["toc"];
	 $fname = $_POST['fname'];
	 $mname = $_POST['mname'];
	 $lname = $_POST['lname'];
	 if(empty($_POST['ssid'])){$ssid = "NULL";}else{$ssid = "'".$_POST['ssid']."'";}
$email_address = $_POST['email'];
$phone = $_POST["phone"];
$dob = $_POST["dddd"];
$department = $_POST["department"];
$section = $_POST["section"];
$rank = $_POST["rank"];
$position = $_POST["position"];
$apd = $_POST["apd"];
$sd = $_POST["sd"];
$report = $_POST["report"];
$address = $_POST['address'];
	
$query1 = "INSERT INTO employees (`employee_ID`, `SSID`, `TitleOfCourtesy`, `FirstName`, `Middle_name`, `LastName`, `phone`, `email`, `department`, `section`, `rank`, `Position`, `BirthDate`, `HireDate`, `Address`, `ReportsTo`) VALUES('$emp_id', $ssid, '$toc', '$fname', '$mname', '$lname', '$phone', '$email_address', '$department', '$section', '$rank', '$position', '$dob', '$apd', '$address', '$report') ";
    
	mysqli_query ($conn ,$query1) or die(json_encode(array('status'=>'ERR', 'message' =>'request "Could not execute SQL query" '.$query1.'')));
	
	if($rank ==3){
		$date = new DateTime($sd);
$interval = new DateInterval('P6M');

$date->add($interval);
		

    /*** INSERT data ***/
    $query2 = "INSERT INTO `contracts`(`employee_ID`, `AptDate`, `starting_date`, `due_date`) VALUES('$emp_id', '$apd', '$sd','".$date->format('Y-m-d')."') ";
    mysqli_query ($conn ,$query2) or die(json_encode(array('status'=>'ERR', 'message' =>'request "Could not execute SQL query" '.$query2.'')));
    }
//everything seems OK
	echo(json_encode(array('status'=>'OK','message'=>'New Employee Added Successfully!', 'url' =>'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/'.$thumb_path.'')));
		
		unlink($save_path);	
		}
		}
	 }
	 
	 return $result;
 }



function resize($in_file, $out_file, $new_width, $new_height=FALSE)
{
	$image = null;
	$extension = strtolower(preg_replace('/^.*\./', '', $in_file));
	switch($extension)
	{
		case 'jpg':
		case 'jpeg':
			$image = imagecreatefromjpeg($in_file);
		break;
		case 'png':
			$image = imagecreatefrompng($in_file);
		break;
		case 'gif':
			$image = imagecreatefromgif($in_file);
		break;
	}
	if(!$image || !is_resource($image)) return false;


	$width = imagesx($image);
	$height = imagesy($image);
	if($new_height === FALSE)
	{
		$new_height = (int)(($height * $new_width) / $width);
	}

	
	$new_image = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	$ret = imagejpeg($new_image, $out_file, 80);

	imagedestroy($new_image);
	imagedestroy($image);

	return $ret;
}
?>