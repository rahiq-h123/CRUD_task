<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking_form";

$connection = new mysqli($servername,$username,$password, $dbname);

$name = "";
$phone = "";
$number_people = "";
$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $number_people = $_POST['number_people'];

    do{
        if(empty($name) || empty($phone)  || empty($number_people) ){
        $errorMessage="All fields are required";
        break;
    }
    $sql ="INSERT into booking(name, phone, number_people)". 
    "values('$name' , '$phone', '$number_people')";
    $result= $connection->query($sql);

    if(!$result){
        die("invalid query :" .$connection->error);
    }
        $name = "";
        $phone = "";
        $number_people = "";
        $successMessage= "Booked successfully";

        header("location:read.php");
        exit;
}
        while(false);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>new booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script> src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" </script>
</head>
<body>
    <div class="container my-5">
        <h2> New Booking <h2>
            <?php
            if(!empty($errorMessage)){
                echo" <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong> $errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>
            <form method="POST">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"> Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form_control" name="name" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"> Phone</label>
                    <div class="col-sm-6">
                        <input type="text" class="form_control" name="phone" value="<?php echo $phone; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"> Number of people</label>
                    <div class="col-sm-6">
                        <input type="text" class="form_control" name="number_people" value="<?php echo $number_people; ?>">
                    </div>
                </div>

             <?php
            if(!empty($successMessage)){
                echo" <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong> $successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
                ";
            }
            ?>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid"> 
                        <button type="submit" class="btn btn-primary"> Book</button>
                    </div>
                    
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="read.php" role="button">Cancel</a>
                    </div>
                </div>
                
            </form>
    </div>
</body>
