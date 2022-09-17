<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking_form";

$connection = new mysqli($servername,$username,$password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

if(!isset($_GET["id"])){
    $id= $_GET["id"];

$sql = "DELETE FROM booking where id=$id";
$connection->query($sql); 
}

if ($connection->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $connection->error;
  }
header("location:read.php");
exit;
?>
