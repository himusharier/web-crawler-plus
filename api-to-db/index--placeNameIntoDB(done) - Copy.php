<?php
header('Content-Type: application/json');

$siteUrl = "https://rongdhonustudio.com/DhakaBus.html";
$page_contents = file_get_contents($siteUrl);


if ($page_contents !== FALSE && !empty($page_contents)) {

	$connect = mysqli_connect("localhost","root","","busfair_main_database") or die('Could not connect: ' . mysql_error());
	
	// extract bus route details
	$bus_details = explode('<div class="accordion" id="BusRouteAccordion">', $page_contents);
	$bus_details = explode('</div> ', $bus_details[1]);

	// get bus routes
	$bus_routes = explode('aria-expanded="false"
                    style="color: white; background-color:lightseagreen;">', $bus_details[0]);
	array_shift($bus_routes);


	for ($i=0; $i < count($bus_routes); $i++) { 

		// get a bus route
		$bus_route = explode('<div class="card card-body"><b>Route: </b>', $bus_routes[$i]);
		$bus_route = explode('</div>', $bus_route[1]);
		//$bus_route = trim($bus_route[0]);
		$bus_route = trim(preg_replace('/[\t\n\r\s]+/', ' ', $bus_route[0]));

		$busRouteMod = explode('-', trim($bus_route));
		//$busRouteMod = json_encode($busRouteMod);
		$busRouteMod = json_encode(array_map('trim',$busRouteMod));

		$bus_route_details[] = $busRouteMod;

	}

	foreach ($bus_route_details as $row) {

		print_r($row);

		//$placeName = json_encode($row["placeName"]);
		//$arrayMerge = array_merge(($placeName));
		//echo $arrayMerge;



		//echo json_encode($row["placeName"]);
		//$placeName = json_encode($row["placeName"]);

		//echo "\n";
		/*
		$allData[] = $row["placeName"];
		$uniqueData = array_unique($allData); 
		*/

		//$arrayMerge = array_merge(array($placeName));

		//echo json_encode($arrayMerge);

	}

	foreach ($arrayMerge as $row2) {

		//echo json_encode($row2);

		// uncomment to execute
		//$sql = "INSERT INTO all_buses (busNameEn, busNameBn) VALUES ('$row2', '')";
		//mysqli_query($connect, $sql);
	}

	//echo json_encode($uniqueData);


}

?>