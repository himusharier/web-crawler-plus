<?php

$page_contents = file_get_contents('https://rongdhonustudio.com/DhakaBus.html');

if ($page_contents !== FALSE && !empty($page_contents)) {
	
	// extract bus route details
	$bus_details = explode('<div class="accordion" id="BusRouteAccordion"><ul id="myUL">', $page_contents);
	$bus_details = explode('<ul></div>', $bus_details[0]);

	// get bus routes
	$ib = 1;
	$bus_routes = explode('role="button" aria-expanded="false"
                    style="color: white; background-color:lightseagreen;">', $bus_details[0]);
	array_shift($bus_routes);

	for ($i=0; $i < count($bus_routes); $i++) { 
		
		// get a bus route
		$bus_route = explode('<div class="card card-body"><b>Route: </b>', $bus_routes[$i]);
		$bus_route = explode('</div>', $bus_route[1]);
		//$bus_route = explode('"', $bus_route[1]);
		$bus_route = trim($bus_route[0]);

		// get bus name
		$bus_name = explode('role=" button" aria-expanded="false" style="color: white; background-color:lightseagreen;">', $bus_routes[$i]);
		$bus_name = explode('</a>', $bus_name[0]);
		$bus_name = trim($bus_name[0]);


		echo '
		<div>
		<h2>'.$bus_name.'</h2>
		<p>'.$bus_route.'</p>
		</div>
		';
	}

}

?>