<?php
       /* date_default_timezone_set("Asia/Jakarta");
        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $messages = array(
        1=>'Record deleted successfully',
        2=>'Error occurred. Please try again',
        3=>'Record saved successfully',
        4=>'Record updated successfully',
        5=>'All fields are required' );

        $ms = $_GET["MS"];
        $rpm = $_GET["rpm"];
        $date = $_GET["date"];
	$time = $_GET["time"];
        $insRec       = new MongoDB\Driver\BulkWrite;
        $doc = ['_id' => new MongoDB\BSON\ObjectID, 'MS' => $ms , 'rpm' => $rpm ,'date' => $date, 'time' => $time , 'status' => 1];
        $insRec->insert($doc);
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $mng->executeBulkWrite('Raspi02.MS06_rpm', $insRec, $writeConcern);
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
        }*/
        date_default_timezone_set("Asia/Jakarta");
        $server = "localhost";
        $username = "root";
        $password = "123456";
        $database = "Raspi02";
              
          $con = mysqli_connect($server, $username, $password, $database);
              
          $ms = $_GET["MS"];
          $rpm = $_GET["rpm"];
          $time = $_GET['time'];
          $date = $_GET['date'];
                  
          $sql = "INSERT INTO MS06_rpm(MS,rpm,date,time,status) VALUES ('$ms','$rpm','$date','$time','1')";
          $result = mysqli_query($con, $sql);
          $checkrow = "SELECT MS FROM MS06_rpm WHERE MS = '$ms'";
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

