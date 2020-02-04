<?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        $server = "localhost";
        $username = "root";
        $password = "123456";
        $database = "Raspi02";

        $con = mysqli_connect($server, $username, $password, $database);
        $sql = "SELECT * FROM MS04_ketan";
        $result = mysqli_query($con, $sql);
        $array = array();
        $subArray=array();
        $no=1;
    while($row =mysqli_fetch_array($result))
    {
        $subArray['id'] = $row['idMS04_ketan'];
        $subArray['MS']= $row['MS'];
        $subArray['ketan']= $row['ketan'];
        $subArray['date']= $row['date'];
        $subArray['time']= $row['time'];
        $subArray['no'] = $no;
        $no++;
        $array[] =  $subArray ;
    }
    echo'{"records":'.json_encode($array).'}';
    mysqli_close($con);
?>
