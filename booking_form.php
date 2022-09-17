<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking_form";

$conn = new mysqli($servername,$username,$password, $dbname);

$name = $_POST['name'];
$phone = $_POST['phone'];
//$b_time = $_POST['b_time'];
//$food = $_POST['food'];
$number_people = $_POST['number_people'];

  if($conn->connect_error){
    die('connection failed'.$conn->connect_error);
}
else{
    $stmt = $conn->prepare ("insert into booking (name, phone, number_people)
    values (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $phone, $number_people);
    $stmt->execute();
    echo "booking secceeded..";
    $stmt->close();
    $conn->close();

}
?>