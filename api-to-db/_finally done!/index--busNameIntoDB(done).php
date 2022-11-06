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

		// get bus name
		$bus_name = explode('role=" button" aria-expanded="false" style="color: white; background-color:lightseagreen;">', $bus_routes[$i]);
		$bus_name = explode('</a>', $bus_name[0]);
		$bus_name = trim($bus_name[0]);

		$bus_route_details[] = [
                "busName" => $bus_name
            ];

	}

	foreach ($bus_route_details as $row) {

		//echo $row["busName"];
		//echo "\n";
		$allData[] = $row["busName"];
		$uniqueData = array_unique($allData); 
	}

	//echo json_encode($allData);
	//echo json_encode($uniqueData);

	foreach ($uniqueData as $row2) {

		echo $row2;
		// uncomment to execute
		//$sql = "INSERT INTO all_buses (busNameEn, busNameBn) VALUES ('$row2', '')";
		//mysqli_query($connect, $sql);
	}



}

?>