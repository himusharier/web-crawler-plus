<?php
header('Content-Type: application/json');

$siteUrl = "https://rongdhonustudio.com/DhakaBus.html";
$page_contents = file_get_contents($siteUrl);

if ($page_contents !== FALSE && !empty($page_contents)) {
	
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
		
		// get a bus route
		$bus_route = explode('<div class="card card-body"><b>Route: </b>', $bus_routes[$i]);
		$bus_route = explode('</div>', $bus_route[1]);
		//$bus_route = trim($bus_route[0]);
		$bus_route = trim(preg_replace('/[\t\n\r\s]+/', ' ', $bus_route[0]));

		$busRouteMod = explode('-', trim($bus_route));
		//$busRouteMod = json_encode($busRouteMod);
		$busRouteMod = json_encode(array_map('trim',$busRouteMod));

		/*echo '
		<div>
		<h2>'.$bus_name.'</h2>
		<pre>
		';

		print_r($busRouteMod);

		echo '
		</div>
		';*/

		/*echo '
		<div>
		<h2>'.$bus_name.'</h2>
		<p>'.$bus_route.'</p>
		</div>
		';*/

		$bus_route_details[] = [
                "busName" => $bus_name,
                "busRoute" => json_decode($busRouteMod)
            ];

	}

	echo json_encode(['status'=>'found','busDetails'=>$bus_route_details,'crawledSite'=>$siteUrl]);

} else {

	echo json_encode(['status'=>'error','busDetails'=>'not-found','crawledSite'=>$siteUrl]);
}

?>