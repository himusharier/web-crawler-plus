<?php
/*
    //connect to mysql db
    //$con = mysql_connect("root","localhost","") or die('Could not connect: ' . mysql_error());
    $con = mysqli_connect("localhost","root","","busfair_main_database");
    //connect to the database
    //mysql_select_db("busfair_main_database", $con);

    //read the json file contents
    $jsondata = file_get_contents('busAndPlaceData.json');
    
    //convert json object to php associative array
    $data = json_decode($jsondata, true);
    
    //get the bus details
    $busName = $data['busDetails']['busRoute'];
    
    //insert into mysql table
    $sql = "INSERT INTO all_buses (busNameEn, busNameBn) VALUES ('$busName', '')";
    if(!mysqli_query($sql,$con))
    {
        die('Error : ' . mysqli_error());
    }
*/

/*
$jsondata = file_get_contents('http://localhost/web-crawler-plus/');
$data = json_decode($jsondata, true);
echo $data['busDetails']['busName'];
*/

/*
$connect = mysqli_connect("localhost","root","","busfair_main_database") or die('Could not connect: ' . mysql_error());
$fileName = "busAndPlaceData.json";
$data = file_get_contents($fileName);
$array = json_decode($data, true);

//echo $row["busDetails"]["busName"];
echo json_encode($array);

foreach ($array as $row) {
	$sql = "INSERT INTO all_buses (busNameEn, busNameBn) VALUES (".$row["busDetails"]["busName"].", "")";
		mysqli_query($connect, $sql);

		//echo $row["busDetails"]["busName"];
}
*/

/*
$josndata = file_get_contents('busAndPlaceData.json');

  $data = json_decode($josndata);
  $singledataName = $data->busDetails->busName;
  //$singledataCountry = $data->student->country;

  echo $singledataName;
  //echo $singledataCountry;

  foreach ($data as $row) {
	echo $singledataName;
  	//echo $singledataCountry;
}
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO student_table ( name, jsondata )
VALUES ('Harry', '$singledata')";

if ($conn->query($sql) === TRUE) {
  echo "Store data only single successfully";
}
*/

/*
// reading json file
$json = file_get_contents('busAndPlaceData.json');

//converting json object to php associative array
$data = json_decode($json, true);

// processing the array of objects
foreach ($data as $user) {
    $firstname = $user['busDetails']['busName'];

    echo $firstname;


    // preparing statement for insert query
    $st = mysqli_prepare($connection, 'INSERT INTO users(firstname, lastname, gender, username) VALUES (?, ?, ?, ?)');

    // bind variables to insert query params
    mysqli_stmt_bind_param($st, 'ssss', $firstname, $lastname, $gender, $username);

    // executing insert query
    mysqli_stmt_execute($st);
}
*/

$connect = mysqli_connect("localhost", "root", "", "busfair_main_database"); 
              
            $query = '';
            $table_data = '';

// json file name
            $filename = "busAndPlaceData.json";
            
            // Read the JSON file in PHP
            $data = file_get_contents($filename); 
            
            // Convert the JSON String into PHP Array
            $array = json_decode($data, true); 
            
            // Extracting row by row
            foreach($array as $row) {
  
                // Database query to insert data 
                // into database Make Multiple 
                // Insert Query 
                $query .= 
                "INSERT INTO student VALUES 
                ('".$row['busDetails']['busName']."', ''); "; 
               
                $table_data .= '
                <tr>
                    <td>'.$row['busDetails']['busName'].'</td>
                </tr>
                '; // Data for display on Web page
            }
  
            if(mysqli_multi_query($connect, $query)) {
                echo '<h3>Inserted JSON Data</h3><br />';
                echo '
                <table>
                <tr>
                    <th width="45%">Name</th>
                </tr>
                ';
                echo $table_data;  
                echo '</table>';
            }


?>