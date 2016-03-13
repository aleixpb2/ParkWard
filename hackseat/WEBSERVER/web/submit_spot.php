<!--submit_spot.php-->

<?php
// DB data
require("wp-config.php");
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;


// Get input
$fields = array("name", "lat", "lng");
$user_values = array($_GET["name"], $_GET["lat"], $_GET["lng"]);
$user_values[0] = "'" . $user_values[0] . "'";

echo json_encode($_GET);

$x1 = $_GET["x1"]; echo $x1 . "<br>";
$y1 = $_GET["y1"]; echo $y1 . "<br>";
$x2 = $_GET["x2"]; echo $x2 . "<br>";
$y2 = $_GET["y2"]; echo $y2 . "<br>";
$x3 = $_GET["x3"]; echo $x3 . "<br>";
$y3 = $_GET["y3"]; echo $y3 . "<br>";
$x4 = $_GET["x4"]; echo $x4 . "<br>";
$y4 = $_GET["y4"]; echo $y4 . "<br>";
$camera_id = $_GET["camera_id"]; echo $camera_id . "<br>";
$lat = $_GET["lat"]; echo $lat . "<br>";
$lng = $_GET["lng"]; echo $lng . "<br>";
echo date ("Y-m-d H:i:s") . "<br>";
$state = $_GET["state"]; echo $state . "<br>";
//$spot_id = $_GET["spot_id"]; echo $spot_id . "<br>";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "connected<br>";

// Make statement

//if ($spot_id == "0"){
	echo "id==0<br>";
	$sql = "INSERT INTO parking_spots (camera_id, lat, lng, last_update, x1, y1, x2, y2, x3, y3, x4, y4) VALUES ("
	. $camera_id . ", " . $lat . ", " . $lng . ", " . CURRENT_TIMESTAMP . ", " . $x1 . ", " . $y1
	. ", " . $x2 . ", " . $y2 . ", " . $x3 . ", " . $y3 . ", " . $x4 . ", " . $y4 . ")";

	echo $sql . "<br>";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully<br>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$id = $conn->insert_id;
	$msg = "Your camera " . $user_values[0] . " located at coordinates " . $user_values[1] . ", " . $user_values[2] . " has this ID:\\n"
		. $id . "\\nKeep this number, you will need it later!";
	echo "<script type='text/javascript'>alert(" . '"' . $msg . '"' . ");</script>";
	echo "id: " . $id . "<br>";

if (1==2) {

	// Codi per actualitzar un spot
	echo "spot != 0";

	$sql = "UPDATE parking_spots SET lat=" . $lat . ", lng=" . $lng . ", state=" . $state .
	", last_update=" . CURRENT_TIMESTAMP . ", x1=" . $x1 . ", y1=" . $y1 . ", x2=" . $x2 . 
	", y2=" . $y2 . ", x3=" . $x3 . ", y3=" . $y3 . ", x4=" . $x4 . ", y4=" . $y4 . 
	" WHERE camera_id=" . $camera_id . " AND spot_id=" . $spot_id;

	echo $sql . "<br>";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully<br>";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$id = $conn->insert_id;
	$msg = "Your camera " . $user_values[0] . " located at coordinates " . $user_values[1] . ", " . $user_values[2] . " has this ID:\\n"
		. $id . "\\nKeep this number, you will need it later!";
	echo "<script type='text/javascript'>alert(" . '"' . $msg . '"' . ");</script>";
	echo "id: " . $id . "<br>";
}

$conn->close();

//header("Location: http://bestbarcelona.org/externalprojects/hackseat/web/");

?>