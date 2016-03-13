<!--submit_camera.php-->

<?php
require("wp-config.php");
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;


// Get input
$fields = array("name", "lat", "lng");
$user_values = array($_GET["name"], $_GET["lat"], $_GET["lng"]);
$user_values[0] = "'" . $user_values[0] . "'";

for ($i=0; $i<count($fields); $i++){
	echo "Your " . $fields[$i] . ": " . $user_values[$i] . "<br>";
}
echo "<br><br>";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Make statement
$sql = "INSERT INTO cameras (" . $fields[0];

for ($i=1; $i<count($fields); $i++){
	$sql = $sql . ", " . $fields[$i];
}
$sql = $sql . ") VALUES (" . $user_values[0];
for ($i=1; $i<count($user_values); $i++){
	$sql = $sql . ", " . $user_values[$i];
}
$sql = $sql . ")";

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

$conn->close();

//header("Location: http://bestbarcelona.org/externalprojects/hackseat/web/");

?>

<html>