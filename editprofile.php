<?php

session_start();
$un=$_SESSION['name'];

if(!$un){
    header("Location:login.php");
}

if(isset($_POST['btnbtnlogout'])){
    unset($_SESSION["name"]);
    header("Location:login.php");
    die;
}

//create a connection to mysql server

$servername = "localhost";
$username = "root";
$password = "";
$conn="";

try {

    $conn = new PDO("mysql:host=$servername;dbname=mca2nd", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}

if($_POST)
{
    if(isset($_POST['cancel']))
    {
        header("Location:home.php");
    }
    if(isset($_POST['done']))
    {
        $q = "update user_details set rollno ='".$_POST['rollno']."', fname ='".$_POST['fname']."', mname ='".$_POST['mname']."', lname ='".$_POST['lname']."' where user_name = '".$un."'";
        $statement=$conn->prepare($q);
        $statement->execute();
        //echo '<script>alert("Data Successfully Altered!")</script>';
        header("Location: home.php");
        die;
    }
    
}

$q = "select * from user_details where user_name = '".$un."'";
$statement=$conn->prepare($q);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="my_css.css" rel="stylesheet">
    <title>Edit Profile</title>
</head>

<body>

    <div class="container">
        <form action='editprofile.php' method='POST'>
        <div class="row">
            <div class="col header d-flex justify-content-between">
                <h1><?php echo('welcome ') ?></h1>
                <button class='btn btn-danger' type="submit" name="btnbtnlogout">LOGOUT</button>
            </div>
        </div>

        <div class="row">
            <div class="col" style="padding: 2% 20%;">
                <div class="form-group">
                    <label>Roll Number:</label>
                    <input type="text" class="form-control" name="rollno" value="<?php echo $row['rollno'] ?>">
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $row['fname'] ?>">
                </div>
                <div class="form-group">
                    <label>Middle Name:</label>
                    <input type="text" class="form-control" name="mname" value="<?php echo $row['mname'] ?>">
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $row['lname'] ?>">
                </div>
                <div class="form-group" style="margin-top:8px;">
                    <button name="cancel" class="btn btn-outline-danger" style="float:left">CANCEL</button>
                    <button name="done" type="submit" class="btn btn-primary" style="float:right">DONE</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>

</html>