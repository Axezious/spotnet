<?php
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
	//connect mongoDB
	$manager     =   new MongoDB\Driver\Manager("mongodb://localhost:27017");

	$aggregate = [
		'aggregate' => 'MS02_hum',
		'pipeline' => [

			/* [ '$project' => [ 'hum' => 1, 'date' => 1, 'MS' => 1]],
			[ '$match' => [ 'date' => $date]],
			[ '$limit' => 3 ], */
			
			/* [ '$project' => [ 'date' => [ '$dateFromParts' => ['year' => 2019 ,'month' => 10 , 'day' => 01]] ]  ],
			[ '$sort' => ['_id' => 1] ],
			[ '$limit' => 2 ] */

			[ '$project' => [ 'hum' => 1 , 'date' => [ '$month' => '$date'] ]  ],
			[ '$match' => [ 'date' => 10 ] ]
			  
		],
		'cursor' => new stdClass,
	];
	$command = new MongoDB\Driver\Command($aggregate);
	$result = $manager->executeCommand("Raspi02", $command);
	$no=1;
	$array = array();
	$subArray = array();
	foreach ($result as $key => $ms02)
	{	
		$subArray['no'] = $no;
		$subArray['id'] = $ms02->_id;
		$subArray['MS'] = $ms02->MS;
		$subArray['hum'] = $ms02->hum;
		$subArray['date'] = $ms02->date;
		$array[] = $subArray;	
		$no++;
		
		//print_r($value);
	}
	echo json_encode($array);
?>
