<?php
        date_default_timezone_set("Asia/Jakarta");
        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $messages = array(
        1=>'Record deleted successfully',
        2=>'Error occurred. Please try again',
        3=>'Record saved successfully',
        4=>'Record updated successfully',
        5=>'All fields are required' );

        $ms = $_GET["MS"];
        $ultra = $_GET["ultra"];
        $date = $_GET["date"];
	$time = $_GET["time"];
        $insRec       = new MongoDB\Driver\BulkWrite;
        $doc = ['_id' => new MongoDB\BSON\ObjectID, 'MS' => $ms , 'ultra' => $ultra ,'date' => $date, 'time' => $time , 'status' => 1];
        $insRec->insert($doc);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $mng->executeBulkWrite('Raspi02.MS03_ultra', $insRec, $writeConcern);
        $array = array();
        $subArray = array();
        if($result->getInsertedCount()){
                $subArray['tampung'] = "success";
                $array[] =  $subArray;
                echo'{"fields":{"records":'.json_encode($array).'}}';
        }else{
                $subArray['tampung'] = "failed";
                $array[] =  $subArray ;
                echo'{"fields":{"records":'.json_encode($array).'}}';
        }
?>

