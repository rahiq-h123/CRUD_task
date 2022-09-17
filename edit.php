<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="booking_form";

$connection = new mysqli($servername,$username,$password, $dbname);

$id ="";
$name = "";
$phone = "";
$number_people = "";
$errorMessage="";
$successMessage="";


if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["id"])){
        header("location:/booking_form/read.php");
        exit;
    }
    $id= $_GET["id"];

    $sql ="SELECT * from booking where id=$id" ;
    $result= $connection->query($sql);
    $row =$result->fetch_assoc();

    if(!$row){
        header("location:/booking_form/read.php");
        exit;
    }
    $name= $row["name"];
    $phone= $row["phone"];
    $number_people= $row["number_people"];

    }
    else{
    $id= $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $number_people = $_POST['number_people'];

    do{
        if(empty($name) || empty($phone)  || empty($number_people) ){
            $errorMessage="All fields are required";
            break;
    }
    $sql ="UPDATE booking" . 
    "SET name='$name', phone='$phone', number_people='$number_people' ". 
    "WHERE id=$id";

    $result= $connection->query($sql);
    
    if(!$result){
        $errorMessage="invalid query: ". $connection->error;
        break;
    }
    $successMessage="booking updated successfully";
    header("location: /booking_form/read.php");
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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
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
