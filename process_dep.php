<?php 
	/* include '../login/dbc.php';
page_protect(); */
  require("config.inc.php");  
 //please note that request will fail if you upload a file larger
 //than what is supported by your PHP or Webserver settings
 if((!empty($_POST) and isset($_POST) && !isset($_FILES['avatar'])))
{
	
    $col_name = $_POST['name'];
	$sid = $_POST['param1'];
	$data = $_POST['value'];
	$eID = $_POST['pk'];
		
	$query = "UPDATE `dependance` SET ".mysql_escape_string($col_name)."='".$data."' WHERE EMPID=:emp_id AND id=:sid";

        //Again, we need to update our tokens with the actual data:
        $query_params = array(
        
        ':emp_id' => $eID,
		':sid' => $sid,
        );

        //time to run our query, and create the user
        try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
        }
        catch (PDOException $ex) {
       die("Failed to run query: " . $ex->getMessage());
        }	
	}

	
sleep(1);//to simulate some delay for local host
 
 //is this an ajax request or sent via iframe(IE9 and below)?
 $ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']==='XMLHttpRequest';

 //our operation result including `status` and `message` which will be sent to browser 
 $result = array();
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
		|| !preg_match('/\.(jpe?g|gif|png|JPE?G)$/' , $file['name'])
			//or extension is not valid
			|| getimagesize($file['tmp_name']) === FALSE
				//or file info such as its size can't be determined, so probably an invalid image file
		)
	 {
		//then there is an error
		$result['status'] = 'ERR';
		$result['message'] = 'Invalid file format! BIG';
	 }
	 else if($file['size'] > 110000) {
		//if size is larger than what we expect
		$result['status'] = 'ERR';
		$result['message'] = 'Please choose a smaller file!';
	 }
	 else if($file['error'] != 0 || !is_uploaded_file($file['tmp_name'])) {
		//if there is an unknown error or temporary uploaded file is not what we thought it was
		$result['status'] = 'ERR';
		$result['message'] = 'Unspecified error!';
	 }
	 else {
		 $emp_id = filter_var($_POST['pk'], FILTER_SANITIZE_STRING);
		 $dep_id = $_POST['pk2'];
		//save file inside current directory using a safer version of its name
		$folder = "employees_files/".$emp_id."_particulers/dependant/";

		if(is_dir($folder))
  {
	  
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
$results2 = $mysqli2->query("SELECT image FROM `dependance` WHERE `EMPID`='".$emp_id."' AND `id`='".$dep_id."'");
$row2 = $results2->fetch_assoc();

// Frees the memory associated with a result
$results2->free();

// close connection
$mysqli2->close();
		
		if(is_file($row2["image"])){
		unlink($row2["image"]);}
		
		$save_path = $folder.preg_replace('/[^\w\.\- ]/', '', $file['name']);
		$random_number      = rand(0, 9999999999);
		//thumbnail name is like filename-thumb.jpg
		$thumb_path = preg_replace('/\.(.+)$/' , '', $save_path).$random_number.'_'.$emp_id.'-img.jpg';
  }
  else{mkdir($folder, 0777, true);
  $save_path = $folder.preg_replace('/[^\w\.\- ]/', '', $file['name']);
  $random_number      = rand(0, 9999999999);
		//thumbnail name is like filename-thumb.jpg
		$thumb_path = preg_replace('/\.(.+)$/' , '', $save_path).$random_number.'_'.$emp_id.'-img.jpg';
  }

		if(
			//if we were not able to move the uploaded file from its temporary location to our desired path
			!move_uploaded_file($file['tmp_name'] , $save_path)
			OR
			//or unable to resize image to our desired size
			!resize($save_path, $thumb_path, 691,886) 
		  )
		{
			$result['status'] = 'ERR';
			$result['message'] = 'Unable to save file!';
		}

		else {
			//everything seems OK
			$result['status'] = 'OK';
			$result['message'] = 'Avatar changed successfully!';
			//include new thumbnails `url` in our result and send to browser
			$result['url'] = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/'.$thumb_path;
			

        /*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '1emaths';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=northwind", $username, $password);
    /*** echo a message saying we have connected ***/
   // echo 'Connected to database<br />';

    /*** INSERT data ***/
    $count = $dbh->exec("UPDATE `dependance` SET image='$thumb_path' WHERE EMPID='$emp_id' AND id='$dep_id'");

    /*** echo the number of affected rows ***/
   // echo $count;

    /*** close the database connection ***/
    $dbh = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }	
			unlink($save_path);
		}
	 }
	 
	 return $result;
 }



function resize($in_file, $out_file, $new_width, $new_height)
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