<?php
	header("Access-Control-Allow-Origin: *");
    	header("Content-Type: application/json");
	//connect mongoDB
	$manager     =   new MongoDB\Driver\Manager("mongodb://localhost:27017");
	/* success, error messages to be displayed */
 	$messages = array(
  	1=>'Record deleted successfully',
  	2=>'Error occurred. Please try again', 
  	3=>'Record saved successfully',
  	4=>'Record updated successfully', 
  	5=>'All fields are required' );
	
	$flag = isset($_GET['flag'])?intval($_GET['flag']):0;
	
	$message = '';
	
	if($flag){
	$message = $messages[$flag];
	}

	$filter = [];

	$options = [
	'sort' => ['_id' => 1],
	];

	$query = new MongoDB\Driver\Query($filter, $options);
	$cursor = $manager->executeQuery('Raspi02.MS06_rpm',$query);

	$array = array();
	$subArray=array();
	$no = 1;	
	foreach($cursor as $rpm){
	$subArray['no'] = $no;
	$subArray['id'] = $rpm->_id;
	$subArray['MS'] = $rpm->MS;
	$subArray['rpm'] = $rpm->rpm;
	$subArray['date'] = $rpm->date;
	$subArray['time'] = $rpm->time;
	$array[] = $subArray;	
	$no++;
	}
	echo'{"records":'.json_encode($array).'}';
?>
