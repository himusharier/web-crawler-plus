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

		/*
		$bus_route_details[] = [
                "placeName" => $busRouteMod
        ];
        */

        $bus_route_details[] = $busRouteMod;

	}

	//echo json_encode($bus_route_details);

	//print_r($bus_route_details);


	$str = implode(", ", $bus_route_details);
	$str = explode("], ", $str);
	$str = implode(", ", $str);
	//$str = explode(" [ ", $str);
	$str = explode(', [', $str);
	$str = implode(", ", $str); // string data
	$str = array($str);
	//print_r($str[0]);
	//echo json_encode($str[0]);
	//echo json_encode($str);

	foreach ($str as $row) {

		$allData = $row;
		//$uniqueData = array_unique($allData); 
	}
	//print_r (json_decode($allData));
	$palceNameDate = (json_decode($allData));
	//print_r ($palceNameDate);

	foreach ($palceNameDate as $row2) {

		//echo $row["busName"];
		//echo "\n";
		$allData2[] = $row2;
		$uniqueData = array_unique($allData2); 
	}
	//echo json_encode($uniqueData);

	foreach ($uniqueData as $row3) {

		echo $row3;
		// uncomment to execute
		//$sql = "INSERT INTO all_places (placeNameEn, placeNameBn) VALUES ('$row3', '')";
		//mysqli_query($connect, $sql);
	}

	

}

?>