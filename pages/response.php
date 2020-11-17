
<?php
	//include connection file 
	include_once("../connection.php");
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = $data1 = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'CasualID',
		1 =>'fname',
		1 =>'mname',
		1 =>'lname'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( c.fname LIKE '".$params['search']['value']."%' ";    
		$where .=" OR c.mname LIKE '".$params['search']['value']."%' ";
		$where .=" OR c.lname LIKE '".$params['search']['value']."%' )"; 
	}

	// getting total number records without any search
	$sql = "SELECT c.*, a.Present, a.Excuse, a.Permission, a.Date FROM `casuals` c LEFT OUTER JOIN cas_attendance a ON c.`CasualID`=a.`CasualID`";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}
	
	$sqlTot .= " GROUP BY c.`CasualID` ";

 	$sqlRec .=  " GROUP BY c.`CasualID` ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));
	
	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch customers data");
	
	//iterate on results row and create new index array of data
	while( $row = mysqli_fetch_array($queryRecords) ) { 
		$queryat = "SELECT date FROM `attendance_date` WHERE id='1'";
		$query_resultat = mysqli_query($conn, $queryat) or die(json_encode(array('type'=>'error', 'text' =>'request "Could not execute SQL query" '.$queryat.'')));
		$rowat = mysqli_fetch_assoc($query_resultat);
		
		$casid = '<p>'.$row["CasualID"].'</p>';
		if(!empty($row["mname"])){$mname = $row["mname"].' ';}else{$mname = '';}
		$name = '<span class="xedit" data-original-title="Edit Name" data-pk="'.$row["id"].'" data-name="Name">'.$row["fname"].' '.$mname.$row["lname"].'</span>';
		
		if($row["Date"]==$rowat["date"] && $row["Present"]=='1'){
			$present = '<div class="checkbox"><label><input type="checkbox" name="present" checked id="present" disabled="disabled"> <div id="ppp"></div></label></div>';
			$excuse = '<div class="checkbox"><label><input type="checkbox" name="excuse" id="excuse" disabled="disabled"> <div id="popp"></div></label></div>';
			$permission = '<div class="checkbox"><label><input type="checkbox" name="permission" id="permission" disabled="disabled"> <div id="pppp"></div></label></div>';
		}
		else{
			$present = '<div class="checkbox"><label><input type="checkbox" name="present" id="present" disabled="disabled"> <div id="ppp"></div></label></div>';
			}
		if($row["Date"]==$rowat["date"] && $row["Excuse"]=='1'){
			$excuse = '<div class="checkbox"><label><input type="checkbox" name="excuse" checked id="excuse" disabled="disabled"> <div id="popp"></div></label></div>';
		}
		else{
			$excuse = '<div class="checkbox"><label><input type="checkbox" name="excuse" id="excuse" disabled="disabled"> <div id="popp"></div></label></div>';
		}
		if($row["Date"]==$rowat["date"] && $row["Permission"]=='1'){
			$permission = '<div class="checkbox"><label><input type="checkbox" name="permission" checked id="permission" disabled="disabled"> <div id="pppp"></div></label></div>';
		}
		else{
			$permission = '<div class="checkbox"><label><input type="checkbox" name="permission" id="permission" disabled="disabled"> <div id="pppp"></div></label></div>';
		}
		
		$data[] = array( $casid, $name ,$present,$excuse,$permission );
	}	
	
	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	