<?php
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $server="localhost";
    $username="root";
    $password="123456";
    $database="Raspi02";
	$con = mysqli_connect($server, $username, $password, $database);
	$username = $_GET["username"];
	$password = $_GET["password"];
	
	$sql = "SELECT * FROM Raspi02_pengguna WHERE username = '$username' AND password = '$password' ";
	$result = mysqli_query($con, $sql);
	$cek = mysqli_num_rows($result);
	$array = array();
	$subArray=array();
	while($row = mysqli_fetch_array($result)){
		$subArray['idusers'] = $row['id'];
		$subArray['username'] = $row['username'];
	}
	if ($cek>0)
	{
		$subArray['status'] = "OK";
		$array[] =  $subArray ;
	} else {
		$subArray['status'] = "FAILED";
		$array[] =  $subArray ;
	}
	echo json_encode($array);
	mysqli_close($con);
?>
