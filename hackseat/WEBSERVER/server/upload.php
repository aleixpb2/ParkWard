<?php

// DB data
require("../web/wp-config.php");
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;


$target_dir = "/var/www/html/externalprojects/hackseat/images/";
$target_file = $target_dir  . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//echo json_encode($_POST);

//echo $_FILES['userfile']['error'];
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Error: File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Error: file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["userfile"]["size"] > 5000000) {
    echo "Error: Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Error:  only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if (is_dir($target_dir) && is_writable($target_dir)) {
    // do upload logic here
} else {
    echo 'Error: Upload directory is not writable, or does not exist.';
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Error, your file was not uploaded.";
// if everything is ok, try to upload file

} else {
    if (copy($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "Image received";
    } else {
        echo "Error: there was an error uploading your file.";
    }
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get camera_id
/*// DEBUG
$target_file = "/var/www/html/externalprojects/hackseat/images/666_1457793133021.jpg";
//*/
echo basename($target_file);
$pieces = explode("_", basename($target_file));
$camera_id = $pieces[0];
echo $camera_id . PHP_EOL;

// Get all spots
$sql = "SELECT spot_id, x1, y1, x2, y2, x3, y3, x4, y4, last_update FROM parking_spots WHERE camera_id=" . $camera_id;

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo PHP_EOL . "x1: " . $row["x1"]. " - y1: " . $row["y1"] . "x2: " . $row["x2"]. " - y2: " . $row["y2"] . 
        "x3: " . $row["x3"]. " - y3: " . $row["y3"] . "x4: " . $row["x4"]. " - y4: " . $row["y4"] . 
        " - last_update: " . $row["last_update"] . PHP_EOL;
        echo $target_file . PHP_EOL;

        // Call python CV puroguramu
        $command = escapeshellcmd('/usr/bin/python2.7 getSpotState.py ' . $row["x1"] . ' ' . $row["y1"]
        . ' ' . $row["x2"] . ' ' . $row["y2"] . ' ' . $row["x3"] . ' ' . $row["y3"] . ' ' . $row["x4"]
        . ' ' . $row["y4"] . ' ' . $target_file);
        $output = shell_exec($command);
        $state = $output;
        echo "CV program has run" . PHP_EOL . "state: " . $state . PHP_EOL;

        // Update DB
        $sql = "UPDATE parking_spots SET state=" . $state . ", last_update=CURRENT_TIMESTAMP WHERE camera_id=" . $camera_id . " AND spot_id=" . $row["spot_id"];

        echo $sql . PHP_EOL;

        if ($conn->query($sql) === TRUE) {
            echo "SQL: Success<br>";
        } else {
        echo "Error: " . $sql . PHP_EOL . $conn->error;
        }

    }
} else {
    echo "no spots found in the image";
}

$conn->close();

?>