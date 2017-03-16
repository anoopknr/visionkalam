 <?php

$mysql_servername = "localhost";
$mysql_username = "root";
$mysql_password = "apjkalam";
$mysql_database = "vision_kalam";

// Create connection
$conn = mysqli_connect($mysql_servername, $mysql_username, $mysql_password,$mysql_database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
