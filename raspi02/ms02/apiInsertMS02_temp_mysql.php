<?php
  date_default_timezone_set("Asia/Jakarta");
  $server = "localhost";
  $username = "root";
  $password = "123456";
  $database = "Raspi02";
	
    $con = mysqli_connect($server, $username, $password, $database);
	
    $ms = $_GET["MS"];
    $temp = $_GET["temp"];
    $time = date("H:i A");
    $date = date("d/m/Y");
    	
    $sql = "INSERT INTO MS02_temp(MS,temp,date,time,status) VALUES ('$ms','$temp','$date','$time','1')";
    $result = mysqli_query($con, $sql);
    $checkrow = "SELECT MS FROM MS02_temp WHERE MS = '$ms'";
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
