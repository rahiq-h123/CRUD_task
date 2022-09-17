<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booked people</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container my-5">
        <h2> List of booked people </h2>
        <a class="btn btn-primary" href="/booking_form/create.php" role="button">New Booking</a>
        <br>
        <table class="table">
        <thead>
            <tr>
                <th> ID </th>
                <th> Name </th>
                <th> Phone </th>
                <th> Number of people </th>
        </tr>
        </thead>
        <tbody>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking_form";

$connection = new mysqli($servername,$username,$password, $dbname);


$sql ="SELECT * from booking";
$result= $connection->query($sql);

if(!$result){
    die("invalid query :" .$connection->error);
}


	while($row = $result->fetch_assoc()) {

		echo"  
        <tr>
		   <td> $row[id] </td>;
		  <td> $row[name] </td>;
		  <td> $row[phone] </td>;
		  <td> $row[number_people] </td>;
          <td> <a class='btn btn-primary btn-sm' href='/booking_form/edit.php? id =$row[id]'> Edit </a> 
          <a class='btn btn-danger btn-sm' href='/booking_form/delete.php? id =$row[id]'> Delete </a>
          </td>
		  </tr>
          ";
        
		}
    
?>
    </tbody>
    </table>
</body>
</html>