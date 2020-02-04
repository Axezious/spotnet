<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	
	$server = "localhost";
	$username = "root";
	$password = "123456";
	$database = "Raspi02";
	
	$con = mysqli_connect($server, $username, $password, $database);
	$sql = "SELECT * FROM MS01_ldr";
	$result = mysqli_query($con, $sql);
    	$array = array();
	$subArray=array();
	$no=1;
    while($row =mysqli_fetch_array($result))
    {
        $subArray['id'] = $row['idMS01_ldr'];
        $subArray['MS']= $row['MS'];
        $subArray['ldr']= $row['ldr'];
        $subArray['date']= $row['date'];
        $subArray['time']= $row['time'];
        $subArray['no'] = $no;
        $array[] =  $subArray ;
        $no++;
    }
    echo'{"records":'.json_encode($array).'}';    
    mysqli_close($con);
?>
