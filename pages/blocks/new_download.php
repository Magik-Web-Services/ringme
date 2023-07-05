<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$id = intval($_POST['type']);
if (!isset($_COOKIE['down' . $id])) {
    setcookie("down" . $id, "123", time() + 3600);

$sql = "UPDATE songs SET downloads= downloads+ '1' , downweek= downweek+ '1' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
} 
?>