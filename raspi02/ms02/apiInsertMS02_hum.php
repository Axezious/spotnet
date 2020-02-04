<?php
	// date_default_timezone_set("Asia/Jakarta");
	// $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	// $messages = array(
  	// 1=>'Record deleted successfully',
  	// 2=>'Error occurred. Please try again', 
  	// 3=>'Record saved successfully',
  	// 4=>'Record updated successfully', 
	// 5=>'All fields are required' );
	
	// $ms = $_GET["MS"];
	// $hum = $_GET["hum"];
	// $date = $_GET["date"];
	// $time = $_GET["time"];
/*     $date = date("d/m/Y"); */
	/* $tz = new DateTimeZone('Asia/Jakarta'); //Change your timezone
	$date = date("Y-m-d h:i:sa"); //Current Date
	$a = new MongoDB\BSON\UTCDateTime(strtotime($date)*1000);
             
    $datetime = $a->toDateTime();

    $datetime->setTimezone($tz); //Set timezone
	$time=$datetime->format(DATE_RSS);  //(example: 2005-08-15T15:52:01+00:00) */
	
	/* $orig_date = new DateTime();
	$orig_date=$orig_date->getTimestamp();
	$utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000); */
	/********************retrieve time in UTC**********************************/
	/* $datetime = $utcdatetime->toDateTime();
	$time=$datetime->format(DATE_RSS); */
	/********************Convert time local timezone*******************/
	/* $dateInUTC=$time;
	$time = strtotime($dateInUTC.' WIB');
	$dateInLocal = date("Y-m-d H:i:s", $time); */

	// $insRec       = new MongoDB\Driver\BulkWrite;

	// $doc = ['_id' => new MongoDB\BSON\ObjectID, 'MS' => $ms , 'hum' => $hum ,'date' => $date, 'time' => $time , 'status' => 1];

	// $insRec->insert($doc);

	// $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

	// $result = $mng->executeBulkWrite('Raspi02.MS02_hum', $insRec, $writeConcern);

	// $array = array();
    // 	$subArray = array();
	// if($result->getInsertedCount()){
	// 	$subArray['tampung'] = "success";
    //        	$array[] =  $subArray;
    //             echo'{"fields":{"records":'.json_encode($array).'}}';
	// }else{
	// 	$subArray['tampung'] = "failed";
    //        	$array[] =  $subArray ;
	// 	echo'{"fields":{"records":'.json_encode($array).'}}'; 
	// }

	date_default_timezone_set("Asia/Jakarta");
        $server = "localhost";
        $username = "root";
        $password = "123456";
        $database = "Raspi02";
              
          $con = mysqli_connect($server, $username, $password, $database);
              
          $ms = $_GET["MS"];
          $hum = $_GET["hum"];
          $time = $_GET['time'];
          $date = $_GET['date'];
                  
          $sql = "INSERT INTO MS02_hum(MS,hum,date,time,status) VALUES ('$ms','$hum','$date','$time','1')";
          $result = mysqli_query($con, $sql);
          $checkrow = "SELECT MS FROM MS02_hum WHERE MS = '$ms'";
          $resultcheck = mysqli_query($con, $checkrow);
          $cek = mysqli_num_rows($resultcheck);
          $array = array();
          $subArray = array();
      
          if($cek>0)
          {
            $subArray['status'] = "OK";
            $array[] =  $subArray ;
      //printf("Result set has %d rows.\n",$cek);
          } else {
            $subArray['status'] = "failed";
            $array[] =  $subArray ;
      //printf("Result set has %d rows.\n",$cek);
                 }
      
          echo'{"fields":{"records":'.json_encode($array).'}}';
          mysqli_close($con);
?>
